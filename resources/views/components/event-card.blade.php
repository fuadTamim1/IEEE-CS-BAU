@php
    $startAt = $event->start_at ? \Illuminate\Support\Carbon::parse($event->start_at) : null;
    $status = ucfirst($event->status ?? 'upcoming');
    $statusClass = 'ieee-event-card__status--' . strtolower($event->status ?? 'upcoming');
@endphp

<article class="ieee-event-card">
    <div class="ieee-event-card__media">
        @if ($event->image)
            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="ieee-event-card__image" />
        @else
            <div class="ieee-event-card__placeholder">
                <i class="fa-solid fa-calendar-days"></i>
            </div>
        @endif

        @if ($startAt)
            <div class="ieee-event-card__date-badge" aria-label="Event date">
                <strong>{{ $startAt->format('d') }}</strong>
                <span>{{ strtoupper($startAt->format('M')) }}</span>
            </div>
        @endif

        <span class="ieee-event-card__status {{ $statusClass }}">{{ $status }}</span>
    </div>

    <div class="ieee-event-card__body">
        <h3 class="ieee-event-card__title">{{ $event->title }}</h3>
        <p class="ieee-event-card__description">{{ \Illuminate\Support\Str::limit(strip_tags($event->description ?? ''), 95) }}</p>

        <div class="ieee-event-card__meta">
            <span>
                <i class="fa-solid fa-location-dot"></i>
                {{ \Illuminate\Support\Str::limit($event->location ?? 'Online', 36) }}
            </span>
            <span>
                <i class="fa-regular fa-clock"></i>
                {{ $startAt ? $startAt->format('D, M j · g:i A') : 'Schedule TBA' }}
            </span>
        </div>

        <a href="{{ url('events/' . $event->slug) }}" class="ieee-event-card__btn">
            View Event
            <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</article>

@once
    @push('styles')
        <style>
            .ieee-event-card {
                --event-accent: #fa5d37;
                --event-bg: #ffffff;
                --event-ink: #18181b;
                --event-muted: #667085;
                position: relative;
                height: 100%;
                border-radius: 20px;
                overflow: hidden;
                background: var(--event-bg);
                box-shadow: 0 12px 30px rgba(17, 24, 39, 0.12);
                transition: transform 0.35s ease, box-shadow 0.35s ease;
                display: flex;
                flex-direction: column;
            }

            .ieee-event-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 20px 42px rgba(17, 24, 39, 0.2);
            }

            .ieee-event-card__media {
                position: relative;
                aspect-ratio: 16 / 10;
                overflow: hidden;
                background: linear-gradient(150deg, #cadff4 0%, #7bb2f4 100%);
            }

            .ieee-event-card__media::after {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(180deg, rgba(6, 11, 22, 0.03) 0%, rgba(6, 11, 22, 0.45) 100%);
            }

            .ieee-event-card__image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.55s ease;
            }

            .ieee-event-card:hover .ieee-event-card__image {
                transform: scale(1.08);
            }

            .ieee-event-card__placeholder {
                width: 100%;
                height: 100%;
                display: grid;
                place-items: center;
                font-size: 3.2rem;
                color: rgba(255, 255, 255, 0.72);
            }

            .ieee-event-card__date-badge {
                position: absolute;
                top: 16px;
                right: 16px;
                z-index: 2;
                width: 62px;
                height: 62px;
                border-radius: 50%;
                background: #ff5630;
                color: #fff;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                line-height: 1;
                box-shadow: 0 8px 20px rgba(255, 86, 48, 0.45);
            }

            .ieee-event-card__date-badge strong {
                font-size: 1.15rem;
                font-weight: 800;
            }

            .ieee-event-card__date-badge span {
                margin-top: 4px;
                font-size: 0.68rem;
                letter-spacing: 0.06em;
                font-weight: 700;
            }

            .ieee-event-card__status {
                position: absolute;
                left: 14px;
                bottom: 14px;
                z-index: 2;
                padding: 7px 12px;
                font-size: 0.73rem;
                text-transform: uppercase;
                border-radius: 999px;
                letter-spacing: 0.08em;
                font-weight: 700;
                color: #fff;
                background: rgba(15, 23, 42, 0.86);
            }

            .ieee-event-card__status--upcoming {
                background: rgba(31, 111, 235, 0.92);
            }

            .ieee-event-card__status--ongoing {
                background: rgba(5, 150, 105, 0.9);
            }

            .ieee-event-card__status--completed {
                background: rgba(107, 114, 128, 0.92);
            }

            .ieee-event-card__body {
                padding: 1.2rem 1.2rem 1.3rem;
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .ieee-event-card__title {
                margin: 0;
                color: var(--event-ink);
                font-size: 1.32rem;
                line-height: 1.3;
                font-weight: 800;
            }

            .ieee-event-card__description {
                margin: 0.65rem 0 1rem;
                color: var(--event-muted);
                font-size: 0.96rem;
                line-height: 1.6;
            }

            .ieee-event-card__meta {
                display: grid;
                gap: 0.42rem;
                margin-top: auto;
                margin-bottom: 1.05rem;
            }

            .ieee-event-card__meta span {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                color: #475467;
                font-size: 0.86rem;
                line-height: 1.3;
            }

            .ieee-event-card__meta i {
                color: #ff7a30;
            }

            .ieee-event-card__btn {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
                width: fit-content;
                border-radius: 999px;
                color: #ffffff;
                text-decoration: none;
                background: linear-gradient(90deg, #ff7a30 0%, #ff4f44 100%);
                padding: 0.58rem 1rem;
                font-size: 0.86rem;
                font-weight: 700;
                transition: transform 0.3s ease, box-shadow 0.3s ease;
                box-shadow: 0 6px 18px rgba(255, 92, 52, 0.35);
            }

            .ieee-event-card__btn:hover {
                color: #fff;
                transform: translateY(-2px);
                box-shadow: 0 10px 24px rgba(255, 92, 52, 0.45);
            }

            .ieee-event-card__btn i {
                transition: transform 0.28s ease;
            }

            .ieee-event-card__btn:hover i {
                transform: translateX(4px);
            }

            @media (max-width: 991px) {
                .ieee-event-card__title {
                    font-size: 1.18rem;
                }
            }

            @media (max-width: 575px) {
                .ieee-event-card__body {
                    padding: 1rem;
                }

                .ieee-event-card__description {
                    font-size: 0.9rem;
                }
            }
        </style>
    @endpush
@endonce
