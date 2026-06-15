<x-base-layout>
    <!--===== HERO AREA START =====-->

    <div class="inner-hero" style="background-image: url({{ asset('images/event_bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 m-auto text-center">
                    <div class="inner-main-heading lightmode-bg">
                        <h1>Our Blog</h1>
                        <div class="breadcrumbs-pages">
                            <ul>
                                <li><a href="{{ route('home') }}">Home</a></li>
                                <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                                <li>Our Blog</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--===== HERO AREA START =====-->

    <!--===== BLOG AREA START =====-->

    <div class="blog1 sp">
        <div class="container">
            @foreach ($blogs as $blog)
                {{-- @dump($blog) --}}
                <x-blog-card :blog=$blog></x-blog-card>
            @endforeach




            {{-- @dd($blogs) --}}
            <div class="space60"></div>
            <div class="row">
                <div class="col-12 m-auto">
                    <!-- Pagination Links -->
                    @if ($blogs->hasPages())
                        <div class="theme-pagination text-center">
                            <ul>
                                {{-- First Page Link --}}
                                @if ($blogs->currentPage() > 1)
                                    <li><a href="{{ $blogs->url(1) }}"><i class="fa-solid fa-angles-left"></i></a></li>
                                @endif
                
                                {{-- Previous Page Link --}}
                                @if ($blogs->currentPage() > 1)
                                    <li><a href="{{ $blogs->previousPageUrl() }}"><i class="fa-solid fa-angle-left"></i></a></li>
                                @endif
                
                                {{-- Current Page --}}
                                <li><a class="active" @disabled(true)>{{ $blogs->currentPage() }}</a></li>
                
                                {{-- Next Page Links --}}
                                @if ($blogs->hasMorePages())
                                    {{-- Show next page number --}}
                                    <li><a href="{{ $blogs->nextPageUrl() }}">{{ $blogs->currentPage() + 1 }}</a></li>
                                    
                                    {{-- Show ellipsis if there are more pages after next --}}
                                    @if ($blogs->currentPage() + 1 < $blogs->lastPage())
                                        <li><span>...</span></li>
                                    @endif
                
                                    {{-- Last Page Link --}}
                                    @if ($blogs->currentPage() + 1 < $blogs->lastPage())
                                        <li ><a href="{{ $blogs->url($blogs->lastPage()) }}">{{ $blogs->lastPage() }}</a></li>
                                    @endif
                
                                    {{-- Next Page Arrow --}}
                                    <li><a href="{{ $blogs->nextPageUrl() }}"><i class="fa-solid fa-angle-right"></i></a></li>
                
                                    {{-- Last Page Arrow --}}
                                    <li><a href="{{ $blogs->url($blogs->lastPage()) }}"><i class="fa-solid fa-angles-right"></i></a></li>
                                @endif
                            </ul>
                        </div>
                        
                    @endif
                </div>
            </div>

        </div>
    </div>

    <!--===== BLOG AREA END =====-->

    @push('styles')
        <style>
            .blog1 .ieee-blog-card {
                border: 1px solid rgba(15, 23, 42, 0.1);
                border-radius: 14px;
                overflow: hidden;
                background: #fff;
                box-shadow: 0 7px 22px rgba(15, 23, 42, 0.06);
                transition: transform 0.28s ease, box-shadow 0.28s ease, border-color 0.28s ease;
            }

            .blog1 .ieee-blog-card:hover {
                transform: translateY(-6px);
                border-color: rgba(250, 164, 26, 0.55);
                box-shadow: 0 18px 36px rgba(15, 23, 42, 0.14);
            }

            .blog1 .ieee-blog-card__thumb {
                height: 100%;
                min-height: 250px;
                border-radius: 0;
            }

            .blog1 .ieee-blog-card__thumb-link,
            .blog1 .ieee-blog-card__title a,
            .blog1 .ieee-blog-card__read-more {
                position: relative;
                z-index: 2;
            }

            .blog1 .ieee-blog-card .image-anime::after {
                pointer-events: none;
            }

            .blog1 .ieee-blog-card__content {
                padding: 1.5rem 1.4rem;
                background: linear-gradient(175deg, #fff 0%, #fffdf8 100%);
            }

            .blog1 .ieee-blog-card__meta {
                display: flex;
                flex-wrap: wrap;
                gap: 0.65rem 1.1rem;
            }

            .blog1 .ieee-blog-card__meta span {
                color: #334155;
                font-size: 0.92rem;
                font-weight: 600;
            }

            .blog1 .ieee-blog-card__title {
                margin-top: 0.25rem;
                line-height: 1.35;
            }

            .blog1 .ieee-blog-card__excerpt {
                color: #475569;
                line-height: 1.72;
                margin-bottom: 0;
            }

            @media (max-width: 991px) {
                .blog1 .ieee-blog-card__thumb {
                    min-height: 220px;
                }
            }
        </style>
    @endpush
</x-base-layout>
