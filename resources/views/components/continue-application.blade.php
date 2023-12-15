
<div id="overlay"></div>
<div class="modal" style="z-index: 99999" id="continue-loan-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    
        <div class="p-6 modal-content">
            <div class="modal-header">
                <h3 class="modal-title text-center ">
                    
                    Loan Completion Form</h3>

                {{-- <span style="cursor:pointer" onclick="closeModal()">x</span> --}}
            </div>
            <div class="modal-body row" style="overflow-y: scroll; overflow-x:hidden; height:63vh">
                <div class="col-xxl-3 col-xl-3 col-lg-3" >
                    <img width="240" src="https://img.freepik.com/free-vector/account-concept-illustration_114360-279.jpg?w=740&t=st=1700475235~exp=1700475835~hmac=99f4c6fbffcf369cc925fde13256cbcdefd9c50ab8b470e1d74610f67d158f4d">
                </div>
                <div class="col-xxl-9 col-xl-9 col-lg-9">
                    <form class="py-6 pb-4 col-xxl-12 col-xl-12 col-lg-12 " method="post" action="{{ route('continue-loan') }}"  id="wizard" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="MAX_FILE_SIZE" value="64000000" />
                        <input type="hidden" name="application_id" value="{{ App\Models\Application::currentApplication()->id }}">
                        <input type="hidden" name="borrower_id" value="{{ auth()->user()->id }}">
                        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                        <!-- Personal Info -->
                        <div class="step col-xxl-12" id="step1"  data-aos="fade-left"
                            data-aos-anchor="#example-anchor"
                            data-aos-startEvent="DOMContentLoaded"
                            data-aos-offset="500"
                            data-aos-duration="500">

                            <div style="width: 90%" class="d-flex justify-content-between mb-2">
                                
                                <h5>
                                    Profile Details</h5>
                            </div>
                            <br>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="dob">D.O.B</label>
                                    <input value="{{auth()->user()->dob}}" type="date" class="form-control" id="dob" name="dob">
                                    <small id="jobDOBError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jobTitle">JOB TITLE</label>
                                    <input value="{{ auth()->user()->occupation ?? auth()->user()->jobTitle }}" data-validation="email" type="text" class="form-control" id="jobTitle" name="jobTitle">
                                    <small id="jobTitleError" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="phone">PHONE NUMBER</label>
                                    <div class="input-group">
                                        {{-- <select class="form-control" name="pcode">
                                            <option value="260">+260</option>
                                            <option value="master">Euro</option>
                                        </select> --}}
                                        <input
                                            id="phone"
                                            value="{{ auth()->user()->phone ?? auth()->user()->phone2 }}"
                                            type="text"
                                            name="phone"
                                            class="form-control"
                                            placeholder="77 214 77 55"
                                        />
                                    </div>
                                    <small id="phoneError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="employeeNo">EMPLOYEE NO</label>
                                    <input value="{{ auth()->user()->employeeNo }}" type="text" class="form-control" id="employeeNo" name="employeeNo">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <label for="nrc">IDENTIFICATION TYPE</label>
                                    <div class="input-group">
                                        <select
                                            id="nrc_id"
                                            name="id_type"
                                            class="form-control"
                                            {{-- wire:model.defer="state.id_type" --}}
                                            >  
                                            <option value="">-- ID TYPE --</option>
                                            <option {{ auth()->user()->id_type == 'NRC' ? 'selected' : ''}} value="NRC">NRC</option>
                                            <option {{ auth()->user()->id_type == 'Passport' ? 'selected' : ''}} value="Passport">Passport</option>
                                            <option {{ auth()->user()->id_type == 'Driver Liecense' ? 'selected' : ''}} value="Driver Liecense">Driver Liecense</option>
                                        </select>
                                        <input value="{{auth()->user()->nrc_no ?? auth()->user()->nrc}}" type="text" placeholder="ID Number" class="form-control" id="nrc" name="nrc">
                                    </div>
                                    <small id="nrcError" class="text-danger"></small>
                                    <br>
                                    <small id="nrcIDError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="ministry">MINISTRY</label>
                                    <input value="{{ auth()->user()->ministry ?? 'ex. Ministry of Health' }}" type="text" class="form-control" id="ministry" name="ministry">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="department">GENDER</label>
                                    <select
                                        id="gender"
                                        class="form-control"
                                        name="gender"
                                        {{-- wire:model.defer="state.gender" --}}
                                        >  
                                        <option> -- GENDER --</option>
                                        <option value="{{ auth()->user()->gender}}">{{ auth()->user()->gender}}</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    <small id="genderError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="department">DEPARTMENT</label>
                                    <input value="{{ auth()->user()->department }}" type="text" class="form-control" id="department" name="department">
                                </div>
                            </div>
                            <button type="button" style="float: right;" class="mt-3 btn btn-primary" onclick="nextStep(1)">
                                Next 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                </svg>
                            </button>
                        </div>

                        {{-- KYC --}}
                        <div class="step" id="step2">
                            <div style="width: 90%" class="d-flex justify-content-between mb-2">
                                <h5>KYC Documents</h5>
                            </div>
                            <br>
                            <div class="row col-md-12 col-lg-12" style="">
                                <div class="file-uploader col-xxl-6 col-xl-6 col-lg-6 border" style="border: 1px #d3d1d1; padding:2%;">
                                    <!-- Use a label for file input and add a Font Awesome icon -->
                                    <input type="file" class="file-input visually-hidden" id="fileInput" accept=".pdf, .doc, .docx" name="nrc_file">
                                    <label for="fileInput" class="file-input-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        <span>Upload Copy of NRC</span>
                                    </label>
                                    
                                    <!-- Uploaded file list -->
                                    <div class="pt-2">
                                        <ul class="file-list" id="fileList"></ul>
                                    </div>
                                    
                                    <small id="nrcFileError" class="text-danger"></small>
                                </div>
                                <div class="file-uploader col-xxl-6 col-xl-6 col-lg-6 border" style="border: 1px #d3d1d1; padding:2%;">
                                    <!-- Use a label for file input and add a Font Awesome icon -->
                                    <input type="file" class="file-input visually-hidden" id="fileInput2" accept=".pdf, .doc, .docx" name="payslip_file">
                                    <label for="fileInput2" class="file-input-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        <span>Upload Copy of Tpin</span>
                                    </label>
                                    
                                    <!-- Uploaded file list -->
                                    <div class="pt-2">
                                        <ul class="file-list-2" id="fileList-2"></ul>
                                    </div>
                                    <small id="fiileInput2Error" class="text-danger"></small>
                                </div>
                            </div>
                            <div style="float: right;" class="mt-2">
                                <button type="button" class="btn btn-light text-dark" onclick="prevStep(2)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                    Back
                                </button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(2)">
                                    Next 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>

                        <!-- Next of Kin Info -->
                        <div class="step" id="step3">
                            <h5>Next of Kin Details</h5>
                            <br>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="nextOfKinFirstName">FIRST NAME (Next of Kin)</label>
                                    <input type="text" class="form-control" id="nextOfKinFirstName" name="nextOfKinFirstName">
                                    <small id="nokFNError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nextOfKinLastName">LAST NAME (Next of Kin)</label>
                                    <input type="text" class="form-control" id="nextOfKinLastName" name="nextOfKinLastName">
                                    <small id="nokLNError" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="nextOfKinPhone">PHONE NUMBER (Next of Kin)</label>
                                    <div class="input-group">
                                        <select class="form-control" name="kpcode">
                                            <option value="260">+260</option>
                                            {{-- <option value="master">Euro</option> --}}
                                        </select>
                                        <input
                                            id="nextOfKinPhone"
                                            type="text"
                                            name="nextOfKinPhone"
                                            class="form-control"
                                            placeholder="77 214 77 55"
                                        />
                                    </div>
                                    <small id="nextOfKinPhoneError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="physicalAddress">PHYSICAL ADDRESS (Next of Kin)</label>
                                    <input type="text" class="form-control" id="physicalAddress" name="physicalAddress">
                                </div>
                            </div>
                            <div class="form-group mb-4">
                                <label for="relationship">RELATIONSHIP WITH APPLICANT</label>
                                <input type="text" class="form-control" id="relationship" name="relationship">
                                <small id="relationError" class="text-danger"></small>
                            </div>
                            <div style="float: right;">
                                <button type="button" class="btn btn-light text-dark" onclick="prevStep(3)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                    Back
                                </button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                    Next 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        {{-- <div class="step" id="step3">
                            <h4>Guarantor's Information</h4>
                            
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="guarantorName">Guarantor’s Name</label>
                                    <input type="text" class="form-control" id="guarantorName" name="guarantorName">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="guarantorAddress">Residential address</label>
                                    <input type="text" class="form-control" id="guarantorAddress" name="guarantorAddress">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="guarantorNRC">NRC Number</label>
                                    <input type="text" class="form-control" id="guarantorNRC" name="guarantorNRC">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="guarantorDOB">Date of Birth</label>
                                    <input type="date" class="form-control" id="guarantorDOB" name="guarantorDOB">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="relationshipToBorrower">Relationship to the Borrower</label>
                                    <input type="text" class="form-control" id="relationshipToBorrower" name="relationshipToBorrower">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="guarantorContactNumber">Contact Number</label>
                                    <input type="text" class="form-control" id="guarantorContactNumber" name="guarantorContactNumber">
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="alternativeNumber">Alternative Number</label>
                                    <input type="text" class="form-control" id="alternativeNumber" name="alternativeNumber">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="spouseContactNumber">Contact NO. of Spouse</label>
                                    <input type="text" class="form-control" id="spouseContactNumber" name="spouseContactNumber">
                                </div>
                            </div>
                            <!-- Navigation buttons to move to the previous and next steps -->
                            <div style="float: right;">
                                <button type="button" class="btn btn-light text-dark" onclick="prevStep(3)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                    Back
                                </button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(3)">
                                    Next 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div> --}}
                        <!-- References -->
                        <div class="step" id="step4">
                            <h5>References</h5>
                            <p>Human Resource Details:</p>
                            <br>
                            <div class="row mb-4">
                                <div class="form-group col-md-4">
                                    <label for="hrFirstName">FIRST NAME (HR)</label>
                                    <input type="text" class="form-control" id="hrFirstName" name="hrFirstName">
                                    <small id="fnHRError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="hrLastName">LAST NAME (HR)</label>
                                    <input type="text" class="form-control" id="hrLastName" name="hrLastName">
                                    <small id="lnHRError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="hrContactNumber">CONTACT NUMBER (HR)</label>
                                    <input type="text" class="form-control" id="hrContactNumber" name="hrContactNumber">
                                    <small id="contactHRError" class="text-danger"></small>
                                </div>
                            </div>
    
                            <p>Supervisor Details:</p>
                            <div class="row mb-4">
                                <div class="form-group col-md-4">
                                    <label for="supervisorFirstName">FIRST NAME (Supervisor)</label>
                                    <input type="text" class="form-control" id="supervisorFirstName" name="supervisorFirstName">
                                    <small id="supFNError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="supervisorLastName">LAST NAME (Supervisor)</label>
                                    <input type="text" class="form-control" id="supervisorLastName" name="supervisorLastName">
                                    <small id="supLNError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="supervisorContactNumber">CONTACT NUMBER (Supervisor)</label>
                                    <input type="text" class="form-control" id="supervisorContactNumber" name="supervisorContactNumber">
                                    <small id="supContactError" class="text-danger"></small>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button type="button" class="btn btn-light text-dark" onclick="prevStep(4)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                    Back
                                </button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(4)">
                                    Next 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
    
                        <!-- Bank Details -->
                        <div class="step" id="step5">
                            <h5>Bank Details</h5>
                            <br>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="bankName">BANK NAME</label>
                                    <input type="text" class="form-control" id="bankName" name="bankName">
                                    <small id="bankNameError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="branchName">BRANCH NAME</label>
                                    <input type="text" class="form-control" id="branchName" name="branchName">
                                    <small id="bankBranchError" class="text-danger"></small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="form-group col-md-6">
                                    <label for="accountNumber">ACCOUNT NUMBER</label>
                                    <input type="text" class="form-control" id="accountNumber" name="accountNumber" placeholder="XXXX XXXX XXXX XXXX">
                                    <small id="bankAccError" class="text-danger"></small>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="accountNames">ACCOUNT NAMES</label>
                                    <input type="text" class="form-control" id="accountNames" name="accountNames">
                                    <small id="bankAccNameError" class="text-danger"></small>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button type="button" class="btn btn-light text-dark" onclick="prevStep(5)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                    Back
                                </button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(5)">
                                    Next 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
    
                        <!-- Bank Details -->
                        <div class="step" id="step6">
                            <div style="width: 90%" class="d-flex justify-content-between mb-2">
                                <h5>Requirements</h5>
                                <button title="Send the preapproval form to employer, manager, or supervisor" type="button" class="btn btn-sm" style="background-color: rgb(54, 15, 94)" onclick="openSendDocModal()">Send Preapproval</button>
                            </div>
                            <br>
                            <div class="col-xxl-12 col-xl-12 col-lg-12">
                                <div class="text-success" id="sendDocResponseText">Pre-approval forms share successfully</div>
                                <div class="text-danger" id="sendDocResponseText2">Cound not send, Please try again</div>
                            </div>
                            {{-- <small>Please upload a Copy of your <b>NRC(Front & Back)</b>, <b>latest Payslip</b>, <b>3 months Bank statement</b> and <b>passport size photo</b></small> --}}
                            <div class="row col-md-12 col-lg-12" style="">

                                <div class="file-uploader col-xxl-6 col-xl-6 col-lg-6 border" style="border: 1px #d3d1d1; padding:2%;">
                                    <!-- Use a label for file input and add a Font Awesome icon -->
                                    <input type="file" class="file-input visually-hidden" id="fileInput3" accept=".pdf, .doc, .docx" name="payslip_file">
                                    <label for="fileInput3" class="file-input-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        <span>Upload Latest Payslip</span>
                                    </label>
                                    
                                    <!-- Uploaded file list -->
                                    <div class="pt-2">
                                        <ul class="file-list-2" id="fileList-2"></ul>
                                    </div>
                                    <small id="payslipError" class="text-danger"></small>
                                </div>
                                <div class="file-uploader col-xxl-6 col-xl-6 col-lg-6 border" style="border: 1px #d3d1d1; padding:2%;">
                                    <!-- Use a label for file input and add a Font Awesome icon -->
                                    <input type="file" class="file-input visually-hidden" id="fileInput4" accept=".pdf, .doc, .docx" name="bankstatement">
                                    <label for="fileInput4" class="file-input-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        <span>3 months Bank statement</span>
                                    </label>
                                    
                                    <!-- Uploaded file list -->
                                    <div class="pt-2">
                                        <ul class="file-list-3" id="fileList-3"></ul>
                                    </div>
                                    <small id="bankstatementError" class="text-danger"></small>
                                </div>
                                <div class="file-uploader col-xxl-6 col-xl-6 col-lg-6 border" style="border: 1px #d3d1d1; padding:2%;">
                                    <!-- Use a label for file input and add a Font Awesome icon -->
                                    <input type="file" class="file-input visually-hidden" id="fileInput5" accept=".pdf, .doc, .docx" name="passport">
                                    <label for="fileInput5" class="file-input-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        <span>Passport size photo</span>
                                    </label>
                                    
                                    <!-- Uploaded file list -->
                                    <div class="pt-2">
                                        <ul class="file-list-4" id="fileList-4"></ul>
                                    </div>
                                    <small id="passportError" class="text-danger"></small>
                                </div>
                                <div class="file-uploader col-xxl-6 col-xl-6 col-lg-6 border" style="border: 1px #d3d1d1; padding:2%;">
                                    <!-- Use a label for file input and add a Font Awesome icon -->
                                    <input type="file" class="file-input visually-hidden" id="fileInput6" accept=".pdf, .doc, .docx" name="preapproval">
                                    <label for="fileInput6" class="file-input-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        <span>Pre approval Document</span>
                                    </label>
                                    
                                    <!-- Uploaded file list -->
                                    <div class="pt-2">
                                        <ul class="file-list-5" id="fileList-5"></ul>
                                    </div>
                                    <small id="preapprovalError" class="text-danger"></small>
                                </div>
                                <div class="file-uploader col-xxl-6 col-xl-6 col-lg-6 border" style="border: 1px #d3d1d1; padding:2%;">
                                    <!-- Use a label for file input and add a Font Awesome icon -->
                                    <input type="file" class="file-input visually-hidden" id="fileInput7" accept=".pdf, .doc, .docx" name="letterofintro">
                                    <label for="fileInput7" class="file-input-label">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="currentColor" class="bi bi-cloud-upload" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M4.406 1.342A5.53 5.53 0 0 1 8 0c2.69 0 4.923 2 5.166 4.579C14.758 4.804 16 6.137 16 7.773 16 9.569 14.502 11 12.687 11H10a.5.5 0 0 1 0-1h2.688C13.979 10 15 8.988 15 7.773c0-1.216-1.02-2.228-2.313-2.228h-.5v-.5C12.188 2.825 10.328 1 8 1a4.53 4.53 0 0 0-2.941 1.1c-.757.652-1.153 1.438-1.153 2.055v.448l-.445.049C2.064 4.805 1 5.952 1 7.318 1 8.785 2.23 10 3.781 10H6a.5.5 0 0 1 0 1H3.781C1.708 11 0 9.366 0 7.318c0-1.763 1.266-3.223 2.942-3.593.143-.863.698-1.723 1.464-2.383z"/>
                                            <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3z"/>
                                        </svg>
                                        <span>Letter of Introduction </span>
                                    </label>
                                    
                                    <!-- Uploaded file list -->
                                    <div class="pt-2">
                                        <ul class="file-list-5" id="fileList-5"></ul>
                                    </div>
                                    <small id="letterError" class="text-danger"></small>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button type="button" class="btn btn-light text-dark" onclick="prevStep(6)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                    Back
                                </button>
                                <button type="button" class="btn btn-primary" onclick="nextStep(6)">
                                    Next 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
    
    
                        <!-- Loan Details -->
                        <div class="step" id="step7">
                            <h5>Loan Summary Details</h5>
                            <br>
                            <div class="col-lg-12 row">
                                <div class="form-group col-md-6">
                                    <p>Loan Amount: <b>K{{ $activeLoan->amount }}</b> </p>
                                    <p>Loan Type: <b>{{ $activeLoan->type }} Loan</b> </p>
                                    <p>Interest rate: <b>21%</b> </p>
                                    <p>Service Charge:  <b>K3.5</b> </p>
                                    <p>Repayment Period: <b>{{ $activeLoan->repayment_plan }} Months</b> </p>
                                </div>
                                <div class="form-group col-md-6">
                                    <p>Payback Amount: <b>K{{ App\Models\Application::payback($activeLoan->amount, $activeLoan->repayment_plan)}}</b> </p>
                                    <p>Phone Number: <b>{{ auth()->user()->phone }}</b> </p>
                                    <p>Email: <b>{{ auth()->user()->email }}</b> </p>
                                </div>
                            </div>
                            <div style="float: right;">
                                <button type="button" class="btn btn-light text-dark" onclick="prevStep(7)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                                    </svg>
                                    Back
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Finish 
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>