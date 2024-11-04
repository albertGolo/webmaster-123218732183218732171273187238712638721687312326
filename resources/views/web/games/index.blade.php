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

@extends('layouts.default', [
    'title' => 'Games'
])

@section('content')
<div class="alert alert-info fw-semibold mb-4 text-center py-2" style="background:#22BB33;color:#fff;">
<div class="flex-container align-justify align-middle gap-2">
<i></i>
<div>
<p>We're working on finalizing a few things before we release the client for download. Stay tuned for more updates!</p></div>
<i></i>
</div>
</div>
<style>
img {
  border-radius: 5%;
}
</style>
<main>
        <div class="grid-x grid-margin-x grid-padding-y">
            <div class="cell large-2">
                <div class="flex-container align-justify align-middle gap-2 mb-2">
                    <div class="text-2xl fw-semibold">Games</div>
                    <a href="#" class="btn btn-success btn-circle" data-tooltip-title="Create"
                        data-tooltip-placement="bottom" style="margin-right: -14px"><i
                            class="fa-solid fa-hexagon-plus"></i></i></a>
                </div>
                <button class="market-section-item text-md active">
                    Recent
                </button>
                <button class="market-section-item text-md">
                    Action
                </button>
                <button class="market-section-item text-md">
                    Survival
                </button>
                <button class="market-section-item text-md">
                    Racing
                </button>
                <button class="market-section-item text-md">
                    Horror
                </button>
                <button class="market-section-item text-md">
                    Open-World
                </button>
                <button class="market-section-item text-md">
                    Multiplayer
                </button>
                <button class="market-section-item text-md">
                    Competitive
                </button>
                <button class="market-section-item text-md">
                    Experimental
                </button>
            </div>
            <div class="cell large-10">
                <div class="grid-x align-middle mb-2">
                    <div class="cell large-3">
                        <div class="text-xl fw-semibold mb-2">
                            Recent
                        </div>
                    </div>
                    <div class="cell large-9">
                        <div class="flex-container-lg gap-2 align-middle">
                            <input type="text" class="form form-xs form-has-section-color mb-2"
                                placeholder="Search..." />
                            <select class="form form-xs form-select form-has-section-color mb-2">
                                <option value="1" selected disabled>
                                    Advanced Sorting...
                                </option>
                            </select>
                            <div class="flex-container flex-child-grow mb-2">
                                <input type="submit" class="btn btn-xs btn-success w-100" value="Search" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid-x grid-margin-x grid-padding-y">
                    <div class="cell large-4 medium-3 small-6">
                        <a href="#" class="d-block squish">
                            <img src="/storage/game-thumbnails/QcbbTnRT3myXdX7URDezYVHAmcQDQh9Ij8gs.png"
                                class="game-thumbnail mb-2" />
                        </a>
                        <div class="text-body fw-semibold text-truncate">
                            Baseplate
                        </div>
                        </a>
                        <div class="text-xs fw-semibold">
                            <span class="text-muted">By</span>
                            <a href="#" class="text-muted">@Vextoria</a>
                        </div>
                    </div>
                    
                
            </div>
        </div>
    </main>
@endsection
