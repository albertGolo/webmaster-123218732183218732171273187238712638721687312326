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
                            <a href="#" class="tab-link active squish"
                                >General</a
                            >
                        </li>
                        <li class="tab-item">
                            <a href="#" class="tab-link squish"
                                >Security & Privacy</a
                            >
                        </li>
                        <li class="tab-item">
                            <a href="#" class="tab-link squish">Billing</a>
                        </li>
                    </ul>
                </div>
				<div class="cell medium-8">
                    <div
                        class="alert alert-success fw-semibold mb-3 text-center"
                    >
                        Username Successfully Changed
                    </div>
                    <div class="text-xl fw-semibold mb-1">General</div>
                    <div class="section-borderless">
                        <div class="card card-body">
                            <div class="text-xl fw-semibold mb-2">
                                Account Information
                            </div>
				<form action="{{ route('account.settings.update') }}" method="POST">
                @csrf
                <input type="hidden" name="category" value="{{ $category }}">

                @if ($category == 'general')
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
                                                    2
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
                                                    <input name="displayname" class="form card card-body card-inner flex-container align-middle align-justify gap-2" placeholder="Username" value="{{ Auth::user()->displayname }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="cell medium-6 mb-3">
									 <div
                                                    class="text-truncate text-xs fw-bold text-muted text-uppercase"
                                                >
                                                    Email Address<span
                                                        style="font-size: 10px"
                                                        class="text-success ms-2"
                                                        ><i
                                                            class="fas fa-check me-1"
                                                        ></i
                                                        >Verified</span
                                                    >
                                                    <!-- <span style="font-size: 10px;" class="text-danger ms-2"><i class="fas fa-times me-1"></i>Unverified</span> -->
                                                </div>
                                        <div>
                                            <div class="min-w-0">
                                                <div
                                                    class="text-truncate fw-semibold"
                                                >
                                                    <input name="email" class="form card card-body card-inner flex-container align-middle align-justify gap-2" placeholder="Username" value="soba@gmail.com">
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
                                        class="form form-has-button pe-5"
                                        rows="5"
										placeholder="Hi there, my name is {{ Auth::user()->username }}!"
                                    >{{ Auth::user()->description }}</textarea
                                    >
                                    <input
                                        type="button"
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
                    <div class="section-borderless">
                        <div class="card card-body">
                            <div class="text-xl fw-semibold mb-2">
                                Website Theme
                            </div>
                            <div class="grid-x grid-margin-x">
                                <div class="cell large-6">
                                    <div
                                        class="theme-selection squish card card-body card-inner mb-2 mb-lg-0"
                                        data-theme="light"
                                    >
                                        <div
                                            class="flex-container gap-4 align-middle"
                                        >
                                            <div
                                                class="selection-circle flex-child-grow show-for-large"
                                            ></div>
                                            <div
                                                class="flex-container flex-dir-column align-middle gap-1"
                                                style="min-width: 0"
                                            >
                                                <div
                                                    class="theme-circle light"
                                                ></div>
                                                <div
                                                    class="fw-semibold text-lg text-truncate"
                                                >
                                                    Light Theme
                                                </div>
                                                <div
                                                    class="selection-circle flex-child-grow show-for-small hide-for-large"
                                                ></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cell large-6">
                                    <div
                                        class="theme-selection squish card card-body card-inner"
                                        data-theme="dark"
                                    >
                                        <div
                                            class="flex-container gap-4 align-middle"
                                        >
                                            <div
                                                class="selection-circle flex-child-grow show-for-large"
                                            ></div>
                                            <div
                                                class="flex-container flex-dir-column align-middle gap-1"
                                            >
                                                <div
                                                    class="theme-circle dark"
                                                ></div>
                                                <div
                                                    class="fw-semibold text-lg text-truncate"
                                                >
                                                    Dark Theme
                                                </div>
                                                <div
                                                    class="selection-circle flex-child-grow show-for-small hide-for-large"
                                                ></div>
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
                    <h3>Privacy & Security</h3>
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
                    <h3>Change Password</h3>
                    <hr>
                    <label for="current_password">Current Password</label>
                    <input class="form mb-2" type="password" name="current_password" placeholder="Current Password" required>
                    <label for="new_password">New Password</label>
                    <input class="form mb-2" type="password" name="new_password" placeholder="New Password" required>
                    <label for="new_password_confirmation">Confirm New Password</label>
                    <input class="form mb-3" type="password" name="new_password_confirmation" placeholder="Confirm New Password" required>
                    <button class="btn btn-success" type="submit">Change</button>
                @elseif ($category == 'appearance')
                    <h3>Appearance</h3>
                    <hr>
                    <select class="form form-select mb-3" name="theme" disabled>
                        @foreach ($themes as $theme)
                            <option value="{{ $theme }}" @if (Auth::user()->setting->theme == $theme) selected @endif>{{ ucwords(str_replace('_', ' ', $theme)) }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-success" type="submit">Update</button>
                    <div class="mb-3"></div>
                    <small class="text-muted">Theme's have been disabled and will return with the new settings page re-design soon.</small>
                @endif
            </form>
        </div>
    </div>
@endsection
