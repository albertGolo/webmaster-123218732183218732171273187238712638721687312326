@extends('layouts.default', [
    'title' => $group->name,
    'image' => $group->thumbnail()
])

@section('meta')
    <meta name="group-info" data-id="{{ $group->id }}" data-can-moderate-wall="{{ Auth::check() && Auth::user()->id == $group->owner->id }}">
@endsection

@section('css')
    <style>
        .group-tabs .nav-link {
            border-radius: 0;
        }

        .group-tabs .nav-link:not(.active):hover {
            background: var(--section_bg_hover);
        }

        .group-tabs li:first-child .nav-link {
            border-radius: 8px 8px 0 0;
        }

        .group-tabs li:last-child .nav-link {
            border-radius: 0 0 8px 8px;
        }
    </style>
@endsection

@section('js')
    <script src="{{ asset('js/group.js?v=3') }}"></script>
@endsection

@section('content')
<div class="container-fluid mt-5" style="max-width: 1300px;">
<br>
<div class="card">
  <div class="card-body">
      <div class="row">
          <div class="col-sm-2">
              <img src="{{ $group->thumbnail() }}" style="border-radius: 50%; height: 100px; width: 100px;" class="img-fluid">
			  @if (Auth::check() && Auth::user()->isInGroup($group->id))
                        <form action="{{ route('groups.set_primary') }}" method="POST" style="display:inline-block;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $group->id }}">
                            <button class="mr-1" style="background:none;font-size:18px;border:none;outline:none;appearance:none;padding:0;" type="submit">
                                <i class="{{ (Auth::user()->primary_group_id == $group->id) ? 'fas' : 'fal' }} fa-star text-warning"></i>
                            </button>
                        </form>
                    @endif
          </div>
          <div class="col-sm-8">
              <h1 class="mb-1">
                  <a href="#_">{{ $group->name }} </a>
              </h1>
              {!! (!empty($group->description)) ? nl2br(e($group->description)) : '<div class="text-muted">This space does not have a description.</div>' !!}
              <div style="height: 20px;"></div>
          </div>
          <div class="col-sm-2">
          @auth
                <div class="mb-4">
                    @if (Auth::user()->id != $group->owner->id)
                        <form action="{{ route('groups.membership') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $group->id }}">

                            @if ($group->is_private && $isPending)
                                <button class="btn btn-block btn-secondary" disabled>Pending</button>
                            @elseif (!Auth::user()->isInGroup($group->id))
                                <button class="btn btn-block btn-success" type="submit">Join</button>
                            @else
                                <button class="btn btn-block btn-danger" type="submit">Leave</button>
                            @endif
                        </form>
                    @else
                        <a href="{{ route('groups.manage', [$group->id, $group->slug()]) }}" class="btn btn-block btn-info">Manage</a>
					<br>
                        <a href="{{ route('creator_area.index', ['gid' => $group->id]) }}" class="btn btn-block btn-success">Create</a>
                    @endif
                </div>
            @endauth
                          </div>
      </div>
  </div>
</div>

<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade active show" id="information" role="tabpanel" aria-labelledby="information-tab">
    <h6 class="header-pretitle">
      Space information
    </h6>
    <div class="card">
      <div class="card-body">
          <div class="row">
              <div class="col-sm-3 text-center">
                  <h2>Owner</h2>
                  <a href="{{ route('users.profile', $group->owner->username) }}" class="text-muted">{{ $group->owner->username }}</a>
              </div>
              <div class="col-sm-3 text-center">
                  <h2>Members</h2>
                  <div class="text-muted">{{ number_format($group->members()->count()) }}</div>
              </div>
			  @if ($group->is_vault_viewable)
              <div class="col-sm-3 text-center">
                  <h2>Cash</h2>
                  <div class="text-muted"><i class="fas fa-money-bill-1-wave" style="width: 22px"></i>&nbsp;0</div>
              </div>
			   <div class="col-sm-3 text-center">
                  <h2>Coins</h2>
                  <div class="text-muted"><i class="fas fa-coins" style="width: 22px"></i>&nbsp;0</div>
              </div>
			  @endif
          </div>
      </div>
    </div>
    <h6 class="header-pretitle">
      Space members
    </h6>
    <div class="card">
      <div class="card-body">
          <div class="row">
              <div class="col-sm-9">

              </div>
              <div class="col-sm-3" id="membersTab">
                  <select class="form form-select">
				  @foreach ($group->ranks() as $rank)
                  <option value="{{ $rank->rank }}">{{ $rank->name }} ({{ $rank->memberCount() }})</option> 
                  @endforeach				  
					</select>
              </div>
          </div>
          <br>
          <div class="row" id="members"></div>
          <br>

      </div>
    </div>
    <h6 class="header-pretitle">
      Space wall
    </h6>
    
      <div class="mb-3">
                    <div class="position-relative">
						
                   <form id="wallPost">
                    <input type="hidden" name="_token" value="MZd56ViJA4pxiTfNjOgvJQrXA42m5zEfyZqucoWR">			
					<textarea class="form form-has-button form-has-section-color pe-5 mb-2"  name="body" rows="5"></textarea>
					<p class="text-danger" id="wallPostError"></p>
                    <input type="submit" class="btn btn-success btn-sm" value="Post" style="position: absolute;bottom: 10px;right: 10px;">
					                    </form>
                </div>
            </div>
      <div><div><div></div></div>
    <div style="height: 10px;"></div>
    <div id="wall">
  </div>
  </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
