<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'IEEE CS BAU Chapter') }} - {{ $title ?? 'Home' }}</title>
    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="{{ asset('images/logo.png') }} " type="image/x-icon">


    {{-- additional libraries --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans:ital,wght@0,100..700;1,100..700&display=swap"
        rel="stylesheet">

    @include('components.basetheme.heads')

</head>

<body class="body-guest">
    <div class="container guest-container ">

        <div class="row">
            <div class="col-md-6 col-sm-12 left-guest-widget position-absolute-sm">
                <div id="particlesGuest-js"></div>
                <div class="logo-header">
                    <a href="/">
                        <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                    </a>
                </div>
                <main>
                    <div class="inner-guest-content">
                        <h4 class="px-2">
                            @yield('title')
                        </h4>
                        <p class="px-2">
                            @yield('description')
                        </p>
                        <div class="mt-4">
                            {{ $slot }}
                        </div>
                    </div>

                </main>

            </div>
            <div class="col-md-6 col-sm-12 img-guest-bg"
                style="background-image: url({{ asset('images/IEEE_CS_BAU_FET_NEON_2.png') }})">

            </div>
        </div>
    </div>

    @include('components.basetheme.scripts')

    <script>
        /* particlesJS.load(@dom-id, @path-json, @callback (optional)); */
        particlesJS.load('particlesGuest-js', "{{ asset('assets/particles.json') }}", function() {
            console.log('callback - particles.js config loaded');
        });
    </script>
</body>

</html>

{{-- 

Thanks For iconscout
<a href="https://iconscout.com/3d-illustrations/python" class="text-underline font-size-sm" target="_blank">Python</a> by <a href="https://iconscout.com/contributors/tomsdesign" class="text-underline font-size-sm">Toms Design</a> on <a href="https://iconscout.com" class="text-underline font-size-sm">IconScout</a>

--}}
