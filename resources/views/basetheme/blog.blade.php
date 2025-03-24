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
</x-base-layout>
