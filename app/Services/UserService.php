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
    public function paginate($search = null)
    {
        $query = User::query();

        if ($search) {
            $userIds = User::search($search)
                ->where('type', 'user')
                ->get()
                ->pluck('id');

            $query->whereIn('id', $userIds);
        }

        $query->with(['province', 'district', 'ward']);
        $users = $query->paginate(15);

        return $users;
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
