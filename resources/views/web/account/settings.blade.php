@extends('layouts.default', [
    'title' => 'Settings'
])

@section('content')
<main>
            <div class="grid-x grid-margin-x grid-padding-y">
                <div class="cell medium-3">
                    <div class="text-xl fw-semibold mb-2">Account Settings</div>
                    <ul class="tabs flex-dir-column">
                        <li class="tab-item">
                            <a href="{{ route('account.settings.index', 'general') }}" class="tab-link @if ($category == 'general') active @endif squish"
                                >General</a
                            >
                        </li>
                        <li class="tab-item">
                            <a href="{{ route('account.settings.index', 'privacy') }}" class="tab-link @if ($category == 'privacy') active @endif squish"
                                >Privacy</a
                            >
                        </li>
						<li class="tab-item">
                            <a href="{{ route('account.settings.index', 'password') }}" class="tab-link @if ($category == 'password') active @endif squish"
                                >Security</a
                            >
                        </li>
						<li class="tab-item">
                            <a href="{{ route('account.settings.index', 'appearance') }}" class="tab-link @if ($category == 'appearance') active @endif squish"
                                >Appearance</a
                            >
                        </li>
                        <li class="tab-item">
                            <a href="{{ route('account.settings.index', 'billing') }}" class="tab-link @if ($category == 'billing') active @endif squish">Billing</a>
                        </li>
                    </ul>
                </div>
				<div class="cell medium-8">
                  
                    <div class="section-borderless">
                        <div class="card card-body">
				<form action="{{ route('account.settings.update') }}" method="POST">
                @csrf
                <input type="hidden" name="category" value="{{ $category }}">

                @if ($category == 'general')
				 <div class="text-xl fw-semibold mb-2">
                                Account Information
                            </div>
                            <div class="section-borderless">
                                <div class="grid-x grid-margin-x">
                                    <div class="cell medium-6 mb-3">
									<div
                                                    class="text-truncate text-xs fw-bold text-muted text-uppercase"
                                                >
                                                    User ID
                                                </div>
                                        <div
                                            class="form"
                                        >
                                            <div class="min-w-0">
                                               
                                                <div
                                                    class="text-truncate fw-semibold"
                                                >
                                                    {{ Auth::user()->id }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell medium-6 mb-3">
									<div
                                                    class="text-truncate text-xs fw-bold text-muted text-uppercase"
                                                >
                                                    Username
                                                </div>
                                        <div>
                                            <div class="min-w-0">
                                                
                                                <div
                                                    class="text-truncate fw-semibold"
                                                >
                                                    <input name="username" class="form card card-body card-inner flex-container align-middle align-justify gap-2" placeholder="Username" value="{{ Auth::user()->username }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell medium-6 mb-3">
									<div
                                                    class="text-truncate text-xs fw-bold text-muted text-uppercase"
                                                >
                                                    Display Name
                                                </div>
                                        <div>
										<div class="min-w-0">
                                                <div
                                                    class="text-truncate fw-semibold"
                                                >
                                                    <input name="displayname" class="form card card-body card-inner flex-container align-middle align-justify gap-2" placeholder="Display Name" value="{{ Auth::user()->displayname }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell medium-6 mb-3">
									 <div
                                                    class="text-truncate text-xs fw-bold text-muted text-uppercase"
                                                >
                                                    Email Address  @if (Auth::user()->email_verified_at =='') <span style="font-size: 10px;" class="text-danger ms-2"><i class="fas fa-times me-1"></i>Unverified</span>
													@else
													<span
                                                        style="font-size: 10px"
                                                        class="text-success ms-2"
                                                        ><i
                                                            class="fas fa-check me-1"
                                                        ></i
                                                        >Verified</span
                                                    >
													@endif
                                                    
                                                </div>
                                        <div>
                                            <div class="min-w-0">
                                                <div
                                                    class="text-truncate fw-semibold"
                                                >
                                                    <input name="email" class="form card card-body card-inner flex-container align-middle align-justify gap-2" placeholder="Email" value="{{ Auth::user()->email }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="text-xs fw-bold text-muted text-uppercase"
                                >
                                    About You
                                </div>
                                <div class="position-relative mb-3">
                                    <textarea
									name="description"
                                        class="form form-has-button pe-5"
                                        rows="5"
                                    >{{ Auth::user()->description }}</textarea
                                    >
                                    <input
                                        type="submit"
                                        class="btn btn-success btn-sm"
                                        value="Update"
										style="
                                            position: absolute;
                                            bottom: 10px;
                                            right: 10px;
                                        "
                                    />
                                </div>
                                <div
                                    class="text-xs fw-bold text-muted text-uppercase"
                                >
                                    Forum Signature
                                </div>
                                <div class="flex-container align-middle gap-2">
                                    <input
                                        type="text"
                                        class="form form-sm btn-sm"
										name="forum_signature"
										placeholder="Forum Signature" value="{{ Auth::user()->forum_signature }}"
                                        value="{{ Auth::user()->forum_signature }}"
                                    />
                                    <input
                                        type="submit"
                                        class="btn btn-success btn-sm"
                                        value="Update"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>
                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                @elseif ($category == 'privacy')
                     <div class="text-xl fw-semibold mb-2">
                               Privacy
                            </div>
                    <hr>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="accepts_messages" @if (Auth::user()->setting->accepts_messages) checked @endif>
                        <label class="form-check-label" for="accepts_messages">Accepts Messages</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="accepts_friends" @if (Auth::user()->setting->accepts_friends) checked @endif>
                        <label class="form-check-label" for="accepts_friends">Accepts Friends</label>
                    </div>
                    <div class="form-check mb-2">
                        <input class="form-check-input" type="checkbox" name="accepts_trades" @if (Auth::user()->setting->accepts_trades) checked @endif>
                        <label class="form-check-label" for="accepts_trades">Accepts Trades</label>
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="public_inventory" @if (Auth::user()->setting->public_inventory) checked @endif>
                        <label class="form-check-label" for="public_inventory">Public Inventory</label>
                    </div>
                    <button class="btn btn-success" type="submit">Update</button>
                @elseif ($category == 'password')
                    <div class="text-xl fw-semibold mb-2">
                               Security
                            </div>
                    <label for="current_password">Current Password</label>
                    <input class="form mb-2" type="password" name="current_password" placeholder="Current Password" required>
                    <label for="new_password">New Password</label>
                    <input class="form mb-2" type="password" name="new_password" placeholder="New Password" required>
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input class="form mb-3" type="password" name="new_password_confirmation" placeholder="Confirm New Password" required>
                    <button class="btn btn-success" type="submit">Change</button>
                @elseif ($category == 'appearance')
                    <div class="text-xl fw-semibold mb-2">
                               Appearance
                            </div>
                    <select class="form form-select mb-3" name="theme">
                        @foreach ($themes as $theme)
                            <option value="{{ $theme }}" @if (Auth::user()->setting->theme == $theme) selected @endif>{{ ucwords(str_replace('_', ' ', $theme)) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success" type="submit">Update</button>
                    <div class="mb-3"></div>
                    
					
				@elseif ($category == 'billing')
                @if (Auth::user()->membership_until == 0)
                <p>You have no active Vextoria + subscription. <a href="/account/upgrade" target="_blank">Click here</a> to upgrade!</p>
            @else
                <p>You currently have an active Vextoria + subscription until {{ Auth::user()->membership_until }}.</p>
                <p>You can contact <a href="mailto:billing@vextoria.com">billing@vextoria.com</a> for billing help.</p>
            @endif
                    
                @endif
            </form>
        </div>
		</div>
		</div>
    </div>
@endsection
