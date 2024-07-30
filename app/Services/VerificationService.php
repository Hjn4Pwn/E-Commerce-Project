<?php

namespace App\Services;

use App\Mail\VerificationCodeMail;
use App\Models\User;
use App\Models\VerificationCode;
use App\Services\Interfaces\VerificationServiceInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

/**
 * Class VerificationService
 * @package App\Services
 */
class VerificationService implements VerificationServiceInterface
{
    public function sendVerificationCode($email, $role)
    {
        $code = Str::random(10);
        $expiresAt = Carbon::now()->addMinutes(2);

        VerificationCode::create([
            'email' => $email,
            'code' => $code,
            'role' => $role,
            'expires_at' => $expiresAt,
        ]);

        Mail::to($email)->send(new VerificationCodeMail($code));
    }

    public function validateVerificationCode($email, $code, $role)
    {
        $verificationCode = VerificationCode::where('email', $email)
            ->where('code', $code)
            ->where('role', $role)
            ->where('expires_at', '>', Carbon::now())
            ->first();

        return $verificationCode !== null;
    }

    public function emailExists(string $email, string $role): bool
    {
        $table = $role === 'admin' ? 'admins' : 'users';
        return DB::table($table)->where('email', $email)->exists();
    }
}
