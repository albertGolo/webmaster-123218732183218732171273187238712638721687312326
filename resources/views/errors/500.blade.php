@extends('layouts.default', [
    'title' => 'Error 500'
])

@section('content')
        <div class="cell large-8 medium-10">
<div class="card">
<div class="card-body">
<div class="mb-1 text-xl fw-semibold">Error 500: Something went wrong on our end. Try again.</div>
<p class="card-text">
<p>
<a href="#!" class="btn btn-info" onclick="window.history.back();">
<i class="fad fa-arrow-left me-1"></i> Go back                        
</a>
</p>                
</div>
</div>
</div>
        </div>
    </main>
</div>
@endsection
