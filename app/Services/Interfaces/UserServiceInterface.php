<?php

namespace App\Services\Interfaces;

use App\Models\User;

/**
 * Interface UserServiceInterface
 * @package App\Services\Interfaces
 */
interface UserServiceInterface
{
    public function paginateUsers();
    public function updateUser(User $user, $validatedData);
    public function deleteUser(User $user);
}
