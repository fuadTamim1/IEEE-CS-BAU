@props(['img' => null])

@php
    $imagePath = $img 
        ? asset('storage/' . $img) 
        : asset('images/placeholder.jpg');
@endphp

<img class="w-full h-full" src="{{ $imagePath }}" alt="">
