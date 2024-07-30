<?php

namespace App\Services\Interfaces;

/**
 * Interface VerificationServiceInterface
 * @package App\Services\Interfaces
 */
interface VerificationServiceInterface
{
    public function sendVerificationCode($email, $role);
    public function validateVerificationCode($email, $code, $role);
    public function emailExists(string $email, string $role);
}
