<?php

namespace App\Services;

use App\Services\Interfaces\ElasticsearchServiceInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException; // Import ClientException
use Illuminate\Support\Facades\Log;

/**
 * Class ElasticsearchService
 * @package App\Services
 */
class ElasticsearchService implements ElasticsearchServiceInterface
{
    protected $client;
    protected $host;

    public function __construct()
    {
        $this->client = new Client();
        $this->host = env('ELASTICSEARCH_HOST');
    }

    public function search($index, $type, $search)
    {
        $ids = collect();
        try {
            $response = $this->client->get("{$this->host}/{$index}/_search", [
                'json' => [
                    'query' => [
                        'bool' => [
                            'must' => [
                                ['match' => ['type' => $type]],
                                ['match' => ['name' => $search]]
                            ]
                        ]
                    ],
                    '_source' => false // Chỉ lấy _id, không lấy dữ liệu khác
                ]
            ]);

            $results = json_decode($response->getBody()->getContents(), true);

            $ids = collect($results['hits']['hits'])->pluck('_id');
        } catch (ClientException $e) {
            if ($e->getResponse()->getStatusCode() == 404) {
                Log::error("Elasticsearch index [{$index}] not found: " . $e->getMessage());
            } else {
                throw $e;
            }
        }

        return $ids;
    }

    public function syncModel($model, $type)
    {
        $data = [
            'id' => $model->id,
            'name' => $model->name,
            'type' => $type
        ];
        $this->indexDocument('app_index', $model->id, $data);
    }

    public function deleteDocument($index, $id)
    {
        try {
            $response = $this->client->delete("{$this->host}/{$index}/_doc/{$id}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            Log::error("Failed to delete document from Elasticsearch index [{$index}]: " . $e->getMessage());
            throw $e;
        }
    }

    public function indexDocument($index, $id, $data)
    {
        try {
            $response = $this->client->post("{$this->host}/{$index}/_doc/{$id}", [
                'json' => $data
            ]);

            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            Log::error("Failed to index document in Elasticsearch [{$index}]: " . $e->getMessage());
            throw $e;
        }
    }

    public function deleteIndex($index)
    {
        try {
            $response = $this->client->delete("{$this->host}/{$index}");
            return json_decode($response->getBody()->getContents(), true);
        } catch (ClientException $e) {
            Log::error("Failed to delete Elasticsearch index [{$index}]: " . $e->getMessage());
            throw $e;
        }
    }

    public function removeModel($model)
    {
        $this->deleteDocument('app_index', $model->id);
    }
}
