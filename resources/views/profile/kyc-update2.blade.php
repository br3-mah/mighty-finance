
<style>
    
    .main-content .wizard-form .progressbar-list::before{
    content: " ";
    background-color: rgb(155, 155, 155);
    border: 10px solid #fff;
    border-radius: 50%;
    display: block;
    width: 30px;
    height: 30px;
    margin: 9px auto;
    box-shadow: 1px 1px 3px #662d91;
    transition:all;
    }
    .main-content .wizard-form .progressbar-list::after{
    content: "";
    background-color: rgb(155, 155, 155);
    padding: 0px 0px;
    position: absolute;
    top: 14px;
    left: -50%;
    width: 100%;
    height: 2px;
    margin: 9px auto;
    z-index: -1;
    transition: all 0.8s;
    }
    .main-content .wizard-form .progressbar-list.active::after{
        background-color: #662d91;
    }
    .main-content .wizard-form .progressbar-list:first-child::after{
        content: none;
    }
    .main-content .wizard-form .progressbar-list.active::before{
        font-family: "Font Awesome 5 free";
        content: "\f00c";
        font-size: 11px;
        font-weight: 600;
        color: #fff;
        padding: 6px;
        background-color: #662d91;
        border: 1px solid #662d91;
        box-shadow: 0 0 0 7.5px rgb(176 60 70 / 11%);
    }
    .progressbar-list{
        color:#662d91;
    }
    .active{
        color:#000;
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
            <section>
            <div class="container">
            <form action="{{ route("update-file-uploads") }}" method="POST" enctype="multipart/form-data" class="main-content">
                @csrf 
                <!-- ... (other form elements) ... -->
                
                <div class="row justify-content-center pt-0 p-4" id="wizardRow">
                    <!-- ... (other form elements) ... -->
            
                    <div class="col-12 text-center">
                        <!-- wizard -->
                        <div class="wizard-form py-4 my-2">
                            <ul id="progressBar" class="progressbar px-lg-0 px-0">
                                <li id="progressList-1" class="d-inline-block fw-bold w-25 position-relative text-center float-center progressbar-list active">
                                    Profile
                                </li>
                                <li id="progressList-2" class="d-inline-block fw-bold w-25 position-relative text-center float-center progressbar-list">
                                    Uplods
                                </li>
                            </ul>
                        </div>
                        <!-- /wizard -->
                    </div>
                </div>
            
                <div class="row justify-content-center" id="cardSection">
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
            
                    <!-- NEXT BUTTON-->
                    <button type="button" class="btn text-white float-end next mt-4 rounded-3 bg-color-info">Continue</button>
                </div>
            
                <div class="row justify-content-center form-business">
                    <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Copy of NRC</label>
                                    <input class="form-control" name="nrc_file" type="file" id="formFile">
                                </div>
    
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="formFile" class="form-label">Business Profile</label>
                                    <input class="form-control" name="business_file" type="file" id="formFile">
                                </div>
    
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="payslip_file" class="form-label">Payslip</label>
                                    <input class="form-control" name="payslip_file" type="file" id="payslip_file">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="form-group">
                            <div class="input-box">
                                <div class="mb-3">
                                    <label for="tpin_file" class="form-label">Tpin</label>
                                    <input class="form-control" name="tpin_file" type="file" id="tpin_file">
                                </div>
                            </div>
                        </div>
                    </div>
            
                    <!-- NEXT and BACK BUTTONS-->
                    <button type="button" class="btn btn-dark text-white float-start back rounded-3">Go Back</button>
                    <button type="submit" class="btn text-white float-end submit-button rounded-3 bg-color-info">Finish</button>
                    <!-- /NEXT and BACK BUTTONS -->
                </div>
            </form>
            </div>
        </section>
    </div>
    </div>
    
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script>
        // hidden things
        $(".form-business").hide();
        $("#successMessage").hide();
        // next button
        $(".next").on({
            click: function () {
                // select any card
                // var getValue = $(this).parents(".row").find(".card").hasClass("active-card");
                // // alert(getValue);
                // if (getValue) {
                    $("#progressBar").find(".active").next().addClass("active");
                    // $("#alertBox").addClass("d-none");
                    $(this).parents(".row").fadeOut("slow", function () {
                        $(this).next(".row").fadeIn("slow");
                        $('.form-business').show();
                        $('.form-business').addClass("d-block");
                    });
            }
        });
        // back button
        $(".back").on({
            click: function () {
                $("#progressBar .active").last().removeClass("active");
                $(this).parents(".row").fadeOut("slow", function () {
                    $(this).prev(".row").fadeIn("slow");
                });
            }
        });
        //finish button
        $(".submit-button").on({
            click: function () {
                $("#wizardRow").fadeOut(300);
                // $(this).parents(".row").children("#successForm").fadeOut(300);
                $(this).parents(".row").children("#successMessage").fadeIn(3000);
            }
        });
        //Active card on click function
        $(".card").on({
            click: function () {
                $(this).toggleClass("active-card");
                $(this).parent(".col").siblings().children(".card").removeClass("active-card");
            }
        });
        //back to wizard
        $(".back-to-wizard").on({
            click: function () {
                location.reload(true);
            }
        });
    </script>