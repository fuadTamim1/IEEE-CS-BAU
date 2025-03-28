<div class="inner-hero" style="background-image: url({{ $background }});">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto text-center lightmode-bg">
                <div class="inner-main-heading">
                    <h1>{{ $title }} </h1>
                    <div class="breadcrumbs-pages">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="angle"><i class="fa-solid fa-angle-right"></i></li>

                            @foreach ($breadcrumbs as $index => $breadcrumb)
                                @if (isset($breadcrumb['url']))
                                    <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a>
                                @else
                                    {{ $breadcrumb['label'] }}
                                @endif

                                @if (!$loop->last)
                                    <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
