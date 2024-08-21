<?php

namespace App\Services;

use App\Services\Interfaces\UserServiceInterface;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\ElasticsearchServiceInterface;
use App\Services\Interfaces\ReviewServiceInterface;

/**
 * Class UserService
 * @package App\Services
 */
class UserService implements UserServiceInterface
{
    protected $elasticsearchService;
    protected $reviewService;

    public function __construct(
        ElasticsearchServiceInterface $elasticsearchService,
        ReviewServiceInterface $reviewService,
    ) {
        $this->elasticsearchService = $elasticsearchService;
        $this->reviewService = $reviewService;
    }

    public function paginateUsers($search = null)
    {
        $query = User::query();

        if ($search) {
            $userIds = $this->elasticsearchService->search('app_index', 'user', $search);
            $query->whereIn('id', $userIds);
        }

        $query->with(['province', 'district', 'ward']);
        $users = $query->paginate(15);

        return $users;
    }

    public function updateUser(User $user, $validatedData)
    {
        return $user->update($validatedData);
    }

    public function deleteUser(User $user)
    {
        $user->reviews()->each(function ($review) {
            $this->reviewService->deleteReview($review);
        });
        return $user->delete();
    }

    public function changePassword($user, $currentPassword, $newPassword)
    {
        if (!Hash::check($currentPassword, $user->password)) {
            return [
                'status' => 'error',
                'field' => 'current_password',
                'message' => 'Mật khẩu cũ không đúng.',
            ];
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return ['status' => 'success'];
    }

    public function resetPassword($user, $newPassword)
    {
        $user->password = Hash::make($newPassword);
        $user->save();

        return ['status' => 'success'];
    }

    public function getUserByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function findOrCreateUser($providerUser, $provider)
    {
        $authUser = User::where('email', $providerUser->getEmail())->first();

        if ($authUser) {
            if (is_null($authUser->provider)) {
                throw ValidationException::withMessages([
                    'email' => 'Email này đã tồn tại trong hệ thống và không thể đăng nhập bằng ' . $provider . '.',
                ]);
            }

            $authUser->update([
                'provider' => $provider,
                'provider_id' => $providerUser->getId(),
            ]);
            return $authUser;
        }
        return User::create([
            'name' => $providerUser->name,
            'email' => $providerUser->email,
            'provider' => $provider,
            'provider_id' => $providerUser->id,
        ]);
    }
}
