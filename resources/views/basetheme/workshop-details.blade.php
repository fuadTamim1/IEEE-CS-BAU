<x-base-layout>
    <x-hero
        :title="$workshop->name"
        :desc="ucfirst($workshop->status) . ' Workshop'"
        :background="asset('images/home_bg.png')"
        :breadcrumbs="[
            ['label' => 'workshops', 'url' => route('workshops')],
            ['label' => $workshop->slug],
        ]"
    />

    <section class="workshop-details sp">
        <div class="container">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    <article class="workshop-details__article">
                        <img
                            src="{{ $workshop->cover ? asset('storage/' . $workshop->cover) : asset('images/home_bg2.png') }}"
                            alt="{{ $workshop->name }}"
                            class="workshop-details__cover"
                        />

                        <div class="workshop-details__meta">
                            <span class="workshop-details__badge workshop-details__badge--{{ $workshop->status }}">{{ ucfirst($workshop->status) }}</span>
                            <span><i class="fa-regular fa-calendar"></i> {{ $workshop->start_at ? $workshop->start_at->format('M d, Y h:i A') : 'Date TBA' }}</span>
                            <span><i class="fa-solid fa-location-dot"></i> {{ $workshop->location ?: 'Location TBA' }}</span>
                        </div>

                        <h2>{{ $workshop->name }}</h2>
                        <p>{{ $workshop->description }}</p>

                        @if ($workshop->content)
                            <div class="workshop-details__content">{!! $workshop->content !!}</div>
                        @endif

                        @if (is_array($workshop->images) && count($workshop->images))
                            <h3 class="mt-5">Gallery</h3>
                            <div class="row g-3 mt-1">
                                @foreach ($workshop->images as $image)
                                    <div class="col-md-4 col-6">
                                        <a href="{{ asset('storage/' . $image) }}" target="_blank" rel="noopener" class="workshop-details__gallery-item">
                                            <img src="{{ asset('storage/' . $image) }}" alt="Workshop gallery image" />
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </article>

                    <section class="workshop-feedback mt-5">
                        <h3>Feedback & Comments</h3>
                        <form method="POST" action="{{ route('workshops.feedback.store', $workshop->slug) }}" class="workshop-feedback__form mt-3">
                            @csrf
                            @guest
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <input type="text" name="author_name" value="{{ old('author_name') }}" class="form-control" placeholder="Your name" />
                                        @error('author_name')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                    <div class="col-md-6">
                                        <input type="email" name="author_email" value="{{ old('author_email') }}" class="form-control" placeholder="Your email (optional)" />
                                        @error('author_email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                            @endguest

                            <div class="row g-3 mt-1">
                                <div class="col-md-3">
                                    <select name="rating" class="form-select">
                                        <option value="">Rate (optional)</option>
                                        @for ($i = 5; $i >= 1; $i--)
                                            <option value="{{ $i }}" {{ (string) old('rating') === (string) $i ? 'selected' : '' }}>{{ $i }} / 5</option>
                                        @endfor
                                    </select>
                                    @error('rating')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                                <div class="col-md-9">
                                    <textarea name="comment" rows="4" class="form-control" placeholder="Share your feedback...">{{ old('comment') }}</textarea>
                                    @error('comment')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>

                            <button class="theme-btn3 mt-3" type="submit">Submit Feedback</button>
                        </form>

                        <div class="workshop-feedback__list mt-4">
                            @forelse ($feedback as $item)
                                <article class="workshop-feedback__item">
                                    <div class="workshop-feedback__head">
                                        <strong>{{ $item->user->name ?? $item->author_name ?? 'Guest' }}</strong>
                                        <span>{{ $item->created_at->diffForHumans() }}</span>
                                    </div>
                                    @if ($item->rating)
                                        <p class="workshop-feedback__rating">Rating: {{ $item->rating }}/5</p>
                                    @endif
                                    <p>{{ $item->comment }}</p>
                                </article>
                            @empty
                                <p class="text-muted">No feedback yet. Be the first to leave a comment.</p>
                            @endforelse
                        </div>

                        <div class="mt-4">{{ $feedback->links() }}</div>
                    </section>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0">
                    <aside class="workshop-details__sidebar">
                        <h4>Host</h4>
                        <div class="workshop-details__host">
                            <img src="{{ $workshop->host_image ? asset('storage/' . $workshop->host_image) : asset('images/profile.png') }}" alt="Host image" />
                            <h5>{{ $workshop->host_name ?: 'Host TBA' }}</h5>
                            <p class="mb-1">{{ $workshop->host_title ?: 'Workshop Host' }}</p>
                            @if ($workshop->host_bio)
                                <p>{{ $workshop->host_bio }}</p>
                            @endif
                        </div>

                        @if ($workshop->google_form_url)
                            <a href="{{ $workshop->google_form_url }}" target="_blank" rel="noopener" class="theme-btn3 w-100 mt-3 text-center">
                                Attend Meeting Form
                            </a>
                        @endif

                        @if ($relatedWorkshops->count())
                            <div class="mt-5">
                                <h4>More Workshops</h4>
                                <div class="d-grid gap-3 mt-3">
                                    @foreach ($relatedWorkshops as $item)
                                        <x-workshop-card :workshop="$item" />
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .workshop-details__article {
                background: #fff;
                border-radius: 16px;
                padding: 1rem;
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
            }
            .workshop-details__cover {
                width: 100%;
                border-radius: 12px;
                aspect-ratio: 16 / 9;
                object-fit: cover;
                margin-bottom: 1rem;
            }
            .workshop-details__meta {
                display: flex;
                flex-wrap: wrap;
                gap: 0.75rem;
                color: #475467;
                font-size: 0.9rem;
                margin-bottom: 1rem;
            }
            .workshop-details__meta span { display: inline-flex; align-items: center; gap: 0.35rem; }
            .workshop-details__badge {
                color: #fff;
                border-radius: 999px;
                padding: 0.3rem 0.6rem;
                font-size: 0.75rem;
                text-transform: uppercase;
                letter-spacing: 0.05em;
                font-weight: 700;
            }
            .workshop-details__badge--upcoming { background: #1d4ed8; }
            .workshop-details__badge--ongoing { background: #059669; }
            .workshop-details__badge--past { background: #6b7280; }
            .workshop-details__gallery-item img {
                width: 100%;
                height: 160px;
                border-radius: 10px;
                object-fit: cover;
            }
            .workshop-details__sidebar {
                background: #fff;
                border-radius: 16px;
                padding: 1rem;
                box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
                position: sticky;
                top: 110px;
            }
            .workshop-details__host img {
                width: 100%;
                max-width: 120px;
                height: 120px;
                border-radius: 50%;
                object-fit: cover;
                margin-bottom: 0.8rem;
            }
            .workshop-feedback__item {
                border: 1px solid #eaecf0;
                border-radius: 12px;
                padding: 0.8rem;
                margin-bottom: 0.8rem;
            }
            .workshop-feedback__head {
                display: flex;
                justify-content: space-between;
                gap: 1rem;
                margin-bottom: 0.35rem;
            }
            .workshop-feedback__rating {
                color: #f59e0b;
                font-weight: 700;
                margin-bottom: 0.35rem;
            }
        </style>
    @endpush
</x-base-layout>
