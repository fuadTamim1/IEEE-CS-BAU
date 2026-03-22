<x-base-layout>
    <x-hero :title="__('Workshops')" :desc="__('Past, Ongoing, and Upcoming Workshops')" :background="asset('images/home_bg2.png')" />

    <section class="workshops-hub sp">
        <div class="container">
            <div class="workshops-hub__filters mb-4">
                <a class="workshops-hub__filter {{ $activeStatus === 'all' ? 'is-active' : '' }}" href="{{ route('workshops') }}">
                    All ({{ $totalPublishedCount }})
                </a>
                <a class="workshops-hub__filter {{ $activeStatus === 'upcoming' ? 'is-active' : '' }}" href="{{ route('workshops', ['status' => 'upcoming']) }}">
                    Upcoming ({{ $upcomingCount }})
                </a>
                <a class="workshops-hub__filter {{ $activeStatus === 'ongoing' ? 'is-active' : '' }}" href="{{ route('workshops', ['status' => 'ongoing']) }}">
                    Ongoing ({{ $ongoingCount }})
                </a>
                <a class="workshops-hub__filter {{ $activeStatus === 'past' ? 'is-active' : '' }}" href="{{ route('workshops', ['status' => 'past']) }}">
                    Past ({{ $pastCount }})
                </a>
            </div>

            @if ($workshops->count())
                <div class="row g-4">
                    @foreach ($workshops as $workshop)
                        <div class="col-lg-4 col-md-6">
                            <x-workshop-card :workshop="$workshop" />
                        </div>
                    @endforeach
                </div>

                <div class="mt-4">
                    {{ $workshops->links() }}
                </div>
            @else
                <div class="workshops-hub__empty text-center">
                    <i class="fa-regular fa-calendar-xmark"></i>
                    <p class="mb-0">No workshops found for this category yet.</p>
                </div>
            @endif
        </div>
    </section>

    @push('styles')
        <style>
            .workshops-hub__filters {
                display: flex;
                flex-wrap: wrap;
                gap: 0.65rem;
            }
            .workshops-hub__filter {
                border-radius: 999px;
                padding: 0.45rem 0.9rem;
                font-size: 0.86rem;
                font-weight: 700;
                text-decoration: none;
                color: #344054;
                border: 1px solid #d0d5dd;
                background: #fff;
            }
            .workshops-hub__filter.is-active {
                color: #111827;
                border-color: #faa41a;
                box-shadow: 0 0 0 3px rgba(250, 164, 26, 0.15);
            }
            .workshops-hub__empty {
                border: 1px dashed #d0d5dd;
                border-radius: 14px;
                padding: 2rem 1rem;
                color: #475467;
            }
            .workshops-hub__empty i {
                font-size: 1.8rem;
                color: #faa41a;
                margin-bottom: 0.5rem;
            }
        </style>
    @endpush
</x-base-layout>