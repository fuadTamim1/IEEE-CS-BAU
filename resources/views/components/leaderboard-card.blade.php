<div class="card shadow-sm rounded-4 overflow-hidden h-100 mb-3">
    <img src="{{ $image ?? asset('images/profile.png') }}" class="card-img-top" alt="Top 1 Member Image">

    <div class="card-body text-center">
        <h5 class="card-title fw-bold mb-2">#1 {{ $first }}</h5>
        <p class="text-muted small mb-0">Top Member - Week {{ $week }}</p>
    </div>
    <ul class="list-group list-group-flush text-center">
        <li class="list-group-item">#2 {{ $second }}</li>
        <li class="list-group-item">#3 {{ $thierd }}</li>
    </ul>

    <div class="card-body d-flex justify-content-center gap-2 p-3">
        <a href="{{ route('leaderboard.show', ['id' => $id]) }}" class="btn btn-outline-primary w-100">
            <i class="bi bi-eye-fill me-1"></i> View
        </a>
        {{-- <a href="#" class="btn btn-primary w-100 text-white">
            <i class="bi bi-share-fill me-1"></i> Share
        </a> --}}
    </div>
</div>
