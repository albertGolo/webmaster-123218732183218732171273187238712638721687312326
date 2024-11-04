@extends('layouts.default', [
    'title' => 'Item Shop'
])

@section('js')
    <script src="{{ asset('js/catalog.js?r=1') }}"></script>
@endsection

@section('content')
            <div class="grid-x grid-margin-x grid-padding-y">
                <div class="cell large-2">
                    <div
                        class="flex-container align-justify align-middle gap-2 mb-2"
                    >
                        <div class="text-2xl fw-semibold">Market</div>
                        <a
                            href="/create"
                            class="btn btn-success btn-circle"
                            data-tooltip-title="Create"
                            data-tooltip-placement="bottom"
                            style="margin-right: -14px"
                            ><i class="fas fa-plus"></i
                        ></a>
                    </div>
                    <button  data-category="crates" class="market-section-item text-sm">
                        Crates
                    </button>
                    <div class="collapsible">
                        <button class="d-block w-100 market-section-item">
                            <div
                                class="flex-container align-justify align-middle"
                            >
                                <div class="text-sm">Accessories</div>
                                <i
                                    class="fas fa-chevron-down text-xs text-muted"
                                ></i>
                            </div>
                        </button>
                        <div class="collapsible-menu mb-2">
                            <button  data-category="hats" class="market-section-item text-xs">
                                Hats
                            </button>
                            <button  data-category="gadgets" class="market-section-item text-xs">
                                Gadgets
                            </button>
                        </div>
                    </div>
                    <div class="collapsible">
                        <button class="d-block w-100 market-section-item">
                            <div
                                class="flex-container align-justify align-middle"
                            >
                                <div class="text-sm">Clothing</div>
                                <i
                                    class="fas fa-chevron-down text-xs text-muted"
                                ></i>
                            </div>
                        </button>
                        <div class="collapsible-menu mb-2">
                            <button  data-category="shirts" class="market-section-item text-xs">
                                Shirts
                            </button>
                            <button  data-category="pants" class="market-section-item text-xs">
                                Pants
                            </button>
                        </div>
                    </div>
                    <div class="collapsible">
                        <button class="d-block w-100 market-section-item">
                            <div
                                class="flex-container align-justify align-middle"
                            >
                                <div class="text-sm">Body</div>
                                <i
                                    class="fas fa-chevron-down text-xs text-muted"
                                ></i>
                            </div>
                        </button>
                        <div class="collapsible-menu mb-2">
                            <button  data-category="faces" class="market-section-item text-xs">
                                Faces
                            </button>
                            <button class="market-section-item text-xs">
                                Heads
                            </button>
                            <button class="market-section-item text-xs">
                                Body Parts
                            </button>
                        </div>
                    </div>
					
					<div class="collapsible">
                        <button class="d-block w-100 market-section-item">
                            <div
                                class="flex-container align-justify align-middle"
                            >
                                <div class="text-sm">Other</div>
                                <i
                                    class="fas fa-chevron-down text-xs text-muted"
                                ></i>
                            </div>
                        </button>
                        <div class="collapsible-menu mb-2">
                            <button  data-category="bundles" class="market-section-item text-xs">
                                Bundle
                            </button>
                        </div>
                    </div>
                </div>
                <div class="cell large-10">
                    <div class="grid-x align-middle mb-2">
                        <div class="cell large-3">
                            <div class="text-xl fw-semibold mb-2">
                                Recent Items
                            </div>
                        </div>
                        <div class="cell large-9">
						<form id="search">
                            <div class="flex-container-lg gap-2 align-middle">
							
                                <input
                                    type="text"
                                    class="form form-xs form-has-section-color mb-2"
                                    placeholder="Search..."
                                />
								</form>
                                <select
                                    class="form form-xs form-select form-has-section-color mb-2"
                                >
                                    <option value="1" selected disabled>
                                        Advanced Sorting...
                                    </option>
                                </select>
                                <div
                                    class="flex-container flex-child-grow mb-2"
                                >
                                    <input
                                        type="submit"
                                        class="btn btn-xs btn-success w-100"
                                        value="Search"
                                    />
									</form>
                                </div>
                                <div
                                    class="flex-container flex-child-grow mb-2"
                                >
                                    <a
                                        href="#"
                                        class="btn btn-info btn-xs flex-child-grow text-center"
                                        >Buy Currency</a
                                    >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="items" class="grid-x grid-margin-x grid-padding-y">
                        
                        
                            </div>
                        </div>
                        
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </main>
@endsection