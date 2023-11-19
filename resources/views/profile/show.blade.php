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
                    <a href="#">Profile</a>
                    {{-- <a href="settings-application.html">Application</a>
                    <a href="settings-security.html">Security</a>
                    <a href="settings-activity.html">Activity</a>
                    <a href="settings-privacy.html">Privacy</a>
                    <a href="settings-payment-method.html">Payment Method</a>
                    <a href="settings-api.html">API</a>
                    <a href="settings-fees.html">Fees</a> --}}
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12">
                        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                            @livewire('profile.update-profile-information-form')
                        @endif
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <script src="{{ asset('public/mfs/vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{ asset('public/mfs/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
</x-dash-layout>
