@section('css')
    <style>
        .user:not(:first-child) {
            padding-top: 15px;
        }

        .user:not(:last-child) {
            padding-bottom: 15px;
            border-bottom: 1px solid var(--divider_color);
        }

        img.headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        @media  only screen and (min-width: 768px) {
            img.headshot {
                width: 50px;
            }
        }
    </style>
@endsection

@forelse ($users as $user)
<div class="user row">
<div class="col-3 col-md-2 align-self-center text-center">
<img class="headshot" src="{{ $user->headshot() }}">
<div class="text-truncate mt-1">{{ $user->username }}</div>
</a>
</div>
<div class="col-9 col-md-10 align-self-center">
<h5 class="mb-1">Description</h5>
<div class="text-muted text-truncate">{{ $user->description ?? 'This user does not have a description.' }}</div>
</div>
</div>
@empty
    <p>No team members found.</p>
@endforelse
