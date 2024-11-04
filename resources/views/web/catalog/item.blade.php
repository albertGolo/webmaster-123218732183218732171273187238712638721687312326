@extends('layouts.default', [
    'title' => $item->name,
    'image' => $item->thumbnail()
])

@section('meta')
    <meta
        name="item-info"
        data-id="{{ $item->id }}"

        @if ($item->has3dView())
            data-model="{{ config('site.storage_url') }}/uploads/{{ $item->filename }}.obj"
            data-texture="{{ config('site.storage_url') }}/uploads/{{ $item->filename }}.png"
        @endif

        @if ($item->isTimed())
            data-onsale-until="{{ $item->onsale_until->format('Y-m-d H:i') }}"
        @endif
    >
@endsection

@section('js')
    @if ($item->has3dView())
        <script src="{{ asset('js/vendor/three.min.js') }}"></script>
        <script src="{{ asset('js/vendor/three.orbitcontrols.min.js') }}"></script>
        <script src="{{ asset('js/vendor/three.obj_loader.min.js') }}"></script>
        <script src="{{ asset('js/3d_view.js') }}"></script>
    @endif

    @if ($item->isTimed())
        <script src="{{ asset('js/vendor/jquery.countdown.min.js') }}"></script>
        <script src="{{ asset('js/vendor/moment.min.js') }}"></script>
        <script src="{{ asset('js/vendor/moment.timezone.min.js') }}"></script>
        <script src="{{ asset('js/timed_item.js') }}"></script>
    @endif

    @if ($item->type == 'crate')
        <script src="{{ asset('js/vendor/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('js/crate.js?v=2') }}"></script>
    @endif
@endsection

@section('content')
</head>
    <body>
	@if ($item->limited && $item->stock <= 0)
            @if (Auth::user()->ownsItem($item->id) && !empty(Auth::user()->resellableCopiesOfItem($item->id)))
        <div class="modal" id="sell-modal">
            <div class="modal-card modal-card-body modal-card-sm">
                <div class="section-borderless">
                    <div
                        class="flex-container align-justify align-middle gap-2"
                    >
                        <div class="text-lg fw-semibold">Sell</div>
                        <button
                            class="btn-circle"
                            data-toggle-modal="#sell-modal"
                            style="margin-right: -10px"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
				<form action="{{ route('catalog.resell') }}" method="POST">
                @csrf
                <div class="section-borderless">
                    <div class="flex-container gap-2">
                        <div class="w-100">
                            <div
                                class="text-xs fw-bold text-muted text-uppercase"
                            >
                                Which Copy
                            </div>
                            <select class="form form-select form-xs" name="id">
							@foreach (Auth::user()->resellableCopiesOfItem($item->id) as $copy)
                                <option value="{{ $copy->id }}">Copy #{{ $copy->number }}</option>
								@endforeach
                            </select>
                        </div>
                        <div class="w-100">
                            <div
                                class="text-xs fw-bold text-muted text-uppercase"
                            >
                                Price (Bucks)
                            </div>
                            <input
                                type="text"
                                class="form form-xs"
								name="price"
                                placeholder="Price"
                            />
							
                        </div>
                    </div>
                </div>
                <div
                    class="flex-container gap-2 align-right section-borderless"
                >
                    
                    <button
                        class="btn btn-success btn-sm"
                    >
                        Sell
                    </button>
					</form>
                </div>
            </div>
        </div>
		@endif
		@endif
        <div class="modal" id="crate-roll-modal">
            <div class="modal-card modal-card-body">
                <div class="section-borderless">
                    <div class="modal-scroll py-1">
                        <div
                            class="d-inline-block card p-2 card-five-star me-2"
                        >
                            <img src="/assets/img/item_dummy_2.png" />
                        </div>
                        <div
                            class="d-inline-block card p-2 card-four-star me-2"
                        >
                            <img src="/assets/img/item_dummy_3.png" />
                        </div>
                        <div
                            class="d-inline-block card p-2 card-three-star me-2"
                        >
                            <img src="/assets/img/item_dummy_5.png" />
                        </div>
                        <div
                            class="d-inline-block card p-2 card-three-star me-2"
                        >
                            <img src="/assets/img/item_dummy_6.png" />
                        </div>
                        <div
                            class="d-inline-block card p-2 card-four-star me-2"
                        >
                            <img src="/assets/img/item_dummy_4.png" />
                        </div>
                        <div
                            class="d-inline-block card p-2 card-two-and-one-star me-2"
                        >
                            <div
                                class="w-100 h-100 flex-container flex-dir-column align-middle align-center"
                            >
                                <i
                                    class="fas fa-coins text-3xl text-warning"
                                ></i>
                                <div class="text-sm fw-semibold text-warning">
                                    1000
                                </div>
                            </div>
                        </div>
                        <div
                            class="d-inline-block card p-2 card-two-and-one-star me-2"
                        >
                            <div
                                class="w-100 h-100 flex-container flex-dir-column align-middle align-center"
                            >
                                <i
                                    class="fas fa-money-bill-1-wave text-3xl text-success"
                                ></i>
                                <div class="text-sm fw-semibold text-success">
                                    10
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex-container align-middle mt-2">
                        <div class="divider flex-child-grow ms-0"></div>
                        <div class="text-xs fw-bold text-muted text-uppercase">
                            <i class="fas fa-arrow-up"></i>
                        </div>
                        <div class="divider flex-child-grow me-0"></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="crate-info-modal">
            <div class="modal-card modal-card-body modal-card-sm">
                <div class="section-borderless">
                    <div
                        class="flex-container align-justify align-middle gap-2"
                    >
                        <div class="text-lg fw-semibold">
                            Information About {crateName}
                        </div>
                        <button
                            class="btn-circle"
                            data-toggle-modal="#crate-info-modal"
                            style="margin-right: -10px"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="section-borderless">
                    <div class="text-sm text-muted fw-semibold">
                        <div class="card card-inner card-body mb-2">
                            <div>
                                Base probability of winning
                                <span class="text-warning"
                                    ><i class="fas fa-star"></i> 5 star
                                    item</span
                                >
                                is <span class="fw-bold text-body">??%</span>
                            </div>
                            <div>
                                Base probability of winning
                                <span class="text-membership"
                                    ><i class="fas fa-star"></i> 4 star
                                    item</span
                                >
                                is <span class="fw-bold text-body">??%</span>
                            </div>
                            <div>
                                Base probability of winning
                                <span class="text-success"
                                    ><i class="fas fa-star"></i> 3 star
                                    item</span
                                >
                                is <span class="fw-bold text-body">??%</span>
                            </div>
                            <div>
                                Base probability of winning
                                <span class="text-danger"
                                    ><i class="fas fa-star"></i> 2 star
                                    item</span
                                >
                                is <span class="fw-bold text-body">??%</span>
                            </div>
                            <div>
                                Base probability of winning
                                <span class="text-info"
                                    ><i class="fas fa-star"></i> 1 star
                                    item</span
                                >
                                is <span class="fw-bold text-body">??%</span>
                            </div>
                        </div>
                        <div class="card card-inner card-body mb-2">
                            Upon opening
                            <span class="text-body fw-bold">9</span> crates, the
                            next crate you open will have its base probability
                            of winning a
                            <span class="text-membership"
                                ><i class="fas fa-star"></i> 4 star item</span
                            >
                            boosted to 100%
                        </div>
                        <div class="card card-inner card-body">
                            Upon opening
                            <span class="text-body fw-bold">49</span> crates,
                            the next crate you open will have its base
                            probability of winning a
                            <span class="text-warning"
                                ><i class="fas fa-star"></i> 5 star item</span
                            >
                            boosted to 100%
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="view-crate-content-modal">
            <div class="modal-card modal-card-body">
                <div class="section-borderless">
                    <div
                        class="flex-container align-justify align-middle gap-2"
                    >
                        <div class="text-lg fw-semibold">
                            {crateName}'s Contents
                        </div>
                        <button
                            class="btn-circle"
                            data-toggle-modal="#view-crate-content-modal"
                            style="margin-right: -10px"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="section-borderless">
                    <div class="flex-container align-middle">
                        <div class="text-xs fw-bold text-muted text-uppercase">
                            5 Star Items
                        </div>
                        <div class="divider flex-child-grow"></div>
                    </div>
                    <div class="grid-x grid-margin-x grid-padding-y">
                        <div class="cell medium-3">
                            <a href="#">
                                <div class="card p-2 card-five-star mb-1">
                                    <img src="/assets/img/item_dummy_2.png" />
                                </div>
                                <div
                                    class="text-truncate text-lg fw-semibold text-warning"
                                >
                                    Bowtie
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-container align-middle">
                        <div class="text-xs fw-bold text-muted text-uppercase">
                            4 Star Items
                        </div>
                        <div class="divider flex-child-grow"></div>
                    </div>
                    <div class="grid-x grid-margin-x grid-padding-y">
                        <div class="cell medium-3">
                            <a href="#">
                                <div class="card p-2 card-four-star mb-1">
                                    <img src="/assets/img/item_dummy_3.png" />
                                </div>
                                <div
                                    class="text-truncate text-lg fw-semibold text-membership"
                                >
                                    Tree Helmet
                                </div>
                            </a>
                        </div>
                        <div class="cell medium-3">
                            <a href="#">
                                <div class="card p-2 card-four-star mb-1">
                                    <img src="/assets/img/item_dummy_4.png" />
                                </div>
                                <div
                                    class="text-truncate text-lg fw-semibold text-membership"
                                >
                                    Fall Fedora
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-container align-middle">
                        <div class="text-xs fw-bold text-muted text-uppercase">
                            3 Star Items
                        </div>
                        <div class="divider flex-child-grow"></div>
                    </div>
                    <div class="grid-x grid-margin-x grid-padding-y">
                        <div class="cell medium-3">
                            <a href="#">
                                <div class="card p-2 card-three-star mb-1">
                                    <img src="/assets/img/item_dummy_5.png" />
                                </div>
                                <div
                                    class="text-truncate text-lg fw-semibold text-success"
                                >
                                    Astronaut Helmet
                                </div>
                            </a>
                        </div>
                        <div class="cell medium-3">
                            <a href="#">
                                <div class="card p-2 card-three-star mb-1">
                                    <img src="/assets/img/item_dummy_6.png" />
                                </div>
                                <div
                                    class="text-truncate text-lg fw-semibold text-success"
                                >
                                    Fall Fedora
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="flex-container align-middle">
                        <div class="text-xs fw-bold text-muted text-uppercase">
                            2 Star Items
                        </div>
                        <div class="divider flex-child-grow"></div>
                    </div>
                    <div class="grid-x grid-margin-x grid-padding-y">
                        <div class="cell medium-3">
                            <div class="card p-2 card-inner text-center mb-1">
                                <i
                                    class="fas fa-money-bill-1-wave text-success text-7xl py-4"
                                ></i>
                            </div>
                            <div
                                class="text-truncate text-lg fw-semibold text-success"
                            >
                                10 Cash
                            </div>
                        </div>
                        <div class="cell medium-3">
                            <div class="card p-2 card-inner text-center mb-1">
                                <i
                                    class="fas fa-money-bill-1-wave text-success text-7xl py-4"
                                ></i>
                            </div>
                            <div
                                class="text-truncate text-lg fw-semibold text-success"
                            >
                                100 Cash
                            </div>
                        </div>
                        <div class="cell medium-3">
                            <div class="card p-2 card-inner text-center mb-1">
                                <i
                                    class="fas fa-money-bill-1-wave text-success text-7xl py-4"
                                ></i>
                            </div>
                            <div
                                class="text-truncate text-lg fw-semibold text-success"
                            >
                                500 Cash
                            </div>
                        </div>
                    </div>
                    <div class="flex-container align-middle">
                        <div class="text-xs fw-bold text-muted text-uppercase">
                            1 Star Items
                        </div>
                        <div class="divider flex-child-grow"></div>
                    </div>
                    <div class="grid-x grid-margin-x grid-padding-y">
                        <div class="cell medium-3">
                            <div class="card p-2 card-inner text-center mb-1">
                                <i
                                    class="fas fa-coins text-warning text-7xl py-4"
                                ></i>
                            </div>
                            <div
                                class="text-truncate text-lg fw-semibold text-warning"
                            >
                                10 Coins
                            </div>
                        </div>
                        <div class="cell medium-3">
                            <div class="card p-2 card-inner text-center mb-1">
                                <i
                                    class="fas fa-coins text-warning text-7xl py-4"
                                ></i>
                            </div>
                            <div
                                class="text-truncate text-lg fw-semibold text-warning"
                            >
                                100 Coins
                            </div>
                        </div>
                        <div class="cell medium-3">
                            <div class="card p-2 card-inner text-center mb-1">
                                <i
                                    class="fas fa-coins text-warning text-7xl py-4"
                                ></i>
                            </div>
                            <div
                                class="text-truncate text-lg fw-semibold text-warning"
                            >
                                500 Coins
                            </div>
                        </div>
                        <div class="cell medium-3">
                            <div class="card p-2 card-inner text-center mb-1">
                                <i
                                    class="fas fa-coins text-warning text-7xl py-4"
                                ></i>
                            </div>
                            <div
                                class="text-truncate text-lg fw-semibold text-warning"
                            >
                                1000 Coins
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="purchase-with-bucks-modal">
            <div class="modal-card modal-card-body modal-card-sm">
                <div class="section-borderless">
                    <div
                        class="flex-container align-justify align-middle gap-2"
                    >
                        <div class="text-lg fw-semibold">Confirm Purchase</div>
                        <button
                            class="btn-circle"
                            data-toggle-modal="#purchase-with-bucks-modal"
                            style="margin-right: -10px"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
				<form action="{{ route('catalog.purchase') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                <div class="section-borderless">
                    <div class="text-sm text-muted fw-semibold">
                        Are you sure you want to buy
                        <span class="text-body fw-semibold">{{ $item->name }}</span>
                        for
                        <span class="text-success"
                            ><i class="fas fa-money-bill-1-wave me-1"></i>{{ $item->price }}
                            Bucks</span
                        >?
                    </div>
                </div>
                <div
                    class="flex-container gap-2 align-right section-borderless"
                >
                  
					
                    <button
                        class="btn btn-success btn-sm"
                        data-toggle-modal="#purchase-with-bucks-modal"
                    >
                        Buy Now
                    </button>
					</form>
                </div>
            </div>
        </div>
		@foreach ($item->resellers() as $listing)
		<div class="modal" id="purchase-with-bucks-modal_{{ $listing->id }}">
            <div class="modal-card modal-card-body modal-card-sm">
                <div class="section-borderless">
                    <div
                        class="flex-container align-justify align-middle gap-2"
                    >
                        <div class="text-lg fw-semibold">Confirm Purchase</div>
                        <button
                            class="btn-circle"
                            data-toggle-modal="#purchase-with-bucks-modal"
                            style="margin-right: -10px"
                        >
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
				<form action="{{ route('catalog.purchase') }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <input type="hidden" name="reseller_id" value="{{ $listing->id }}">
                <div class="section-borderless">
                    <div class="text-sm text-muted fw-semibold">
                        Are you sure you want to buy this
                        <span class="text-body fw-semibold">{{ strtolower(itemType($item->type)) }}</span>
                        for
                        <span class="text-success"
                            ><i class="fas fa-money-bill-1-wave me-1"></i>{{ number_format($listing->price) }}
                            Bucks</span
                        >?
                    </div>
                </div>
                <div
                    class="flex-container gap-2 align-right section-borderless"
                >
                  
					
                    <button
                        class="btn btn-success btn-sm"
                    >
                        Buy Now
                    </button>
					</form>
                </div>
            </div>
        </div>
		@endforeach
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
            <div>
                <div class="cell large-10">
                    <div class="grid-x grid-margin-x grid-padding-y">
                        <div class="cell medium-5">
                            <div class="card overflow-hidden mb-3">
                                <div class="position-relative p-4">
                                    <div
                                        style="
                                            position: absolute;
                                            top: 10px;
                                            left: 10px;
                                        "
                                    >
									@if ($item->new)                 
									<div class="mb-1">
                                            <span
                                                class="badge badge-info fw-semibold"
                                            >
                                                <i
                                                    class="fas fa-fire"
                                                    style="width: 18px"
                                                ></i
                                                >New
                                            </span>
                                        </div>
                                    @endif
									    @if ($item->limited)
                                        <div class="mb-1">
                                            <span
                                                class="badge badge-witch fw-semibold"
                                            >
                                                <i
                                                    class="fas fa-star"
                                                    style="width: 18px"
                                                ></i
                                                >Rare
                                            </span>
                                        </div>
										@endif
										@if ($item->limited)                 
										<div class="mb-1">
                                            <span
                                                class="badge badge-danger fw-semibold"
                                            >
                                                {{ ($item->stock > 0) ? "{$item->stock} LEFT" : 'SOLD OUT' }}
                                            </span>
                                        </div>
                                    @endif
										@if ($item->isTimed())
                                        <div class="mb-1">
                                            <span
                                                class="badge badge-danger fw-semibold"
                                            >
                                                <i
                                                    class="fas fa-clock"
                                                    style="width: 18px"
                                                ></i
                                                >Goes offsale in <i id="timer"></i>
                                            </span>
                                        </div>
										@endif
                                    </div>
                                    <div
                                        class="flex-container flex-dir-column gap-1"
                                        style="
                                            position: absolute;
                                            bottom: 10px;
                                            right: 10px;
                                        "
                                    >
									     @if ($item->type == 'crate')
                                         <div class="ms-auto">
                                            <button
                                                class="btn btn-success btn-xs"
                                                data-toggle-modal="#view-crate-content-modal"
                                            >
                                                View Contents
                                            </button>
                                        </div>
										@endif
                                    </div>
                                    <img
                                        src="{{ $item->thumbnail() }}"
                                        class="d-block mx-auto"
                                    />
                                </div>
								@if (Auth::check() && Auth::user()->ownsItem($item->id))
                                <div
                                    class="flex-container align-middle align-center gap-2 bg-success text-center text-sm fw-semibold py-2 overflow-hidden bg-success"
                                >
                                    <i class="fas fa-party-horn text-lg"></i>
                                    Yahoo! You own this item.
                                </div>
								@endif
								
                            </div>
							@if ($item->type == 'crate')
							@if (Auth::check() && Auth::user()->ownsItem($item->id))
                            <div class="flex-container align-middle gap-3 mb-3">
                                <button class="btn btn-info btn-xs w-100" id="openCrateButton" data-toggle-modal="#crate-roll-modal">
                                    Open Crate
                                </button>
                                <div
                                    class="flex-child-grow text-danger text-center fw-bold text-xs text-uppercase"
                                >
                                    {{ $copiesOwned }} Owned
                                </div>
                                <button
                                    class="text-muted"
                                    data-toggle-modal="#crate-info-modal"
                                >
                                    <i class="far fa-question-circle"></i>
                                </button>
								@endif
                            </div>
							@endif
                            <div class="text-xl mb-1 fw-semibold">
                                Statistics
                            </div>
                            <div class="card p-3 mb-3">
                                <div class="grid-x grid-margin-x">
                                    <div class="cell large-6 mb-2">
                                        <div
                                            class="text-xs fw-bold text-uppercase text-muted text-truncate"
                                        >
                                            Date Created
                                        </div>
                                        <div class="fw-semibold text-truncate">
                                            {{ $item->created_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="cell large-6 mb-2">
                                        <div
                                            class="text-xs fw-bold text-uppercase text-muted text-truncate"
                                        >
                                            Last Updated
                                        </div>
                                        <div class="fw-semibold text-truncate">
                                            {{ $item->updated_at->format('M d, Y') }}
                                        </div>
                                    </div>
                                    <div class="cell large-6 mb-2 mb-md-0">
                                        <div
                                            class="text-xs fw-bold text-uppercase text-muted text-truncate"
                                        >
                                            Type
                                        </div>
                                        <div class="fw-semibold text-truncate">
                                            {{ itemType($item->type) }}
                                        </div>
                                    </div>
                                    <div class="cell large-6">
                                        <div
                                            class="text-xs fw-bold text-uppercase text-muted text-truncate"
                                        >
                                            Owners
                                        </div>
                                        <div class="fw-semibold text-truncate">
                                            {{ ($item->type != 'crate') ? number_format($item->owners()->count()) : number_format($item->sold()->count()) }}
                                        </div>
                                    </div>
                                </div>
                            </div>
							@if ($item->limited && $item->stock <= 0)
                            <div class="text-xl mb-1 fw-semibold">
                                Private Sellers
                            </div>
                            <div class="card card-body">
							@forelse ($item->resellers() as $listing)
                                <div
                                    class="section flex-container align-middle gap-4"
                                >
                                    <div
                                        class="flex-container align-middle gap-2 flex-child-grow"
                                    >
                                        <img
                                            src="{{ $listing->seller->headshot() }}"
                                            class="headshot"
                                            width="50"
                                        />
                                        <div style="line-height: 10px">
                                            <div class="text-lg fw-semibold">
                                                {{ $listing->seller->username }} @if ($item->creator_type == 'user' && $item->creator->is_verified)
                                    <i
                                        class="fas fa-shield-check text-success"
                                        data-toggle-modal="#verified-modal"
                                        data-tooltip-title="Verified"
                                        data-tooltip-placement="bottom"
                                        style="cursor: pointer"
                                    ></i>
									@endif
                                            </div>
                                            <div
                                                class="text-xs fw-semibold text-muted"
                                            >
                                                
                                            </div>
                                        </div>
                                    </div>
									@if (!Auth::check() || Auth::user()->id != $listing->seller->id)
                                    <button
                                        class="btn btn-success btn-xs w-100"
                                        data-toggle-modal="#purchase-with-bucks-modal_{{ $listing->id }}"
                                    >
                                        <i
                                            class="fas fa-money-bill-1-wave"
                                            style="width: 30px"
                                        ></i
                                        >{{ number_format($listing->price) }}
                                    </button>
									@else
                                <form action="{{ route('catalog.take_off_sale') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $listing->id }}">
									<button class="btn btn-danger btn-xs w-100" type="submit">Remove
                                    </button>
									@endif
                                </div>
                               @empty
                    <p>No one is currently reselling this item.</p>
                @endforelse
                               {{ $item->resellers()->onEachSide(1) }}
                            </div>
						
						@endif
						</div>
                        <div class="cell medium-7">
                            <div class="card card-body mb-3">
                                <div
                                    class="flex-container align-justify align-middle gap-2 mb-2"
                                >
                                    <div class="text-3xl fw-semibold">
                                        {{ $item->name }}
                                    </div>
                                    <div
                                        class="position-relative dropdown"
                                        style="margin-right: -10px"
                                    >
									@auth
                                        <button
                                            class="btn-circle"
                                            data-tooltip-title="More"
                                            data-tooltip-placement="bottom"
                                        >
                                            <i
                                                class="fas fa-ellipsis-vertical"
                                            ></i>
                                        </button>
                                        <ul
                                            class="dropdown-menu dropdown-menu-end"
                                        >
										
										@if (Auth::user()->canEditItem($item->id))
                                            <li class="dropdown-item">
                                                <a
                                                    href="{{ route('catalog.edit', [$item->id, $item->slug()]) }}"
                                                    class="dropdown-link dropdown-link-has-icon"
                                                >
                                                    <i
                                                        class="fas fa-edit dropdown-icon"
                                                    ></i>
                                                    Edit
                                                </a>
                                            </li>
											@endif
											<li class="dropdown-item">
                                                <a
                                                    href="{{ route('report.index', ['item', $item->id]) }}"
                                                    class="dropdown-link dropdown-link-has-icon"
                                                >
                                                    <i
                                                        class="fas fa-flag dropdown-icon"
                                                    ></i>
                                                    Report
                                                </a>
                                            </li>
											@if (Auth::user()->isStaff() && Auth::user()->staff('can_view_item_info'))
                                            <div
                                                class="flex-container align-middle"
                                            >
                                                <div class="dropdown-title">
                                                    Moderation
                                                </div>
                                                <li
                                                    class="divider flex-child-grow"
                                                ></li>
                                            </div>
                                            <li class="dropdown-item">
                                                <a
                                                    href="{{ route('admin.items.view', $item->id) }}"
                                                    class="dropdown-link dropdown-link-has-icon text-danger"
                                                >
                                                    <i
                                                        class="fas fa-gavel dropdown-icon text-danger"
                                                    ></i>
                                                    View in Panel
                                                </a>
                                            </li>
											@endif
                                        </ul>
										@endauth
                                    </div>
                                </div>
                                <div
                                    class="flex-container gap-2 align-middle fw-semibold mb-3"
                                >
                                    <div
                                        class="text-muted text-uppercase text-xs fw-bold"
                                    >
                                        By
                                    </div>
                                    <a
                                        href="{{ $item->creatorUrl() }}"
                                        class="flex-container align-middle gap-2 text-muted"
                                        ><img
                                            src="{{ $item->creatorImage() }}"
                                            class="headshot"
                                            width="38"
                                        />
                                        <div style="line-height: 17px">
                                            <div>{{ $item->creatorName() }}</div>
                                            <div
                                                class="text-xs text-muted text-truncate"
                                                style="max-width: 140px"
                                            >
                                                
                                            </div>
                                        </div>
                                    </a>
									@if ($item->creator_type == 'user' && $item->creator->is_verified)
                                    <i
                                        class="fas fa-shield-check text-success"
                                        data-toggle-modal="#verified-modal"
                                        data-tooltip-title="Verified"
                                        data-tooltip-placement="bottom"
                                        style="cursor: pointer"
                                    ></i>
									@endif
                                </div>
                                <div
                                    class="text-xs fw-bold text-uppercase text-muted mb-1"
                                >
								@if (site_setting('catalog_purchases_enabled') && $item->status == 'approved' && $item->onsale())
                                    Purchase For
								@endif
                                </div>
                                <div
                                    class="flex-container-lg gap-2 align-middle"
                                >
                                    
									@auth
                        @if (site_setting('catalog_purchases_enabled') && $item->status == 'approved' && $item->onsale())
                            @if (!Auth::user()->ownsItem($item->id) || $item->type == 'crate')
                                <button class="btn btn-success btn-sm mb-2 w-100" data-toggle-modal="#purchase-with-bucks-modal">{!! ($item->price == 0) ? 'Take for Free' : 'Buy for &nbsp;<i class="fas fa-money-bill-1-wave"></i> ' . number_format($item->price) !!}</button>
                            @else
                                <button class="btn btn-success btn-sm mb-2 w-100" disabled data-toggle-modal="#purchase-with-bucks-modal">{!! ($item->price == 0) ? 'Take for Free' : 'Buy for &nbsp;<i class="fas fa-money-bill-1-wave"></i> ' . number_format($item->price) !!}</button>
                            @endif
                        @endif
						
						@endauth
						@if ($item->limited && $item->stock <= 0)
						@if (Auth::check() && Auth::user()->ownsItem($item->id) && !empty(Auth::user()->resellableCopiesOfItem($item->id)))
						<div
                                        class="text-xs fw-bold text-uppercase text-muted mb-2"
                                    >
                                        or
                                    </div>	
						<button class="btn btn-success btn-sm mb-2 w-100" data-toggle-modal="#sell-modal">Sell Item</button>
					    @endif
						@endif
                                </div>
                            </div>
                            <div class="text-xl mb-1 fw-semibold">
                                Description
                            </div>
                            <div class="card card-body mb-3">
                                <div class="text-sm fw-semibold">
                                    @if ($item->type != 'crate')
                            {!! (!empty($item->description)) ? nl2br(e($item->description)) : '<div class="text-muted">This item does not have a description.</div>' !!}
                        @else
                            @if (!empty($item->description))
                                {!! nl2br(e($item->description)) !!}
                                <br>
                                <br>
                            @endif

                            This crate contains {{ count($item->crateItems()) }} items that each consist of different rarities. Opening this crate will give you a guaranteed item from the crate.
							@endif
                                </div>
                            </div>
							@if ($item->type == 'bundle')
							<div class="text-xl mb-1 fw-semibold">
                                Items in this Bundle
                            </div>
                            <div class="card card-body mb-3">
                                <div class="grid-x grid-margin-x">
								@forelse ($item->bundleItems() as $bundleItem)
                                    <div class="cell large-3 medium-4 small-6">
                                        <a href="{{ route('catalog.item', [$bundleItem->id, $bundleItem->slug()]) }}" class="d-block">
                                            <div
                                                class="card card-inner position-relative p-2 mb-1"
                                            >
                                                <img
                                                    src="{{ $bundleItem->thumbnail() }}"
                                                />
                                            </div>
                                            <div
                                                class="text-body fw-semibold text-truncate"
                                            >
                                                {{ $bundleItem->name }}
                                            </div>
                                        </a>
                                    </div>
									@empty
                    <div class="col">No items found.</div>
                @endforelse
					
				</div>
                            </div>
				@endif			
							
                            <div class="text-xl mb-1 fw-semibold">
                                Suggested Items
                            </div>
                            <div class="card card-body mb-3">
                                <div class="grid-x grid-margin-x">
								@forelse ($suggestions as $suggestion)
                                    <div class="cell large-3 medium-4 small-6">
                                        <a href="{{ route('catalog.item', [$suggestion->id, $suggestion->slug()]) }}" class="d-block">
                                            <div
                                                class="card card-inner position-relative p-2 mb-1"
                                            >
                                                <img
                                                    src="{{ $suggestion->thumbnail() }}"
                                                />
                                            </div>
                                            <div
                                                class="text-body fw-semibold text-truncate"
                                            >
                                                {{ $suggestion->name }}
                                            </div>
                                        </a>
                                    </div>
									@empty
                    <div class="col">No items found.</div>
                @endforelse
                                </div>
                            </div>
                            <div class="text-xl mb-1 fw-semibold">
                                
                            </div>
                            <div>
                                <div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
