<x-base-layout>

    <x-hero :background="asset('images/home_bg2.png')" style="min-height: 154px" />

    <div class="leaderboard">
        <div class="container">
            <div class="row ">

                <div class="leaderboard-container">

                    <div class="glow"></div>
                    @if ($currentLeaderboard)
                        @if (strtotime($currentLeaderboard->publish_at) > time())
                            <div id="countdown" class="countdown-container">
                                <h1 class="title">LEADERBOARD REVEAL</h1>
                                <div class="countdown-timer">
                                    <div class="countdown-box">
                                        <div id="days" class="countdown-number">00</div>
                                        <div class="countdown-label">Days</div>
                                    </div>
                                    <div class="countdown-box">
                                        <div id="hours" class="countdown-number">00</div>
                                        <div class="countdown-label">Hours</div>
                                    </div>
                                    <div class="countdown-box">
                                        <div id="minutes" class="countdown-number">00</div>
                                        <div class="countdown-label">Minutes</div>
                                    </div>
                                    <div class="countdown-box">
                                        <div id="seconds" class="countdown-number">00</div>
                                        <div class="countdown-label">Seconds</div>
                                    </div>
                                </div>
                                <div class="countdown-text">Until Leaderboard Reveal!</div>
                            </div>
                        @else
                            <div id="leaderboard">
                                <h1 class="leaderboard-title">Members Of The Month
                                    {{ $currentLeaderboard->week_start_date->format('F j, Y') }}</h1>
                                <table class="leaderboard-table">
                                    <thead>
                                        <tr>
                                            <th>Rank</th>
                                            <th>Name</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>🥇 1</td>
                                            <td>{{ $currentLeaderboard->member1->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>🥈 2</td>
                                            <td>{{ $currentLeaderboard->member2?->name }}</td>
                                        </tr>
                                        <tr>
                                            <td>🥉 3</td>
                                            <td>{{ $currentLeaderboard->member3?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td># 4</td>
                                            <td>{{ $currentLeaderboard->member4?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td># 5</td>
                                            <td>{{ $currentLeaderboard->member5?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td># 6</td>
                                            <td>{{ $currentLeaderboard->member6?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td># 7</td>
                                            <td>{{ $currentLeaderboard->member7?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td># 8</td>
                                            <td>{{ $currentLeaderboard->member8?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td># 9</td>
                                            <td>{{ $currentLeaderboard->member9?->name ?? '-' }}</td>
                                        </tr>
                                        <tr>
                                            <td># 10</td>
                                            <td>{{ $currentLeaderboard->member10?->name ?? '-' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    @endif


                </div>
            </div>
        </div>
        <div id="particles-js"></div>
        <hr>

        <div class="leaderboards-cards">
            <div class="container">
                <div class="row  mt-5">
                    <div id="topMembers" class="swiper-container">
                        <div class="swiper-wrapper">
                            @foreach ($leaderboards as $leaderboard)
                                <div class="swiper-slide">
                                    <x-leaderboard-card :leaderboard="$leaderboard" />
                                </div>
                            @endforeach
                        </div>

                        <!-- Navigation only on small devices -->
                        <div class="swiper-pagination d-lg-none"></div>
                        <div class="swiper-button-prev d-lg-none"></div>
                        <div class="swiper-button-next d-lg-none"></div>
                    </div>

                </div>
            </div>
        </div>

        @section('scripts')
            <script>
                const swiper = new Swiper('#topMembers', {
                    slidesPerView: 1,
                    spaceBetween: 20,
                    navigation: {
                        nextEl: '.swiper-button-next',
                        prevEl: '.swiper-button-prev',
                    },
                    pagination: {
                        el: '.swiper-pagination',
                        clickable: true,
                    },
                    breakpoints: {
                        768: {
                            slidesPerView: 2,
                        },
                        992: {
                            slidesPerView: 3,
                            allowTouchMove: false, // Desktop should not swipe
                        }
                    }
                });
            </script>
            <!-- Include particles.js from CDN -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Get publish timestamp from Laravel
                    const publishTimestamp = {{ strtotime($currentLeaderboard->publish_at) * 1000 }};
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
                        timerElement.days.textContent = days.toString().padStart(2, '0');
                        timerElement.hours.textContent = hours.toString().padStart(2, '0');
                        timerElement.minutes.textContent = minutes.toString().padStart(2, '0');
                        timerElement.seconds.textContent = seconds.toString().padStart(2, '0');
                    }

                    // Update immediately then set interval
                    updateTimer();
                    const timer = setInterval(updateTimer, 1000);
                }

                function startCelebration() {
                    // Initialize particles.js
                    particlesJS('particles-js', {
                        "particles": {
                            "number": {
                                "value": 150,
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
                                "speed": 6,
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
