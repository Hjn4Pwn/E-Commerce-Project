<?php

namespace App\Services\Interfaces;

/**
 * Interface ElasticsearchServiceInterface
 * @package App\Services\Interfaces
 */
interface ElasticsearchServiceInterface
{
    public function search($index, $type, $search);
    public function indexDocument($index, $id, $data);
    public function deleteDocument($index, $id);
    public function syncModel($model, $type);
    public function removeModel($model);
    public function deleteIndex($index);
}
