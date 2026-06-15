<div class="card leaderboard-history-card shadow-sm rounded-4 overflow-hidden h-100 mb-3">
    <img src="{{ $image ?? asset('images/profile.png') }}" class="card-img-top" alt="Top ranked member image for week {{ $week ?? '-' }}">

    <div class="card-body text-center">
        <h5 class="card-title fw-bold mb-2">#1 {{ $first ?? '-' }}</h5>
        <p class="text-muted small mb-0">Top Member - Week {{ $week ?? "-" }}</p>
    </div>
    <ul class="list-group list-group-flush text-center">
        <li class="list-group-item">#2 {{ $second ?? '-' }}</li>
        <li class="list-group-item">#3 {{ $third ?? '-' }}</li>
    </ul>

    <div class="card-body d-flex justify-content-center gap-2 p-3">
        @if (!empty($id))
            <a href="{{ route('leaderboard.show', ['id' => $id]) }}" class="btn btn-outline-primary w-100" aria-label="View leaderboard for week {{ $week ?? '-' }}">
                <i class="bi bi-eye-fill me-1" aria-hidden="true"></i> View
            </a>
        @else
            <button class="btn btn-outline-primary w-100" type="button" disabled aria-disabled="true">View Unavailable</button>
        @endif
    </div>
</div>
