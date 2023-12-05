<x-dash-layout>

    <div class="content-body">
        <div class="container">
          <div class="row">
            <div class="col-xxl-12 col-xl-12">
              <div class="page-title">
                <h4>Profile</h4>
              </div>
              <div class="card">
                <div class="card-header">
                  <div class="settings-menu">
                    <a href="#" onclick="profileTab()">Profile</a>
                    <a href="#" onclick="activityTab()">Security</a>
                    {{-- <a href="#" onclick="securityTab()">Activity</a> --}}
                    <a href="#" onclick="docUplaodsTab()">Uploads</a>
                    {{--<a href="settings-privacy.html">Privacy</a>
                    <a href="settings-payment-method.html">Payment Method</a>
                    <a href="settings-api.html">API</a>
                    <a href="settings-fees.html">Fees</a> --}}
                  </div>
                </div>
                <div class="col-xxl-12 col-xl-12 col-lg-12 px-4">
                  @if (session('success'))
                      <div class="alert alert-success">
                          {{ session('success') }}
                      </div>
                  @endif

                  @if (session('error'))
                      <div class="alert alert-danger">
                          {{ session('error') }}
                      </div>
                  @endif
                </div>
                <div id="updateProfile" class="card-body">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @include('profile.update-profile-information-form')
                        @endif
                    </div>
                  </div>
                </div>
                <div id="twoFactor" class="card-body">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.two-factor-authentication-form')
                        @endif
                    </div>
                  </div>
                </div>
                <div id="browserSession" class="card-body">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        {{-- @if (Laravel\Fortify\Features::canUpdateProfileInformation()) --}}
                            @livewire('profile.update-password-form')
                        {{-- @endif --}}
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.logout-other-browser-sessions-form')
                        @endif
                    </div>
                  </div>
                </div>

                <div id="docUploads" class="card-body">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                      <div id="fileUploadSection" class="card profile-card card-bx m-b30 p-4">
                        <form action="{{ route("update-file-uploads") }}" method="POST" enctype="multipart/form-data">
                            @csrf 
                            <div class="row pt-4">
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
                            </div>
                            <div>
                                <button class="btn btn-primary">Upload</button>
                            </div>
                        </form>
                    </div>
                    </div>
                  </div>
                </div>


              </div>
            </div>
          </div>
        </div>
      </div>
      <script>
          document.getElementById('twoFactor').style.display = "none";
          document.getElementById('browserSession').style.display = "none";
          function profileTab() {
            document.getElementById('updateProfile').style.display = "block";
            document.getElementById('twoFactor').style.display = "none";
            document.getElementById('browserSession').style.display = "none";
            document.getElementById('docUploads').style.display = "none";
          }
          function activityTab() {
            document.getElementById('updateProfile').style.display = "none";
            document.getElementById('twoFactor').style.display = "none";
            document.getElementById('browserSession').style.display = "block";
            document.getElementById('docUploads').style.display = "none";
          }
          function securityTab() {
            document.getElementById('updateProfile').style.display = "none";
            document.getElementById('twoFactor').style.display = "block";
            document.getElementById('browserSession').style.display = "none";
            document.getElementById('docUploads').style.display = "none";
          }
          function docUplaodsTab() {
            document.getElementById('updateProfile').style.display = "none";
            document.getElementById('twoFactor').style.display = "none";
            document.getElementById('browserSession').style.display = "none";
            document.getElementById('docUploads').style.display = "block";
          }
      </script>
      <script src="{{ asset('public/mfs/vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{ asset('public/mfs/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</x-dash-layout>
