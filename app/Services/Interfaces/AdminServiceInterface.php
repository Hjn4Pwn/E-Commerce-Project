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
    public function getAdminByEmail(string $email);
    public function resetPassword($admin, $newPassword);
    public function changePassword($admin, $currentPassword, $newPassword);
}
