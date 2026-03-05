<div class="event-card-wrapper">
    <div class="event-card-box">
        <!-- Image Section -->
        <div class="event-image-container">
            @if ($event->image)
                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="event-image" />
            @else
                <div class="event-image-placeholder">
                    <i class="fa-solid fa-calendar"></i>
                </div>
            @endif
        </div>

        <!-- Content Section -->
        <div class="event-card-content">
            <h3 class="event-title">{{ $event->title }}</h3>
            <p class="event-description">{{ Str::limit($event->description, 80) }}</p>
            <a href="{{ url('events/' . $event->slug) }}" class="event-btn">
                Learn More <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

    @push('styles')
        <style>
            .event-card-wrapper {
                padding: 0.75rem;
                height: 100%;
                display: flex;
                flex-direction: column;
            }

            .event-card-box {
                background: #fff;
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
                display: flex;
                flex-direction: column;
                height: 100%;
            }

            .event-card-wrapper:hover .event-card-box {
                box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
                transform: translateY(-6px);
            }

            /* Image Container */
            .event-image-container {
                position: relative;
                overflow: hidden;
                aspect-ratio: 4 / 3;
                background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
                flex-shrink: 0;
            }

            .event-image {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
                transition: transform 0.4s ease;
            }

            .event-image-placeholder {
                width: 100%;
                height: 100%;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(135deg, #f5f5f5 0%, #e0e0e0 100%);
                font-size: 3rem;
                color: #ccc;
            }

            .event-card-wrapper:hover .event-image {
                transform: scale(1.08);
            }

            /* Content Section */
            .event-card-content {
                padding: 1.25rem;
                flex: 1;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .event-title {
                margin: 0 0 0.75rem 0;
                font-size: 1.125rem;
                font-weight: 600;
                color: #1a1a1a;
                line-height: 1.4;
                word-break: break-word;
            }

            .event-description {
                margin: 0 0 1rem 0;
                font-size: 0.95rem;
                color: #666;
                line-height: 1.5;
                flex-grow: 1;
            }

            /* Button */
            .event-btn {
                display: inline-flex;
                align-items: center;
                gap: 0.5rem;
                padding: 0.75rem 1.25rem;
                background: #FAA41A;
                color: #fff;
                text-decoration: none;
                border-radius: 6px;
                font-size: 0.95rem;
                font-weight: 500;
                transition: all 0.3s ease;
                border: 2px solid #FAA41A;
                width: fit-content;
            }

            .event-btn:hover {
                background: transparent;
                color: #FAA41A;
            }

            .event-btn i {
                font-size: 0.85rem;
                transition: transform 0.3s ease;
            }

            .event-btn:hover i {
                transform: translateX(4px);
            }

            /* Responsive Design */
            @media (max-width: 1024px) {
                .event-card-content {
                    padding: 1rem;
                }

                .event-title {
                    font-size: 1rem;
                }

                .event-description {
                    font-size: 0.9rem;
                }
            }

            @media (max-width: 768px) {
                .event-card-wrapper {
                    padding: 0.5rem;
                }

                .event-card-content {
                    padding: 0.875rem;
                }

                .event-title {
                    font-size: 0.95rem;
                }

                .event-description {
                    font-size: 0.85rem;
                    margin-bottom: 0.75rem;
                }
            }
        </style>
    @endpush
