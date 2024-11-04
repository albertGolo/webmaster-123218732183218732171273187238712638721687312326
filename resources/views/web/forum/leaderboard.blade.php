@extends('layouts.default', [
    'title' => 'Leaderboard'
])

@section('css')
    <style>
        .thread {
            padding-top: 15px;
            padding-bottom: 15px;
        }

        .thread:not(:last-child) {
            border-bottom: 1px solid var(--divider_color);
        }

        .thread:hover {
            background: var(--section_bg_hover);
        }

        .thread .user-headshot {
            width: 50px;
            height: 50px;
            float: left;
            position: relative;
            overflow: hidden;
        }

        .thread .user-headshot img {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        .thread .details {
            padding-left: 25px;
        }

        .thread .status {
            font-size: 11px;
            border-radius: 4px;
            margin-top: -2px;
            margin-right: 5px;
            padding: 0.5px 5px;
            font-weight: 600;
            display: inline-block;
        }

        .thread .status i {
            font-size: 10px;
            vertical-align: middle;
        }

        .thread .status i.fa-lock {
            margin-top: -1px;
        }
    </style>
@endsection

@section('content')
    <h3>Top Posters</h3>
    <ul class="breadcrumb forum">
        <li class="breadcrumb-item"><a href="{{ route('forum.index') }}">Forum</a></li>
        <li class="breadcrumb-item active">Leaderboard</li>
    </ul>
     <div class="row">
        @include('web.forum._leadbar', ['mobile' => true])
        <div class="col-md">
           <div class="card">
            {{-- ugly --}}
               @forelse ($users as $user)
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 text-center">
                                <a href="{{ route('users.profile', $user->username) }}">
                                    <img src="{{ $user->thumbnail() }}">
                                </a>
                            </div>
                            <div class="col-md-9 align-self-center">
                                <h3 class="fw-bold">
                                    <a href="{{ route('users.profile', $user->username) }}" style="color: inherit">{{ $user->username }}</a>
                                </h3>
                                <div class="text-muted">
                                    <h5 class="mb-0">Posts: {{ $user->forumPostCount() }}</h5>
                                    <h5 class="mb-0">Level: {{ $user->forum_level }}</h5>
                                    <h5 class="mb-0">EXP: {{ $user->forum_exp }}</h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="card-body">No users have been found.</div>
                    @endforelse
            </div>
        </div>
        @include('web.forum._leadbar', ['mobile' => false])
    </div>
@endsection