@extends('layouts.default', [
    'title' => 'Friend Requests'
])

@section('content')
<div class="text-xl fw-semibold mb-1">Friend Requests ({{ number_format($friendRequests->count()) }})</div>
<div class="card card-body mb-3">
<div class="grid-x grid-margin-x">
@forelse ($friendRequests as $friendRequest)
<div class="cell large-3 medium-4 small-6">
<a href="{{ route('users.profile', $friendRequest->sender->username) }}" class="d-block">
<div class="card card-inner position-relative p-2 mb-1">
<img src="{{ $friendRequest->sender->thumbnail() }}">
</div>
<div class="text-body fw-semibold text-truncate">
{{ $friendRequest->sender->username }}
</div>
</a>
<form action="{{ route('account.friends.update') }}" method="POST">
@csrf
<input type="hidden" name="id" value="{{ $friendRequest->sender->id }}">
<div class="min-w-0 flex-container gap-2 mt-3">
<button class="btn btn-success btn-sm text-truncate w-100" name="action" value="accept">
Accept
</button>
<button class="btn btn-danger btn-sm text-truncate w-100" name="action" value="decline">
Decline
</button>
</div>
</form>
<br>
</div>
                @empty
                    <div class="col">You currently have no incoming friend requests.</div>
                    
                @endforelse
            </div>
        </div>
    </div>
    {{ $friendRequests->onEachSide(1) }}
@endsection
