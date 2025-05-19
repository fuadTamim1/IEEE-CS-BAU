@props(['class' => '', 'style' => '', 'background' => '', 'title' => '', 'desc' => '', 'breadcrumbs' => []])

<div class="inner-hero {{ $class }}"
    {{ $attributes->merge(['style' => "background-image: url('$background'); $style"]) }}>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto text-center lightmode-bg">
                <div class="inner-main-heading">
                    @if ($title != '')
                        <h1>{{ $title }} </h1>
                        @if ($desc != '')
                            <h4>
                                {{ $desc }}
                            </h4>
                        @endif
                        @if (!empty($breadcrumbs))
                            <div class="breadcrumbs-pages">
                                <ul>
                                    <li><a href="{{ route('home') }}">Home</a></li>
                                    <li class="angle"><i class="fa-solid fa-angle-right"></i></li>

                                    @foreach ($breadcrumbs as $index => $breadcrumb)
                                        @if (isset($breadcrumb['url']))
                                            <li><a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['label'] }}</a></li>
                                        @else
                                            <li>{{ $breadcrumb['label'] }}</li>
                                        @endif

                                        @if (!$loop->last)
                                            <li class="angle"><i class="fa-solid fa-angle-right"></i></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
