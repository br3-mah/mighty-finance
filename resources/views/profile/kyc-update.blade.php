
<style>
    .wizard-container {
      margin: auto;
    }

    .step {
      display: none;
    }

    .step.active {
      display: block;
    }

    button {
      margin-top: 10px;
    }

/* card */
.card img{
    width: 40px;
}
.card{
    border: 3px solid #fbf6f6;
    cursor: pointer;
}
.active-card{
    color:#662d91;
    font-weight: bold;
    border: 3px solid #662d91;
}
.form-check-input:focus {
    box-shadow: none;
}
.bg-color-info{
    background-color:#662d91 !important;
}
.border-color{
    border-color: #662d91;
}
.btn{
    padding:16px 30px;
}
.back-to-wizard{
    transform: translate(-50%, -139%) !important;
}
.bg-success-color{
    background-color:#87D185;
}
.bg-success-color:focus{
    box-shadow: 0 0 0 0.25rem rgb(55 197 20 / 25%);
}

.selected-card {
    background-color: #ffd500; /* Light red background color */
    border: 1px solid #ffd900; /* Red border color */
}

/* Input Field Style */
/* General styling for all inputs */
input {
    
    padding: 10px;
    border: 2px solid #662d91; /* Border color */
    border-radius: 5px; /* Rounded corners */
    font-size: 24px; /* Increased font size */
    font-family: 'Arial', sans-serif;
}

/* Styling for text-type inputs */
input[name='amount'] {
    text-align: right;
}

/* Hover effect */
input:hover {
    border-color: #662d91; /* Border color on hover */
}

/* Focus effect */
input:focus {
    outline: none;
    border-color: #662d91; /* Border color when focused */
    box-shadow: 0 0 10px rgba(185, 60, 231, 0.8); /* Box shadow when focused */
}

</style>
<div class="col-xxl-12 col-xl-12 col-lg-12">
    <div id="fileUploadSection" class="profile-card card-bx m-b30 p-4">    
        <div class="wizard-container">
            <form action="{{ route("update-kyc-uploads") }}" method="POST" enctype="multipart/form-data"  id="wizardForm">
                @csrf
                <div class="step" id="step1">
                    <div class="row justify-content-center">
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">First Name</label>
                            <input
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->fname }}"
                            name="fname"
                            value="{{ auth()->user()->fname }}"
                            {{-- wire:model.defer="state.fname" --}}
                            />
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">Last Name</label>
                            <input
                            name="lname"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->lname }}"
                            value="{{ auth()->user()->lname }}"
                            {{-- wire:model.defer="state.lname" --}}
                            />
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">Phone Number</label>
                            <input
                            name="phone"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->phone}}"
                            value="{{ auth()->user()->phone}}"
                            {{-- wire:model.defer="state.phone" --}}
                            />
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">National ID Type</label>
                            <select
                                name="id_type"
                                class="form-control"
                                {{-- wire:model.defer="state.id_type" --}}
                                >  
                                <option value="">-- Choose --</option>
                                <option {{ auth()->user()->id_type == 'NRC' ? 'selected' : ''}} value="NRC">NRC</option>
                                <option {{ auth()->user()->id_type == 'Passport' ? 'selected' : ''}} value="Passport">Passport</option>
                                <option {{ auth()->user()->id_type == 'Driver Liecense' ? 'selected' : ''}} value="Driver Liecense">Driver Liecense</option>
                            </select>
                        </div>
                        
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">National ID Number</label>
                            <input
                            name="nrc_no"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->nrc_no}}"
                            value="{{ auth()->user()->nrc_no}}"
                            {{-- wire:model.defer="state.nrc_no" --}}
                            />
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">Sex</label>
                            <select
                                name="gender"
                                class="form-control"
                                name="gender"
                                {{-- wire:model.defer="state.gender" --}}
                                >  
                                <option value="{{ auth()->user()->gender}}">{{ auth()->user()->gender}}</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">Date of birth</label>
                            <input
                            name="dob"
                            type="text"
                            class="form-control hasDatepicker"
                            placeholder="{{ auth()->user()->dob}}"
                            value="{{ auth()->user()->dob}}"
                            id="datepicker"
                            autocomplete="off"
                            {{-- wire:model.defer="state.dob" --}}
                            />
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">Present Address</label>
                            <input
                            name="address"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->address }}"
                            value="{{ auth()->user()->address }}"
                            {{-- wire:model.defer="state.address" --}}
                            />
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4">
                            <label class="form-label">Job Title</label>
                            <input
                            name="occupation"
                            type="text"
                            class="form-control"
                            placeholder="{{ auth()->user()->occupation }}"
                            value="{{ auth()->user()->occupation }}"
                            {{-- wire:model.defer="state.address" --}}
                            />
                        </div>
                    </div>
                    <button type="button" class="btn text-white float-end next mt-4 rounded-3 bg-color-info" onclick="nextStep(1)">Next</button>
                    
                </div>
            
                <div class="step justify-content-center" id="step2">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Copy of NRC</label>
                                    <input required class="form-control" name="nrc_file" type="file" id="formFile">
                                </div>
    
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Business Profile</label>
                                    <input class="form-control" name="business_file" type="file" id="formFile">
                                </div>
    
                            </div>
                        </div>
                    </div> --}}
                    {{-- <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="payslip_file" class="form-label">Payslip</label>
                                    <input class="form-control" name="payslip_file" type="file" id="payslip_file">
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="tpin_file" class="form-label">Tpin</label>
                                    <input required class="form-control" name="tpin_file" type="file" id="tpin_file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-dark text-white float-start back rounded-3" type="button" onclick="prevStep(3)">Previous</button>
                    <button class="btn text-white float-end submit-button rounded-3 bg-color-info" type="submit">Submit</button>
                </div>
            </form>
            <br><br><br><br>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
  let currentStep = 1;
  const form = document.getElementById('wizardForm');

  function showStep(step) {
    const steps = document.querySelectorAll('.step');
    steps.forEach(s => s.classList.remove('active'));
    document.getElementById(`step${step}`).classList.add('active');
  }

  function nextStep(step) {
    if (step === currentStep && currentStep < 3) {
      currentStep++;
      showStep(currentStep);
    }
  }

  function prevStep(step) {
    if (step === currentStep && currentStep > 1) {
      currentStep--;
      showStep(currentStep);
    }
  }

//   form.addEventListener('submit', function (e) {
//     e.preventDefault();
//     // Handle form submission here
//     alert('Form submitted successfully!');
//   });

  // Show initial step
  showStep(currentStep);
</script>