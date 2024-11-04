@extends('layouts.default', [
    'title' => $title,
    'image' => $icon
])

@section('css')
    <style>
        @media only screen and (max-width: 768px) {
            img.referrer {
                width: 50%;
            }
        }
    </style>
@endsection

@section('js')
    @if (config('app.env') == 'production' && site_setting('registration_enabled'))
        {!! NoCaptcha::renderJs() !!}
    @endif
	<script>
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}
</script>
@endsection

@section('content')
<style>

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}


</style>

<div class="tab"><div class="grid-x align-center">
                <div class="cell large-8 medium-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="progress-bar">
                                <span
                                    class="progress"
                                    style="width: 10%"
                                ></span>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="grid-x grid-margin-x grid-padding-y">
                                <div class="cell medium-3 text-center">
                                    <img
                                        src="/dummy.png"
                                        class="show-for-medium"
                                        alt="earl"
                                    />
                                    <img
                                        src="/dummy.png"
                                        alt="earl"
                                        style="max-width: 180px"
                                        class="show-for-small-only"
                                    />
                                </div>
								 <form action="{{ route('auth.register.authenticate') }}" method="POST">
                            @csrf
                                <div class="cell medium-9">
                                    <div class="text-2xl fw-semibold">
                                        Welcome to Vextoria!
                                    </div>
                                    <div
                                        class="flex-container flex-dir-column gap-1 mb-2"
                                    >
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            I am Vextoria! I will be guiding you
                                            through the sign up process.
                                        </div>
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            For starters, what is your e-mail?
                                            We need this so we can contact you!
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="text-xs fw-bold text-muted text-uppercase"
                                        >
                                            Email Address
                                        </div>
                                        <input
                                            type="text"
											name="email"
                                            class="form"
                                            placeholder="Email Address..."
                                        />
										</div>
                                    <div class="divider mx-1 my-3"></div>
                                    <div
                                        class="flex-container flex-dir-column gap-1 mb-2"
                                    >
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            <span class="me-2">&bullet;</span
                                            >Please verify your not a robot before proceeding to the next step
                                        </div>
                                    </div>
                                    <div class="flex-container-lg gap-2">
                                        @if (config('app.env') == 'production')
                                <div class="mt-3 mb-3">
                                    {!! NoCaptcha::display(['data-theme' => 'light']) !!}
                                </div>
                            @endif
										
                                    </div>
                                </div>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="flex-container align-justify">
                                <button
                                    class="btn btn-danger btn-disabled px-4"
                                >
                                    Previous
                                </button>
                                <button type="button" class="btn btn-success px-4" id="nextBtn" onclick="nextPrev(1)">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<div class="tab"><div class="grid-x align-center">
                <div class="cell large-8 medium-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="progress-bar">
                                <span
                                    class="progress"
                                    style="width: 30%"
                                ></span>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="grid-x grid-margin-x grid-padding-y">
                                <div class="cell medium-3 text-center">
                                    <img
                                        src="/dummy.png"
                                        class="show-for-medium"
                                        alt="earl"
                                    />
                                    <img
                                        src="/dummy.png"
                                        alt="earl"
                                        style="max-width: 180px"
                                        class="show-for-small-only"
                                    />
                                </div>
                                <div class="cell medium-9">
                                    <div class="text-2xl fw-semibold">
                                        Great! Now, what should we call you?
                                    </div>
                                    <div
                                        class="flex-container flex-dir-column gap-2"
                                    >
                                        <div>
                                            <div
                                                class="text-xs fw-bold text-muted text-uppercase"
                                            >
                                                Username
                                            </div>
                                            <input
                                                type="text"
                                                class="form"
												name="username"
                                                placeholder="Username..."
                                            />
                                            
                                        </div>
                                        <div>
                                            <div
                                                class="text-xs fw-bold text-muted text-uppercase"
                                            >
                                                Display Name
                                            </div>
                                            <input
                                                type="text"
                                                class="form"
												name="displayname"
                                                placeholder="@Display Name..."
                                            />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="flex-container align-justify">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-danger btn px-4">Previous</button>
                                <button type="button" class="btn btn-success px-4" id="nextBtn" onclick="nextPrev(1)">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<div class="tab"><div class="grid-x align-center">
                <div class="cell large-8 medium-10">
                    <div class="card">
                        <div class="card-body">
                            <div class="progress-bar">
                                <span
                                    class="progress"
                                    style="width: 40%"
                                ></span>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="grid-x grid-margin-x grid-padding-y">
                                <div class="cell medium-3 text-center">
                                    <img
                                        src="/dummy.png"
                                        class="show-for-medium"
                                        alt="earl"
                                    />
                                    <img
                                        src="/dummy.png"
                                        alt="earl"
                                        style="max-width: 180px"
                                        class="show-for-small-only"
                                    />
                                </div>
                                <div class="cell medium-9">
                                    <div class="text-2xl fw-semibold">
                                        Choose your password.
                                    </div>
                                    <div
                                        class="flex-container flex-dir-column gap-1 mb-2"
                                    >
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            Your password is the way you will be
                                            able to access your account and
                                            change your settings, please use a
                                            password you do not use anywhere
                                            else.
                                        </div>
                                        <div class="text-muted text-sm fw-bold">
                                            Do not share your password with
                                            anybody.
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <div
                                            class="text-xs fw-bold text-muted text-uppercase"
                                        >
                                            Password
                                        </div>
                                        <input
                                            type="text"
                                            class="form"
											name="password"
                                            placeholder="Password..."
                                        />
                                    </div>
                                    <div class="mt-2">
                                        <div
                                            class="text-xs fw-bold text-muted text-uppercase"
                                        >
                                            Confirm Password
                                        </div>
                                        <input
                                            type="text"
                                            class="form"
											name="password_confirmation"
                                            placeholder="Confirm Password..."
                                        />
                                    </div>
                                </div>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="flex-container align-justify">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-danger btn px-4">Previous</button>
                                <button type="button" class="btn btn-success px-4" id="nextBtn" onclick="nextPrev(1)">
                                    Next
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>
<div class="tab"><div class="grid-x align-center">
                <div class="cell medium-10 large-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="progress-bar">
                                <span
                                    class="progress"
                                    style="width: 80%"
                                ></span>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="grid-x grid-margin-x grid-padding-y">
                                <div class="cell medium-3 text-center">
                                    <img
                                        src="/dummy.png"
                                        class="show-for-medium"
                                        alt="earl"
                                    />
                                    <img
                                        src="/dummy.png"
                                        alt="earl"
                                        style="max-width: 180px"
                                        class="show-for-small-only"
                                    />
                                </div>
                                <div class="cell medium-9">
                                    <div class="text-2xl fw-semibold">
                                        Legal Mumbo Jumbo &trade;
                                    </div>
                                    <div
                                        class="flex-container flex-dir-column gap-1 mb-2"
                                    >
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            By clicking the "Sign Me Up!" button
                                            below, you agree to our Terms of
                                            Service and Privacy Policy.
                                        </div>
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            You can review our Terms of Service
                                            and/or Privacy Policy below.
                                        </div>
                                    </div>
                                    <div class="flex-container-lg gap-2">
                                        <button type="button" class="btn btn-gray btn-block mb-2 mb-lg-0">
                                            <i
                                                class="fas fa-scroll text-muted me-1"
                                            ></i>
                                            Terms of Service
                                        </button>
                                        <button type="button" class="btn btn-gray btn-block mb-2 mb-lg-0">
                                            <i
                                                class="fas fa-user-secret text-muted me-1"
                                            ></i>
                                            Privacy Policy
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="flex-container align-justify">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-danger btn px-4">Previous</button>
                                <button class="btn btn-success px-4">
                                    Sign Me Up!
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
</div>

<div style="text-align:center;margin-top:40px;">
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
  <span class="step"></span>
</div>
</form>
@endsection
