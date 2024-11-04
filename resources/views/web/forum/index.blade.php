@extends('layouts.default', [
    'title' => 'Forum'
])

@section('css')
    <style>
        .forum-border {
          border-left: solid;
      }

      .card-no-corners {
          border-radius: 0;
          overflow: hidden;

      }

      .forum-border-danger {
          border-left-color: var(--danger-500);
      }

      .forum-border-primary {
          border-left-color: var(--info-600);
      }

      .forum-border-warning {
          border-left-color: var(--warning-600);
      }

      .forum-border-membership {
        border-left-color: var(--sidebar-upgrade-color) !important;
      }
	  .card {
    background: var(--section-bg);
    border: 1px solid var(--section-border-color);
    box-shadow: 0 1px 2px rgb(var(--section-shadow), 0.1);
    border-radius: var(--rounded-lg);
}
.card-body {
    padding: 18px;
}

@media print, screen and (max-width: 65em) {
    .card-body-small-padding {
        padding: 0px !important;
    }
}
.card-inner {
    background: var(--input-bg);
    border-color: var(--input-border-color);
}

.card-five-star {
    background: rgb(var(--warning-700-rgb), 20%);
    border-color: var(--warning-700);
    border-bottom: 4px solid var(--warning-700);
}
.card-four-star {
    background: rgb(var(--upgrade-400-rgb), 20%);
    border-color: var(--upgrade-400);
    border-bottom: 4px solid var(--upgrade-400);
}
.card-three-star {
    background: rgb(var(--success-500-rgb), 20%);
    border-color: var(--success-500);
    border-bottom: 4px solid var(--success-500);
}
.card-two-and-one-star {
    background: var(--input-bg);
    border-color: var(--input-border-color);
    border-bottom-width: 4px;
}

.card-status {
    border-bottom-width: 4px;
}
.card-status.online {
    border-bottom-color: var(--success-500);
}
    </style>
@endsection

@section('content')
      <div class="grid-x">
        <div class="cell large-12">
          <div class="grid-x align-middle mb-2">
            <div class="cell large-7">
              <div class="text-xl fw-semibold mb-2">Forum</div>
            </div>
            <div class="cell large-5">
              <div class="flex-container-lg gap-2 align-middle">
                <input
                  type="text"
                  class="form form-xs form-has-section-color mb-2"
                  placeholder="Search Posts..."
                />
                <div class="flex-container flex-child-grow mb-2">
                  <input
                    type="submit"
                    class="btn btn-xs btn-success w-100"
                    value="Search"
                  />
                </div>
                <div class="flex-container flex-child-grow mb-2">
                  <a
                    href="https://vextoria.com/account/upgrade"
                    class="btn btn-info btn-xs flex-child-grow text-center"
                    >Buy Currency</a
                  >
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="cell large-3">
          <div href="https://vextoria.com/discussion/leaderboard" class="btn btn-success btn-block text-center mb-3">
            Leaderboard
          </div>
          <div class="card card-no-corners">
            <div class="card-body">
              <div class="section-borderless">
                <div class="section">
                  <a href="https://vextoria.com/user/JozefPilsudski" class="">
                    <div
                      class="flex-container align-justify align-middle gap-2 squish"
                    >
                      <div class="flex-container align-middle gap-2">
                        <img
                          src="https://vextoria.com/storage/thumbnails/HpcX8uWhOyDPEfQt9UMsIi3AF7ojGwZgTSr0K1mB42dRelLqkY_headshot.png"
                          class="headshot"
                          width="50"
                        />
                        <div class="w-100 text-bold text-truncate min-w-0">
                          <span class="fw-semibold"
                            >JozefPilsudski</span
                          >
                          <div class="text-sm fw-semibold text-muted">
                            #1
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                </div>
                <div class="section">
                  <a href="https://vextoria.com/user/builderman" class="">
                    <div
                      class="flex-container align-justify align-middle gap-2 squish"
                    >
                      <div class="flex-container align-middle gap-2">
                        <img
                          src="https://vextoria.com/storage/thumbnails/boipwHtJrWVCxXmDKsL18T3g24jFz5S6QedInhMvZY0UBqacPk_headshot.png"
                          class="headshot"
                          width="50"
                        />
                        <div class="w-100 text-bold text-truncate min-w-0">
                          <span class="fw-semibold"
                            >builderman</span
                          >
                          <div class="text-sm fw-semibold text-muted">
                            #2
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  </div>
                  <div class="section">
                  <a href="https://vextoria.com/user/1Dev2" class="">
                    <div
                      class="flex-container align-justify align-middle gap-2 squish"
                    >
                      <div class="flex-container align-middle gap-2">
                        <img
                          src="https://vextoria.com/storage/thumbnails/BXkKt45ATYeZxqH7SIVDhOGw2PLC8pJdl0zuN96r1gyacQvoEi_headshot.png"
                          class="headshot"
                          width="50"
                        />
                        <div class="w-100 text-bold text-truncate min-w-0">
                          <span class="fw-semibold"
                            >1Dev2</span
                          >
                          <div class="text-sm fw-semibold text-muted">
                            #3
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  </div>
                <div class="section">
                  <a href="https://vextoria.com/user/affinity" class="">
                    <div
                      class="flex-container align-justify align-middle gap-2 squish"
                    >
                      <div class="flex-container align-middle gap-2">
                        <img
                          src="https://vextoria.com/storage/thumbnails/B0PgQ3CXz6dJZHA1MLGws4h2pofRcSYr9vNuTa5W7Ket8jixIn_headshot.png"
                          class="headshot"
                          width="50"
                        />
                        <div class="w-100 text-bold text-truncate min-w-0">
                          <span class="fw-semibold"
                            >affinity</span
                          >
                          <div class="text-sm fw-semibold text-muted">
                            #4
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  </div>
				  <div class="section">
                  <a href="https://vextoria.com/user/NORTH" class="">
                    <div
                      class="flex-container align-justify align-middle gap-2 squish"
                    >
                      <div class="flex-container align-middle gap-2">
                        <img
                          src="https://vextoria.com/storage/thumbnails/e70xoYynHmv4kE8tf5N26Z1MIs3wRbjFpgVrUSaXcTilQKhzDu_headshot.png"
                          class="headshot"
                          width="50"
                        />
                        <div class="w-100 text-bold text-truncate min-w-0">
                          <span class="fw-semibold"
                            >NORTH</span
                          >
                          <div class="text-sm fw-semibold text-muted">
                            #5
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  </div>
				  <div class="section">
                  <a href="https://vextoria.com/user/Himer" class="">
                    <div
                      class="flex-container align-justify align-middle gap-2 squish"
                    >
                      <div class="flex-container align-middle gap-2">
                        <img
                          src="https://vextoria.com/storage/thumbnails/10KZNJfxl4wuTzCWn6bXprEqSjDHFI8Lvd5YBRMGVO2cQ7yAo3_headshot.png"
                          class="headshot"
                          width="50"
                        />
                        <div class="w-100 text-bold text-truncate min-w-0">
                          <span class="fw-semibold"
                            >Himer</span
                          >
                          <div class="text-sm fw-semibold text-muted">
                            #6
                          </div>
                        </div>
                      </div>
                    </div>
                  </a>
                  </div>
              </div>
            </div>
          </div>
        </div>
        <div class="cell large-9">
          <div class="card-body card-body-small-padding">
            <div class="section-borderless">
              <div class="section">
			   @foreach ($topics as $topic)
               <a href="{{ route('forum.topic', [$topic->id, $topic->slug()]) }}" class="">
                  <div
                    class="forum-border forum-border-info flex-container card-no-corners squish card align-justify align-middle gap-2 p-1 mt-2 mb-2"
                  >
                    <div class="flex-container align-middle gap-2">
                      <i class="fad fa-comments text-info-new text-2xl p-2"></i>
                      <div class="w-100">
                        <div class="fw-semibold text-info-new">{{ $topic->name }}</div>
                        <div class="text-sm fw-semibold text-muted">
                          {{ $topic->description }}
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
				
@endforeach
</div>
</div>
</div>
</div>
</div>
@endsection
