<div class="content-body">
    <div class="container-fluid">
        <div class="row">
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
            <div class="col-xl-3">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-6">
                        <div class="card welcome-profile">
                            <div class="card-body">
                            <img src="https://www.seekpng.com/png/detail/72-729756_how-to-add-a-new-user-to-your.png" alt="" />
                  <h4>Hi, {{ auth()->user()->fname.' '.auth()->user()->lname }}!</h4>
                  <p>
                    Looks like you are not verified yet. Verify yourself to use
                      the full potential of Tende.
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
                        <a href="{{ route('profile.show') }}">
                          <span class="not-verified"
                            ><i class="icofont-close-line"></i
                          ></span>
                          Update Profile (KYC)
                        </a>
                      </li> 
                    {{-- <li>
                      <a href="#">
                        <span class="not-verified"
                          ><i class="icofont-close-line"></i
                        ></span>
                        Two-factor authentication (2FA)
                      </a>
                    </li> --}}
                    {{-- <li>
                      <a href="#">
                        <span class="not-verified"
                          ><i class="icofont-close-line"></i
                        ></span>
                        Deposit money
                      </a>
                    </li> --}}
                  </ul>
                </div>
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
                      class="btn btn-primary btn-block"
                    >
                      Check Now
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
                          <span class="input-group-text copy">Copy</span>
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

        <div class="col-xl-9">
          <div class="row">
            <div class="col-xxl-12 col-xl-12">
              <div class="card home-chart">
                <div class="card-header">
                  <h4 class="card-title home-chart">Overview</h4>
                  {{-- <select
                    class="form-select"
                    name="report-type"
                    id="report-select"
                  >
                    <option value="1">Bitcoin</option>
                    <option value="2">Litecoin</option>
                  </select> --}}
                </div>
                <div class="card-body">
                  <div class="home-chart-height">
                    <div class="row">
                      <div
                        class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6"
                      >
                        <div class="chart-price-value">
                          <span>Total Borrowed</span>
                          <h5>K0.00</h5>
                        </div>
                      </div>
                      <div
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
                      </div>
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

            <div class="col-xxl-4 col-xl-12">
              <div class="row">
                <div class="col-xxl-12 col-xl-4 col-lg-6">
                  <div class="price-widget">
                    <a href="price-details.html">
                      <div class="price-content">
                        <div class="icon-title">
                          <i class="cc BTC"></i>
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
                          <i class="cc ETH"></i>
                          <span>Withdrawals</span>
                        </div>
                        <h5>K 0.0</h5>
                      </div>
                      <div id="chart2"></div>
                    </a>
                  </div>
                </div>
                <div class="col-xxl-12 col-xl-4 col-lg-6">
                  <div class="price-widget">
                    <a href="price-details.html">
                      <div class="price-content">
                        <div class="icon-title">
                          <i class="cc USDT"></i>
                          <span>Deposits</span>
                        </div>
                        <h5>K 0.00</h5>
                      </div>
                      <div id="chart3"></div>
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
                <div class="card-body">
                  <div class="table-responsive transaction-table">
                    <table class="table table-striped responsive-table">
                      <thead>
                        <tr>
                          <th>Ledger ID</th>
                          <th>Date</th>
                          <th>Type</th>
                          <th>Currency</th>
                          <th>Amount</th>
                          <th>Fee</th>
                          <th>Balance</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>523640</td>
                          <td>January 15</td>
                          <td>
                            <span class="danger-arrow"
                              ><i class="icofont-arrow-down"></i> Sell</span
                            >
                          </td>
                          <td class="coin-name">
                            <i class="cc BTC"></i> Bitcoin
                          </td>
                          <td class="text-danger">-0.000242 BTC</td>
                          <td>0.02%</td>
                          <td><strong>0.25484 BTC</strong></td>
                        </tr>
                        <tr>
                          <td>523640</td>
                          <td>January 15</td>
                          <td>
                            <span class="success-arrow"
                              ><i class="icofont-arrow-up"></i>Buy</span
                            >
                          </td>
                          <td class="coin-name">
                            <i class="cc LTC"></i> Litecoin
                          </td>
                          <td class="text-success">-0.000242 BTC</td>
                          <td>0.02%</td>
                          <td><strong> 0.25484 LTC</strong></td>
                        </tr>
                        <tr>
                          <td>523640</td>
                          <td>January 15</td>
                          <td>
                            <span class="success-arrow"
                              ><i class="icofont-arrow-up"></i>Buy</span
                            >
                          </td>
                          <td class="coin-name">
                            <i class="cc XRP"></i> Ripple
                          </td>
                          <td class="text-success">-0.000242 BTC</td>
                          <td>0.02%</td>
                          <td><strong> 0.25484 LTC</strong></td>
                        </tr>
                        <tr>
                          <td>523640</td>
                          <td>January 15</td>
                          <td>
                            <span class="success-arrow"
                              ><i class="icofont-arrow-up"></i>Buy</span
                            >
                          </td>
                          <td class="coin-name">
                            <i class="cc DASH"></i> Dash
                          </td>
                          <td class="text-success">-0.000242 BTC</td>
                          <td>0.02%</td>
                          <td><strong> 0.25484 LTC</strong></td>
                        </tr>
                        <tr>
                          <td>523640</td>
                          <td>January 15</td>
                          <td>
                            <span class="success-arrow"
                              ><i class="icofont-arrow-up"></i>Buy</span
                            >
                          </td>
                          <td class="coin-name">
                            <i class="cc DASH"></i> Dash
                          </td>
                          <td class="text-success">-0.000242 BTC</td>
                          <td>0.02%</td>
                          <td><strong> 0.25484 LTC</strong></td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>













