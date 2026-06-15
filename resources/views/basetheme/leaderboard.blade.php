<x-base-layout>

    <x-hero :background="asset('images/home_bg2.png')" style="min-height: 154px" />

    <div class="leaderboard">
        <div class="container">
            <div class="row ">

                <div class="leaderboard-container">

                    <div class="glow"></div>
                    @if (!empty($currentLeaderboard))
                        @php
                            $publishAt = $currentLeaderboard->publish_at ?? null;
                            $weekStart = $currentLeaderboard->week_start_date ?? null;
                            $leaderboardTitle = trim((string) ($currentLeaderboard->title ?? ''));
                            $publishLabel = $publishAt
                                ? (is_object($publishAt)
                                    ? $publishAt->format('M j, Y g:i A')
                                    : \Carbon\Carbon::parse($publishAt)->format('M j, Y g:i A'))
                                : null;
                        @endphp
                        @if ($publishAt && strtotime($publishAt) > time())
                            <div id="countdown" class="countdown-container" role="timer" aria-live="polite">
                                <h1 class="title">LEADERBOARD REVEAL</h1>
                                <div class="countdown-timer">
                                    @foreach (['days' => 'Days', 'hours' => 'Hours', 'minutes' => 'Minutes', 'seconds' => 'Seconds'] as $id => $label)
                                        <div class="countdown-box">
                                            <div id="{{ $id }}" class="countdown-number" aria-label="{{ $label }}">00</div>
                                            <div class="countdown-label">{{ $label }}</div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="countdown-text">Until Leaderboard Reveal!</div>
                                @if ($publishLabel)
                                    <div class="countdown-meta">Reveal Time: {{ $publishLabel }}</div>
                                @endif
                            </div>
                        @else
                            <div id="leaderboard">
                                <h1 class="leaderboard-title">
                                    {{ $leaderboardTitle !== '' ? $leaderboardTitle : 'Members Of The Month' }}
                                    <span class="leaderboard-period">
                                        {{ $weekStart ? (is_object($weekStart) ? $weekStart->format('F j, Y') : \Carbon\Carbon::parse($weekStart)->format('F j, Y')) : '' }}
                                    </span>
                                </h1>
                                <p class="leaderboard-subtitle">This month\'s top contributors. Keep pushing to climb the next reveal.</p>
                                <table class="leaderboard-table" aria-label="Current leaderboard rankings">
                                    <thead>
                                        <tr>
                                            <th scope="col">Rank</th>
                                            <th scope="col">Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach (range(1, 10) as $i)
                                            @php
                                                $member = $currentLeaderboard->{'member'.$i} ?? null;
                                                $rankIcons = [1 => '🥇', 2 => '🥈', 3 => '🥉'];
                                                $rank = $rankIcons[$i] ?? "#";
                                            @endphp
                                            <tr class="{{ $i <= 3 ? 'top-rank' : '' }}">
                                                <td>{{ $rank }} {{ $i }}</td>
                                                <td>{{ $member?->name ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @else
                        <div class="no-leaderboard">
                            <h1 class="title">No Leaderboard Available</h1>
                            <p class="message">Please check back later for updates.</p>
                        </div>
                    @endif


                </div>
            </div>
        </div>
        <div id="particles-js"></div>
        <hr>
        @if(isset($leaderboards))
            <div class="leaderboards-cards">
                <div class="container">
                    <div class="row  mt-5">
                        @foreach ($leaderboards as $leaderboard)
                            <div class="col-sm-12 col-lg-4 mb-3">
                                <x-leaderboard-card :leaderboard="$leaderboard" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @section('scripts')
            <!-- Include particles.js from CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if (!empty($currentLeaderboard) && !empty($currentLeaderboard->id))
                        if(localStorage.getItem('leaderboardShown_{{ $currentLeaderboard->id }}')) {
                            // If already shown, skip celebration and keep normal page view.
                            return;
                        }
                        // Get publish timestamp from Laravel
                        const publishTimestamp = {{ strtotime($currentLeaderboard->publish_at ?? '') * 1000 }};
                        const currentTimestamp = Date.now();
                        const hasShownBefore = localStorage.getItem('leaderboardShown_{{ $currentLeaderboard->id }}');

                        // Check if already published
                        if (currentTimestamp >= publishTimestamp) {
                            // If first time viewing for this user, show celebration
                            if (!hasShownBefore) {
                                startCelebration();
                                localStorage.setItem('leaderboardShown_{{ $currentLeaderboard->id }}', 'true');
                            }
                        } else {
                            // If not published yet, start countdown
                            startCountdown(publishTimestamp);
                        }
                    @endif
                });

                function startCountdown(endTime) {
                    const timerElement = {
                        days: document.getElementById('days'),
                        hours: document.getElementById('hours'),
                        minutes: document.getElementById('minutes'),
                        seconds: document.getElementById('seconds')
                    };

                    function updateTimer() {
                        const now = Date.now();
                        const distance = endTime - now;

                        // When countdown ends
                        if (distance <= 0) {
                            clearInterval(timer);
                            window.location.reload();

                            return;
                        }

                        // Calculate time units
                        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                        // Update the display
                        if (timerElement.days && timerElement.hours && timerElement.minutes && timerElement.seconds) {
                            timerElement.days.textContent = days.toString().padStart(2, '0');
                            timerElement.hours.textContent = hours.toString().padStart(2, '0');
                            timerElement.minutes.textContent = minutes.toString().padStart(2, '0');
                            timerElement.seconds.textContent = seconds.toString().padStart(2, '0');
                        }
                    }

                    // Update immediately then set interval
                    updateTimer();
                    const timer = setInterval(updateTimer, 1000);
                }

                function startCelebration() {
                    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches || typeof particlesJS !== 'function') {
                        return;
                    }

                    // Initialize particles.js
                    particlesJS('particles-js', {
                        "particles": {
                            "number": {
                                "value": 90,
                                "density": {
                                    "enable": true,
                                    "value_area": 800
                                }
                            },
                            "color": {
                                "value": ["#ffd700", "#ff8800", "#ffcc00", "#ff4500"]
                            },
                            "shape": {
                                "type": ["circle", "triangle", "star"],
                                "stroke": {
                                    "width": 0,
                                    "color": "#000000"
                                }
                            },
                            "opacity": {
                                "value": 0.7,
                                "random": true,
                                "anim": {
                                    "enable": false,
                                    "speed": 1,
                                    "opacity_min": 0.1,
                                    "sync": false
                                }
                            },
                            "size": {
                                "value": 5,
                                "random": true,
                                "anim": {
                                    "enable": false,
                                    "speed": 40,
                                    "size_min": 0.1,
                                    "sync": false
                                }
                            },
                            "line_linked": {
                                "enable": false
                            },
                            "move": {
                                "enable": true,
                                "speed": 4,
                                "direction": "top",
                                "random": true,
                                "straight": false,
                                "out_mode": "out",
                                "bounce": false,
                                "attract": {
                                    "enable": false,
                                    "rotateX": 600,
                                    "rotateY": 1200
                                }
                            }
                        },
                        "interactivity": {
                            "detect_on": "canvas",
                            "events": {
                                "onhover": {
                                    "enable": false
                                },
                                "onclick": {
                                    "enable": false
                                },
                                "resize": true
                            }
                        },
                        "retina_detect": true
                    });

                    // Hide particles after celebration (8 seconds)
                    setTimeout(() => {
                        if (window.pJSDom && window.pJSDom.length > 0) {
                            window.pJSDom[0].pJS.fn.vendors.destroypJS();
                            window.pJSDom = [];
                        }

                        const particlesElement = document.getElementById('particles-js');
                        if (particlesElement) {
                            particlesElement.style.opacity = '0';
                            setTimeout(() => {
                                particlesElement.style.display = 'none';
                            }, 1000);
                        }
                    }, 8000);
                }
            </script>
        @endsection

</x-base-layout>
