<x-dash-layout>
<div>
  @php
  if (isset($_GET['view'])) {
      // Retrieve the value of the 'view' parameter
      $param = $_GET['view'];

      // Use the $view variable as needed
      $view = htmlspecialchars($param);
  } else {
      // If 'view' parameter is not set in the URL
      echo "The 'view' parameter is not set.";
  }
  @endphp
    <div class="content-body">
        <div class="container">
          <div class="row">
            <div class="col-xxl-12 col-xl-12">
              <div class="page-title" style="display: flex; gap:3%">
                <span>
                  <a href="{{ route('settings') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="27" height="26" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
                    </svg>
                  </a>
                </span>
                @switch($view)
                    @case('profile')
                        <h4>Profile</h4>
                        @break
                    @case('kyc')
                        <h4>Kyc Information</h4>
                        @break
                    @case('privacy-security')
                        <h4>Privacy & Security</h4>
                        @break
                    @case('issue')
                        <h4>Support (Report Issue)</h4>
                        @break
                    @default
                        
                @endswitch
              </div>
              <div class="">
     
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
                <div id="updateProfile" class="">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @include('profile.update-profile-information-form')
                        @endif
                    </div>
                  </div>
                </div>
                <div id="twoFactor" class="">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                      @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                          @livewire('profile.update-password-form')
                        @endif
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.logout-other-browser-sessions-form')
                        @endif
                    </div>
                  </div>
                </div>
                <div id="browserSession" class="">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-password-form')
                        @endif
                    </div>
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.logout-other-browser-sessions-form')
                        @endif
                    </div>
                  </div>
                </div>

                <div id="docUploads" class="">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                      <div id="fileUploadSection" class="profile-card card-bx m-b30 p-4">
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
          var view = '{{$view}}';
          switch (view) {
            case 'profile':
              profileTab();
              break;
            case 'kyc':
              docUplaodsTab()
              break;
            case 'privacy-security':
              securityTab();
              break;
            case 'issue':
              activityTab();
              break;
          
            default:
              profileTab();
              break;
          }

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
</div>
</x-dash-layout>
