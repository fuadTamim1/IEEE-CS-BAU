<?php

namespace App\Services;

use App\Models\ContestRegistration;
use Illuminate\Support\Facades\Log;
use Throwable;

class ContestRegistrationService
{
    public function register(array $data, string $ipAddress, string $userAgent): array
    {
        try {
            $registration = ContestRegistration::create([
                'full_name' => $data['full_name'],
                'university_id' => $data['university_id'],
                'email' => $data['email'],
                'platform_handle' => $data['platform_handle'] ?? null,
                'preferred_language' => $data['preferred_language'],
                'ip_address' => substr($ipAddress, 0, 45),
                'user_agent' => substr($userAgent, 0, 255),
                'status' => 'submitted',
            ]);

            return [
                'saved' => true,
                'registration' => $registration,
            ];
        } catch (Throwable $exception) {
            Log::error('Contest registration failed.', [
                'email' => $data['email'] ?? null,
                'university_id' => $data['university_id'] ?? null,
                'error' => $exception->getMessage(),
            ]);

            return [
                'saved' => false,
            ];
        }
    }
}
