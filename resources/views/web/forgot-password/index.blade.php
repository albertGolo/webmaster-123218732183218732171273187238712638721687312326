@extends('layouts.default', [
    'title' => 'Forgot Password'
])

@section('js')
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
                <div class="cell medium-10 large-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="progress-bar">
                                <span
                                    class="progress"
                                    style="width: 25%"
                                ></span>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="grid-x grid-margin-x grid-padding-y">
                                <div class="cell medium-3 text-center">
                                    <img
                                        src="https://kaplash.com/dummy.png"
                                        class="show-for-medium"
                                        alt="earl"
                                    />
                                    <img
                                        src="https://kaplash.com/dummy.png"
                                        alt="earl"
                                        style="max-width: 180px"
                                        class="show-for-small-only"
                                    />
                                </div>
                                <div class="cell medium-9">
                                    <div class="text-2xl fw-semibold">
                                        Oh noes! Did you forget your password?
                                    </div>
                                    <div
                                        class="flex-container flex-dir-column gap-1 mb-2"
                                    >
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            Fill in the e-mail asscoiated with
                                            your account in the field below, if
                                            said e-mail is linked to an account,
                                            we'll send you a link to reset your
                                            password.
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
                                            class="form"
                                            placeholder="Email Address"
                                        />
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
                <div class="cell medium-10 large-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="progress-bar">
                                <span
                                    class="progress"
                                    style="width: 100%"
                                ></span>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="grid-x grid-margin-x grid-padding-y">
                                <div class="cell medium-3 text-center">
                                    <img
                                        src="https://kaplash.com/dummy.png"
                                        class="show-for-medium"
                                        alt="earl"
                                    />
                                    <img
                                        src="https://kaplash.com/dummy.png"
                                        alt="earl"
                                        style="max-width: 180px"
                                        class="show-for-small-only"
                                    />
                                </div>
                                <div class="cell medium-9">
                                    <div class="text-2xl fw-semibold">
                                        Sent!
                                    </div>
                                    <div
                                        class="flex-container flex-dir-column gap-1 mb-2"
                                    >
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            An e-mail with instructions on how
                                            to reset your password has been sent
                                            to your inbox.
                                        </div>
                                        <div
                                            class="text-muted text-sm fw-semibold"
                                        >
                                            If you do not see the e-mail within
                                            5 minutes, please check your spam
                                            folder. If you still do not see it,
                                            then please press the "Resend
                                            Confirmation Email" button below.
                                            (Sorry for the inconvenience!)
                                        </div>
                                    </div>
                                    <div>
                                        <button
                                            class="btn btn-info btn btn-block"
                                        >
                                            <i class="fas fa-envelopes me-2"></i
                                            >Resend Confirmation Email
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="divider mx-1 my-3"></div>
                            <div class="flex-container align-justify">
                                <button type="button" id="prevBtn" onclick="nextPrev(-1)" class="btn btn-danger btn px-4">Previous</button>
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
