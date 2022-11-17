@extends('layouts.master')


@section("title")
    <meta content="" name="description">
    <meta content="" name="keywords">

    <title>Multistep Form | {{ env('MY_SITE_NAME') }}</title>


<style>

#multiStepForm {
  background-color: #ffffff;
  margin: 0px auto;
  padding: 0px;
  width: 100%;
  min-width: 300px;
}

h5 {
  text-align: center;  
}

input {
  padding: 10px;
  width: 100%;
  font-size: 17px;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

select.invalid {
  background-color: #ffdddd;
}

textarea.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #04AA6D;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #04AA6D;
}
</style>

@endsection


@section('content')
<main id="main" class="main">

    <section class="section">
      <div class="row">
        
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              
              <h5 class="card-title">Register</h5>
              
              @if(session()->has('success_msg'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session()->get('success_msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif

              @if(session()->has('error_msg'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session()->get('error_msg') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
              @endif


              <!-- Custom Styled Validation with Tooltips -->
              <form method="post" action="{{ route('save-multistep-form')}}" class="row g-3 needs-validation" novalidate id="multiStepForm">
                @csrf

                 
				  <!-- One "tab" for each step in the form: -->
				  <div class="tab">
				  	<h5>Basic Info</h5>
				  	<label for="name" class="form-label">First Name:</label>
				    <p>
				    	<input placeholder="First name..." oninput="this.className = ''" name="fname" class="form-control">
				    </p>

				    <label for="name" class="form-label">Last Name:</label>
				    <p>
				    	<input placeholder="Last name..." oninput="this.className = ''" name="lname" class="form-control" value="">
				    </p>

				    <label for="name" class="form-label">Designation:</label>
				    <p>
				    	<select class="form-select" name="designation_id" id="designation_id" onselect="this.className = ''">
		                    <option value="">Choose...</option>
		                    
		                    <option value="PHP Developer" @if(old('company_id')=='PHP Developer') selected @endif>PHP Developer</option>
		                    <option value="Manager" @if(old('company_id')=='Manager') selected @endif>Manager</option>
		                    <option value="UI Designer" @if(old('company_id')=='UI Designer') selected @endif>UI Designer</option>
		                    
		                  </select>
				    </p>
				  </div>

				  <!-- <div class="tab">
				  	<h5>HR Info</h5>
				  	<label for="name" class="form-label">HR Name:</label>
				    <p><input placeholder="HR name..." oninput="this.className = ''" name="hrname" class="form-control"></p>

				    <label for="name" class="form-label">HR Email:</label>
				    <p><input placeholder="HR email..." oninput="this.className = ''" name="hremail" class="form-control"></p>
				  </div> -->

				  <div class="tab">
				  	<h5>Company Info</h5>
				  	<label for="name" class="form-label">Company Name:</label>
				    <p><!-- <input placeholder="Company name..." oninput="this.className = ''" name="companyname" class="form-control"> -->
				    <select class="form-select" name="company_id" id="company_id" onselect="this.className = ''">
	                    <option value="">Choose...</option>
	                    
	                    <option value="BVC" @if(old('company_id')=='BVC') selected @endif>BVC</option>
	                    <option value="vCommission" @if(old('company_id')=='vCommission') selected @endif>vCommission</option>
	                    <option value="Nutrafy" @if(old('company_id')=='Nutrafy') selected @endif>Nutrafy</option>
	                    
	                  </select>
				    </p>

				    <label for="name" class="form-label">Company Location:</label>
				    <p>
				    	
				    	<select class="form-select" name="companylocation" id="companylocation" onselect="this.className = ''">
		                    <option value="">Choose...</option>
		                    
		                    <option value="Gurgram" @if(old('company_id')=='Gurgram') selected @endif>Gurgram</option>
		                    <option value="Mohali" @if(old('company_id')=='Mohali') selected @endif>Mohali</option>
		                    
		                  </select>
				    </p>

				    <label for="discipline" class="form-label rdioBtn">Company Policy  <span class="text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Required"><strong>*</strong></span></label><br>
				    <p>
				    	
				    	<span id="radioBtn">
                    <div class="rating">
                      <label class="form_row form_row_0">
                        <input type="radio" name="discipline" id="discipline" value="NA" @if(old('discipline')=='NA') checked @elseif(old('discipline')=='') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating0.png') }}" alt="img">
                          <p>NA</p>
                        </div>
                      </label>
              

                      <label class="form_row form_row_1">
                        <input type="radio" name="discipline" id="discipline" value="1" @if(old('discipline')=='1') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating5.png') }}" alt="img">
                          <p>1 <span>Poor</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_2">
                        <input type="radio" name="discipline" id="discipline" value="2" @if(old('discipline')=='2') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating4.png') }}" alt="img">
                          <p>2 <span>Fair</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_3">
                        <input type="radio" name="discipline" id="discipline" value="3" @if(old('discipline')=='3') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating3.png') }}" alt="img">
                          <p>3 <span>Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_4">
                        <input type="radio" name="discipline" id="discipline" value="4" @if(old('discipline')=='4') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating2.png') }}" alt="img">
                          <p>4 <span>Very Good</span></p>
                        </div>
                      </label>


                      <label class="form_row form_row_5">
                        <input type="radio" name="discipline" id="discipline" value="5" @if(old('discipline')=='5') checked @endif>
                        <div class="checkmark">
                          <img src="{{ asset('assests/assets/img/rating1.png') }}" alt="img">
                          <p>5 <span>Outstanding</span></p>
                        </div>
                      </label>
                    </div>
                    
                  </span>
				    </p>
				  </div>

				  <div class="tab">
				  	<h5>Contact Info</h5>
				  	<label for="name" class="form-label">Email:</label>
				    <p><input placeholder="E-mail..." oninput="this.className = ''" name="email" class="form-control"></p>

				    <label for="name" class="form-label">Mobile No.:</label>
				    <p><input placeholder="Phone..." oninput="this.className = ''" name="phone" class="form-control"></p>


				    <label for="name" class="form-label">Address:</label>
				    <p>
				    	<textarea class="form-control" name="address" id="address" style="height: 100px">{{ old('address')}}</textarea>
				    	<script>
		                    CKEDITOR.replace( 'address' );
		                </script>
				    </p>

				  </div>
				  
				  <div class="tab">
				  	<h5>Login Info</h5>
				  	<label for="name" class="form-label">Username:</label>
				    <p>
				    	<input placeholder="Username..." oninput="this.className = ''" name="uname" class="form-control">
				    </p>

				    <label for="name" class="form-label">Password:</label>
				    <p>
				    	<input placeholder="Password..." oninput="this.className = ''" name="pword" type="password" class="form-control">
				    </p>
				  </div>

				  <div style="overflow:auto;">
				    <div style="float:right;">
				      <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
				      <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
				    </div>
				  </div>

				  <!-- Circles which indicates the steps of the form: -->
				  <div style="text-align:center;margin-top:40px; display: none;">
				    <span class="step"></span>
				    <span class="step"></span>
				    <span class="step"></span>
				    <span class="step"></span>
				    <span class="step"></span>
				  </div>

                <!-- <div class="col-12">
                  <input type="submit" name="submit" value="Add" class="btn btn-primary">
                  
                  <input type="button" name="button" value="Cancel" class="btn btn-info" onclick="location.href = '{{ url("manage-designations")}}';">
                  
                </div> -->

              </form><!-- End Custom Styled Validation with Tooltips -->
              
            </div>
          </div>

        </div>
      </div>
    </section>

    <script>
		var currentTab = 0; // Current tab is set to be the first tab (0)
		showTab(currentTab); // Display the current tab

		function showTab(n) {
		  // This function will display the specified tab of the form...
		  var x = document.getElementsByClassName("tab");
		  x[n].style.display = "block";
		  //... and fix the Previous/Next buttons:
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
		  //... and run a function that will display the correct step indicator:
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
		  // if you have reached the end of the form...
		  if (currentTab >= x.length) {
		    // ... the form gets submitted:
		    document.getElementById("multiStepForm").submit();
		    return false;
		  }
		  // Otherwise, display the correct tab:
		  showTab(currentTab);
		}

		function validateForm() {
		  // This function deals with validation of the form fields
		  var x, y, z, i, valid = true;
		  x = document.getElementsByClassName("tab");
		  y = x[currentTab].getElementsByTagName("input");
		  z = x[currentTab].getElementsByTagName("select");
		  m = x[currentTab].getElementsByTagName("textarea");

		  console.log(y);

		  // A loop that checks every input field in the current tab:
		  for (i = 0; i < y.length; i++) {
		    // If a field is empty...
		    console.log(y[i]);
		    if (y[i].value == "") {
		      // add an "invalid" class to the field:
		      y[i].className = "form-control invalid";
		      // and set the current valid status to false
		      valid = false;
		    } else {
		    	y[i].className = "form-control";
		    }
		  }

		  for (j = 0; j < z.length; j++) {
		    // If a field is empty...
		    console.log(z[j]);
		    if (z[j].value == "") {
		      // add an "invalid" class to the field:
		      z[j].className = "form-select invalid";
		      // and set the current valid status to false
		      valid = false;
		    } else {
		    	z[j].className = "form-select";
		    }
		  }


		  for (k = 0; k < m.length; k++) {
		    // If a field is empty...
		    console.log(m[k]);
		    if (m[k].value == '') {
		      // add an "invalid" class to the field:
		      m[k].className += " invalid";
		      // and set the current valid status to false
		      valid = false;
		    } else {
		    	m[k].className = "form-control";
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
		  //... and adds the "active" class on the current step:
		  x[n].className += " active";
		}
	</script>
  </main>
@endsection