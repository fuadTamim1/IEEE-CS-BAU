@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'small text-danger text-opacity-75 mb-2']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
