<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $contestName ?? 'IEEE CS BAU CodeSprint 2026' }} | Contest Coming Soon</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;700;800&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-0: #060606;
            --bg-1: #101010;
            --panel: #141414;
            --ink: #fff5dc;
            --muted: #ceb98a;
            --line: rgba(255, 196, 68, 0.28);
            --yellow: #ffd24a;
            --orange: #ff922f;
            --orange-strong: #ff6b00;
            --ok: #8cffb5;
            --danger: #ff9076;
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            background: var(--bg-0);
            color: var(--ink);
            scroll-behavior: smooth;
        }

        body {
            font-family: 'JetBrains Mono', monospace;
            overflow-x: hidden;
        }

        .boot-screen {
            position: fixed;
            inset: 0;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at 80% 0%, rgba(255, 146, 47, 0.14), transparent 48%), #050505;
            transition: opacity 0.65s ease, visibility 0.65s ease;
        }

        .boot-screen.is-hidden {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }

        .boot-console {
            width: min(800px, 92vw);
            border: 1px solid rgba(255, 146, 47, 0.35);
            border-radius: 14px;
            background: #0f0f0f;
            overflow: hidden;
            box-shadow: 0 30px 65px rgba(0, 0, 0, 0.45);
        }

        .boot-head {
            display: flex;
            align-items: center;
            gap: 0.45rem;
            padding: 0.7rem 0.9rem;
            border-bottom: 1px solid rgba(255, 146, 47, 0.22);
            background: #151515;
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

        .boot-title {
            margin-left: 0.5rem;
            color: #ffdc93;
            font-size: 0.78rem;
        }

        .boot-body {
            padding: 1rem;
        }

        #bootLog {
            margin: 0;
            min-height: 180px;
            max-height: 45vh;
            overflow: auto;
            color: #ffe2a0;
            line-height: 1.55;
            font-size: 0.86rem;
            white-space: pre-wrap;
        }

        .boot-progress {
            margin-top: 0.9rem;
            height: 8px;
            border-radius: 999px;
            background: rgba(255, 210, 74, 0.2);
            overflow: hidden;
        }

        .boot-progress span {
            display: block;
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, var(--yellow), var(--orange));
            transition: width 0.28s ease;
        }

        .contest-page {
            min-height: 100vh;
            padding: 1.7rem 0 4rem;
            position: relative;
            isolation: isolate;
            background:
                radial-gradient(circle at 12% 0%, rgba(255, 210, 74, 0.1), transparent 42%),
                radial-gradient(circle at 86% 12%, rgba(255, 107, 0, 0.14), transparent 45%),
                linear-gradient(160deg, #050505 0%, #101010 42%, #060606 100%);
        }

        .contest-page::before,
        .contest-page::after {
            content: '';
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: -1;
        }

        .contest-page::before {
            background-image:
                linear-gradient(rgba(255, 210, 74, 0.08) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255, 210, 74, 0.08) 1px, transparent 1px);
            background-size: 38px 38px;
            opacity: 0.52;
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.75), transparent 86%);
        }

        .contest-page::after {
            background: linear-gradient(0deg, rgba(255, 255, 255, 0.015) 50%, transparent 50%);
            background-size: 100% 3px;
            opacity: 0.16;
            animation: crtFlicker 6s linear infinite;
        }

        @keyframes crtFlicker {

            0%,
            100% {
                opacity: 0.16;
            }

            50% {
                opacity: 0.08;
            }
        }

        .container {
            width: min(1120px, 92vw);
            margin: 0 auto;
        }

        .top-dock {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.8rem;
            margin-bottom: 1rem;
        }

        .dock-link {
            text-decoration: none;
            color: #ffd88b;
            border: 1px solid rgba(255, 210, 74, 0.3);
            border-radius: 999px;
            padding: 0.42rem 0.78rem;
            font-size: 0.77rem;
            background: rgba(255, 210, 74, 0.08);
            transition: transform 0.22s ease, background 0.22s ease;
        }

        .dock-link:hover {
            transform: translateY(-2px);
            background: rgba(255, 210, 74, 0.18);
        }

        .stack {
            display: grid;
            gap: 1rem;
        }

        .panel {
            background: linear-gradient(160deg, rgba(21, 21, 21, 0.96), rgba(10, 10, 10, 0.96));
            border: 1px solid var(--line);
            border-radius: 16px;
            padding: 1.2rem;
            box-shadow: 0 20px 44px rgba(0, 0, 0, 0.42);
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.55s ease, transform 0.55s ease, border-color 0.3s ease;
        }

        .panel.in-view {
            opacity: 1;
            transform: translateY(0);
        }

        .panel:hover {
            border-color: rgba(255, 210, 74, 0.5);
        }

        .hero {
            display: grid;
            grid-template-columns: 1.1fr 1fr;
            gap: 1rem;
        }

        .eyebrow {
            margin: 0;
            color: #ffd88b;
            font-size: 0.77rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        h1,
        h2,
        h3 {
            margin-top: 0;
            margin-bottom: 0.62rem;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 0.02em;
        }

        h1 {
            font-size: clamp(1.85rem, 3.45vw, 3rem);
            line-height: 1.12;
        }

        h2 {
            font-size: clamp(1.28rem, 2.4vw, 2rem);
        }

        .lead,
        .subtle {
            margin: 0;
            color: var(--muted);
            line-height: 1.7;
        }

        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 0.62rem;
            margin-top: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.4rem;
            border-radius: 10px;
            text-decoration: none;
            border: 1px solid transparent;
            padding: 0.68rem 1rem;
            font-size: 0.81rem;
            font-weight: 700;
            letter-spacing: 0.03em;
            cursor: pointer;
            font-family: 'JetBrains Mono', monospace;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .btn.primary {
            background: linear-gradient(120deg, var(--yellow), var(--orange));
            color: #181818;
            box-shadow: 0 12px 22px rgba(255, 146, 47, 0.32);
        }

        .btn.ghost {
            color: #ffd88b;
            border-color: rgba(255, 210, 74, 0.36);
            background: rgba(255, 210, 74, 0.09);
        }

        .terminal {
            border: 1px solid rgba(255, 210, 74, 0.28);
            border-radius: 14px;
            overflow: hidden;
            background: #0b0b0b;
            display: flex;
            flex-direction: column;
        }

        .terminal-head {
            border-bottom: 1px solid rgba(255, 210, 74, 0.2);
            background: #171717;
            padding: 0.62rem 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.42rem;
        }

        .terminal-head .title {
            margin-left: 0.5rem;
            color: #ffd88b;
            font-size: 0.74rem;
        }

        .terminal-body {
            padding: 0.9rem;
            display: grid;
            gap: 0.8rem;
        }

        .token-k {
            color: #ffd489;
        }

        .token-v {
            color: #ffe072;
        }

        .token-c {
            color: #bda66e;
        }

        .countdown {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 0.5rem;
        }

        .count {
            border: 1px solid rgba(255, 146, 47, 0.34);
            border-radius: 10px;
            background: rgba(255, 146, 47, 0.09);
            text-align: center;
            padding: 0.6rem 0.3rem;
        }

        .count strong {
            display: block;
            color: var(--yellow);
            font-size: clamp(1.1rem, 2.4vw, 1.55rem);
            margin-bottom: 0.18rem;
        }

        .count span {
            color: #ffc674;
            font-size: 0.68rem;
            letter-spacing: 0.07em;
            text-transform: uppercase;
        }

        .command-row {
            display: flex;
            flex-wrap: wrap;
            gap: 0.45rem;
        }

        .cmd {
            border: 1px solid rgba(255, 210, 74, 0.3);
            background: rgba(255, 210, 74, 0.07);
            color: #ffd88b;
            border-radius: 999px;
            padding: 0.36rem 0.68rem;
            font-size: 0.72rem;
            cursor: pointer;
        }

        .cmd:hover {
            background: rgba(255, 210, 74, 0.16);
        }

        .console-log {
            border: 1px solid rgba(255, 210, 74, 0.2);
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.45);
            margin: 0;
            padding: 0.74rem;
            list-style: none;
            display: grid;
            gap: 0.3rem;
            max-height: 140px;
            overflow: auto;
        }

        .console-log li {
            color: #f9dd9c;
            font-size: 0.76rem;
        }

        .section-head {
            margin-bottom: 0.8rem;
        }

        .tag {
            margin: 0;
            color: #ffc15b;
            font-size: 0.77rem;
            text-transform: uppercase;
            letter-spacing: 0.08em;
        }

        .spec-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 0.8rem;
        }

        .spec {
            border: 1px solid rgba(255, 210, 74, 0.2);
            border-radius: 12px;
            background: rgba(255, 210, 74, 0.04);
            padding: 0.75rem;
        }

        .spec h3 {
            margin-bottom: 0.38rem;
            color: #ffd88b;
            font-size: 0.9rem;
        }

        .chips {
            display: flex;
            flex-wrap: wrap;
            gap: 0.4rem;
        }

        .chip {
            border: 1px solid rgba(255, 146, 47, 0.35);
            border-radius: 999px;
            padding: 0.24rem 0.56rem;
            color: #ffca76;
            font-size: 0.72rem;
            background: rgba(255, 146, 47, 0.13);
        }

        .pipeline {
            border: 1px solid rgba(255, 210, 74, 0.24);
            border-radius: 12px;
            background: rgba(0, 0, 0, 0.35);
            padding: 0.8rem;
            overflow: auto;
        }

        .pipeline .line {
            display: grid;
            grid-template-columns: 3.1rem 5.8rem 1fr;
            gap: 0.7rem;
            border-bottom: 1px dashed rgba(255, 210, 74, 0.2);
            padding: 0.45rem 0;
            color: #ffddb0;
            font-size: 0.83rem;
        }

        .pipeline .line:last-child {
            border-bottom: 0;
        }

        .pipeline .idx {
            color: #c9aa6f;
        }

        .pipeline .tm {
            color: var(--yellow);
        }

        .form-note {
            margin-top: 0;
            margin-bottom: 0.9rem;
            color: var(--muted);
            font-size: 0.9rem;
        }

        .alert {
            border-radius: 10px;
            padding: 0.66rem 0.8rem;
            margin-bottom: 0.84rem;
            font-size: 0.79rem;
        }

        .alert.success {
            border: 1px solid rgba(140, 255, 181, 0.36);
            background: rgba(24, 62, 40, 0.44);
            color: #b8f6cf;
        }

        .alert.error {
            border: 1px solid rgba(255, 144, 118, 0.4);
            background: rgba(61, 28, 24, 0.5);
            color: #ffc8bb;
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
            color: #ffd88b;
            font-size: 0.79rem;
        }

        .field input,
        .field select {
            width: 100%;
            border: 1px solid rgba(255, 210, 74, 0.28);
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.4);
            color: #fff0cf;
            padding: 0.66rem 0.72rem;
            font-size: 0.9rem;
            font-family: inherit;
        }

        .field input:focus,
        .field select:focus {
            outline: none;
            border-color: rgba(255, 146, 47, 0.7);
            box-shadow: 0 0 0 3px rgba(255, 146, 47, 0.16);
        }

        .error-text {
            margin: 0;
            color: #ffb9a5;
            font-size: 0.74rem;
        }

        .form-actions {
            margin-top: 0.95rem;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 0.75rem;
        }

        .form-actions p {
            margin: 0;
            color: var(--muted);
            font-size: 0.78rem;
        }

        .form-actions a {
            color: #ffd88b;
        }

        .honeypot {
            position: absolute;
            left: -9999px;
            top: -9999px;
            opacity: 0;
            pointer-events: none;
        }

        .game-wrap {
            border: 1px solid rgba(255, 210, 74, 0.22);
            border-radius: 12px;
            padding: 0.78rem;
            background: rgba(255, 146, 47, 0.05);
        }

        .score-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 0.6rem;
            margin-bottom: 0.7rem;
        }

        .score {
            color: #ffd88b;
            font-size: 0.83rem;
        }

        .score strong {
            color: var(--yellow);
            font-size: 1rem;
        }

        .playground {
            position: relative;
            height: 220px;
            border: 1px dashed rgba(255, 210, 74, 0.3);
            border-radius: 10px;
            background: radial-gradient(circle at 70% 30%, rgba(255, 146, 47, 0.12), transparent 44%), #0a0a0a;
            overflow: hidden;
        }

        .byte-node {
            position: absolute;
            width: 44px;
            height: 44px;
            border-radius: 999px;
            border: 1px solid rgba(255, 210, 74, 0.5);
            background: rgba(255, 210, 74, 0.14);
            color: #ffe2a5;
            cursor: pointer;
            font-weight: 700;
            font-size: 0.8rem;
            transform: translate(-50%, -50%);
            transition: transform 0.15s ease, background 0.15s ease;
        }

        .byte-node:hover {
            transform: translate(-50%, -50%) scale(1.08);
            background: rgba(255, 146, 47, 0.3);
        }

        .spark {
            position: absolute;
            color: var(--yellow);
            font-size: 0.75rem;
            font-weight: 700;
            pointer-events: none;
            animation: rise 0.8s ease forwards;
        }

        @keyframes rise {
            0% {
                transform: translate(-50%, 0);
                opacity: 1;
            }

            100% {
                transform: translate(-50%, -28px);
                opacity: 0;
            }
        }

        .faq {
            display: grid;
            gap: 0.52rem;
        }

        .faq-item {
            border: 1px solid rgba(255, 210, 74, 0.24);
            border-radius: 10px;
            background: rgba(0, 0, 0, 0.28);
            overflow: hidden;
        }

        .faq-trigger {
            width: 100%;
            border: 0;
            background: transparent;
            color: #ffe4b3;
            text-align: left;
            padding: 0.78rem 0.9rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-family: inherit;
            cursor: pointer;
            font-size: 0.84rem;
        }

        .faq-icon {
            color: #ffcc60;
            transition: transform 0.25s ease;
        }

        .faq-trigger[aria-expanded='true'] .faq-icon {
            transform: rotate(45deg);
        }

        .faq-panel {
            padding: 0 0.9rem 0.8rem;
            color: var(--muted);
            font-size: 0.82rem;
            line-height: 1.6;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 0.72rem;
        }

        .contact-box {
            border: 1px solid rgba(255, 210, 74, 0.2);
            border-radius: 12px;
            background: rgba(255, 210, 74, 0.03);
            padding: 0.8rem;
        }

        .contact-box h3 {
            margin-bottom: 0.35rem;
            color: #ffcb64;
            font-size: 0.9rem;
        }

        .contact-box p {
            margin: 0.25rem 0;
            color: var(--muted);
            font-size: 0.82rem;
            line-height: 1.6;
        }

        .contact-box a {
            color: #ffd88b;
            text-decoration: none;
        }

        .contact-box a:hover {
            color: #ffe9ba;
        }

        .tiny-footer {
            margin-top: 1rem;
            text-align: center;
            color: #9a8560;
            font-size: 0.72rem;
        }

        @media (max-width: 1024px) {
            .hero {
                grid-template-columns: 1fr;
            }

            .spec-grid,
            .form-grid,
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .contest-page {
                padding-top: 1.15rem;
            }

            .countdown {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .pipeline .line {
                grid-template-columns: 2.4rem 1fr;
                gap: 0.4rem;
            }

            .pipeline .line span:nth-child(3) {
                grid-column: 2;
            }
        }
    </style>
</head>

<body>
    @php
        $contestName = $contestName ?? 'IEEE CS BAU CodeSprint 2026';
        $contestDateIso = $contestDateIso ?? '2026-07-24T09:00:00+03:00';
        $contestDateLabel = $contestDateLabel ?? 'July 24, 2026 - 09:00 AM (GMT+3)';
        $languages = $languages ?? ['C++17', 'Python 3.12', 'Java 21', 'Kotlin 1.9', 'Rust 1.78', 'Go 1.22'];

        $agenda = [
            ['time' => '08:15', 'title' => 'Check-in and Environment Verification'],
            ['time' => '09:00', 'title' => 'Rules Brief and Contest Kickoff'],
            ['time' => '09:30', 'title' => 'Round 1: Algorithmic Sprint'],
            ['time' => '11:15', 'title' => 'Round 2: Advanced Problem Solving'],
            ['time' => '13:15', 'title' => 'Submission Freeze and Judging'],
            ['time' => '14:00', 'title' => 'Leaderboard Reveal and Closing'],
        ];

        $faqs = [
            ['q' => 'What IDEs are allowed?', 'a' => 'Any local IDE is allowed, including VS Code, JetBrains IDEs, and Vim. Internet access is restricted to the contest platform and approved language docs.'],
            ['q' => 'Are there registration fees?', 'a' => 'No. Participation is free for currently enrolled students.'],
            ['q' => 'How many members are allowed per team?', 'a' => 'You can join solo or as a team of up to 3 students.'],
            ['q' => 'Can I change my preferred language later?', 'a' => 'Yes. The selected language helps planning only. During contest, any allowed language can be used.'],
        ];
    @endphp

    <div id="bootScreen" class="boot-screen" aria-hidden="true">
        <div class="boot-console">
            <div class="boot-head">
                <span class="dot red"></span>
                <span class="dot yellow"></span>
                <span class="dot green"></span>
                <span class="boot-title">contest://initializer</span>
            </div>
            <div class="boot-body">
                <pre id="bootLog"></pre>
                <div class="boot-progress"><span id="bootBar"></span></div>
            </div>
        </div>
    </div>

    <main id="contestPage" class="contest-page" data-launch-at="{{ $contestDateIso }}">
        <div class="container">
            <div class="top-dock">
                <a class="dock-link" href="{{ route('home') }}">cd /home</a>
                <a class="dock-link" href="#registration">jump --register</a>
            </div>

            <div class="stack">
                <section id="hero" class="panel hero">
                    <div>
                        <p class="eyebrow">$ init --mode contest</p>
                        <h1>{{ $contestName }}</h1>
                        <p class="lead">
                            A university competitive programming showdown for builders, debuggers, and algorithmic
                            thinkers. Bring your fastest logic and cleanest code.
                        </p>
                        <div class="hero-actions">
                            <a class="btn primary" href="#registration">Register Now</a>
                            <a class="btn ghost" href="#details">Read Problem Statement</a>
                        </div>
                    </div>

                    <aside class="terminal" aria-live="polite">
                        <div class="terminal-head">
                            <span class="dot red"></span>
                            <span class="dot yellow"></span>
                            <span class="dot green"></span>
                            <span class="title">runtime://countdown</span>
                        </div>

                        <div class="terminal-body">
                            <p class="subtle"><span class="token-c">// launch_at:</span> {{ $contestDateLabel }}</p>
                            <p class="subtle"><span class="token-k">const</span> status = <span id="countdownState"
                                    class="token-v">"T_MINUS"</span>;</p>

                            <div class="countdown" aria-label="contest countdown">
                                <div class="count"><strong data-count="days">00</strong><span>days</span></div>
                                <div class="count"><strong data-count="hours">00</strong><span>hours</span></div>
                                <div class="count"><strong data-count="minutes">00</strong><span>minutes</span></div>
                                <div class="count"><strong data-count="seconds">00</strong><span>seconds</span></div>
                            </div>

                            <div class="command-row">
                                <button class="cmd" type="button" data-command="build">run build</button>
                                <button class="cmd" type="button" data-command="lint">run lint</button>
                                <button class="cmd" type="button" data-command="stress">stress test</button>
                            </div>

                            <ul id="consoleLog" class="console-log">
                                <li>> waiting for command...</li>
                            </ul>
                        </div>
                    </aside>
                </section>

                <section id="details" class="panel">
                    <div class="section-head">
                        <p class="tag">The Problem Statement</p>
                        <h2>Contest Details</h2>
                    </div>
                    <p class="subtle">
                        Solve a curated set of programming problems under strict constraints. Scoring focuses on
                        correctness first, then speed and efficiency.
                    </p>

                    <div class="spec-grid" style="margin-top: 0.85rem;">
                        <article class="spec">
                            <h3>Target Platform</h3>
                            <p class="subtle">Codeforces-style online judge with live verdicts.</p>
                        </article>
                        <article class="spec">
                            <h3>Allowed Languages</h3>
                            <div class="chips">
                                @foreach ($languages as $language)
                                    <span class="chip">{{ $language }}</span>
                                @endforeach
                            </div>
                        </article>
                        <article class="spec">
                            <h3>Team Size Limits</h3>
                            <p class="subtle">1 to 3 students per team.</p>
                        </article>
                        <article class="spec">
                            <h3>Standard Limits</h3>
                            <p class="subtle">Time Limit: 2 sec, Memory Limit: 256 MB.</p>
                        </article>
                    </div>
                </section>

                <section id="agenda" class="panel">
                    <div class="section-head">
                        <p class="tag">Execution Pipeline</p>
                        <h2>Event Agenda</h2>
                    </div>

                    <div class="pipeline" aria-label="agenda pipeline">
                        @foreach ($agenda as $index => $slot)
                            <div class="line">
                                <span class="idx">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="tm">{{ $slot['time'] }}</span>
                                <span>{{ $slot['title'] }}</span>
                            </div>
                        @endforeach
                    </div>
                </section>

                <section id="registration" class="panel">
                    <div class="section-head">
                        <p class="tag">Registration System</p>
                        <h2>Submit Your Registration Payload</h2>
                    </div>

                    <p class="form-note">Submissions are stored securely and used only for contest operations.</p>

                    @if (session('contest_registration_success'))
                        <div class="alert success">{{ session('contest_registration_success') }}</div>
                    @endif

                    @if (session('contest_registration_error'))
                        <div class="alert error">{{ session('contest_registration_error') }}</div>
                    @endif

                    <form method="POST" action="{{ route('contest.register') }}" novalidate>
                        @csrf

                        <div class="honeypot" aria-hidden="true">
                            <label for="website">Website</label>
                            <input id="website" name="website" type="text" tabindex="-1" autocomplete="off"
                                value="{{ old('website') }}">
                        </div>

                        <div class="form-grid">
                            <div class="field">
                                <label for="full_name">Full Name</label>
                                <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}"
                                    required>
                                @error('full_name')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="university_id">University ID</label>
                                <input id="university_id" name="university_id" type="text"
                                    value="{{ old('university_id') }}" required>
                                @error('university_id')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="email">Email</label>
                                <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field">
                                <label for="platform_handle">Platform Handle (optional)</label>
                                <input id="platform_handle" name="platform_handle" type="text"
                                    value="{{ old('platform_handle') }}" placeholder="e.g. coder_123">
                                @error('platform_handle')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="field full">
                                <label for="preferred_language">Preferred Programming Language</label>
                                <select id="preferred_language" name="preferred_language" required>
                                    <option value="">Select language</option>
                                    @foreach ($languages as $language)
                                        <option value="{{ $language }}" @selected(old('preferred_language') === $language)>
                                            {{ $language }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('preferred_language')
                                    <p class="error-text">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="form-actions">
                            <button class="btn primary" type="submit">Submit Registration</button>
                            <p>By submitting, you agree to our <a href="{{ route('privacy-policy') }}">privacy policy</a> and
                                contest code of conduct.</p>
                        </div>
                    </form>
                </section>

                <section id="playground" class="panel">
                    <div class="section-head">
                        <p class="tag">Interactive Playground</p>
                        <h2>Catch The Bug Packets</h2>
                    </div>

                    <div class="game-wrap">
                        <div class="score-row">
                            <p class="score">Debug score: <strong id="debugScore">0</strong></p>
                            <button class="btn ghost" id="resetGame" type="button">Reset Game</button>
                        </div>
                        <div class="playground" id="playground" aria-label="mini game area"></div>
                    </div>
                </section>

                <section id="faq" class="panel">
                    <div class="section-head">
                        <p class="tag">Knowledge Base</p>
                        <h2>Frequently Asked Questions</h2>
                    </div>

                    <div class="faq" data-accordion>
                        @foreach ($faqs as $index => $faq)
                            <article class="faq-item">
                                <button class="faq-trigger" type="button" id="faq-trigger-{{ $index }}"
                                    aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                    aria-controls="faq-panel-{{ $index }}">
                                    <span>{{ $faq['q'] }}</span>
                                    <span class="faq-icon">+</span>
                                </button>
                                <div class="faq-panel" id="faq-panel-{{ $index }}"
                                    @if ($index !== 0) hidden @endif>
                                    {{ $faq['a'] }}
                                </div>
                            </article>
                        @endforeach
                    </div>
                </section>

                <section id="contact" class="panel">
                    <div class="section-head">
                        <p class="tag">Contact and Footer</p>
                        <h2>Need Help?</h2>
                    </div>

                    <div class="contact-grid">
                        <article class="contact-box">
                            <h3>Contact</h3>
                            <p>Email: <a href="mailto:contest@ieeecs-bau.org">contest@ieeecs-bau.org</a></p>
                            <p>General inquiries: <a href="{{ route('contact') }}">Contact IEEE CS BAU</a></p>
                        </article>

                        <article class="contact-box">
                            <h3>Social</h3>
                            <p><a href="#">Facebook</a></p>
                            <p><a href="#">Instagram</a></p>
                            <p><a href="#">LinkedIn</a></p>
                        </article>

                        <article class="contact-box">
                            <h3>Administrative</h3>
                            <p><a href="{{ route('privacy-policy') }}">Privacy Policy</a></p>
                            <p><a href="https://www.ieee.org/about/corporate/governance/p9-26.html" target="_blank"
                                    rel="noopener">Terms and Conditions</a></p>
                            <p><a href="https://www.ieee.org/about/corporate/governance/p9-26.html" target="_blank"
                                    rel="noopener">Code of Conduct</a></p>
                        </article>
                    </div>

                    <p class="tiny-footer">IEEE CS BAU Contest Landing Experience</p>
                </section>
            </div>
        </div>
    </main>

    <noscript>
        <style>
            .boot-screen {
                display: none;
            }

            .panel {
                opacity: 1;
                transform: none;
            }
        </style>
    </noscript>

    <script>
        (function() {
            var bootScreen = document.getElementById('bootScreen');
            var bootLog = document.getElementById('bootLog');
            var bootBar = document.getElementById('bootBar');
            var bootLines = [
                '[init] loading contest kernel...',
                '[ok] runtime clock synchronized',
                '[ok] judge adapters online',
                '[ok] anti-cheat module primed',
                '[ok] challenge dataset encrypted',
                '[ok] registration API connected',
                '[ready] launching interface'
            ];
            var index = 0;

            var timer = setInterval(function() {
                if (index >= bootLines.length) {
                    clearInterval(timer);
                    setTimeout(function() {
                        bootScreen.classList.add('is-hidden');
                    }, 320);
                    return;
                }

                bootLog.textContent += '> ' + bootLines[index] + '\n';
                bootBar.style.width = (((index + 1) / bootLines.length) * 100) + '%';
                bootLog.scrollTop = bootLog.scrollHeight;
                index += 1;
            }, 280);
        })();

        (function() {
            var root = document.getElementById('contestPage');
            var launch = root ? new Date(root.getAttribute('data-launch-at')).getTime() : NaN;
            var stateNode = document.getElementById('countdownState');
            var parts = {
                days: document.querySelector('[data-count="days"]'),
                hours: document.querySelector('[data-count="hours"]'),
                minutes: document.querySelector('[data-count="minutes"]'),
                seconds: document.querySelector('[data-count="seconds"]')
            };

            function setValues(d, h, m, s) {
                parts.days.textContent = String(d).padStart(2, '0');
                parts.hours.textContent = String(h).padStart(2, '0');
                parts.minutes.textContent = String(m).padStart(2, '0');
                parts.seconds.textContent = String(s).padStart(2, '0');
            }

            function tick() {
                if (Number.isNaN(launch)) {
                    stateNode.textContent = '"INVALID_DATE"';
                    setValues(0, 0, 0, 0);
                    return;
                }

                var left = launch - Date.now();
                if (left <= 0) {
                    stateNode.textContent = '"LIVE_NOW"';
                    setValues(0, 0, 0, 0);
                    return;
                }

                var total = Math.floor(left / 1000);
                var d = Math.floor(total / 86400);
                var h = Math.floor((total % 86400) / 3600);
                var m = Math.floor((total % 3600) / 60);
                var s = total % 60;

                setValues(d, h, m, s);
                stateNode.textContent = '"T_MINUS_' + String(d).padStart(2, '0') + 'D"';
            }

            tick();
            setInterval(tick, 1000);
        })();

        (function() {
            var commandMap = {
                build: ['[build] compiling templates...', '[build] linking challenge modules...', '[build] success in 1.2s'],
                lint: ['[lint] scanning submissions style...', '[lint] no critical warnings', '[lint] quality gate passed'],
                stress: ['[stress] generating adversarial tests...', '[stress] running worst-case simulation...', '[stress] all systems stable']
            };

            var logBox = document.getElementById('consoleLog');
            var buttons = Array.prototype.slice.call(document.querySelectorAll('[data-command]'));

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var key = button.getAttribute('data-command');
                    var lines = commandMap[key] || [];
                    logBox.innerHTML = '';

                    lines.forEach(function(line, idx) {
                        setTimeout(function() {
                            var li = document.createElement('li');
                            li.textContent = '> ' + line;
                            logBox.appendChild(li);
                            logBox.scrollTop = logBox.scrollHeight;
                        }, idx * 220);
                    });
                });
            });
        })();

        (function() {
            var playground = document.getElementById('playground');
            var scoreNode = document.getElementById('debugScore');
            var resetButton = document.getElementById('resetGame');
            if (!playground || !scoreNode || !resetButton) {
                return;
            }

            var score = 0;
            var nodeCount = 10;

            function randomBetween(min, max) {
                return Math.random() * (max - min) + min;
            }

            function placeNode(node) {
                node.style.left = randomBetween(8, 92) + '%';
                node.style.top = randomBetween(12, 88) + '%';
            }

            function spawnSpark(x, y) {
                var spark = document.createElement('span');
                spark.className = 'spark';
                spark.textContent = '+1';
                spark.style.left = x + 'px';
                spark.style.top = y + 'px';
                playground.appendChild(spark);
                setTimeout(function() {
                    spark.remove();
                }, 780);
            }

            function createNode(index) {
                var node = document.createElement('button');
                node.type = 'button';
                node.className = 'byte-node';
                node.textContent = '0x' + (index + 1);
                placeNode(node);

                node.addEventListener('click', function() {
                    score += 1;
                    scoreNode.textContent = String(score);
                    var rect = playground.getBoundingClientRect();
                    var nodeRect = node.getBoundingClientRect();
                    spawnSpark(nodeRect.left - rect.left + (nodeRect.width / 2), nodeRect.top - rect.top + 4);
                    placeNode(node);
                });

                return node;
            }

            function renderGame() {
                playground.innerHTML = '';
                for (var i = 0; i < nodeCount; i += 1) {
                    playground.appendChild(createNode(i));
                }
            }

            resetButton.addEventListener('click', function() {
                score = 0;
                scoreNode.textContent = '0';
                renderGame();
            });

            renderGame();
        })();

        (function() {
            var items = Array.prototype.slice.call(document.querySelectorAll('.faq-item'));

            items.forEach(function(item) {
                var trigger = item.querySelector('.faq-trigger');
                var panel = item.querySelector('.faq-panel');

                trigger.addEventListener('click', function() {
                    var isOpen = trigger.getAttribute('aria-expanded') === 'true';
                    items.forEach(function(target) {
                        var t = target.querySelector('.faq-trigger');
                        var p = target.querySelector('.faq-panel');
                        t.setAttribute('aria-expanded', 'false');
                        p.setAttribute('hidden', 'hidden');
                    });

                    if (!isOpen) {
                        trigger.setAttribute('aria-expanded', 'true');
                        panel.removeAttribute('hidden');
                    }
                });
            });
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
    </script>
</body>

</html>
