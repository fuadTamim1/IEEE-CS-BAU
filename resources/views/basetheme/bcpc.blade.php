<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $contestName }} | IEEE CS BAU</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500;700;900&family=JetBrains+Mono:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-dark: #070707;
            --bg-panel: #121212;
            --bg-soft: #1a1a1a;
            --text-main: #fff4dc;
            --text-soft: #d2be93;
            --line: rgba(255, 201, 79, 0.28);
            --yellow: #ffd24f;
            --orange: #ff952f;
            --orange-strong: #ff6f00;
            --good: #98ffc0;
            --danger: #ff9b82;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: var(--bg-dark);
            color: var(--text-main);
            scroll-behavior: smooth;
        }

        body {
            font-family: 'JetBrains Mono', monospace;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .boot-screen {
            position: fixed;
            inset: 0;
            background: radial-gradient(circle at 80% 0%, rgba(255, 149, 47, 0.16), transparent 48%), #050505;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.65s ease, visibility 0.65s ease;
        }

        .boot-screen.hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .boot-box {
            width: min(760px, 92vw);
            border: 1px solid rgba(255, 149, 47, 0.32);
            border-radius: 14px;
            overflow: hidden;
            background: #0e0e0e;
            box-shadow: 0 30px 60px rgba(0, 0, 0, 0.45);
        }

        .boot-head {
            padding: 0.68rem 0.9rem;
            border-bottom: 1px solid rgba(255, 149, 47, 0.24);
            display: flex;
            align-items: center;
            gap: 0.45rem;
            background: #151515;
            color: #ffd992;
            font-size: 0.78rem;
        }

        .dot {
            width: 10px;
            height: 10px;
            border-radius: 999px;
            display: inline-block;
        }

        .dot.red {
            background: #ff5c57;
        }

        .dot.yellow {
            background: #febc2e;
        }

        .dot.green {
            background: #28c840;
        }

        #bootLog {
            margin: 0;
            padding: 1rem;
            min-height: 180px;
            max-height: 45vh;
            overflow: auto;
            white-space: pre-wrap;
            color: #ffe4a6;
            font-size: 0.86rem;
            line-height: 1.55;
        }

        .boot-progress {
            margin: 0 1rem 1rem;
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 210, 79, 0.2);
            overflow: hidden;
        }

        .boot-progress span {
            display: block;
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, var(--yellow), var(--orange));
            transition: width 0.25s ease;
        }

        .page {
            min-height: 100vh;
            padding: 1.5rem 0 4rem;
            background:
                radial-gradient(circle at 8% 0%, rgba(255, 210, 79, 0.09), transparent 40%),
                radial-gradient(circle at 88% 10%, rgba(255, 111, 0, 0.13), transparent 46%),
                linear-gradient(165deg, #050505 0%, #101010 45%, #050505 100%);
            position: relative;
            overflow: hidden;
        }

        .page::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(255, 210, 79, 0.06) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 210, 79, 0.06) 1px, transparent 1px);
            background-size: 40px 40px;
            pointer-events: none;
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.75), transparent 88%);
        }

        .container {
            width: min(1150px, 92vw);
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        .topbar .left,
        .topbar .right {
            display: flex;
            align-items: center;
            gap: 0.6rem;
        }

        .chip-link {
            text-decoration: none;
            color: #ffd88f;
            border: 1px solid rgba(255, 210, 79, 0.3);
            border-radius: 999px;
            padding: 0.42rem 0.78rem;
            background: rgba(255, 210, 79, 0.08);
            font-size: 0.74rem;
            transition: transform 0.2s ease, background 0.2s ease;
        }

        .chip-link:hover {
            transform: translateY(-2px);
            background: rgba(255, 210, 79, 0.16);
        }

        .stack {
            display: grid;
            gap: 1rem;
        }

        .panel {
            background: linear-gradient(160deg, rgba(20, 20, 20, 0.95), rgba(10, 10, 10, 0.96));
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.25rem;
            box-shadow: 0 22px 44px rgba(0, 0, 0, 0.4);
            opacity: 0;
            transform: translateY(20px);
            transition: transform 0.55s ease, opacity 0.55s ease, border-color 0.3s ease;
        }

        .panel.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .panel:hover {
            border-color: rgba(255, 210, 79, 0.52);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.15fr 0.85fr;
            gap: 1rem;
            align-items: center;
        }

        .hero h1,
        h2,
        h3 {
            margin-top: 0;
            margin-bottom: 0.64rem;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 0.02em;
        }

        .hero h1 {
            font-size: clamp(1.8rem, 3.6vw, 3rem);
            line-height: 1.12;
        }

        h2 {
            font-size: clamp(1.25rem, 2.3vw, 1.95rem);
        }

        .eyebrow {
            margin: 0;
            color: #ffd88f;
            font-size: 0.78rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .lead,
        .soft {
            margin: 0;
            color: var(--text-soft);
            line-height: 1.65;
        }

        .hero-actions {
            margin-top: 1rem;
            display: flex;
            flex-wrap: wrap;
            gap: 0.62rem;
        }

        .btn {
            border: 1px solid transparent;
            border-radius: 10px;
            padding: 0.7rem 1.02rem;
            text-decoration: none;
            font-family: inherit;
            font-size: 0.8rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            cursor: pointer;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn.primary {
            background: linear-gradient(120deg, var(--yellow), var(--orange));
            color: #1a1a1a;
            box-shadow: 0 12px 22px rgba(255, 149, 47, 0.32);
        }

        .btn.ghost {
            color: #ffd88f;
            border-color: rgba(255, 210, 79, 0.36);
            background: rgba(255, 210, 79, 0.08);
        }

        .hero-brand {
            display: grid;
            gap: 0.8rem;
            justify-items: center;
            text-align: center;
        }

        .hero-brand .mascot {
            width: clamp(140px, 22vw, 210px);
            filter: drop-shadow(0 10px 22px rgba(255, 149, 47, 0.35));
            animation: mascotFloat 3.8s ease-in-out infinite;
        }

        @keyframes mascotFloat {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .hero-brand .logos {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            flex-wrap: wrap;
        }

        .hero-brand .logos img.logo-round {
            width: 70px;
            height: 70px;
            object-fit: contain;
            border-radius: 999px;
            border: 1px solid rgba(255, 210, 79, 0.28);
            background: #0f0f0f;
            padding: 0.35rem;
        }

        .hero-brand .logos img.logo-wide {
            width: min(300px, 70vw);
            max-height: 70px;
            object-fit: contain;
            border-radius: 10px;
            border: 1px solid rgba(255, 210, 79, 0.24);
            background: #111;
            padding: 0.55rem;
        }

        .section-head {
            margin-bottom: 0.8rem;
        }

        .tag {
            margin: 0;
            color: #ffc262;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            font-size: 0.76rem;
        }

        .detail-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.76rem;
        }

        .detail-card {
            border: 1px solid rgba(255, 210, 79, 0.22);
            border-radius: 12px;
            background: rgba(255, 210, 79, 0.04);
            padding: 0.72rem;
        }

        .detail-card h3 {
            margin-bottom: 0.36rem;
            color: #ffd88f;
            font-size: 0.9rem;
        }

        .timeline {
            margin-top: 0.76rem;
            border: 1px solid rgba(255, 210, 79, 0.22);
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.35);
            overflow: hidden;
        }

        .line {
            display: grid;
            grid-template-columns: 6rem 1fr;
            gap: 0.8rem;
            padding: 0.58rem 0.8rem;
            border-bottom: 1px dashed rgba(255, 210, 79, 0.2);
            color: #ffe0ad;
            font-size: 0.83rem;
        }

        .line:last-child {
            border-bottom: 0;
        }

        .line .tm {
            color: var(--yellow);
        }

        .badges {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-top: 0.7rem;
        }

        .badge {
            border: 1px solid rgba(255, 149, 47, 0.34);
            border-radius: 999px;
            padding: 0.34rem 0.64rem;
            color: #ffce79;
            background: rgba(255, 149, 47, 0.12);
            font-size: 0.74rem;
        }

        .sponsor-row {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.76rem;
            margin-top: 0.78rem;
        }

        .sponsor-card {
            border: 1px solid rgba(255, 210, 79, 0.2);
            border-radius: 12px;
            background: rgba(255, 210, 79, 0.03);
            padding: 0.76rem;
            text-align: center;
        }

        .sponsor-card img {
            max-width: 100%;
            max-height: 64px;
            object-fit: contain;
            margin-bottom: 0.5rem;
        }

        .alert {
            border-radius: 10px;
            padding: 0.67rem 0.82rem;
            margin-bottom: 0.85rem;
            font-size: 0.79rem;
        }

        .alert.success {
            border: 1px solid rgba(152, 255, 192, 0.35);
            background: rgba(22, 57, 36, 0.45);
            color: #b7f6cf;
        }

        .alert.error {
            border: 1px solid rgba(255, 155, 130, 0.4);
            background: rgba(64, 27, 22, 0.5);
            color: #ffc8ba;
        }

        .modal {
            position: fixed;
            inset: 0;
            background: rgba(4, 4, 4, 0.78);
            backdrop-filter: blur(3px);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transition: opacity 0.28s ease, visibility 0.28s ease;
        }

        .modal.open {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
        }

        .modal-card {
            width: min(820px, 96vw);
            max-height: 90vh;
            overflow: auto;
            border: 1px solid rgba(255, 210, 79, 0.3);
            border-radius: 14px;
            background: linear-gradient(170deg, #161616, #0f0f0f);
            box-shadow: 0 32px 56px rgba(0, 0, 0, 0.44);
            transform: translateY(12px) scale(0.98);
            transition: transform 0.28s ease;
        }

        .modal.open .modal-card {
            transform: translateY(0) scale(1);
        }

        .modal-head {
            position: sticky;
            top: 0;
            z-index: 2;
            background: #171717;
            border-bottom: 1px solid rgba(255, 210, 79, 0.22);
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.8rem;
            padding: 0.82rem 0.95rem;
        }

        .modal-head h3 {
            margin: 0;
            font-size: 1rem;
            color: #ffe2a8;
        }

        .close-btn {
            border: 1px solid rgba(255, 210, 79, 0.32);
            background: rgba(255, 210, 79, 0.08);
            color: #ffd88f;
            border-radius: 8px;
            width: 34px;
            height: 34px;
            font-size: 1rem;
            cursor: pointer;
        }

        .modal-body {
            padding: 0.95rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.75rem;
        }

        .field {
            display: grid;
            gap: 0.3rem;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        .field label {
            color: #ffd88f;
            font-size: 0.79rem;
        }

        .field input,
        .field select {
            width: 100%;
            border: 1px solid rgba(255, 210, 79, 0.28);
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.42);
            color: #fff0cf;
            padding: 0.66rem 0.72rem;
            font-size: 0.9rem;
            font-family: inherit;
        }

        .field input:focus,
        .field select:focus {
            outline: none;
            border-color: rgba(255, 149, 47, 0.72);
            box-shadow: 0 0 0 3px rgba(255, 149, 47, 0.16);
        }

        .error-text {
            margin: 0;
            color: #ffbba9;
            font-size: 0.74rem;
        }

        .form-actions {
            margin-top: 1rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.72rem;
        }

        .form-actions p {
            margin: 0;
            color: var(--text-soft);
            font-size: 0.77rem;
        }

        .form-actions a {
            color: #ffd88f;
        }

        .hidden-field {
            display: none;
        }

        .faq {
            display: grid;
            gap: 0.5rem;
        }

        .faq-item {
            border: 1px solid rgba(255, 210, 79, 0.22);
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.3);
            overflow: hidden;
        }

        .faq-trigger {
            width: 100%;
            border: 0;
            background: transparent;
            color: #ffe4b4;
            text-align: left;
            padding: 0.76rem 0.88rem;
            font-family: inherit;
            font-size: 0.82rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
        }

        .faq-trigger .icon {
            color: #ffcb64;
            transition: transform 0.24s ease;
        }

        .faq-trigger[aria-expanded='true'] .icon {
            transform: rotate(45deg);
        }

        .faq-panel {
            padding: 0 0.88rem 0.82rem;
            color: var(--text-soft);
            font-size: 0.8rem;
            line-height: 1.6;
        }

        .footer {
            margin-top: 0.9rem;
            text-align: center;
            color: #9f8960;
            font-size: 0.72rem;
        }

        .honeypot {
            position: absolute;
            left: -9999px;
            top: -9999px;
            opacity: 0;
            pointer-events: none;
        }

        @media (max-width: 1024px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .detail-grid,
            .sponsor-row,
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .topbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .line {
                grid-template-columns: 1fr;
                gap: 0.2rem;
            }
        }
    </style>
</head>

<body>
    <div class="boot-screen" id="bootScreen" aria-hidden="true">
        <div class="boot-box">
            <div class="boot-head">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
                <span>bcpc://bootstrap</span>
            </div>
            <pre id="bootLog"></pre>
            <div class="boot-progress"><span id="bootProgress"></span></div>
        </div>
    </div>

    <main class="page" data-launch-at="{{ $contestDateIso }}">
        <div class="container">
            <div class="topbar">
                <div class="left">
                    <a class="chip-link" href="{{ route('home') }}">Back To Home</a>
                    <a class="chip-link" href="#details">Competition Details</a>
                </div>
                <div class="right">
                    <button class="chip-link" type="button" id="openRegistrationTop">Register Team</button>
                </div>
            </div>

            @if (session('contest_registration_success'))
                <div class="alert success">{{ session('contest_registration_success') }}</div>
            @endif

            @if (session('contest_registration_error'))
                <div class="alert error">{{ session('contest_registration_error') }}</div>
            @endif

            <div class="stack">
                <section class="panel hero">
                    <div>
                        <p class="eyebrow">$ bcpc --division newbies</p>
                        <h1>{{ $contestName }}</h1>
                        <p class="lead">{{ $contestSubtitle }}</p>
                        <p class="lead" style="margin-top: 0.6rem;">A team-based competitive programming contest built for beginner and newbie coders to learn, solve, and compete together.</p>

                        <div class="hero-actions">
                            <button class="btn primary" id="openRegistrationHero" type="button">Register Your Team</button>
                            <a class="btn ghost" href="#details">See Schedule</a>
                        </div>
                    </div>

                    <div class="hero-brand">
                        <img class="mascot" src="{{ asset($mascotImage) }}" alt="Pixel mascot">
                        <div class="logos">
                            <img class="logo-round" src="{{ asset($logoImage) }}" alt="IEEE CS logo">
                            <img class="logo-wide" src="{{ asset($chapterLogoImage) }}" alt="IEEE Computer Society BAU">
                        </div>
                    </div>
                </section>

                <section class="panel" id="details">
                    <div class="section-head">
                        <p class="tag">Competition Details</p>
                        <h2>BCPC Newbie Teams Cup</h2>
                    </div>

                    <div class="detail-grid">
                        <article class="detail-card">
                            <h3>Format</h3>
                            <p class="soft">Team-based onsite programming contest for beginner and newbie teams.</p>
                        </article>
                        <article class="detail-card">
                            <h3>Date and Time</h3>
                            <p class="soft">{{ $contestDayTime }}</p>
                        </article>
                        <article class="detail-card">
                            <h3>Team Size</h3>
                            <p class="soft">Teams of 2 or 3 students.</p>
                        </article>
                    </div>

                    <div class="timeline">
                        <div class="line"><span class="tm">09:00 AM</span><span>Opening and team check-in</span></div>
                        <div class="line"><span class="tm">09:20 AM</span><span>Rules briefing and warmup</span></div>
                        <div class="line"><span class="tm">09:40 AM</span><span>Contest start</span></div>
                        <div class="line"><span class="tm">12:40 PM</span><span>Final submission window</span></div>
                        <div class="line"><span class="tm">01:00 PM</span><span>Closing and announcement</span></div>
                    </div>

                    <div class="badges">
                        <span class="badge">Certificates For All Qualified Teams</span>
                        <span class="badge">Winner Certificates</span>
                        <span class="badge">Sponsor Gifts</span>
                    </div>
                </section>

                <section class="panel">
                    <div class="section-head">
                        <p class="tag">Certificates and Sponsors</p>
                        <h2>Recognition and Support</h2>
                    </div>

                    <p class="soft">All qualifying teams receive participation certificates, top teams receive winner certificates, and our sponsors support prizes and logistics.</p>

                    <div class="sponsor-row">
                        <article class="sponsor-card">
                            <img src="{{ asset($logoImage) }}" alt="IEEE CS">
                            <p class="soft">Organized by IEEE Computer Society BAU Chapter.</p>
                        </article>
                        <article class="sponsor-card">
                            <img src="{{ asset($chapterLogoImage) }}" alt="IEEE CS BAU">
                            <p class="soft">Academic and community support partner.</p>
                        </article>
                        <article class="sponsor-card">
                            <img src="{{ asset('images/logo.png') }}" alt="Chapter mark">
                            <p class="soft">Additional sponsor slots available.</p>
                        </article>
                    </div>
                </section>

                <section class="panel">
                    <div class="section-head">
                        <p class="tag">Knowledge Base</p>
                        <h2>FAQ</h2>
                    </div>

                    <div class="faq" data-accordion>
                        <article class="faq-item">
                            <button class="faq-trigger" type="button" aria-expanded="true" aria-controls="faq-a">
                                <span>Can we register as a team of two?</span>
                                <span class="icon">+</span>
                            </button>
                            <div class="faq-panel" id="faq-a">Yes. Team size can be either 2 or 3 students.</div>
                        </article>
                        <article class="faq-item">
                            <button class="faq-trigger" type="button" aria-expanded="false" aria-controls="faq-b">
                                <span>Will we receive certificates?</span>
                                <span class="icon">+</span>
                            </button>
                            <div class="faq-panel" id="faq-b" hidden>Yes. Certificates are provided based on participation and final ranking criteria.</div>
                        </article>
                        <article class="faq-item">
                            <button class="faq-trigger" type="button" aria-expanded="false" aria-controls="faq-c">
                                <span>Can beginner teams join?</span>
                                <span class="icon">+</span>
                            </button>
                            <div class="faq-panel" id="faq-c" hidden>Yes. This division is specifically designed for beginner and newbie teams.</div>
                        </article>
                    </div>
                </section>
            </div>

            <p class="footer">BCPC Newbie Teams Cup 2026 | IEEE CS BAU Chapter</p>
        </div>
    </main>

    <div class="modal" id="registrationModal" aria-hidden="true">
        <div class="modal-card" role="dialog" aria-modal="true" aria-labelledby="registrationTitle">
            <div class="modal-head">
                <h3 id="registrationTitle">Team Registration</h3>
                <button type="button" class="close-btn" id="closeRegistration" aria-label="Close registration">x</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('bcpc.register') }}" novalidate>
                    @csrf

                    <div class="honeypot" aria-hidden="true">
                        <label for="website">Website</label>
                        <input id="website" name="website" type="text" tabindex="-1" autocomplete="off" value="{{ old('website') }}">
                    </div>

                    <div class="form-grid">
                        <div class="field full">
                            <label for="team_name">Team Name</label>
                            <input id="team_name" name="team_name" type="text" value="{{ old('team_name') }}" required>
                            @error('team_name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="captain_name">Captain Full Name</label>
                            <input id="captain_name" name="captain_name" type="text" value="{{ old('captain_name') }}" required>
                            @error('captain_name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="captain_university_id">Captain University ID</label>
                            <input id="captain_university_id" name="captain_university_id" type="text" value="{{ old('captain_university_id') }}" required>
                            @error('captain_university_id')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="captain_email">Captain Email</label>
                            <input id="captain_email" name="captain_email" type="email" value="{{ old('captain_email') }}" required>
                            @error('captain_email')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="team_size">Team Size</label>
                            <select id="team_size" name="team_size" required>
                                <option value="">Select team size</option>
                                <option value="2" @selected(old('team_size') == 2)>2 Members</option>
                                <option value="3" @selected(old('team_size') == 3)>3 Members</option>
                            </select>
                            @error('team_size')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field">
                            <label for="member_two_name">Member 2 Full Name</label>
                            <input id="member_two_name" name="member_two_name" type="text" value="{{ old('member_two_name') }}" required>
                            @error('member_two_name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="field full" id="memberThreeField">
                            <label for="member_three_name">Member 3 Full Name</label>
                            <input id="member_three_name" name="member_three_name" type="text" value="{{ old('member_three_name') }}">
                            @error('member_three_name')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="form-actions">
                        <button class="btn primary" type="submit">Submit Team</button>
                        <p>By submitting, you agree to the <a href="{{ route('privacy-policy') }}">privacy policy</a>.</p>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function() {
            var bootScreen = document.getElementById('bootScreen');
            var bootLog = document.getElementById('bootLog');
            var bootProgress = document.getElementById('bootProgress');
            var lines = [
                '[init] loading BCPC newbie module',
                '[ok] team registration endpoint online',
                '[ok] schedule loaded: Saturday 09:00 - 13:00',
                '[ok] certificate pipeline ready',
                '[ok] sponsor section initialized',
                '[ready] welcome to BCPC Newbie Teams Cup'
            ];
            var index = 0;

            var timer = setInterval(function() {
                if (index >= lines.length) {
                    clearInterval(timer);
                    setTimeout(function() {
                        bootScreen.classList.add('hidden');
                    }, 260);
                    return;
                }

                bootLog.textContent += '> ' + lines[index] + '\n';
                bootProgress.style.width = (((index + 1) / lines.length) * 100) + '%';
                bootLog.scrollTop = bootLog.scrollHeight;
                index += 1;
            }, 280);
        })();

        (function() {
            var panels = Array.prototype.slice.call(document.querySelectorAll('.panel'));
            if (!('IntersectionObserver' in window)) {
                panels.forEach(function(panel) {
                    panel.classList.add('in-view');
                });
                return;
            }

            var observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('in-view');
                        observer.unobserve(entry.target);
                    }
                });
            }, {
                threshold: 0.12
            });

            panels.forEach(function(panel) {
                observer.observe(panel);
            });
        })();

        (function() {
            var modal = document.getElementById('registrationModal');
            var openButtons = [
                document.getElementById('openRegistrationTop'),
                document.getElementById('openRegistrationHero')
            ];
            var closeButton = document.getElementById('closeRegistration');

            function openModal() {
                modal.classList.add('open');
                modal.setAttribute('aria-hidden', 'false');
                document.body.style.overflow = 'hidden';
            }

            function closeModal() {
                modal.classList.remove('open');
                modal.setAttribute('aria-hidden', 'true');
                document.body.style.overflow = '';
            }

            openButtons.forEach(function(button) {
                if (button) {
                    button.addEventListener('click', openModal);
                }
            });

            if (closeButton) {
                closeButton.addEventListener('click', closeModal);
            }

            modal.addEventListener('click', function(event) {
                if (event.target === modal) {
                    closeModal();
                }
            });

            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && modal.classList.contains('open')) {
                    closeModal();
                }
            });

            @if ($errors->any() || session('contest_registration_error'))
                openModal();
            @endif
        })();

        (function() {
            var teamSize = document.getElementById('team_size');
            var memberThreeField = document.getElementById('memberThreeField');
            var memberThreeInput = document.getElementById('member_three_name');

            function syncThirdMemberField() {
                var value = teamSize ? teamSize.value : '';
                var show = value === '3';
                memberThreeField.classList.toggle('hidden-field', !show);
                memberThreeInput.required = show;
                if (!show) {
                    memberThreeInput.value = '';
                }
            }

            if (teamSize && memberThreeField && memberThreeInput) {
                syncThirdMemberField();
                teamSize.addEventListener('change', syncThirdMemberField);
            }
        })();

        (function() {
            var triggers = Array.prototype.slice.call(document.querySelectorAll('.faq-trigger'));
            triggers.forEach(function(trigger) {
                trigger.addEventListener('click', function() {
                    var panel = document.getElementById(trigger.getAttribute('aria-controls'));
                    var open = trigger.getAttribute('aria-expanded') === 'true';

                    triggers.forEach(function(other) {
                        var otherPanel = document.getElementById(other.getAttribute('aria-controls'));
                        other.setAttribute('aria-expanded', 'false');
                        otherPanel.setAttribute('hidden', 'hidden');
                    });

                    if (!open) {
                        trigger.setAttribute('aria-expanded', 'true');
                        panel.removeAttribute('hidden');
                    }
                });
            });
        })();
    </script>
</body>

</html>
