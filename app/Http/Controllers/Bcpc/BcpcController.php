<?php

namespace App\Http\Controllers\Bcpc;

use App\Http\Controllers\Controller;
use App\Http\Requests\Bcpc\BcpcRegistrationRequest;
use App\Models\Bcpc\BcpcRegistration;
use App\Services\Bcpc\BcpcRegistrationService;

class BcpcController extends Controller
{
    public function show()
    {
        $backgroundVideoPath = $this->resolveFirstExistingAsset([
            'IEEE/coding_bg.mp4',
            'videos/videoplayback.mp4',
            'videos/coding-loop.mp4',
            'videos/bcpc-loop.mp4',
        ]);

        $backgroundPatternPath = $this->resolveFirstExistingAsset([
            'IEEE/cs_bg.png',
            'images/cs_bg.png',
            'images/cs_bg.webp',
            'images/cs_bg.jpg',
            'images/cs_bg.jpeg',
        ]);

        $backgroundPosterPath = $this->resolveFirstExistingAsset([
            'images/home_bg2.png',
            'images/home_bg.png',
            'images/team_bg.png',
        ]);

        return view('basetheme.bcpc', [
            'contestName' => 'BCPC Newbie Teams Cup 2026',
            'contestDateIso' => '2026-07-25T09:00:00+03:00',
            'contestDayTime' => 'Saturday, 9:00 AM - 1:00 PM',
            'contestSubtitle' => 'Beginner and Newbie Teams Division',
            'mascotImage' => 'IEEE/Pixel-20250805T060422Z-1-001/Pixel/Confident.png',
            'logoImage' => 'images/IEEE-CS_LogoTM-orange.png',
            'chapterLogoImage' => 'images/logo_name_description.svg',
            'backgroundVideo' => $backgroundVideoPath,
            'backgroundPatternImage' => $backgroundPatternPath,
            'backgroundPosterImage' => $backgroundPosterPath,
        ]);
    }

    public function register(
        BcpcRegistrationRequest $request,
        BcpcRegistrationService $bcpcRegistrationService,
    ) {
        $result = $bcpcRegistrationService->register(
            $request->validated(),
            (string) $request->ip(),
            (string) $request->userAgent(),
        );

        if (!($result['saved'] ?? false)) {
            return back()
                ->withInput()
                ->with('contest_registration_error', 'Team registration could not be completed. Please try again.');
        }

        /** @var BcpcRegistration $registration */
        $registration = $result['registration'];

        return back()->with('contest_registration_success', sprintf(
            'Team registration received. Your confirmation id is #%d.',
            $registration->id,
        ));
    }

    private function resolveFirstExistingAsset(array $candidates): ?string
    {
        foreach ($candidates as $path) {
            if (file_exists(public_path($path))) {
                return $path;
            }
        }

        return null;
    }
}
