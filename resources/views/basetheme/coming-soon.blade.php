<style>
    body {
        background: linear-gradient(135deg, #000000 0%, #1a1a1a 50%, #000000 100%);
        min-height: 100vh;
        font-family: 'Arial', sans-serif;
        overflow-x: hidden;
        overflow-y: hidden;
    }

    .coming-soon-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }

    .floating-particles {
        position: absolute;
        width: 100%;
        height: 100%;
        overflow: hidden;
        top: 0;
        left: 0;
        z-index: 1;
    }

    .particle {
        position: absolute;
        background: linear-gradient(45deg, #FFD700, #FFA500, #FFFF00);
        border-radius: 50%;
        animation: float 6s ease-in-out infinite;
        opacity: 0.7;
    }

    .particle:nth-child(1) {
        width: 10px;
        height: 10px;
        left: 10%;
        animation-delay: 0s;
        animation-duration: 8s;
    }

    .particle:nth-child(2) {
        width: 6px;
        height: 6px;
        left: 20%;
        animation-delay: 2s;
        animation-duration: 6s;
    }

    .particle:nth-child(3) {
        width: 8px;
        height: 8px;
        left: 80%;
        animation-delay: 4s;
        animation-duration: 10s;
    }

    .particle:nth-child(4) {
        width: 12px;
        height: 12px;
        left: 70%;
        animation-delay: 1s;
        animation-duration: 7s;
    }

    .particle:nth-child(5) {
        width: 5px;
        height: 5px;
        left: 60%;
        animation-delay: 3s;
        animation-duration: 9s;
    }

    @keyframes float {
        0%, 100% {
            transform: translateY(100vh) rotate(0deg);
            opacity: 0;
        }
        10% {
            opacity: 0.7;
        }
        90% {
            opacity: 0.7;
        }
        50% {
            transform: translateY(-10vh) rotate(180deg);
            opacity: 1;
        }
    }

    .main-content {
        text-align: center;
        z-index: 10;
        position: relative;
        animation: fadeInUp 1s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(50px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .logo-container {
        margin-bottom: 3rem;
        animation: pulse 2s ease-in-out infinite;
    }

    @keyframes pulse {
        0%, 100% {
            transform: scale(1);
        }
        50% {
            transform: scale(1.05);
        }
    }

    .gear-icon {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FFFF00 100%);
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto;
        box-shadow: 0 10px 30px rgba(255, 215, 0, 0.3);
        animation: rotate 4s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    .gear-icon i {
        font-size: 3rem;
        color: #000;
    }

    .main-title {
        font-size: 4rem;
        font-weight: bold;
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 50%, #FFFF00 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 1rem;
        text-shadow: 0 0 30px rgba(255, 215, 0, 0.5);
        animation: glow 2s ease-in-out infinite alternate;
    }

    @keyframes glow {
        from {
            filter: brightness(1);
        }
        to {
            filter: brightness(1.2);
        }
    }

    .subtitle {
        font-size: 1.5rem;
        color: #FFA500;
        margin-bottom: 2rem;
        opacity: 0.9;
    }

    .description {
        font-size: 1.1rem;
        color: #CCCCCC;
        margin-bottom: 3rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.6;
    }

    .btn-back {
        background: linear-gradient(135deg, #FFD700 0%, #FFA500 100%);
        border: none;
        color: #000;
        font-weight: bold;
        font-size: 1.2rem;
        padding: 15px 40px;
        border-radius: 50px;
        text-decoration: none;
        display: inline-block;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(255, 215, 0, 0.4);
        position: relative;
        overflow: hidden;
    }

    .btn-back:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(255, 215, 0, 0.6);
        color: #000;
        text-decoration: none;
    }

    .btn-back::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s;
    }

    .btn-back:hover::before {
        left: 100%;
    }

    .countdown-container {
        margin-top: 3rem;
        animation: fadeIn 2s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .countdown-flex {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    .countdown-box {
        background: rgba(255, 215, 0, 0.1);
        border: 2px solid #FFD700;
        border-radius: 15px;
        padding: 20px;
        margin: 0 10px;
        backdrop-filter: blur(10px);
        transition: transform 0.3s ease;
    }

    .countdown-box:hover {
        transform: scale(1.05);
    }

    .countdown-number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #FFD700;
        display: block;
    }

    .countdown-label {
        font-size: 0.9rem;
        color: #FFA500;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    @media (max-width: 768px) {
        .main-title {
            font-size: 2.5rem;
        }
        
        .subtitle {
            font-size: 1.2rem;
        }
        
        .gear-icon {
            width: 80px;
            height: 80px;
        }
        
        .gear-icon i {
            font-size: 2rem;
        }
        
        .countdown-box {
            margin: 5px;
            padding: 15px;
        }
        
        .countdown-number {
            font-size: 2rem;
        }

        .countdown-flex {
            flex-direction: column;
            gap: 10px;
            align-items: stretch;
        }
    }
</style>

<div class="coming-soon-container">
    <!-- Floating Particles -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <div class="container">
        <div class="main-content">
            <!-- Logo/Icon -->
            <div class="logo-container">
                <div class="gear-icon">
                    <i class="fas fa-cog"></i>
                </div>
            </div>

            <!-- Main Title -->
            <h1 class="main-title">Coming Soon</h1>
            
            <!-- Subtitle -->
            <p class="subtitle">Something Amazing is on the Way!</p>
            
            <!-- Description -->
            <p class="description">
                We're working hard to bring you an incredible experience. 
                Our team is putting the finishing touches on something special that will exceed your expectations. 
                Stay tuned for the big reveal!
            </p>

            <!-- Countdown Timer -->
            {{-- <div class="countdown-container mb-5">
                <div class="countdown-flex">
                    <div class="countdown-box text-center">
                        <span class="countdown-number" id="days">00</span>
                        <span class="countdown-label">Days</span>
                    </div>
                    <div class="countdown-box text-center">
                        <span class="countdown-number" id="hours">00</span>
                        <span class="countdown-label">Hours</span>
                    </div>
                    <div class="countdown-box text-center">
                        <span class="countdown-number" id="minutes">00</span>
                        <span class="countdown-label">Minutes</span>
                    </div>
                    <div class="countdown-box text-center">
                        <span class="countdown-number" id="seconds">00</span>
                        <span class="countdown-label">Seconds</span>
                    </div>
                </div>
            </div> --}}

            <!-- Back Button -->
            <div class="mt-5" style="margin: 2rem 0;">
                <a href="{{ url()->previous() }}" class="btn-back">
                    <i class="fas fa-arrow-left me-2"></i>
                    Go Back
                </a>
            </div>
        </div>
    </div>
</div>

<script>
// // Countdown Timer
// function updateCountdown() {
//     // Set the date we're counting down to (30 days from now)
//     const countDownDate = new Date().getTime() + (30 * 24 * 60 * 60 * 1000);
    
//     // Update the count down every 1 second
//     const timer = setInterval(function() {
//         const now = new Date().getTime();
//         const distance = countDownDate - now;
        
//         // Time calculations for days, hours, minutes and seconds
//         const days = Math.floor(distance / (1000 * 60 * 60 * 24));
//         const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
//         const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
//         const seconds = Math.floor((distance % (1000 * 60)) / 1000);
        
//         // Display the result
//         document.getElementById("days").innerHTML = days.toString().padStart(2, '0');
//         document.getElementById("hours").innerHTML = hours.toString().padStart(2, '0');
//         document.getElementById("minutes").innerHTML = minutes.toString().padStart(2, '0');
//         document.getElementById("seconds").innerHTML = seconds.toString().padStart(2, '0');
        
//         // If the count down is finished, write some text
//         if (distance < 0) {
//             clearInterval(timer);
//             document.getElementById("days").innerHTML = "00";
//             document.getElementById("hours").innerHTML = "00";
//             document.getElementById("minutes").innerHTML = "00";
//             document.getElementById("seconds").innerHTML = "00";
//         }
//     }, 1000);
// }

// // Initialize countdown when page loads
// document.addEventListener('DOMContentLoaded', function() {
//     updateCountdown();
// });

// Add some interactive particles on mouse move
// document.addEventListener('mousemove', function(e) {
//     const particle = document.createElement('div');
//     particle.className = 'particle';
//     particle.style.left = e.clientX + 'px';
//     particle.style.top = e.clientY + 'px';
//     particle.style.width = '4px';
//     particle.style.height = '4px';
//     particle.style.position = 'fixed';
//     particle.style.pointerEvents = 'none';
//     particle.style.zIndex = '5';
    
//     document.body.appendChild(particle);
    
//     setTimeout(() => {
//         particle.remove();
//     }, 1000);
// });
</script>

<!-- Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">