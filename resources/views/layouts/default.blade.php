<!--
MIT License

Copyright (c) 2021-2022 FoxxoSnoot

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
-->

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ isset($title) ? "{$title} | " . config('site.name') : config('site.name') }}</title>

    <!-- Preconnect -->
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">

    <!-- Meta -->
    <link rel="shortcut icon" href="{{ asset('img/main.png') }}">
    <meta name="author" content="{{ config('site.name') }}">
    <meta name="description" content="Explore {{ config('site.name') }}: A free online social hangout.">
    <meta name="keywords" content="{{ strtolower(config('site.name')) }}, {{ strtolower(str_replace(' ', '', config('site.name'))) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <!-- OpenGraph -->
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ config('site.name') }}">
    <meta property="og:title" content="{{ str_replace(' | ' . config('site.name'), '', $title) }}">
    <meta property="og:description" content="Explore {{ config('site.name') }}: A free online social hangout.">
    <meta property="og:image" content="{{ !isset($image) ? asset('img/main.png') : $image }}">

    <!-- Fonts -->
    
    @yield('fonts')

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/stylesheet.css?r=4') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
 <link rel="stylesheet" href="{{ (Auth::check()) ? asset('css/themes/' . Auth::user()->setting->theme . '.css?v=' . rand()) : asset('css/themes/style.css?v=' . rand()) }}">
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
    @yield('css')
</head>
<body>
    <nav class="navbar">
            <ul class="navbar-nav grid-x">
                <li
                    class="nav-item cell shrink show-for-small hide-for-large me-1"
                >
                    <button class="btn-circle squish" id="sidebar-toggler">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </li>
                <li class="nav-item cell shrink me-2">
                    <a href="/" class="nav-link">
                        <img
                            src="{{ asset('img/favicon.png') }}"
                            class="show-for-medium"
                            width="180"
                        />
                        <img
                            src="{{ asset('img/main.png') }}"
                            class="show-for-small-only"
                            width="43"
                        />
                    </a>
                </li>
				<li class="nav-item cell shrink show-for-large">
                <a href="/games" class="nav-link">Games</a>
            </li>
            <li class="nav-item cell shrink show-for-large">
                <a href="{{ route('catalog.index') }}" class="nav-link">Market</a>
            </li>
            <li class="nav-item cell shrink show-for-large">
                <a href="{{ route('forum.index') }}" class="nav-link">Forum</a>
            </li>
            <li class="nav-item cell shrink show-for-large">
                <a href="#" class="nav-link">Develop</a>
            </li>
                <li class="nav-item cell auto align-middle nav-search mx-1 mx-md-3">
                    <input type="text" class="form" id="global-search-bar" placeholder="Search...">
                    <ul class="dropdown-menu hide" id="global-search-results"></ul>
                    <button data-tooltip-title="Search" data-tooltip-placement="bottom">
                        <i class="fas fa-search"></i>
                    </button>
                </li>
				@guest
				<li class="nav-item cell shrink show-for-large me-1">
<a href="/sign-up" class="btn btn-success">Get Started</a>
</li>
<li class="nav-item cell shrink show-for-large ms-1">
<a href="/login" class="btn btn-info">Log In</a>
</li>
</ul>
@else
                 <li class="position-relative nav-item cell shrink">
                    <div class="show-for-small-only position-relative">
                        <a href="#" class="btn-circle squish px-2 text-body"
                            >
                            ><i class="fas fa-bell text-xl"></i
                        ></a>
                    </div>
                    <div class="dropdown show-for-medium position-relative">
                        <div class="btn-circle squish">
                            <button
                                class="px-2 text-body"
                                data-tooltip-title="Notifications"
                                data-tooltip-placement="bottom"
                            >
                                
                                <i class="fas fa-bell text-xl"></i>
                            </button>
                        </div>
                        <ul
                            class="dropdown-menu dropdown-menu-end"
                            style="width: 340px"
                        >
                            <div class="flex-container align-middle">
                                <div class="dropdown-title">Notifications</div>
                                <li class="divider flex-child-grow"></li>
                            </div>
                            <li class="dropdown-item px-2 text-center py-2">
                                <div
                                    class="flex-container flex-dir-column gap-3"
                                >
                                    <i
                                        class="fas fa-face-sleeping text-5xl text-muted"
                                    ></i>
                                    <div style="line-height: 16px">
                                        <div
                                            class="fw-bold text-xs text-muted text-uppercase"
                                        >
                                            No Notifications
                                        </div>
                                        <div
                                            class="text-xs text-muted fw-semibold"
                                        >
                                            You have not recieved any
                                            notifications recently.
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <!--
                <li class="dropdown-item">
                <a href="#" class="dropdown-link">
                  <div class="flex-container gap-1 align-middle">
                    <i
                      class="fas fa-comments-alt text-info text-lg text-center flex-child-grow"
                      style="width: 38px"
                    ></i>
                    <div class="flex-container align-middle gap-2 w-100">
                      <img
                        src="dummy_headshot.png"
                        class="headshot flex-child-shrink"
                        height="40"
                        width="40"
                      />
                      <div class="min-w-0" style="line-height: 16px">
                        <div class="text-truncate text-sm">
                          <span class="search-keyword">Riley</span>
                          <span class="text-muted text-sm"
                            >replied to your forum post</span
                          >
                        </div>
                        <div class="text-xs text-muted">8 min ago</div>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <li class="dropdown-item">
                <a href="#" class="dropdown-link">
                  <div class="flex-container gap-1 align-middle">
                    <i
                      class="fas fa-users-medical text-success text-lg text-center flex-child-grow"
                      style="width: 38px"
                    ></i>
                    <div class="flex-container align-middle gap-2 w-100">
                      <img
                        src="dummy_headshot.png"
                        class="headshot flex-child-shrink"
                        height="40"
                        width="40"
                      />
                      <div class="min-w-0" style="line-height: 16px">
                        <div class="text-truncate text-sm">
                          <span class="search-keyword">Nabrious</span>
                          <span class="text-muted text-sm"
                            >sent you a friend request</span
                          >
                        </div>
                        <div class="text-xs text-muted">8 min ago</div>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <li class="dropdown-item">
                <a href="#" class="dropdown-link">
                  <div class="flex-container gap-1 align-middle">
                    <i
                      class="fas fa-message-lines text-warning text-lg text-center flex-child-grow"
                      style="width: 38px"
                    ></i>
                    <div class="flex-container align-middle gap-2 w-100">
                      <img
                        src="dummy_headshot.png"
                        class="headshot flex-child-shrink"
                        height="40"
                        width="40"
                      />
                      <div class="min-w-0" style="line-height: 16px">
                        <div class="text-truncate text-sm">
                          <span class="search-keyword">Squidward</span>
                          <span class="text-muted text-sm"
                            >sent you a message</span
                          >
                        </div>
                        <div class="text-xs text-muted">8 min ago</div>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              <li class="dropdown-item">
                <a href="#" class="dropdown-link">
                  <div class="flex-container gap-1 align-middle">
                    <i
                      class="fas fa-exchange text-danger text-lg text-center flex-child-grow"
                      style="width: 38px"
                    ></i>
                    <div class="flex-container align-middle gap-2 w-100">
                      <img
                        src="dummy_headshot.png"
                        class="headshot flex-child-shrink"
                        height="40"
                        width="40"
                      />
                      <div class="min-w-0" style="line-height: 16px">
                        <div class="text-truncate text-sm">
                          <span class="search-keyword">Hunter</span>
                          <span class="text-muted text-sm"
                            >sent you a trade request</span
                          >
                        </div>
                        <div class="text-xs text-muted">8 min ago</div>
                      </div>
                    </div>
                  </div>
                </a>
              </li>
              -->
                            <li class="divider"></li>
                            <!--
                <li class="dropdown-item">
                <a href="#" class="dropdown-link">
                  <div class="flex-container align-middle align-justify">
                    <div class="flex-container align-middle gap-2">
                      <i
                        class="fas fa-check headshot text-lg text-muted flex-container align-center align-middle flex-child-grow"
                        style="height: 38px; width: 38px"
                      ></i>
                      <div class="text-sm">Mark All As Read</div>
                    </div>
                  </div>
                </a>
              </li>
              -->
                            <li class="dropdown-item">
                                <a href="/notifications" class="dropdown-link">
                                    <div
                                        class="flex-container align-middle align-justify"
                                    >
                                        <div
                                            class="flex-container align-middle gap-2"
                                        >
                                            <i
                                                class="fas fa-bell headshot text-lg text-muted flex-container align-center align-middle flex-child-grow"
                                                style="
                                                    height: 38px;
                                                    width: 38px;
                                                "
                                            ></i>
                                            <div class="text-sm">
                                                Show All Notifications
                                            </div>
                                        </div>
                                        <i
                                            class="fas fa-chevron-right text-muted text-sm px-1"
                                        ></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> 
                 <li class="nav-item cell shrink show-for-large">
                    <a href="{{ route('account.money.index', '') }}" data-toggle-modal="#display-conversion" class="nav-link text-sm" style="line-height: 20px"
                        data-tooltip-html data-tooltip-title="<div>{{ str_replace('from now', '', Auth::user()->next_currency_payout->diffForHumans()) }} until next reward</div>"
                        data-tooltip-placement="bottom">
                        <div class="text-success">
                            <i class="fas fa-money-bill-1-wave"
                                style="width: 22px"></i>{{ number_format(Auth::user()->currency) }}
                        </div>
                    </a>
                </li>
                <li class="dropdown position-relative nav-item cell shrink ms-1">
                    <button class="flex-container squish align-middle gap-2">
                        <img src="{{ Auth::user()->headshot() }}" class="headshot" alt="headshot" width="40">
                        <div class="text-start show-for-large">
                            <div class="fw-semibold text-sm text-body">
                                {{ Str::limit(Auth::user()->displayname, 10, '...') }}
                            </div>
                            <div class="text-muted fw-semibold text-xs">
                                <i>@</i>{{ Str::limit(Auth::user()->username, 10, '...') }} • Lvl. {{ Auth::user()->forum_level }}
                            </div>
                        </div>
                        <i class="fas fa-chevron-down text-sm text-muted show-for-large"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <div class="show-for-small hide-for-large">
                            <div class="px-2 py-1 flex-container align-middle gap-2">
                                <img src="{{ Auth::user()->headshot() }}" class="headshot flex-child-shrink" alt="headshot" width="40">
                                <div class="text-start" style="line-height: 12px">
                                    <div class="fw-semibold text-sm">
                                        {{ Str::limit(Auth::user()->displayname, 10, '...') }}
                                    </div>
                                    <div
                                        class="text-muted fw-semibold text-xs mb-1"
                                    >
                                        
                                    </div>
                                    <div class="text-muted fw-semibold text-xs">
                                        <i>@</i>{{ Str::limit(Auth::user()->username, 10, '...') }} • Lvl. {{ Auth::user()->forum_level }}
                                    </div>
                                </div>
                            </div>
                            <li class="dropdown-item">
                                <a
                                    href="#"
                                    class="dropdown-link dropdown-link-has-icon text-success"
                                    ><i
                                        class="fas fa-money-bill-1-wave text-success dropdown-icon"
                                    ></i
                                    >{{ number_format(Auth::user()->currency) }}  Cash</a
                                >
                            </li>
                        </div>
                        <div class="flex-container align-middle">
                            <div class="dropdown-title">Account</div>
                            <li class="divider flex-child-grow"></li>
                        </div>
                        <li class="dropdown-item">
                            <a
                                href="{{ route('users.profile', Auth::user()->username) }}"
                                class="dropdown-link dropdown-link-has-icon"
                                ><i class="fas fa-user dropdown-icon"></i
                                >Profile</a
                            >
                        </li>
						 @if (site_setting('character_enabled'))
                        <li class="dropdown-item">
                            <a
                                href="{{ route('account.character.index') }}"
                                class="dropdown-link dropdown-link-has-icon"
                                ><i class="fas fa-edit dropdown-icon"></i
                                >Character</a
                            >
                        </li>
						@endif
						@if (site_setting('settings_enabled'))
                        <li class="dropdown-item">
                            <a
                                href="{{ route('account.settings.index', '') }}"
                                class="dropdown-link dropdown-link-has-icon"
                                ><i class="fas fa-cogs dropdown-icon"></i
                                >Settings</a
                            >
                        </li>
						 @endif
						@if (Auth::user()->isStaff())
						<li class="dropdown-item">
                            <a
                                href="{{ route('admin.index') }}"
                                class="dropdown-link dropdown-link-has-icon"
                                ><i class="fas fa-gavel dropdown-icon"></i
                                >Panel</a>
								@if (pendingAssetsCount() > 0 || pendingReportsCount() > 0)
                        <span class="notification float-right">
                            @if (pendingAssetsCount() > 0)
                                <span>(A: {{ number_format(pendingAssetsCount()) }})</span>
                            @endif

                            @if (pendingReportsCount() > 0)
                                <span>(R: {{ number_format(pendingReportsCount()) }})</span>
                            @endif
                        </span>
                    @endif
                </a>
                        </li>
						@endif
                        <li class="divider"></li>
                        <li class="dropdown-item">
                            <a
                                href="/logout"
                                class="dropdown-link dropdown-link-has-icon text-danger"
                                ><i
                                    class="fas fa-sign-out text-danger dropdown-icon"
                                ></i
                                >Logout</a
                            >
                        </li>
                    </ul>
                </li>
            </ul>
			@endguest
        </nav>
		<div class="navbar-search-dropdown-parent">
        <div class="navbar-search-dropdown" id="navbarSearchResults" style="display:none;"></div>
    </div>
    <nav class="sidebar show-for-large">
            <ul class="sidebar-nav">
                <li class="side-item side-title">Navigation</li>
                <li class="side-item">
                    <a href="/" class="side-link"
                        ><i class="fas fa-home side-icon"></i
                        ><span>Home</span></a
                    >
                </li>
                <li class="side-item side-title">Social</li>
                <li class="side-item">
                    <a href="{{ route('users.index', '') }}" class="side-link"
                        ><i class="fas fa-users side-icon"></i
                        ><span>Players</span></a
                    >
                </li>
                <li class="side-item">
                    <a href="{{ route('groups.index') }}" class="side-link"
                        ><i class="fas fa-planet-ringed side-icon"></i
                        ><span>Spaces</span></a
                    >
                </li>
				<li class="side-item">
                <a href="/discussion/leaderboard" class="side-link "><i class="fas fa-list-ol side-icon"></i><span>Leaderboard</span></a>
            </li>
                @auth
				<li class="side-item side-title">Personal</li>
                <li class="side-item">
                    <a href="{{ route('account.friends.index') }}" class="side-link"
                        ><i class="fas fa-user-friends side-icon"></i
                        ><span>Friends</span></a
                    >
                </li>
				<li class="side-item">
                    <a href="{{ route('account.inbox.index', '') }}" class="side-link"
                        ><i class="fas fa-inbox side-icon"></i
                        ><span>Inbox</span></a
                    >
                </li>
				<li class="side-item">
                    <a href="{{ route('account.trades.index', '') }}" class="side-link"
                        ><i class="fas fa-exchange side-icon"></i
                        ><span>Trades</span></a
                    >
                </li>
                
                @unless (empty($myGroups))
                    <li class="side-item side-title">My Spaces</li>
                    
                    @foreach ($myGroups as $myGroup)
                        <li class="side-item">
                            <a href="{{ route('groups.view', [$myGroup->id, $myGroup->slug()]) }}" class="side-link side-link-has-img">
                                <span class="side-img">
                                    <img src="{{ $myGroup->thumbnail() }}">
                                </span>
                                <span>{{ $myGroup->name }}</span>
                            </a>
                        </li>
                    @endforeach
                @endunless
				@if (site_setting('real_life_purchases_enabled'))
                    <div class="side-item side-title">Boost Your Account</div>
                    <li class="side-item">
                        <a href="{{ route('account.upgrade.index') }}" class="side-link side-upgrade">
                            <i class="fas fa-rocket-launch side-icon"></i>
                            <span>Upgrade</span>
                        </a>
                    </li>
				@endif
				@endauth
            </ul>
        </nav>

    <div class="container-custom">
        @if (site_setting('alert_enabled') && site_setting('alert_message'))
        <div class="alert alert-info fw-semibold mb-4 text-center py-2" style="background:{{ site_setting('alert_background_color') }};color:{{ site_setting('alert_text_color') }};">
<div class="flex-container align-justify align-middle gap-2">
<i class="far fa-exclamation-circle pe-2 text-lg"></i>
<div>{!! site_setting('alert_message') !!}</div>
<i class="far fa-exclamation-circle pe-2 text-lg"></i>
</div>
</div>
        @endif

        @if (site_setting('maintenance_enabled'))
            <div class="alert bg-danger text-center text-white">
                You are currently in maintenance mode. <a href="{{ route('maintenance.exit') }}" class="text-white" style="font-weight:600;">[Exit]</a>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert bg-danger text-white">
                @foreach ($errors->all() as $error)
                    <div>{!! $error !!}</div>
                @endforeach
            </div>
        @endif

        @if (session()->has('success_message'))
            <div class="alert bg-success text-white">
                {!! session()->get('success_message') !!}
            </div>
        @endif

        @if (!site_setting('catalog_purchases_enabled') && Str::startsWith(request()->route()->getName(), 'catalog.'))
            <div class="alert bg-warning text-center text-white" style="font-weight:600;">
                Market purchases are temporarily unavailable. Items may be browsed but are unable to be purchased.
            </div>
        @endif

        @yield('content')
    </div>
	
	<footer class="footer">
            <main class="container py-3">
                <div class="grid-x grid-margin-x align-middle">
                    <div class="cell large-6">
                        <div class="fw-semibold text-lg mb-1 mb-lg-0">
                            Copyright &copy; {{ date('Y') }}
                            <img src="{{ asset('img/main.png') }}" width="24" style="margin-top: -2px">
                            {{ config('site.name') }}. All rights reserved.
                        </div>
                        <div class="flex-container-lg mb-2 mb-lg-0">
                            <a href="{{ route('info.index', 'terms') }}" class="footer-link fw-semibold text-sm">TERMS OF SERVICE</a>
                            <a href="{{ route('info.index', 'privacy') }}" class="footer-link fw-semibold text-sm">PRIVACY POLICY</a>
                            <a href="{{ route('jobs.listings.index') }}" class="footer-link fw-semibold text-sm">JOBS</a>
                            <a href="{{ route('info.index', 'team') }}" class="footer-link fw-semibold text-sm">TEAM</a>
                        </div>
                    </div>
                    <div class="cell large-6">
                        <div class="flex-container gap-3 align-right align-center-sm">
                            @foreach (config('socials') as $data)
                                <a href="{{ $data['url'] }}" target="_blank" class="footer-media text-2xl text-muted">
                                    <i class="{{ $data['icon_class'] }}"></i>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </main>
        </footer>
        
        <!-- JS -->
        <script>window._token = document.head.querySelector('meta[name="csrf-token"]').getAttribute('content');</script>
        <script src="https://unpkg.com/jquery@3"></script>
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://unpkg.com/tippy.js@6"></script>
        <script src="{{ asset('assets/js/app.js?r=2') }}"></script>
        @yield('js')
</body>
</html>
