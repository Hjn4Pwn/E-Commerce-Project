<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\Flavor;
use App\Models\Product;
use App\Models\User;
use Illuminate\Console\Command;
use App\Services\Interfaces\ElasticsearchServiceInterface;

class ReindexAllModels extends Command
{
    protected $elasticsearchService;

    public function __construct(ElasticsearchServiceInterface $elasticsearchService)
    {
        parent::__construct();
        $this->elasticsearchService = $elasticsearchService;
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reindex:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Reindex all models into Elasticsearch';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->reindexModel(Product::class, 'product');
        $this->reindexModel(Flavor::class, 'flavor');
        $this->reindexModel(Category::class, 'category');
        $this->reindexModel(User::class, 'user');

        $this->info('All models reindexed successfully!');
    }

    protected function reindexModel($modelClass, $type)
    {
        $records = $modelClass::all();

        foreach ($records as $record) {
            $data = $record->toArray();
            $data['type'] = $type;
            $this->elasticsearchService->indexDocument('app_index', $record->id, $data);
        }

        $this->info("Reindexed {$modelClass} with type {$type}");
    }
}
