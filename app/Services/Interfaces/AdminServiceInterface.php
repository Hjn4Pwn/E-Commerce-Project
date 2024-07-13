<?php

namespace App\Services\Interfaces;

/**
 * Interface AdminServiceInterface
 * @package App\Services\Interfaces
 */
interface AdminServiceInterface
{
    public function update($admin, $validatedData);
    public function getAddress();
}
