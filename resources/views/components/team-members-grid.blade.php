@php
    $membersList = $members instanceof \Illuminate\Pagination\LengthAwarePaginator
        ? $members->items()
        : $members;
@endphp

@if (count($membersList))
    @foreach ($membersList as $m)
        <x-team-member-card name="{{ $m->name }}" role="{{ $m->title }}" :links="$m->contacts" :image="$m->image" />
    @endforeach
@else
    <div class="col-12">
        <p class="team-switcher__empty">No members found for this section yet.</p>
    </div>
@endif
