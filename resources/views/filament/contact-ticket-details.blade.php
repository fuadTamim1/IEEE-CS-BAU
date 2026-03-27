<div class="space-y-6">
    <div>
        <h3 class="text-lg font-semibold">Submission</h3>
        <div class="mt-3 space-y-2 text-sm">
            <p><strong>Name:</strong> {{ $ticket->first_name }} {{ $ticket->last_name }}</p>
            <p><strong>Email:</strong> {{ $ticket->email }}</p>
            <p><strong>Phone:</strong> {{ $ticket->phone ?: '-' }}</p>
            <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
            <p><strong>Submitted:</strong> {{ $ticket->created_at?->format('Y-m-d H:i') }}</p>
        </div>
    </div>

    <div>
        <h3 class="text-lg font-semibold">Original Message</h3>
        <p class="mt-2 whitespace-pre-line text-sm">{{ $ticket->message }}</p>
    </div>

    <div>
        <h3 class="text-lg font-semibold">Responses</h3>

        @if($ticket->replies->isEmpty())
            <p class="mt-2 text-sm text-gray-500">No responses yet.</p>
        @else
            <div class="mt-3 space-y-4">
                @foreach($ticket->replies as $reply)
                    <div class="rounded-lg border p-3">
                        <p class="text-xs text-gray-500">
                            {{ $reply->sent_at?->format('Y-m-d H:i') }}
                            @if($reply->responder)
                                by {{ $reply->responder->name }}
                            @endif
                        </p>
                        <p class="mt-2 whitespace-pre-line text-sm">{{ $reply->message }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
