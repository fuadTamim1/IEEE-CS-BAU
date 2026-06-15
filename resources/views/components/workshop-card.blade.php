@php
    $startAt = $workshop->start_at ? \Illuminate\Support\Carbon::parse($workshop->start_at) : null;
    $status = ucfirst($workshop->status ?? 'upcoming');
    $detailsUrl = $workshop->slug ? route('workshops.show', $workshop->slug) : '#';
@endphp

<article class="ieee-workshop-card">
    <a class="ieee-workshop-card__media" href="{{ $detailsUrl }}">
        <img
            src="{{ $workshop->cover ? asset('storage/' . $workshop->cover) : asset('images/home_bg2.png') }}"
            alt="{{ $workshop->name }}"
            class="ieee-workshop-card__image"
        />
        <span class="ieee-workshop-card__status ieee-workshop-card__status--{{ strtolower($workshop->status) }}">{{ $status }}</span>
    </a>

    <div class="ieee-workshop-card__body">
        <h3 class="ieee-workshop-card__title">
            <a href="{{ $detailsUrl }}">{{ $workshop->name }}</a>
        </h3>

        <p class="ieee-workshop-card__desc">
            {{ \Illuminate\Support\Str::limit(strip_tags($workshop->description ?? $workshop->content ?? ''), 120) }}
        </p>

        <div class="ieee-workshop-card__meta">
            <span>
                <i class="fa-regular fa-calendar"></i>
                {{ $startAt ? $startAt->format('M d, Y h:i A') : 'Date TBA' }}
            </span>
            <span>
                <i class="fa-solid fa-location-dot"></i>
                {{ $workshop->location ?: 'Location TBA' }}
            </span>
        </div>

        <a href="{{ $detailsUrl }}" class="ieee-workshop-card__link">
            View Details <i class="fa-solid fa-arrow-right"></i>
        </a>
    </div>
</article>

@once
    @push('styles')
        <style>
            .ieee-workshop-card {
                background: #fff;
                border-radius: 16px;
                overflow: hidden;
                box-shadow: 0 10px 26px rgba(15, 23, 42, 0.1);
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .ieee-workshop-card__media {
                position: relative;
                display: block;
                aspect-ratio: 8 / 10;
                overflow: hidden;
            }

            .ieee-workshop-card__image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: transform 0.4s ease;
            }

            .ieee-workshop-card:hover .ieee-workshop-card__image {
                transform: scale(1.04);
            }

            .ieee-workshop-card__status {
                position: absolute;
                top: 12px;
                right: 12px;
                border-radius: 999px;
                color: #fff;
                font-weight: 700;
                text-transform: uppercase;
                letter-spacing: 0.06em;
                font-size: 0.68rem;
                padding: 0.38rem 0.58rem;
                background: rgba(15, 23, 42, 0.85);
            }

            .ieee-workshop-card__status--upcoming { background: #1d4ed8; }
            .ieee-workshop-card__status--ongoing { background: #059669; }
            .ieee-workshop-card__status--past { background: #6b7280; }

            .ieee-workshop-card__body {
                padding: 1rem 1rem 1.1rem;
                display: flex;
                flex-direction: column;
                gap: 0.75rem;
                /* height: 100%; */
            }

            .ieee-workshop-card__title {
                font-size: 1.15rem;
                margin: 0;
                line-height: 1.3;
            }

            .ieee-workshop-card__title a {
                color: #0f172a;
                text-decoration: none;
            }

            .ieee-workshop-card__desc {
                margin: 0;
                color: #475467;
                line-height: 1.6;
                font-size: 0.94rem;
            }

            .ieee-workshop-card__meta {
                display: grid;
                gap: 0.45rem;
                color: #667085;
                font-size: 0.84rem;
                margin-top: auto;
            }

            .ieee-workshop-card__meta span {
                display: inline-flex;
                align-items: center;
                gap: 0.45rem;
            }

            .ieee-workshop-card__meta i {
                color: #faa41a;
            }

            .ieee-workshop-card__link {
                display: inline-flex;
                gap: 0.45rem;
                align-items: center;
                text-decoration: none;
                color: #faa41a;
                font-weight: 700;
                font-size: 0.88rem;
            }
        </style>
    @endpush
@endonce
