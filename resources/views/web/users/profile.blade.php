@extends('layouts.default', [
    'title' => "{$user->username}'s Profile",
    'image' => $user->headshot()
])

@section('meta')
    <meta name="item-types-with-padding" content="{{ json_encode(config('site.item_thumbnails_with_padding')) }}">
    <meta name="item-type-padding-amount" content="{{ itemTypePadding('default') }}">
    <meta name="user-info" data-id="{{ $user->id }}" data-inventory-public="{{ $user->setting->public_inventory }}">
@endsection

@section('js')
    <script src="{{ asset('js/profile.js?v=4') }}"></script>
@endsection

@section('content')
@if ($user->isBanned())
<meta http-equiv="refresh" content="0;url=/404" />
@endif
<div class="modal" id="verified-modal">
            <div class="modal-card modal-card-body modal-card-sm">
                <div class="section-borderless">
                    <div
                        class="flex-container align-justify align-middle gap-2"
                    >
                        <div class="text-lg fw-semibold">Verified Badge</div>
                        <button
                            class="btn-circle"
                            data-toggle-modal="#verified-modal"
                            style="margin-right: -10px"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="section-borderless text-center">
                    <i
                        class="fas fa-shield-check text-6xl text-success mb-3"
                    ></i>
                    <div class="text-sm text-muted fw-semibold">
                        This account is verified because it's a noteable and
                        trustworthy figure in Vextoria.
                    </div>
                </div>
                <div
                    class="flex-container gap-2 align-center section-borderless"
                >
                    <a href="#" class="btn btn-success btn-sm">Learn More</a>
                    <button
                        class="btn btn-secondary btn-sm"
                        data-toggle-modal="#verified-modal"
                    >
                        Close
                    </button>
                </div>
            </div>
        </div>
            <div class="grid-x grid-margin-x grid-padding-y align-center">
                <div class="cell medium-3">
                    <div class="flex-container align-justify align-middle mb-2">
                        <div class="flex-container align-middle gap-3">
                            <div class="text-xl" style="line-height: 16px">
                                <div class="fw-semibold mb-1">{{ $user->displayname }}@if ($user->is_verified)<i class="fas fa-shield-check text-success ml-1" style="font-size:16px;" title="This user is verified." data-toggle-modal="#verified-modal"></i>
                                @endif

                                @if ($user->usernameHistory()->count() > 0)
                                    <i class="fal fa-info-circle text-muted ml-1" style="font-size:16px;" data-tooltip-title="Previous Usernames: {{ $user->usernameHistoryString() }}"></i>
                                @endif</div>
                                <div class="text-sm text-muted fw-semibold">
								@unless (empty($user->username))
								@<a>{{ $user->username }}</a>
								@endunless
                                </div>
                            </div>
                        </div>
                        <div
                            class="dropdown position-relative"
                            style="margin-right: -14px"
                        >
						@if (Auth::check() && $user->id != Auth::user()->id)
                            <button
                                class="far fa-ellipsis-vertical text-sm btn-circle"
                                data-tooltip-title="More"
                                data-tooltip-placement="bottom"
                            ></button>
                            <ul class="dropdown-menu dropdown-menu-end">
							@if ($user->setting->accepts_trades && !$user->isBanned())
                                <li class="dropdown-item">
                                    <a
                                        href="{{ route('account.trades.send', $user->username) }}"
                                        class="dropdown-link dropdown-link-has-icon"
                                    >
                                        <i
                                            class="fas fa-exchange dropdown-icon"
                                        ></i>
                                        Send Trade
                                    </a>
                                </li>
								@endif
                                <li class="dropdown-item">
                                    <a
                                        href="/report"
                                        class="dropdown-link dropdown-link-has-icon"
                                    >
                                        <i
                                            class="fas fa-flag dropdown-icon"
                                        ></i>
                                        Report
                                    </a>
                                </li>
								@if (Auth::check() && Auth::user()->isStaff() && Auth::user()->staff('can_view_user_info'))
                                <div class="flex-container align-middle">
                                    <div class="dropdown-title">Moderation</div>
                                    <li class="divider flex-child-grow"></li>
                                </div>
                                <li class="dropdown-item">
                                    <a
                                        href="{{ route('admin.users.view', $user->id) }}"
                                        class="dropdown-link dropdown-link-has-icon text-danger"
                                    >
                                        <i
                                            class="fas fa-gavel text-danger dropdown-icon"
                                        ></i>
                                        View in Panel
                                    </a>
                                </li>
                            </ul>
							@endif
								@endif
                        </div>
                    </div>
                    <div class="card card-body card-status {{ ($user->online()) ? 'online' : 'offline' }} mb-3">
                        <img src="{{ $user->thumbnail() }}" onerror="this.onerror=null;this.src='/storage/default.png';">
                        <div class="text-center mt-3">
                            <div
                                class="flex-container align-center gap-3 text-sm"
                            >
                                
                            </div>
                            <div class="text-info text-sm fw-semibold">
                               
                            </div>
                        </div>
						@if (Auth::check() && $user->id != Auth::user()->id)
                        <div class="min-w-0 flex-container gap-2 mt-3">
							@if ($areFriends || $isPending || $user->setting->accepts_friends)
							 @if ($areFriends)
							 <form action="{{ route('account.friends.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <input type="hidden" name="action" value="remove">
                            <button
                                class="btn btn-danger btn-sm text-truncate w-100"
                            >
                                Unfriend
                            </button>
							</form>
							@elseif ($isPending)
							 <button
                                class="btn btn-secondary btn-sm text-truncate w-100"
                            >
                                Pending
                            </button>
							 @elseif ($user->setting->accepts_friends)
							 <form action="{{ route('account.friends.update') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $user->id }}">
                                                    <input type="hidden" name="action" value="send">
                                                    <button
                                class="btn btn-success btn-sm text-truncate w-100"
                            >
                                Add
                            </button>
							</form>
							 @endif
                            @endif
                
                           @if ($user->setting->accepts_messages)
						   <a href="{{ route('account.inbox.new', ['message', $user->username]) }}" class="btn btn-info btn-sm text-truncate w-100">Chat</a>
							@endif
                        </div>
						@endif
                        
						@if ($user->hasPrimaryGroup())
                        <a
                            class="card p-2 card-inner flex-container align-middle gap-2 mt-3"
                        >
                            <img
                                src="{{ $user->primaryGroup->thumbnail() }}"
                                class="headshot"
                                width="40"
                            />
                            <div class="min-w-0" style="line-height: 14px">
                                <div
                                    class="text-truncate text-xs fw-bold text-muted text-uppercase"
                                >
                                    Primary Space
                                </div>
                                <div
                                    class="text-truncate fw-semibold text-sm text-body"
                                >
                                    {{ $user->primaryGroup->name }}
                                </div>
                            </div>
                        </a>
                        @endif 
						 
                    </div>
					@if ($user->isBanned())
        <div class="alert bg-danger text-white text-center">
            <span>This user is banned.</span>
        </div>
    @endif
                    @unless (empty($user->description))
                    <div class="text-xl fw-semibold mb-1">About</div>
                    <div class="card card-body mb-3">
                        {!! nl2br(e($user->description)) !!}
                    </div>
                @endunless
                    <div class="text-xl fw-semibold mb-1">Statistics</div>
                    <div class="card card-body mb-3">
                        <div
                            class="flex-container flex-dir-column gap-1 align-middle"
                        >
						@if ($user->membership_until)
                            <div
                                class="text-sm text-membership fw-semibold w-100"
                            >
                                <i
                                    class="fas fa-rocket-launch text-membership text-center"
                                    style="width: 26px"
                                ></i>
                                Vextoria + Subscriber
                            </div>
							@endif
                            <div class="text-sm w-100">
                                <i
                                    class="fas fa-medal text-muted text-center"
                                    style="width: 26px"
                                ></i>
                                Rank Lvl. {{ $user->forum_level }}
                            </div>
                            <div class="text-sm w-100">
                                <i
                                    class="fas fa-users-medical text-muted text-center"
                                    style="width: 26px"
                                ></i>
                                Joined on {{ $user->created_at->format('M d, Y') }}
                            </div>
                            <div class="text-sm w-100">
                                <i
                                    class="fas fa-clock text-muted text-center"
                                    style="width: 26px"
                                ></i>
                                Last seen {{ $user->updated_at->diffForHumans() }}
                            </div>
                            <div class="text-sm w-100">
                                <i
                                    class="fas fa-messages text-muted text-center"
                                    style="width: 26px"
                                ></i>
                                {{ number_format($user->forumPostCount()) }} Discussion Posts
                            </div>
                        </div>
                    </div>
                    <div class="text-xl fw-semibold mb-1">Spaces</div>
                    <div class="card card-body mb-3">     					
              <div @if ($groups->count() > 0) class="grid-x grid-margin-x grid-padding-y" @endif>
			  @forelse ($groups as $group)  
              <div class="cell medium-6 small-6 text-center">
                <a href="{{ route('groups.view', [$group->id, $group->slug()]) }}" class="text-body">
                  <div class="text-xs text-muted fw-bold text-uppercase mb-1">
                  </div>
                  <img src="{{ $group->thumbnail() }}" class="mb-1" />
                  <div>
                    <div class="text-sm fw-semibold text-truncate">
                      {{ $group->name }}
                    </div>
                    <div class="text-xs text-muted fw-semibold">
                    </div>
                  </div>
                </a>
              </div>
			  @empty
			  <div class="flex-container flex-dir-column text-center gap-3">
                            <i class="fas fa-planet-ringed text-5xl text-muted"></i>
                            <div style="line-height: 16px">
                                <div class="fw-bold text-xs text-muted text-uppercase">
                                    No Spaces
                                </div>
                                <div class="text-xs text-muted fw-semibold">
                                    {{ $user->username }} has not joined any spaces.
                                </div>
                            </div>
                        </div>
			  @endforelse
 
            </div>
            
                    </div>
                </div>
				@if ($user->status())
                <div class="cell medium-8">
                    <div style="height: 6px"></div>
                    <div class="flex-container align-justify align-middle mb-1">
                        <div class="text-xl fw-semibold mb-1">Personal Status</div>
                        
                    </div>
                    <div class="card card-body mb-3">
              <div>          
			{{ $user->status() }}
			</div>
					</div>
@endif
            
                    
					<div class="cell medium-8">
                    <div style="height: 6px"></div>
                    <div class="flex-container align-justify align-middle mb-1">
                        <div class="text-xl fw-semibold mb-1">Achievements</div>
                        
                    </div>
                    <div class="card card-body mb-3">
               <div>
                                <div>
                                <div>
                                    
                                </div>
                            </div>
                        </div>
			
@if (!empty($user->badges()))  
			<div class="row">
		@endif
            @forelse ($user->badges() as $badge)  
			<div class="col-6 col-md-2 text-center mb-0">
<a href="{{ route('badges.index') }}" style="color:inherit;text-decoration:none;">
<img src="{{ $badge->image }}">
<div class="text-truncate" style="font-size:14px;">{{ $badge->name }}</div>
</a>
</div>
@empty
<div
                            class="flex-container flex-dir-column text-center gap-3"
                        >
                            <i class="fas fa-award text-5xl text-muted"></i>
                            <div style="line-height: 16px">
                                <div
                                    class="fw-bold text-xs text-muted text-uppercase"
                                >
                                    No Achievements
                                </div>
                                <div class="text-xs text-muted fw-semibold">
                                    {{ $user->username }} has not made any achievements.
                                </div>
                            </div>
                        
@endforelse
           </div>
</div>	 

<div class="cell medium-8">
                    <div style="height: 6px"></div>
                    <div class="flex-container align-justify align-middle mb-1">
                        <div class="text-xl fw-semibold mb-1">Friends</div>
						<a href="{{ route('users.friends', $user->username) }}" class="btn btn-secondary btn-sm"
                            >View All</a
                        >
                        
                    </div>
                    <div class="card card-body mb-3">
               <div>
                                <div>
                                <div>
                                    
                                </div>
                            </div>
                        </div> 
			<div class="row">
            @forelse ($friends as $friend)
			<div class="col-6 col-md-2 text-center mb-0">
<a href="{{ route('users.profile', $friend->username) }}" style="color:inherit;text-decoration:none;">
<img src="{{ $friend->thumbnail() }}" onerror="this.onerror=null;this.src='/storage/default.png';">
<div class="text-truncate" style="font-size:14px;">{{ $friend->username }}</div>
</a>
</div>          
@empty
                            <div class="col text-center">
                                <i class="fas fa-frown text-5xl text-muted"></i>
                                <div style="line-height: 16px">
                                <div
                                    class="fw-bold text-xs text-muted text-uppercase"
                                >
                                    No Friends
                                </div>
                                <div class="text-xs text-muted fw-semibold">
                                    {{ $user->username }} has not made any friends.
                                </div>
                            </div>
                        @endforelse
	</div>
           </div>
</div>	     

		
				
<div class="flex-container align-justify align-left mb-1">
            <div class="text-xl fw-semibold mb-1">Inventory</div>
    </div>
    <div class="card card-body mb-3">
    <div class="section">
        <ul class="tabs">
		@foreach (config('site.inventory_item_types') as $type)
            <li class="tab-item">
                <a class="tab-link @if ($type == 'hat') active @endif squish" data-category="{{ lcfirst(itemType($type, true)) }}">{{ itemType($type, true) }}</a>
            </li>
		 @endforeach
        </ul>
    </div>
    <br>
	@if ($user->setting->public_inventory)  
    <center><div class="row justify-content-center" id="inventory"></center>
    @else
    <center>{{ $user->displayname }}'s inventory is private.</center>
@endif
</div>
</div>
</div>
</div>
@endsection
