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
    'title' => 'Badges'
])

@section('js')
    <script>
        function info(name, description, image)
        {
            $('#badge #badgeName').text(name);
            $('#badge #badgeDescription').text(description);
            $('#badge #badgeImage').attr('src', image);

            $('#badge').modal('show');
        }
    </script>
@endsection

@section('content')
 <h3>Achievements</h3>
<div class="row">
@forelse ($badges as $badge)
<div class="col-md-6">
<div class="card">
<div class="card-body">
<div class="row">
<div class="col-3 align-self-center">
<img class="mb-1" src="{{ $badge->image }}">
</div>
<div class="col-9 align-self-center">
<h4>{{ $badge->name }}</h4>
<div>{{ $badge->description }}</div>
</div>
</div>
</div>
</div>
</div>
@empty
<div class="col">There are currently no achievements.</div>
 @endforelse
</div>
</div>
@endsection
