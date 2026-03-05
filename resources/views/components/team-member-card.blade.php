<div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-delay="200">
    <div class="team-card-wrapper">
        <div class="team-card-box">
            <!-- Image Section -->
            <div class="card-image-container">
                <img class="card-image" 
                     src="{{ isset($image) ? asset('storage/' . $image) : asset('images/profile.png') }}"
                     alt="{{ $name }}" />
                <div class="image-overlay">
                    @if(!empty($contacts))
                        <div class="social-icons-overlay">
                            @foreach($contacts as $contact)
                                <a href="{{ $contact['value'] ?? '#' }}" target="_blank"
                                   title="{{ ucfirst($contact['key']) }}" class="social-link">
                                    @switch(strtolower($contact['key']))
                                        @case('facebook')<i class="fa-brands fa-facebook-f"></i>@break
                                        @case('twitter')<i class="fa-brands fa-twitter"></i>@break
                                        @case('instagram')<i class="fa-brands fa-instagram"></i>@break
                                        @case('linkedin')<i class="fa-brands fa-linkedin-in"></i>@break
                                        @case('youtube')<i class="fa-brands fa-youtube"></i>@break
                                        @case('email')<i class="fa-solid fa-envelope"></i>@break
                                        @case('github')<i class="fa-brands fa-github"></i>@break
                                        @default <i class="fa-solid fa-link"></i>
                                    @endswitch
                                </a>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Info Section -->
            <div class="card-info-section">
                <div class="info-text">
                    <h4 class="member-name">{{ $name }}</h4>
                    <p class="member-role">{{ $role }}</p>
                </div>
                <button class="info-toggle" aria-label="Member options">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <style>
        /* Card wrapper and container */
        .team-card-wrapper { padding: 0.5rem; }
        .team-card-box {
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
        }
        .team-card-wrapper:hover .team-card-box {
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            transform: translateY(-4px);
        }

        /* Image container */
        .card-image-container {
            position: relative;
            overflow: hidden;
            aspect-ratio: 1 / 1;
            background: #f0f0f0;
        }
        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
            transition: transform 0.3s ease;
        }
        .team-card-wrapper:hover .card-image {
            transform: scale(1.05);
        }

        /* Image overlay with social icons */
        .image-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }
        .team-card-wrapper:hover .image-overlay {
            background: rgba(0, 0, 0, 0.4);
        }

        .social-icons-overlay {
            display: flex;
            gap: 1rem;
            opacity: 0;
            transform: scale(0.8);
            transition: all 0.3s ease;
        }
        .team-card-wrapper:hover .social-icons-overlay {
            opacity: 1;
            transform: scale(1);
        }

        .social-link {
            width: 40px;
            height: 40px;
            background: #FAA41A;
            color: #fff;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }
        .social-link:hover {
            background: #fff;
            color: #FAA41A;
            transform: scale(1.1);
        }

        /* Info section */
        .card-info-section {
            padding: 1.2rem 1rem;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .info-text {
            flex: 1;
        }

        .member-name {
            margin: 0 0 0.3rem 0;
            font-size: 1rem;
            font-weight: 600;
            color: #1a1a1a;
            line-height: 1.3;
        }

        .member-role {
            margin: 0;
            font-size: 0.85rem;
            color: #666;
            line-height: 1.3;
        }

        /* Info toggle button */
        .info-toggle {
            background: none;
            border: none;
            color: #FAA41A;
            font-size: 1rem;
            cursor: pointer;
            padding: 0.25rem;
            transition: all 0.3s ease;
            flex-shrink: 0;
        }
        .info-toggle:hover {
            transform: rotate(45deg) scale(1.2);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .card-info-section {
                padding: 1rem;
            }
            .member-name {
                font-size: 0.95rem;
            }
            .member-role {
                font-size: 0.8rem;
            }
        }
    </style>
@endpush
