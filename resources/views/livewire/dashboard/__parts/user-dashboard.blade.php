<style>
  #checkNowBtn {
    position: relative;
  }

  #disabledIcon {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: none; /* Initially hidden */
  }

  #checkNowBtn[disabled]:hover #disabledIcon {
    display: inline; /* Show the icon on hover when the button is disabled */
  }
</style>
<div class="content-body">
    <div class="container-fluid">
        <div class="row" style="">
            <div class="col-xl-12">
                <div class="page-title-content">
                    <p>
                    Welcome Back,
                    <strong class="text-primary"> {{ auth()->user()->fname.' '.auth()->user()->lname }}!</strong>
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            

        <div class="col-xl-9">
          <div class="row">
            <div class="col-xxl-12 col-xl-12">
              <div class="card home-chart" style="background-image: linear-gradient(to right, #662d91, #912d73); color:#fff">
                {{-- <div class="card-header">
                  
                  <select
                    class="form-select"
                    name="report-type"
                    id="report-select"
                  >
                    <option value="1">Bitcoin</option>
                    <option value="2">Litecoin</option>
                  </select>
                </div> --}}
                <div class="card-body">
                  <h4 class="card-title home-chart text-white">Your Balance</h4>
                  <div class="home-chart-height">
                    <div class="row">
                      <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12">
                        <div class="my-2">
                          <h1 class="text-white" style="font-weight: 900;">0.00 ZMW</h1>
                        </div>
                      </div>
                      {{-- <div
                        class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                      >
                        <div class="chart-price-value">
                          <span>Current Borrowed</span>
                          <h5>K0.00 </h5>
                        </div>
                      </div>
                      <div
                        class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                      >
                        <div class="chart-price-value">
                          <span>Owing Amount</span>
                          <h5>K0.00</h5>
                        </div>
                      </div>
                      <div
                        class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                      >
                        <div class="chart-price-value">
                          <span>Commissions</span>
                          <h5>K0.00</h5>
                        </div>
                      </div> --}}
                    </div>
                    <div id="chartx"></div>
                  </div>
                </div>
              </div>
            </div>

            {{-- <div class="col-xxl-4 col-xl-4">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Latest Loans</h4>
                </div>
                <div class="card-body">
                  <ul class="balance-widget trade-balance">
                    <li>
                      <h5>GRZ Loan</h5>
                      <div class="text-end">
                        <h5>K10000</h5>
                        <span>K12100.</span>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
            </div> --}}

            {{-- <div class="col-xxl-8">
            <div class="card">
                <div class="card-header">
                <h4 class="card-title">Balance</h4>
                </div>
                <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <div class="balance-chart">
                        <div id="balance-chart"></div>
                        <h4>Total Balance = K 5360</h4>
                    </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                    <ul class="balance-widget mt-4">
                        <li>
                        <div class="icon-title">
                            <i class="cc BTC"></i>
                            <span>Bitcoin</span>
                        </div>
                        <div class="text-end">
                            <h5>0.000242 BTC</h5>
                            <span>0.125 USD</span>
                        </div>
                        </li>
                        <li>
                        <div class="icon-title">
                            <i class="cc USDT"></i>
                            <span>Tether</span>
                        </div>
                        <div class="text-end">
                            <h5>0.000242 USDT</h5>
                            <span>0.125 USD</span>
                        </div>
                        </li>
                        <li>
                        <div class="icon-title">
                            <i class="cc XTZ"></i>
                            <span>Tezos</span>
                        </div>
                        <div class="text-end">
                            <h5>0.000242 XTZ</h5>
                            <span>0.125 USD</span>
                        </div>
                        </li>
                        <li>
                        <div class="icon-title">
                            <i class="cc XMR"></i>
                            <span>Monero</span>
                        </div>
                        <div class="text-end">
                            <h5>0.000242 XMR</h5>
                            <span>0.125 USD</span>
                        </div>
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
            </div>
            </div> --}}

            {{-- Yellow Background --}}
            
            @include('livewire.dashboard.__parts.current-balance')

            <div class="col-xxl-4 col-xl-12">
              <div class="row">
                <div class="col-xxl-12 col-xl-4 col-lg-6">
                  <div class="price-widget">
                    <a href="price-details.html">
                      <div class="price-content">
                        <div class="icon-title">
                          <span class="badge badge-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-wallet2" viewBox="0 0 16 16">
                              <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499L12.136.326zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z"/>
                            </svg>
                          </span>
                          <span>Wallet</span>
                        </div>
                        <h5>K 0.00</h5>
                      </div>
                      {{-- <div id="chart"></div> --}}
                    </a>
                  </div>
                </div>
                <div class="col-xxl-12 col-xl-4 col-lg-6">
                  <div class="price-widget">
                    <a href="price-details.html">
                      <div class="price-content">
                        <div class="icon-title">
                          <span class="badge badge-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-down" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M3.5 6a.5.5 0 0 0-.5.5v8a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5v-8a.5.5 0 0 0-.5-.5h-2a.5.5 0 0 1 0-1h2A1.5 1.5 0 0 1 14 6.5v8a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 14.5v-8A1.5 1.5 0 0 1 3.5 5h2a.5.5 0 0 1 0 1z"/>
                              <path fill-rule="evenodd" d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                            </svg>
                          </span>
                          <span>Withdrawals</span>
                        </div>
                        <h5>K 0.0</h5>
                      </div>
                      {{-- <div id="chart2"></div> --}}
                    </a>
                  </div>
                </div>
                <div class="col-xxl-12 col-xl-4 col-lg-6">
                  <div class="price-widget">
                    <a href="price-details.html">
                      <div class="price-content">
                        <div class="icon-title">
                          <span class="badge badge-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-up" viewBox="0 0 16 16">
                              <path fill-rule="evenodd" d="M3.5 10a.5.5 0 0 1-.5-.5v-8a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-.5.5h-2a.5.5 0 0 0 0 1h2A1.5 1.5 0 0 0 14 9.5v-8A1.5 1.5 0 0 0 12.5 0h-9A1.5 1.5 0 0 0 2 1.5v8A1.5 1.5 0 0 0 3.5 11h2a.5.5 0 0 0 0-1z"/>
                              <path fill-rule="evenodd" d="M7.646 4.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V14.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708z"/>
                            </svg>
                          </span>
                          <span>Deposits</span>
                        </div>
                        <h5>K 0.00</h5>
                      </div>
                      {{-- <div id="chart3"></div> --}}
                    </a>
                  </div>
                </div>
                <!-- <div class="col-xxl-6 col-xl-4 col-lg-6">
                                    <div class="price-widget">
                                        <a href="price-details.html">
                                            <div class="price-content">
                                                <div class="icon-title">
                                                    <i class="cc USDT"></i>
                                                    <span>Tether</span>
                                                </div>
                                                <h5>K 11,785.10</h5>
                                            </div>
                                            <div id="chart4"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-4 col-lg-6">
                                    <div class="price-widget">
                                        <a href="price-details.html">
                                            <div class="price-content">
                                                <div class="icon-title">
                                                    <i class="cc USDT"></i>
                                                    <span>Tether</span>
                                                </div>
                                                <h5>K 11,785.10</h5>
                                            </div>
                                            <div id="chart5"></div>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-xxl-6 col-xl-4 col-lg-6">
                                    <div class="price-widget">
                                        <a href="price-details.html">
                                            <div class="price-content">
                                                <div class="icon-title">
                                                    <i class="cc USDT"></i>
                                                    <span>Tether</span>
                                                </div>
                                                <h5>K 11,785.10</h5>
                                            </div>
                                            <div id="chart6"></div>
                                        </a>
                                    </div>
                                </div> -->
              </div>
            </div>

            <div class="col-xxl-12 col-xl-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Recent Loans</h4>
                </div>
                @if(!empty($all_loan_requests->toArray()))
                <div class="card-body">
                  <div class="table-responsive transaction-table">
                    <table class="table table-striped responsive-table">
                      <thead>
                        <tr>
                          <th>Loan ID</th>
                          <th>Date</th>
                          <th>Type</th>
                          <th>Amount</th>
                          <th>Payback</th>
                          {{-- <th>Fee</th> --}}
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                        @forelse($all_loan_requests as $loan)
                        <tr>
                          <td>{{ $loan->id }}</td>
                          <td>{{ $loan->created_at->toFormattedDateString()}}</td>
                          <td>
                            <span class="danger-arrow"
                              >{{ $loan->type }}</span
                            >
                          </td>
                          <td class="text-primary">{{ $loan->amount  }} ZMW</td>
                          <td class="text-danger">{{ App\Models\Application::payback($loan->amount, $loan->repayment_plan)}} ZMW</td>
                          {{-- <td>0.02%</td> --}}
                          <td><strong>{{ App\Models\Loans::loan_balance($loan->id) }} ZMW</strong></td>
                        </tr>
                        @empty
                        <p>No Completed Loans</p>
                        @endforelse
                      </tbody>
                    </table>
                  </div>
                </div>
                @endif
              </div>
            </div>

          </div>
        </div>

        <div class="col-xl-3">
          <div class="row">
            <div class="col-xxl-12 col-xl-12 col-lg-6">
              <div class="card welcome-profile" style="background-image: linear-gradient(to right, #662d91, #662d91); color:#fff">
                <div class="card-body">
                  <img src="https://www.seekpng.com/png/detail/72-729756_how-to-add-a-new-user-to-your.png" alt="" />
                  <h4>Hi, {{ auth()->user()->fname.' '.auth()->user()->lname }}!</h4>
                  <p>
                    Looks like you are not verified yet. Verify yourself to use
                      the full potential of MFS.
                  </p>

                  <ul>
                    <li>
                      <a href="#">
                        <span class="verified"
                          ><i class="icofont-check"></i
                        ></span>
                        Verify account
                      </a>
                    </li>
                    <li>
                        <a class="tour-kyc-1" href="{{ route('profile.show') }}">
                          <span class="not-verified"
                            ><i class="icofont-close-line"></i
                          ></span>
                          Update Profile (KYC)
                          <div
                          data-hint="Please continue to update and upload neccessary 
                          profile information, to allow quick loan processing and review" 
                          data-hint-position="top-left"></div>
                        </a>
                      </li> 
                    <li>
                      <a href="#">
                        <span class="not-verified"
                          ><i class="icofont-close-line"></i
                        ></span>
                        Two-factor authentication (2FA)
                      </a>
                    </li>
                    <li>
                      <a href="#">
                        <span class="not-verified"
                          ><i class="icofont-close-line"></i
                        ></span>
                        Deposit money
                      </a>
                    </li>
                  </ul>
          </div>
        </div>
      </div>
      <div class="mb-4 justify-content-between" style="display: flex; gap:1%;">
        <div class="notify-bell">
          <span class="btn" style="background: #662d91"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-repeat" viewBox="0 0 16 16">
            <path d="M11 5.466V4H5a4 4 0 0 0-3.584 5.777.5.5 0 1 1-.896.446A5 5 0 0 1 5 3h6V1.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384l-2.36 1.966a.25.25 0 0 1-.41-.192Zm3.81.086a.5.5 0 0 1 .67.225A5 5 0 0 1 11 13H5v1.466a.25.25 0 0 1-.41.192l-2.36-1.966a.25.25 0 0 1 0-.384l2.36-1.966a.25.25 0 0 1 .41.192V12h6a4 4 0 0 0 3.585-5.777.5.5 0 0 1 .225-.67Z"/>
          </svg> Transfer</span>
        </div>
        <div class="notify-bell">
          <span class="btn text-primary" style="background: #662d912f"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-safe" viewBox="0 0 16 16">
            <path d="M1 1.5A1.5 1.5 0 0 1 2.5 0h12A1.5 1.5 0 0 1 16 1.5v13a1.5 1.5 0 0 1-1.5 1.5h-12A1.5 1.5 0 0 1 1 14.5V13H.5a.5.5 0 0 1 0-1H1V8.5H.5a.5.5 0 0 1 0-1H1V4H.5a.5.5 0 0 1 0-1H1zM2.5 1a.5.5 0 0 0-.5.5v13a.5.5 0 0 0 .5.5h12a.5.5 0 0 0 .5-.5v-13a.5.5 0 0 0-.5-.5z"/>
            <path d="M13.5 6a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 1 .5-.5M4.828 4.464a.5.5 0 0 1 .708 0l1.09 1.09a3.003 3.003 0 0 1 3.476 0l1.09-1.09a.5.5 0 1 1 .707.708l-1.09 1.09c.74 1.037.74 2.44 0 3.476l1.09 1.09a.5.5 0 1 1-.707.708l-1.09-1.09a3.002 3.002 0 0 1-3.476 0l-1.09 1.09a.5.5 0 1 1-.708-.708l1.09-1.09a3.003 3.003 0 0 1 0-3.476l-1.09-1.09a.5.5 0 0 1 0-.708zM6.95 6.586a2 2 0 1 0 2.828 2.828A2 2 0 0 0 6.95 6.586"/>
          </svg> Fund Account</span>
        </div>
      </div>
      <div class="col-xxl-12 col-xl-12 col-lg-6">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Loan Calculator</h4>
          </div>
          <div class="card-body">
            <form
              name="myform"
              class="currency_validate trade-form row g-3"
            >
              <div class="col-12">
                <label class="form-label">Principal</label>
                <div class="input-group">
                  <select class="form-select" name="method">
                    <option value="ZMW">ZMW</option>
                    {{-- <option value="master">Euro</option> --}}
                  </select>
                  <input
                    type="text"
                    name="currency_amount"
                    class="form-control"
                    placeholder="0.00"
                  />
                </div>
              </div>

              <div class="col-12">
                <label class="form-label">Duration</label>
                <div class="input-group">
                  <select class="form-select" name="method">
                    <option value="Months">Months</option>
                    <option value="Years">Years</option>
                  </select>
                  <input
                    type="text"
                    name="currency_amount"
                    class="form-control"
                    placeholder="2"
                  />
                </div>
              </div>

              {{-- <p class="mb-0">
                1 USD ~ 0.000088 BTC
                <a href="#">Expected rate <br />No extra fees</a>
              </p> --}}

              <button
                type="submit"
                name="submit"
                class="btn btn-block"
                style="background: #662d91"
                disabled
              >
              <span>Check Now</span>
              <span class="icon" id="disabledIcon">&#128683;</span>
              </button>
            </form>
          </div>
        </div>
      </div>
      {{-- <div class="col-xxl-12 col-xl-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Position Valuation</h4>
          </div>
          <div class="card-body">
            <ul class="balance-widget position-value">
              <li>
                <h5>Opening Cost</h5>
                <div class="text-end">
                  <h5>K0.0000</h5>
                  <span>Original cost of all open positions.</span>
                </div>
              </li>
              <li>
                <h5>Current Valuation</h5>
                <div class="text-end">
                  <h5>K0.0000</h5>
                  <span>Paper valuation of all open positions.</span>
                </div>
              </li>
              <li>
                <h5>Profit</h5>
                <div class="text-end">
                  <h5>K0.0000 (0,00%)</h5>
                  <span>Paper profit of all open positions..</span>
                </div>
              </li>
              <li>
                <h5>Loss</h5>
                <div class="text-end">
                  <h5>K0.0000 (0,00%)</h5>
                  <span>Paper loss of all open positions.</span>
                </div>
              </li>
              <li>
                <h5>Fees</h5>
                <div class="text-end">
                  <h5>K0.0000</h5>
                  <span>Current Fee</span>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div> --}}

      <div class="col-xxl-12 col-xl-12 col-lg-12">
        <div class="card">
          <div class="card-body">
            <div class="invite-content">
              <h4>Invite a friend and get K30</h4>
              <p>
                You will receive up to K30 when they： (1).Apply for a Loan (2).
                Get approved and (3). Payback <br /><a href="#"
                  >Learn more</a
                >
              </p>

              <div class="copy-link">
                <form action="#">
                  <div class="input-group">
                    <input
                    disabled
                      type="text"
                      class="form-control"
                      value="https://mightyfinance.co.zm/"
                    />
                    <span class="input-group-text copy" style="background: #662d91">Copy</span>
                  </div>
                </form>
              </div>

              <!-- <div class="social-share-link">
                                  <a href="#"><span><i class="icofont-facebook"></i></span></a>
                                  <a href="#"><span><i class="icofont-twitter"></i></span></a>
                                  <a href="#"><span><i class="icofont-whatsapp"></i></span></a>
                                  <a href="#"><span><i class="icofont-telegram"></i></span></a>
                              </div> -->
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="col-xxl-12 col-xl-6 col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="invite-content">
                        <h4>Get free BTC every day</h4>
                        <p>Earn free bitcoins in rewards by completing a learning mission daily or
                            inviting
                            friends to Tende. <a href="#">Learn more</a>

                        </p>

                        <a href="#" class="btn btn-primary">Invite friends to join</a>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
  </div>
      </div>
    </div>
  </div>













