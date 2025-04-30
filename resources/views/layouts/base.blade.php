<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'IEEE CS BAU Chapter') }} - {{$title ?? "Home"}}</title>
    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }} " type="image/x-icon">
    @include('components.basetheme.heads')
</head>

<body class="body1">
    <div class="paginacontainer">

        <div class="progress-wrap bg-white">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

    </div>

    <!--=====progress END=======-->
    @if (get_setting('enable_preloader') != 0)
        @include('components.basetheme.preloader')
    @endif
    @include('components.basetheme.popup-searchbar')

    @include('components.basetheme.header')
    <main>
        {{ $slot }}
    </main>
    {{-- @include('components.basetheme.footer') --}}
    <x-Footer/>

    @include('components.basetheme.scripts')
    @yield('scripts')
</body>

</html>

{{-- 

Thanks For iconscout
<a href="https://iconscout.com/3d-illustrations/python" class="text-underline font-size-sm" target="_blank">Python</a> by <a href="https://iconscout.com/contributors/tomsdesign" class="text-underline font-size-sm">Toms Design</a> on <a href="https://iconscout.com" class="text-underline font-size-sm">IconScout</a>

--}}