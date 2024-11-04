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
    'title' => 'Notifications'
])

@section('content')
 <div class="row">
        <div class="col">
            
        </div>
                    <div>
                
            </div>
            </div>
    <div class="card">
        <div class="card-body">
		<center>
		<div class="flex-container flex-dir-column gap-3">
                                    <i class="fas fa-face-sleeping text-5xl text-muted"></i>
                                    <div style="line-height: 16px">
                                        <div class="fw-bold text-xs text-muted text-uppercase">
                                            No Notifications
                                        </div>
                                        <div class="text-xs text-muted fw-semibold">
                                            You have not recieved any
                                            notifications recently.
                                        </div>
                                    </div>
                                </div>

        </div>
    </div>
    </div>
@endsection
