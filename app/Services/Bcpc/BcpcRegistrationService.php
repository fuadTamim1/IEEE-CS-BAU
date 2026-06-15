<?php

namespace App\Services\Bcpc;

use App\Models\Bcpc\BcpcRegistration;
use Illuminate\Support\Facades\Log;
use Throwable;

class BcpcRegistrationService
{
    public function register(array $data, string $ipAddress, string $userAgent): array
    {
        try {
            $registration = BcpcRegistration::create([
                'team_name' => $data['team_name'],
                'captain_name' => $data['captain_name'],
                'captain_university_id' => $data['captain_university_id'],
                'captain_email' => $data['captain_email'],
                'team_size' => (int) $data['team_size'],
                'member_two_name' => $data['member_two_name'],
                'member_three_name' => $data['member_three_name'] ?? null,
                'full_name' => $data['captain_name'],
                'university_id' => $data['captain_university_id'],
                'email' => $data['captain_email'],
                'platform_handle' => null,
                'preferred_language' => 'N/A',
                'ip_address' => substr($ipAddress, 0, 45),
                'user_agent' => substr($userAgent, 0, 255),
                'status' => 'submitted',
            ]);

            return [
                'saved' => true,
                'registration' => $registration,
            ];
        } catch (Throwable $exception) {
            Log::error('BCPC registration failed.', [
                'captain_email' => $data['captain_email'] ?? null,
                'captain_university_id' => $data['captain_university_id'] ?? null,
                'team_name' => $data['team_name'] ?? null,
                'error' => $exception->getMessage(),
            ]);

            return [
                'saved' => false,
            ];
        }
    }
}
