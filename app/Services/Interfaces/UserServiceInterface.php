<?php

namespace App\Services\Interfaces;

use App\Models\User;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
    public function paginate();
    public function update(User $user, $validatedData);
    public function delete(User $user);
}
