<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    public function paginate()
    {
        return User::paginate(15);
    }

    public function update(User $user, $validatedData)
    {
        return $user->update($validatedData);
    }

    public function delete(User $user)
    {
        return $user->delete();
    }
}
