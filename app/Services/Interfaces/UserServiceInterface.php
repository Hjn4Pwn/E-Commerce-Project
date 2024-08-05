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
    public function changePassword($user, $currentPassword, $newPassword);
    public function resetPassword($user, $newPassword);
    public function getUserByEmail(string $email);
    public function findOrCreateUser($facebookUser, $provider);
}
