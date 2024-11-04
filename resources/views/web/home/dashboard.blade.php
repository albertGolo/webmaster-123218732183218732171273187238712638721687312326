@extends('layouts.default', [
    'title' => 'Dashboard'
])



@section('content')
<style>
.link{
  background-color:none;
  color:#fff;
 }
 </style>
@if (Auth::user()->email_verified_at =='')
<div class="alert alert-danger fw-semibold mb-4 text-center py-2" style="color:#fff;">
<div class="flex-container align-justify align-middle gap-2">
<i class="far fa-exclamation-circle pe-2 text-lg"></i>
<div>Your email is currently not verified! <a class="link" href="/account/verify">Send Email</a></div>
<i class="far fa-exclamation-circle pe-2 text-lg"></i>
</div>
</div>
@endif

            <div class="grid-x grid-margin-x grid-padding-y align-center">
                <div class="cell medium-3">
                    <div
                        class="card card-body flex-container flex-dir-column align-middle gap-2 mb-3"
                    >
                        <img
                            src="{{ Auth::user()->headshot() }}"
                            width="60"
                            class="headshot"
                        />
                        <div class="text-center" style="line-height: 16px">
                            <div class="fw-semibold">{{ Str::limit(Auth::user()->displayname, 100, '...') }}</div>
                            <div class="text-xs fw-semibold text-muted">
							<i>@</i>{{ Str::limit(Auth::user()->username, 100, '...') }}
                            </div>
                        </div>
                        <div class="divider w-100"></div>
                        <div class="w-100">
                            <div class="flex-container align-middle gap-3">
                                <i
                                    class="fas fa-medal text-3xl text-info"
                                    style="width: 40px"
                                ></i>
                                <div class="w-100">
                                    <div
                                        class="flex-container align-justify mb-1"
                                    >
                                        <div
                                            class="text-xs fw-bold text-muted text-uppercase"
                                        >
                                            Rank Lvl. {{ Str::limit(Auth::user()->forum_level, 10, '...') }}
                                        </div>
                                        <div
                                            class="text-xs fw-bold text-muted text-uppercase"
                                        >
                                            {{ Auth::user()->forum_exp }}/{{ round(Auth::user()->forumLevelMaxExp()) }}
                                        </div>
                                    </div>
                                    <div class="progress-bar">
                                        <span
                                            class="progress"
                                            style="width: {{ Auth::user()->forum_exp }}%"
                                        ></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-xl fw-semibold mb-1">
                        Blog
                    </div>
                    <div class="card card-body">
                        <div class="section">
                            <a href="/" class="d-block squish">
                                <img
                                    src="http://localhost/img/lo.png"
                                    class="blog-thumbnail mb-2"

                                />
                                <div style="line-height: 18px">
                                    <div class="d-block fw-semibold text-body">
                                        Welcome To the Blog
                                    </div>
                                    <div
                                        class="text-muted text-xs fw-semibold text-truncate"
                                    >
                                      Vextoria, Is Back!!!
                                    </div>
                                    <div
                                        class="text-xs mt-1 fw-semibold text-muted"
                                    >
                                        Posted<span class="mx-1">&bullet;</span
                                        >27th Feb, 2024
                                    </div>
                                </div>
                            </a>
                        </div>
                        
                    </div>
                </div>
                    
                <div class="cell medium-8">
                    <div class="text-xl fw-semibold show-for-small-only mb-1">
                        Feed
                    </div>
                    <div class="mb-3">
                    <div class="position-relative">
					@if (Auth::user()->email_verified_at)	
                    <form method="POST" action="{{ route('home.status') }}">
                    @csrf			
					<textarea class="form form-has-button form-has-section-color pe-5 mb-2" name="message" rows="5" placeholder="What's good, {{ Str::limit(Auth::user()->username, 100, '...') }}?"></textarea>
                    <input type="submit" class="btn btn-success btn-sm" value="Post" style="position: absolute;bottom: 10px;right: 10px;">
					@else
					<textarea disabled class="form form-has-button form-has-section-color pe-5 mb-2" rows="5" placeholder="You must verify your email in order post a status."></textarea>
                    <input type="submit" class="btn btn-success btn-sm" disabled value="Post" style="position: absolute;bottom: 10px;right: 10px;">
					@endif
                    </form>
                </div>
            </div>
                    <div class="text-xl fw-semibold mb-1">Posts</div>
                    <div class="card card-body">
           @forelse ($statuses as $status)               
            <div class="section flex-container flex-dir-column-sm gap-3">
              <div class="flex-child-grow mx-auto" style="width: 100px">
                <a href="{{ route('users.profile', $status->creator->username) }}" class="d-block text-center text-sm squish">
                  <img
                    src="{{ $status->creator->headshot() }}"
                    class="headshot mb-1"
                    width="60"
                  />
                  <div style="line-height: 16px">
                    <div class="text-muted text-truncate">{{ $status->creator->displayname }}</div>
                    <div class="text-xs text-muted text-truncate">
					<i>@</i>{{ Str::limit($status->creator->username, 100, '...') }}
					</div>
                  </div>
                </a>
              </div>
              <div class="card card-body card-inner w-100">
                <div class="flex-container align-justify align-middle">
                  <div class="w-100">
                    <div class="text-muted text-xs">
                      <i
                        class="far fa-clock me-1"
                        style="
                          vertical-align: middle;
                          margin-top: -2.5px;
                          font-size: 10px;
                        "
                      ></i
                      >Posted {{ $status->created_at->diffForHumans() }}
                    </div>
                    <div>
                      {{ $status->message }}
                    </div>
                    <div class="text-sm" style="margin-left: -6px">
                    </div>
                  </div>
                  <div class="dropdown ms-auto position-relative">
                    <button class="btn-circle" style="margin-right: -10px">
                      <i class="fas fa-ellipsis-vertical"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                      <li class="dropdown-item">
                        <a
                          href="/report"
                          class="dropdown-link dropdown-link-has-icon"
                        >
                          <i class="fas fa-flag dropdown-icon"></i> Report
                        </a>
                      </li>
                      
                    </ul>
                  </div>
                </div>
                
              </div>
            </div>
            @empty
            <div
                            class="flex-container flex-dir-column text-center gap-3"
                        >
                            <i
                                class="fas fa-face-sleeping text-5xl text-muted"
                            ></i>
                            <div style="line-height: 16px">
                                <div
                                    class="fw-bold text-xs text-muted text-uppercase"
                                >
                                    No Posts
                                </div>
                                <div class="text-xs text-muted fw-semibold">
                                    Start friending players and their posts will
                                    appear here.
                                </div>
                            </div>
                        </div>
          @endforelse
                </div>
              </div>
            </div>
            <div class="section">
             
              </ul>
            </div>
            
                    </div>
                </div>
            </div>
@endsection
