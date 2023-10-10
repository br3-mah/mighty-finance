<div class="modal" id="continue-loan-modal" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Loan Application Form</h5>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('continue-loan') }}"  id="wizard" enctype="multipart/form-data">
                @csrf
                    <input type="hidden" name="application_id" value="{{ App\Models\Application::currentApplication()->id }}">
                    <input type="hidden" name="borrower_id" value="{{ auth()->user()->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                    <!-- Personal Info -->
                    <div class="step" id="step1">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="dob">D.O.B</label>
                                <input type="date" class="form-control" id="dob" name="dob">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nrc">NRC NUMBER</label>
                                <input type="text" class="form-control" id="nrc" name="nrc">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="phone">PHONE NUMBER</label>
                                <input type="text" class="form-control" id="phone" name="phone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="employeeNo">EMPLOYEE NO</label>
                                <input type="text" class="form-control" id="employeeNo" name="employeeNo">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="jobTitle">JOB TITLE</label>
                                <input type="text" class="form-control" id="jobTitle" name="jobTitle">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="ministry">MINISTRY</label>
                                <input type="text" class="form-control" id="ministry" name="ministry">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="department">DEPARTMENT</label>
                            <input type="text" class="form-control" id="department" name="department">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="nextStep(1)">Next</button>
                    </div>

                    <!-- Next of Kin Info -->
                    <div class="step" id="step2">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nextOfKinFirstName">FIRST NAME (Next of Kin)</label>
                                <input type="text" class="form-control" id="nextOfKinFirstName" name="nextOfKinFirstName">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="nextOfKinLastName">LAST NAME (Next of Kin)</label>
                                <input type="text" class="form-control" id="nextOfKinLastName" name="nextOfKinLastName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="relationship">RELATIONSHIP WITH APPLICANT</label>
                            <input type="text" class="form-control" id="relationship" name="relationship">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nextOfKinPhone">PHONE NUMBER (Next of Kin)</label>
                                <input type="text" class="form-control" id="nextOfKinPhone" name="nextOfKinPhone">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="physicalAddress">PHYSICAL ADDRESS (Next of Kin)</label>
                                <input type="text" class="form-control" id="physicalAddress" name="physicalAddress">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="prevStep(2)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(2)">Next</button>
                    </div>
                    <div class="step" id="step3">
                        <h4>Guarantor's Information</h4>
                        
                        <div class="form-group">
                            <label for="guarantorName">Guarantor’s Name</label>
                            <input type="text" class="form-control" id="guarantorName" name="guarantorName">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="guarantorNRC">NRC Number</label>
                                <input type="text" class="form-control" id="guarantorNRC" name="guarantorNRC">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="guarantorDOB">Date of Birth</label>
                                <input type="date" class="form-control" id="guarantorDOB" name="guarantorDOB">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="relationshipToBorrower">Relationship to the Borrower</label>
                                <input type="text" class="form-control" id="relationshipToBorrower" name="relationshipToBorrower">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="guarantorContactNumber">Contact Number</label>
                                <input type="text" class="form-control" id="guarantorContactNumber" name="guarantorContactNumber">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="alternativeNumber">Alternative Number</label>
                                <input type="text" class="form-control" id="alternativeNumber" name="alternativeNumber">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="spouseContactNumber">Contact NO. of Spouse</label>
                                <input type="text" class="form-control" id="spouseContactNumber" name="spouseContactNumber">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="guarantorAddress">Residential address</label>
                            <input type="text" class="form-control" id="guarantorAddress" name="guarantorAddress">
                        </div>
                        <!-- Navigation buttons to move to the previous and next steps -->
                        <button type="button" class="btn btn-primary" onclick="prevStep(3)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(3)">Next</button>
                    </div>
                    <!-- References -->
                    <div class="step" id="step4">
                        <h4>References</h4>
                        <p>Human Resource Details:</p>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="hrFirstName">FIRST NAME (HR)</label>
                                <input type="text" class="form-control" id="hrFirstName" name="hrFirstName">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="hrLastName">LAST NAME (HR)</label>
                                <input type="text" class="form-control" id="hrLastName" name="hrLastName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hrContactNumber">CONTACT NUMBER (HR)</label>
                            <input type="text" class="form-control" id="hrContactNumber" name="hrContactNumber">
                        </div>

                        <p>Supervisor Details:</p>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="supervisorFirstName">FIRST NAME (Supervisor)</label>
                                <input type="text" class="form-control" id="supervisorFirstName" name="supervisorFirstName">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="supervisorLastName">LAST NAME (Supervisor)</label>
                                <input type="text" class="form-control" id="supervisorLastName" name="supervisorLastName">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="supervisorContactNumber">CONTACT NUMBER (Supervisor)</label>
                            <input type="text" class="form-control" id="supervisorContactNumber" name="supervisorContactNumber">
                        </div>
                        <button type="button" class="btn btn-primary" onclick="prevStep(4)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(4)">Next</button>
                    </div>

                    <!-- Bank Details -->
                    <div class="step" id="step5">
                        <h4>Bank Details</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="bankName">BANK NAME</label>
                                <input type="text" class="form-control" id="bankName" name="bankName">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="branchName">BRANCH NAME</label>
                                <input type="text" class="form-control" id="branchName" name="branchName">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="accountNumber">ACCOUNT NUMBER</label>
                                <input type="text" class="form-control" id="accountNumber" name="accountNumber">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="accountNames">ACCOUNT NAMES</label>
                                <input type="text" class="form-control" id="accountNames" name="accountNames">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="prevStep(5)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(5)">Next</button>
                    </div>

                    <!-- Bank Details -->
                    <div class="step" id="step6">
                        <h4>Attachments</h4>
                        {{-- <small>Please upload a Copy of your <b>NRC(Front & Back)</b>, <b>latest Payslip</b>, <b>3 months Bank statement</b> and <b>passport size photo</b></small> --}}
                        <div class="row col-md-12 col-lg-12" style="gap: 12%">

                            <div class="file-uploader">
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
                            </div>
                            <div class="file-uploader">
                                <!-- Use a label for file input and add a Font Awesome icon -->
                                <input type="file" class="file-input visually-hidden" id="fileInput2" accept=".pdf, .doc, .docx" name="payslip_file">
                                <label for="fileInput2" class="file-input-label">
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
                            </div>
                            <div class="file-uploader">
                                <!-- Use a label for file input and add a Font Awesome icon -->
                                <input type="file" class="file-input visually-hidden" id="fileInput3" accept=".pdf, .doc, .docx" name="bankstatement">
                                <label for="fileInput3" class="file-input-label">
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
                            </div>
                            <div class="file-uploader">
                                <!-- Use a label for file input and add a Font Awesome icon -->
                                <input type="file" class="file-input visually-hidden" id="fileInput4" accept=".pdf, .doc, .docx" name="passport">
                                <label for="fileInput4" class="file-input-label">
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
                            </div>
                            <div class="file-uploader">
                                <!-- Use a label for file input and add a Font Awesome icon -->
                                <input type="file" class="file-input visually-hidden" id="fileInput5" accept=".pdf, .doc, .docx" name="preapproval">
                                <label for="fileInput5" class="file-input-label">
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
                            </div>

                        </div>
                        <button type="button" class="btn btn-primary" onclick="prevStep(6)">Back</button>
                        <button type="button" class="btn btn-primary" onclick="nextStep(6)">Next</button>
                    </div>


                    <!-- Loan Details -->
                    <div class="step" id="step7">
                        <h4>Loan Details</h4>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="loanAmount">LOAN AMOUNT</label>
                                <input type="text" class="form-control" id="loanAmount">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="tenure">TENURE</label>
                                <input type="text" class="form-control" id="tenure">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="serviceCharge">SERVICE CHARGE</label>
                                <input type="text" class="form-control" id="serviceCharge">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="amountToBeDisbursed">AMOUNT TO BE DISBURSED</label>
                                <input type="text" class="form-control" id="amountToBeDisbursed">
                            </div>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="prevStep(7)">Back</button>
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-primary">Done</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>