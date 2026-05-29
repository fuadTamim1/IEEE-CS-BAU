<x-base-layout>
    @php
        $contestName = $contestName ?? 'IEEE CS BAU CodeSprint 2026';
        $contestDateIso = $contestDateIso ?? '2026-07-24T09:00:00+03:00';
        $contestDateLabel = $contestDateLabel ?? 'July 24, 2026 - 09:00 AM (GMT+3)';
        $languages = $languages ?? ['C++17', 'Python 3.12', 'Java 21', 'Kotlin 1.9', 'Rust 1.78', 'Go 1.22'];

        $agenda = [
            ['time' => '08:15', 'title' => 'Check-in and Environment Verification', 'detail' => 'Identity check, seat assignment, and system warm-up.'],
            ['time' => '09:00', 'title' => 'Contest Kickoff and Rules Brief', 'detail' => 'Problem packet release and scoring model walkthrough.'],
            ['time' => '09:30', 'title' => 'Round 1: Algorithmic Sprint', 'detail' => 'Fast-paced warmup set to calibrate strategy.'],
            ['time' => '11:15', 'title' => 'Round 2: Advanced Problem Solving', 'detail' => 'Graph, DP, and greedy-heavy challenge batch.'],
            ['time' => '13:15', 'title' => 'Final Submission Freeze', 'detail' => 'Judging queue closes and plagiarism checks start.'],
            ['time' => '14:00', 'title' => 'Leaderboard Reveal and Closing', 'detail' => 'Top teams announcement and networking session.'],
        ];

        $faqs = [
            ['q' => 'What IDEs are allowed?', 'a' => 'Any local IDE is allowed, including VS Code, JetBrains IDEs, and Vim. Internet access is restricted to contest platform pages and approved language documentation.'],
            ['q' => 'Are there registration fees?', 'a' => 'No. Participation is free for all currently enrolled university students.'],
            ['q' => 'How many members are allowed per team?', 'a' => 'Teams can have up to 3 members. Solo participation is also accepted.'],
            ['q' => 'Can I change my preferred language later?', 'a' => 'Yes. The language choice in this form is for planning. You can use any allowed language during the contest.'],
        ];
    @endphp

    <div class="cs-landing" data-launch-at="{{ $contestDateIso }}">
        <div class="cs-landing__bg" aria-hidden="true"></div>

        <div class="container cs-shell">
            <section id="hero" class="cs-panel cs-reveal" style="--reveal-delay: 0ms;">
                <div class="cs-hero__left">
                    <p class="cs-tag">$ boot --contest-mode</p>
                    <h1>{{ $contestName }}</h1>
                    <p class="cs-subtitle">
                        A university-wide problem-solving and competitive programming challenge built for thinkers,
                        debuggers, and speed coders.
                    </p>

                    <div class="cs-actions">
                        <a href="#registration" class="cs-btn cs-btn--primary">Register Now</a>
                        <a href="#details" class="cs-btn cs-btn--secondary">Read Problem Statement</a>
                    </div>
                </div>

                <div class="cs-terminal" role="status" aria-live="polite">
                    <div class="cs-terminal__head">
                        <span class="cs-dot cs-dot--red"></span>
                        <span class="cs-dot cs-dot--yellow"></span>
                        <span class="cs-dot cs-dot--green"></span>
                        <span class="cs-terminal__title">terminal://contest/runtime</span>
                    </div>
                    <div class="cs-terminal__body">
                        <p><span class="token-comment">// launch timestamp</span> {{ $contestDateLabel }}</p>
                        <p><span class="token-key">const</span> state = <span id="countdown-state" class="token-string">"T_MINUS"</span>;</p>

                        <div class="cs-countdown" aria-label="Contest countdown">
                            <div class="cs-countdown__cell">
                                <span class="cs-countdown__num" data-countdown="days">00</span>
                                <span class="cs-countdown__label">days</span>
                            </div>
                            <div class="cs-countdown__cell">
                                <span class="cs-countdown__num" data-countdown="hours">00</span>
                                <span class="cs-countdown__label">hours</span>
                            </div>
                            <div class="cs-countdown__cell">
                                <span class="cs-countdown__num" data-countdown="minutes">00</span>
                                <span class="cs-countdown__label">minutes</span>
                            </div>
                            <div class="cs-countdown__cell">
                                <span class="cs-countdown__num" data-countdown="seconds">00</span>
                                <span class="cs-countdown__label">seconds</span>
                            </div>
                        </div>

                        <p class="cs-terminal__footer"><span class="token-fn">print</span>("Ready to compile your strategy?");</p>
                    </div>
                </div>
            </section>

            <section id="details" class="cs-panel cs-reveal" style="--reveal-delay: 90ms;">
                <div class="cs-section-head">
                    <p class="cs-tag"># The Problem Statement</p>
                    <h2>Contest Details</h2>
                </div>

                <p class="cs-section-copy">
                    Participants will solve a curated set of algorithmic problems under time pressure. Solutions are
                    judged on correctness and execution efficiency.
                </p>

                <div class="cs-spec-grid">
                    <article class="cs-spec-card">
                        <h3>Target Platform</h3>
                        <p class="cs-spec-value">Codeforces-style online judge</p>
                    </article>
                    <article class="cs-spec-card">
                        <h3>Allowed Languages</h3>
                        <div class="cs-language-list">
                            @foreach ($languages as $language)
                                <span>{{ $language }}</span>
                            @endforeach
                        </div>
                    </article>
                    <article class="cs-spec-card">
                        <h3>Team Size Limit</h3>
                        <p class="cs-spec-value">1 to 3 students per team</p>
                    </article>
                    <article class="cs-spec-card">
                        <h3>Standard Limits</h3>
                        <p class="cs-spec-value">Time: 2 sec / Memory: 256 MB</p>
                    </article>
                </div>
            </section>

            <section id="agenda" class="cs-panel cs-reveal" style="--reveal-delay: 180ms;">
                <div class="cs-section-head">
                    <p class="cs-tag"># Execution Pipeline</p>
                    <h2>Event Agenda</h2>
                </div>

                <div class="cs-pipeline" aria-label="Event timeline in code style">
                    <p class="cs-pipeline__header">const agenda = [</p>
                    <ol>
                        @foreach ($agenda as $index => $slot)
                            <li>
                                <span class="cs-line">{{ str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT) }}</span>
                                <span class="cs-time">{{ $slot['time'] }}</span>
                                <span class="cs-task">{{ $slot['title'] }}</span>
                                <span class="cs-detail">{{ $slot['detail'] }}</span>
                            </li>
                        @endforeach
                    </ol>
                    <p class="cs-pipeline__footer">];</p>
                </div>
            </section>

            <section id="registration" class="cs-panel cs-reveal" style="--reveal-delay: 260ms;">
                <div class="cs-section-head">
                    <p class="cs-tag"># Registration System</p>
                    <h2>Submit Your Registration Payload</h2>
                </div>

                <p class="cs-section-copy">
                    Fill in your student details. Submission is stored securely in our registration database and used
                    only for contest operations.
                </p>

                @if (session('contest_registration_success'))
                    <div class="cs-alert cs-alert--success" role="status">
                        {{ session('contest_registration_success') }}
                    </div>
                @endif

                @if (session('contest_registration_error'))
                    <div class="cs-alert cs-alert--error" role="alert">
                        {{ session('contest_registration_error') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('contest.register') }}" class="cs-form" novalidate>
                    @csrf

                    <div class="cs-honeypot" aria-hidden="true">
                        <label for="website">Website</label>
                        <input id="website" name="website" type="text" tabindex="-1" autocomplete="off"
                            value="{{ old('website') }}">
                    </div>

                    <div class="cs-form-grid">
                        <div class="cs-field">
                            <label for="full_name">Full Name</label>
                            <input id="full_name" name="full_name" type="text" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <p class="cs-field__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="cs-field">
                            <label for="university_id">University ID</label>
                            <input id="university_id" name="university_id" type="text" value="{{ old('university_id') }}"
                                required>
                            @error('university_id')
                                <p class="cs-field__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="cs-field">
                            <label for="email">Email</label>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required>
                            @error('email')
                                <p class="cs-field__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="cs-field">
                            <label for="platform_handle">Platform Handle (optional)</label>
                            <input id="platform_handle" name="platform_handle" type="text"
                                value="{{ old('platform_handle') }}" placeholder="e.g. coder_123">
                            @error('platform_handle')
                                <p class="cs-field__error">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="cs-field cs-field--full">
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
                                <p class="cs-field__error">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="cs-form__actions">
                        <button type="submit" class="cs-btn cs-btn--primary">Submit Registration</button>
                        <p>
                            By submitting, you agree to our
                            <a href="{{ route('privacy-policy') }}">privacy policy</a>
                            and contest code of conduct.
                        </p>
                    </div>
                </form>
            </section>

            <section id="faq" class="cs-panel cs-reveal" style="--reveal-delay: 340ms;">
                <div class="cs-section-head">
                    <p class="cs-tag"># Knowledge Base</p>
                    <h2>Frequently Asked Questions</h2>
                </div>

                <div class="cs-faq" data-accordion>
                    @foreach ($faqs as $index => $faq)
                        <article class="cs-faq-item">
                            <button type="button" class="cs-faq-trigger" id="faq-trigger-{{ $index }}"
                                aria-expanded="{{ $index === 0 ? 'true' : 'false' }}"
                                aria-controls="faq-panel-{{ $index }}">
                                <span>{{ $faq['q'] }}</span>
                                <span class="cs-faq-icon" aria-hidden="true">+</span>
                            </button>
                            <div id="faq-panel-{{ $index }}" class="cs-faq-panel {{ $index === 0 ? 'is-open' : '' }}"
                                role="region" aria-labelledby="faq-trigger-{{ $index }}"
                                @if ($index !== 0) hidden @endif>
                                <p>{{ $faq['a'] }}</p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </section>

            <section id="contact" class="cs-panel cs-reveal" style="--reveal-delay: 420ms;">
                <div class="cs-section-head">
                    <p class="cs-tag"># Contact and Footer</p>
                    <h2>Need Help?</h2>
                </div>

                <div class="cs-contact-grid">
                    <article>
                        <h3>Contact</h3>
                        <p>Email: <a href="mailto:contest@ieeecs-bau.org">contest@ieeecs-bau.org</a></p>
                        <p>General inquiries: <a href="{{ route('contact') }}">Contact IEEE CS BAU</a></p>
                    </article>

                    <article>
                        <h3>Socials</h3>
                        <p><a href="#" aria-label="Facebook">Facebook</a> / <a href="#" aria-label="Instagram">Instagram</a> /
                            <a href="#" aria-label="LinkedIn">LinkedIn</a>
                        </p>
                    </article>

                    <article>
                        <h3>Administrative Links</h3>
                        <p><a href="{{ route('privacy-policy') }}">Privacy Policy</a></p>
                        <p><a href="https://www.ieee.org/about/corporate/governance/p9-26.html" target="_blank" rel="noopener">Terms and Conditions</a></p>
                        <p><a href="https://www.ieee.org/about/corporate/governance/p9-26.html" target="_blank" rel="noopener">Code of Conduct</a></p>
                    </article>
                </div>
            </section>
        </div>
    </div>

    @push('styles')
        <style>
            @import url('https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;600;700&family=Space+Grotesk:wght@500;700&display=swap');

            :root {
                --cs-bg: #0b1020;
                --cs-panel: rgba(9, 14, 27, 0.92);
                --cs-border: rgba(121, 192, 255, 0.24);
                --cs-text: #e6edf3;
                --cs-muted: #95a8c3;
                --cs-blue: #79c0ff;
                --cs-green: #7ee787;
                --cs-orange: #ffa657;
                --cs-red: #ff7b72;
                --cs-pink: #ffaecc;
            }

            .cs-landing {
                position: relative;
                padding: 5.2rem 0;
                background:
                    radial-gradient(circle at 12% 14%, rgba(121, 192, 255, 0.16), transparent 40%),
                    radial-gradient(circle at 90% 10%, rgba(255, 166, 87, 0.14), transparent 43%),
                    linear-gradient(160deg, #050912 0%, #0c1328 46%, #090f1f 100%);
                overflow: hidden;
                color: var(--cs-text);
            }

            .cs-landing__bg {
                position: absolute;
                inset: 0;
                background-image:
                    linear-gradient(rgba(121, 192, 255, 0.08) 1px, transparent 1px),
                    linear-gradient(90deg, rgba(121, 192, 255, 0.08) 1px, transparent 1px);
                background-size: 40px 40px;
                mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.75), transparent 82%);
                pointer-events: none;
            }

            .cs-shell {
                position: relative;
                z-index: 2;
                display: grid;
                gap: 1.35rem;
            }

            .cs-panel {
                border: 1px solid var(--cs-border);
                border-radius: 16px;
                background: var(--cs-panel);
                box-shadow: 0 20px 38px rgba(0, 0, 0, 0.38);
                padding: 1.6rem;
            }

            .cs-reveal {
                opacity: 0;
                transform: translateY(20px);
                animation: csReveal 0.68s ease forwards;
                animation-delay: var(--reveal-delay, 0ms);
            }

            @keyframes csReveal {
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .cs-tag {
                margin: 0;
                color: var(--cs-green);
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.84rem;
                letter-spacing: 0.03em;
            }

            h1,
            h2,
            h3 {
                margin-top: 0;
                color: var(--cs-text);
            }

            h1,
            h2 {
                font-family: 'Space Grotesk', sans-serif;
                letter-spacing: 0.01em;
            }

            h1 {
                font-size: clamp(1.8rem, 4vw, 3.15rem);
                margin: 0.6rem 0 0.8rem;
            }

            h2 {
                font-size: clamp(1.35rem, 2.8vw, 2.1rem);
                margin-bottom: 0.25rem;
            }

            .cs-subtitle,
            .cs-section-copy,
            .cs-terminal p,
            .cs-form__actions p,
            .cs-faq-panel p,
            .cs-contact-grid p {
                color: var(--cs-muted);
                line-height: 1.65;
                margin-top: 0;
            }

            .cs-hero__left {
                margin-bottom: 1.2rem;
            }

            .cs-actions {
                display: flex;
                flex-wrap: wrap;
                gap: 0.7rem;
            }

            .cs-btn {
                border: 1px solid transparent;
                border-radius: 10px;
                padding: 0.7rem 1.05rem;
                text-decoration: none;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.88rem;
                font-weight: 600;
                transition: transform 0.25s ease, box-shadow 0.25s ease, background-color 0.25s ease;
            }

            .cs-btn:hover {
                transform: translateY(-2px);
            }

            .cs-btn--primary {
                color: #05101d;
                background: linear-gradient(120deg, var(--cs-green), #87d8ff);
                box-shadow: 0 12px 26px rgba(126, 231, 135, 0.2);
            }

            .cs-btn--secondary {
                color: var(--cs-blue);
                border-color: rgba(121, 192, 255, 0.35);
                background: rgba(121, 192, 255, 0.1);
            }

            .cs-terminal {
                border: 1px solid rgba(148, 163, 184, 0.22);
                background: linear-gradient(180deg, rgba(4, 8, 16, 0.96), rgba(7, 12, 24, 0.96));
                border-radius: 12px;
                font-family: 'JetBrains Mono', monospace;
                overflow: hidden;
            }

            .cs-terminal__head {
                display: flex;
                align-items: center;
                gap: 0.42rem;
                padding: 0.55rem 0.75rem;
                background: rgba(148, 163, 184, 0.08);
                border-bottom: 1px solid rgba(148, 163, 184, 0.18);
            }

            .cs-dot {
                width: 9px;
                height: 9px;
                border-radius: 999px;
                display: inline-block;
            }

            .cs-dot--red {
                background: #ff5f56;
            }

            .cs-dot--yellow {
                background: #ffbd2e;
            }

            .cs-dot--green {
                background: #27c93f;
            }

            .cs-terminal__title {
                margin-left: 0.35rem;
                color: #a7bdd8;
                font-size: 0.72rem;
            }

            .cs-terminal__body {
                padding: 1rem;
            }

            .token-comment {
                color: #8b949e;
            }

            .token-key {
                color: var(--cs-pink);
            }

            .token-string {
                color: var(--cs-orange);
            }

            .token-fn {
                color: var(--cs-blue);
            }

            .cs-countdown {
                margin: 0.8rem 0;
                display: grid;
                grid-template-columns: repeat(4, minmax(0, 1fr));
                gap: 0.55rem;
            }

            .cs-countdown__cell {
                border: 1px solid rgba(126, 231, 135, 0.3);
                background: rgba(16, 33, 22, 0.5);
                border-radius: 10px;
                text-align: center;
                padding: 0.75rem 0.35rem;
            }

            .cs-countdown__num {
                display: block;
                color: var(--cs-green);
                font-weight: 700;
                font-size: clamp(1.15rem, 3vw, 1.6rem);
            }

            .cs-countdown__label {
                display: block;
                color: #9bd9bf;
                font-size: 0.71rem;
                text-transform: uppercase;
                letter-spacing: 0.08em;
            }

            .cs-terminal__footer {
                margin-bottom: 0;
            }

            .cs-section-head {
                margin-bottom: 0.65rem;
            }

            .cs-spec-grid {
                display: grid;
                gap: 0.85rem;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .cs-spec-card {
                border: 1px solid rgba(121, 192, 255, 0.25);
                border-radius: 12px;
                background: rgba(8, 13, 24, 0.82);
                padding: 0.9rem;
            }

            .cs-spec-card h3 {
                margin-bottom: 0.45rem;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.9rem;
                color: var(--cs-blue);
            }

            .cs-spec-value {
                margin-bottom: 0;
            }

            .cs-language-list {
                display: flex;
                flex-wrap: wrap;
                gap: 0.4rem;
            }

            .cs-language-list span {
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.75rem;
                color: #f6d78f;
                border: 1px solid rgba(255, 166, 87, 0.33);
                border-radius: 999px;
                padding: 0.26rem 0.6rem;
                background: rgba(255, 166, 87, 0.08);
            }

            .cs-pipeline {
                border: 1px solid rgba(121, 192, 255, 0.25);
                border-radius: 12px;
                background: rgba(6, 10, 18, 0.92);
                font-family: 'JetBrains Mono', monospace;
                padding: 0.95rem;
            }

            .cs-pipeline__header,
            .cs-pipeline__footer {
                color: var(--cs-blue);
                margin: 0;
                font-size: 0.86rem;
            }

            .cs-pipeline ol {
                margin: 0.55rem 0;
                padding: 0;
                list-style: none;
                display: grid;
                gap: 0.45rem;
            }

            .cs-pipeline li {
                display: grid;
                grid-template-columns: 2rem 4.6rem 1fr;
                grid-template-areas:
                    'line time task'
                    '. detail detail';
                column-gap: 0.7rem;
                row-gap: 0.28rem;
                padding: 0.42rem 0.2rem;
                border-bottom: 1px dashed rgba(148, 163, 184, 0.2);
            }

            .cs-pipeline li:last-child {
                border-bottom: 0;
            }

            .cs-line {
                grid-area: line;
                color: #8b949e;
            }

            .cs-time {
                grid-area: time;
                color: var(--cs-green);
            }

            .cs-task {
                grid-area: task;
                color: var(--cs-text);
            }

            .cs-detail {
                grid-area: detail;
                color: #8aa1be;
                font-size: 0.78rem;
            }

            .cs-alert {
                border-radius: 10px;
                padding: 0.68rem 0.82rem;
                margin-bottom: 0.9rem;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.8rem;
            }

            .cs-alert--success {
                border: 1px solid rgba(126, 231, 135, 0.4);
                background: rgba(16, 54, 35, 0.5);
                color: #9de7bc;
            }

            .cs-alert--error {
                border: 1px solid rgba(255, 123, 114, 0.4);
                background: rgba(62, 22, 25, 0.52);
                color: #ffb5ac;
            }

            .cs-form-grid {
                display: grid;
                gap: 0.8rem;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .cs-field {
                display: flex;
                flex-direction: column;
                gap: 0.36rem;
            }

            .cs-field--full {
                grid-column: 1 / -1;
            }

            .cs-field label {
                color: var(--cs-blue);
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.8rem;
            }

            .cs-field input,
            .cs-field select {
                border: 1px solid rgba(121, 192, 255, 0.28);
                border-radius: 9px;
                background: rgba(4, 10, 20, 0.85);
                color: var(--cs-text);
                padding: 0.65rem 0.72rem;
                font-size: 0.92rem;
            }

            .cs-field input:focus,
            .cs-field select:focus {
                border-color: rgba(126, 231, 135, 0.6);
                outline: 0;
                box-shadow: 0 0 0 3px rgba(126, 231, 135, 0.12);
            }

            .cs-field__error {
                margin: 0;
                color: #ffb5ac;
                font-size: 0.76rem;
            }

            .cs-honeypot {
                position: absolute;
                left: -9999px;
                top: -9999px;
                opacity: 0;
                pointer-events: none;
            }

            .cs-form__actions {
                margin-top: 1rem;
                display: flex;
                flex-wrap: wrap;
                align-items: center;
                gap: 0.82rem;
            }

            .cs-form__actions p {
                margin-bottom: 0;
                font-size: 0.83rem;
            }

            .cs-form__actions a,
            .cs-contact-grid a {
                color: var(--cs-green);
                text-decoration: none;
            }

            .cs-form__actions a:hover,
            .cs-contact-grid a:hover {
                color: #a7f2ce;
            }

            .cs-faq {
                display: grid;
                gap: 0.55rem;
            }

            .cs-faq-item {
                border: 1px solid rgba(121, 192, 255, 0.23);
                border-radius: 10px;
                background: rgba(5, 10, 19, 0.84);
            }

            .cs-faq-trigger {
                width: 100%;
                border: 0;
                background: transparent;
                color: var(--cs-text);
                display: flex;
                justify-content: space-between;
                align-items: center;
                text-align: left;
                padding: 0.82rem 0.9rem;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.85rem;
            }

            .cs-faq-icon {
                color: var(--cs-green);
                transition: transform 0.2s ease;
            }

            .cs-faq-trigger[aria-expanded='true'] .cs-faq-icon {
                transform: rotate(45deg);
            }

            .cs-faq-panel {
                padding: 0 0.9rem 0.8rem;
            }

            .cs-faq-panel p {
                margin: 0;
                font-size: 0.91rem;
            }

            .cs-contact-grid {
                display: grid;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 0.8rem;
            }

            .cs-contact-grid article {
                border: 1px solid rgba(121, 192, 255, 0.2);
                border-radius: 11px;
                padding: 0.85rem;
                background: rgba(6, 11, 21, 0.84);
            }

            .cs-contact-grid h3 {
                margin-bottom: 0.45rem;
                font-family: 'JetBrains Mono', monospace;
                font-size: 0.92rem;
                color: var(--cs-orange);
            }

            @media (max-width: 991px) {
                .cs-form-grid,
                .cs-spec-grid,
                .cs-contact-grid {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width: 720px) {
                .cs-landing {
                    padding: 4.1rem 0;
                }

                .cs-panel {
                    padding: 1rem;
                }

                .cs-countdown {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }

                .cs-pipeline li {
                    grid-template-columns: 1.7rem 1fr;
                    grid-template-areas:
                        'line time'
                        'line task'
                        'line detail';
                }
            }
        </style>
    @endpush

    @section('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var root = document.querySelector('.cs-landing');
                if (root) {
                    var launchRaw = root.getAttribute('data-launch-at');
                    var launchDate = new Date(launchRaw);
                    var launchMs = launchDate.getTime();
                    var stateNode = document.getElementById('countdown-state');
                    var parts = {
                        days: document.querySelector('[data-countdown="days"]'),
                        hours: document.querySelector('[data-countdown="hours"]'),
                        minutes: document.querySelector('[data-countdown="minutes"]'),
                        seconds: document.querySelector('[data-countdown="seconds"]')
                    };

                    var setValues = function (d, h, m, s) {
                        parts.days.textContent = String(d).padStart(2, '0');
                        parts.hours.textContent = String(h).padStart(2, '0');
                        parts.minutes.textContent = String(m).padStart(2, '0');
                        parts.seconds.textContent = String(s).padStart(2, '0');
                    };

                    var tick = function () {
                        if (Number.isNaN(launchMs)) {
                            stateNode.textContent = '"INVALID_LAUNCH_DATE"';
                            setValues(0, 0, 0, 0);
                            return;
                        }

                        var remainingMs = launchMs - Date.now();
                        if (remainingMs <= 0) {
                            stateNode.textContent = '"LIVE_NOW"';
                            setValues(0, 0, 0, 0);
                            return;
                        }

                        var totalSeconds = Math.floor(remainingMs / 1000);
                        var days = Math.floor(totalSeconds / 86400);
                        var hours = Math.floor((totalSeconds % 86400) / 3600);
                        var minutes = Math.floor((totalSeconds % 3600) / 60);
                        var seconds = totalSeconds % 60;

                        setValues(days, hours, minutes, seconds);
                        stateNode.textContent = '"T_MINUS_' + String(days).padStart(2, '0') + 'D"';
                    };

                    tick();
                    setInterval(tick, 1000);
                }

                var accordion = document.querySelector('[data-accordion]');
                if (!accordion) {
                    return;
                }

                var items = Array.prototype.slice.call(accordion.querySelectorAll('.cs-faq-item'));

                var setItemState = function (item, isOpen) {
                    var trigger = item.querySelector('.cs-faq-trigger');
                    var panel = item.querySelector('.cs-faq-panel');
                    trigger.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
                    if (isOpen) {
                        panel.removeAttribute('hidden');
                    } else {
                        panel.setAttribute('hidden', 'hidden');
                    }
                };

                items.forEach(function (item) {
                    var trigger = item.querySelector('.cs-faq-trigger');
                    trigger.addEventListener('click', function () {
                        var isCurrentlyOpen = trigger.getAttribute('aria-expanded') === 'true';
                        items.forEach(function (currentItem) {
                            setItemState(currentItem, false);
                        });
                        if (!isCurrentlyOpen) {
                            setItemState(item, true);
                        }
                    });
                });
            });
        </script>
    @endsection
</x-base-layout>
