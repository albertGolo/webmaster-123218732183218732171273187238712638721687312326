@extends('layouts.default', [
    'title' => 'Users'
])

@section('css')
    <style>
        img.user-headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
            margin: 0 auto;
            display: block;
        }

        @media only screen and (min-width: 768px) {
            img.user-headshot {
                width: 60%;
            }
        }
    </style>
@endsection

@section('content')
<style>
        a:hover {
            text-decoration: none;
        }

        img.login-headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
            width: 96px;
            height: 96px;
            margin-bottom: -70px;
            z-index: 100;
            position: relative;
        }

        .bounce-in {
            animation: bounce-in .5s ease 1;
            animation-fill-mode: forwards;
        }

        @keyframes  bounce-in {
            0% {
                opacity: 0;
                transform: scale(.3);
            }

            50% {
                opacity: 1;
                transform: scale(1.05);
            }

            70% {
                transform: scale(.9);
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
        <style>
        .user:not(:first-child) {
            padding-top: 15px;
        }

        .user:not(:last-child) {
            padding-bottom: 15px;
            border-bottom: 1px solid var(--divider_color);
        }

        img.user-headshot {
            background: var(--headshot_bg);
            border-radius: 50%;
        }

        @media  only screen and (min-width: 768px) {
            img.user-headshot {
                width: 60px;
            }
        }
    </style>
  <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="row">
                <div class="col-3"><h3>All Players</h3></div>
                <div class="col-9 text-right mt-1"><strong>{{ number_format($total) }} Total Users</strong></div>
            </div>
          <div class="card">
            <div class="card-body">
               <form action="{{ route('users.index') }}" method="GET">
                <input class="form mb-1" type="text" name="search" placeholder="Search..." value="{{ request()->search }}">
            </form>
            </div>
          </div>
    @forelse ($users as $user)
      <div class="card mb-3">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-auto">
              <a href="{{ route('users.profile', $user->username) }}">
                <img src="{{ $user->headshot() }}" alt="{{ $user->displayname }}" class="user-headshot" onerror="this.onerror=null;this.src='/storage/default_headshot.png';">
              </a>

            </div>
            <div class="col ml-n2">
              <h4 class="mb-1">
                <div class="text-truncate mt-1">{{ $user->displayname }}@if ($user->is_verified)<i class="fas fa-shield-check text-success ml-1" style="font-size:16px;" title="This user is verified." data-toggle-modal="#verified-modal"></i>
                                @endif</div>
				<div class="text-xs fw-semibold text-muted"><i>@</i>{{ $user->username }}</div>
              </h4>
              <p class="card-text small text-muted mb-1">
                              </p>
              
                <div class="text-xs fw-semibold text-muted">{{ $user->description }}</div>

            </div>
            <div class="col-auto">
              <a style="font-size:12px;color:#666666;">
                Last seen {{ $user->updated_at->diffForHumans() }}
              </a>
            </div>
            <div>
              <div>
                <div>
                 
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @empty
                        <div class="col">No users have been found.</div>
                    @endforelse
     {{ $users->onEachSide(1) }}
      
        
      </div>
  </div>
</div>
<div class="chat">

</div>
@endsection
