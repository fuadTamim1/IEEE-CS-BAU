@props(['state'])
@if($state)
    <div class="p-4 border rounded-lg">
        <img src="{{ asset('storage/projects/'.basename($state)) }}" 
             class="max-w-full h-auto rounded-lg">
    </div>
@endif