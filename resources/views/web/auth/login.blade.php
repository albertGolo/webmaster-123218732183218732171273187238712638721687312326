@extends('layouts.default', [
    'title' => 'Login'
])

@section('js')
    <script src="{{ asset('js/login.js') }}"></script>
@endsection

@section('content')
<style>
.text-sm {
    font-size: 0.875rem;
    line-height: 1.25rem;
}
</style>
<div class="grid-x align-center">
                <div class="cell medium-4">
                    <div class="mb-2">
                        <div class="text-2xl fw-semibold">Log In</div>
                        <div class="text-sm text-muted fw-semibold">
						@if (site_setting('registration_enabled'))
                            Don't have an account?
                            <a href="/sign-up" class="d-inline-block squish"
                                >Sign Up</a
                            >
							@endif
                        </div>
                    </div>
                    <div></div>
                    <div class="card card-body">
                        <div class="mb-2">
						<form action="{{ route('auth.login.authenticate') }}" method="POST">
                        @csrf
                            <div class="text-xs fw-bold text-uppercase">Username</div>
							<input type="text" class="form" name="username" placeholder="Username..."/>
                            <div class="text-danger text-xs fw-semibold">
                                
                            </div>
                        </div>
                        <div class="mb-2">
                            <div
                                class="text-xs fw-bold text-muted text-uppercase"
                            >
                                Password
                            </div>
                            <input
                                type="password"
								name="password"
                                class="form mb-2"
                                placeholder="Password..."
                            />
                        </div>
                        <div class="flex-container align-middle align-justify">
                            <input
                                type="submit"
                                class="btn btn-success"
                                value="Log In"
                            />
							</form>
                            <a href="/forgot-password" class="text-sm fw-semibold squish"
                                >Forgot Password?</a
                            > 
                        </div>
						<div class="divider mx-1 my-3"></div>
                        <button class="btn btn-discord btn-block mt-2">
                            <i class="fab fa-discord me-1"></i> Log In with
                            Discord
                        </button>
                    </div>
                </div>
            </div>
</html>

@endsection
