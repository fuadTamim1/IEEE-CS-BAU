<x-base-layout>
    <!--===== HERO AREA START =====-->

    <x-hero title="{{ __('Our Events') }}" background="{{ asset('images/home_bg.png') }}" :breadcrumbs="[
        ['label' => 'events', 'url' => route('events')],
    ]"/>

    <!--===== HERO AREA START =====-->

    <!--=== SERVICE AREA START === -->

    <div class="service5 sp">
        <div class="container">
            <div class="row">
                @foreach ($events as $e)
                    <x-event-card :event=$e/>
                @endforeach
            </div>
        </div>
    </div>

    <!--=== SERVICE AREA END === -->

    <!--===== COUNTER AREA START =====-->
    <x-basetheme.stats-counter />
    <!--===== COUNTER AREA END =====-->

    <!--===== CONTACT AREA START =====-->

    @include('components.contactSection')

    <!--===== CONTACT AREA END =====-->
</x-base-layout>
