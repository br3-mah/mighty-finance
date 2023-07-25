<style>
body {
    color: #000;
    overflow-x: hidden;
    height: 100%;
    background-repeat: no-repeat
}
.card0 {
    background-color: #F5F5F5;
    border-radius: 8px;
    z-index: 0
}

.card00 {
    z-index: 0
}

.card1 {
    margin-left: 140px;
    z-index: 0;
    border-right: 1px solid #F5F5F5
}

.card2 {
    display: none
}

.card2.show {
    display: block
}

.social {
    border-radius: 50%;
    background-color: #ffd900;
    color: #52138d;
    height: 47px;
    width: 47px;
    padding-top: 16px;
    cursor: pointer
}

input,
select {
    padding: 2px;
    border-radius: 0px;
    box-sizing: border-box;
    color: #9E9E9E;
    border: 1px solid #BDBDBD;
    font-size: 16px;
    letter-spacing: 1px;
    height: 50px !important
}

select {
    width: 100%;
    margin-bottom: 85px
}

input:focus,
select:focus {
    -moz-box-shadow: none !important;
    -webkit-box-shadow: none !important;
    box-shadow: none !important;
    border: 1px solid #52138d !important;
    outline-width: 0 !important
}

.custom-checkbox .custom-control-input:checked~.custom-control-label::before {
    background-color: #52138d
}

.form-group {
    position: relative;
    margin-bottom: 1.5rem;
    width: 77%
}

.form-control-placeholder {
    position: absolute;
    top: 0px;
    padding: 12px 2px 0 2px;
    transition: all 300ms;
    opacity: 0.5
}

.form-control:focus+.form-control-placeholder,
.form-control:valid+.form-control-placeholder {
    font-size: 95%;
    top: 10px;
    transform: translate3d(0, -100%, 0);
    opacity: 1;
    background-color: #fff
}

.next-button {
    width: 18%;
    height: 50px;
    background-color: #BDBDBD;
    color: #fff;
    border-radius: 6px;
    padding: 10px;
    cursor: pointer
}

.next-button:hover {
    background-color: #52138d;
    color: #fff
}

.get-bonus {
    margin-left: 154px
}

.pic {
    width: 230px;
    height: 110px
}

#progressbar {
    position: absolute;
    left: 35px;
    overflow: hidden;
    color: #52138d
}

#progressbar li {
    list-style-type: none;
    font-size: 8px;
    font-weight: 400;
    margin-bottom: 36px
}

#progressbar li:nth-child(3) {
    margin-bottom: 88px
}

#progressbar .step0:before {
    content: "";
    color: #fff
}

#progressbar li:before {
    width: 30px;
    height: 30px;
    line-height: 30px;
    display: block;
    font-size: 20px;
    background: #fff;
    border: 2px solid #52138d;
    border-radius: 50%;
    margin: auto
}

#progressbar li:last-child:before {
    width: 40px;
    height: 40px
}

#progressbar li:after {
    content: '';
    width: 3px;
    height: 66px;
    background: #BDBDBD;
    position: absolute;
    left: 58px;
    top: 15px;
    z-index: -1
}

#progressbar li:last-child:after {
    top: 147px;
    height: 132px
}

#progressbar li:nth-child(3):after {
    top: 81px
}

#progressbar li:nth-child(2):after {
    top: 0px
}

#progressbar li:first-child:after {
    position: absolute;
    top: -81px
}

#progressbar li.active:after {
    background: #52138d
}

#progressbar li.active:before {
    background: #52138d;
    font-family: FontAwesome;
    content: "\f00c"
}

.tick {
    width: 100px;
    height: 100px
}

.prev {
    display: block;
    position: absolute;
    left: 40px;
    top: 20px;
    cursor: pointer
}

.prev:hover {
    color: #D50000 !important
}

@media screen and (max-width: 912px) {
    .card00 {
        padding-top: 30px
    }

    .card1 {
        border: none;
        margin-left: 50px
    }

    .card2 {
        border-bottom: 1px solid #F5F5F5;
        margin-bottom: 25px
    }

    .social {
        height: 30px;
        width: 30px;
        font-size: 15px;
        padding-top: 8px;
        margin-top: 7px
    }

    .get-bonus {
        margin-top: 40px !important;
        margin-left: 75px
    }

    #progressbar {
        left: -25px
    }
}

/* div {
  position: absolute;
} */
#rangeValue {
  position: relative;
  display: block;
  font-size: 6em;
  color: #67188b;
  font-weight: 400;
}
.range {
  width: 400px;
  -webkit-appearance: none;
  background: #ffffff;
  outline: none;
  /* border-radius: 15px; */
  overflow: hidden;
  /* box-shadow: inset 0 0 5px rgba(0, 0, 0, 1); */
}
.range::-webkit-slider-thumb {
  -webkit-appearance: none;
  width: 15px;
  height: 15px;
  border-radius: 50%;
  background: #ffe600;
  cursor: pointer;
  border: 4px solid #333;
  box-shadow: -407px 0 0 400px #fdcf00;
}

</style>
<div class="content-body">
        <div class="container-fluid px-1 py-5 ">
            <h2 class="mx-4">Get a Loan</h2>
            <form action="{{ route("apply-loan") }}" method="POST" enctype="multipart/form-data" class="container">
                @csrf
                <input type="hidden" name="user_id" value="{{auth()->user()->id}}" />
                <div id="mystep1" class="">
                    <div class="mt-2 block">
                        <div class="w-full card p-4">
                            <h4>Loan Amount</h4>
                            <span id="rangeValue">K10000</span>
                            <input id="biz_name" class="range" type="range" step="1000" name="amount" value="10000" min="10000" max="200000" onChange="rangeSlide(this.value)" onmousemove="rangeSlide(this.value)"/>
                        </div>
                        <button type="button" class="goto2 btn btn-primary">
                            Continue
                        </button>
                    </div>
                </div>
                <div id="mystep2" class="">
                    <div style="cursor:pointer" class="goto1 flex space-x-2 items-center content-center hover:bg-gradient-to-bl focus:ring-4">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </span>
                        <span>Back to Step 1</span>
                    </div>
                    
                    <div class="mt-2">
                        <div class="w-full card p-4">
                            <h4>Duration</h4>
                            <div class="input-group">
                                <select name="duration" id="biz_email" class="">
                                    <option selected>Choose...</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
                                <div class="input-group-append">
                                    <span class="input-group-text"></span>
                                    <span class="input-group-text">Months</span>
                                </div>
                            </div>                        
                        </div>
                        <button type="button" class="goto3 btn btn-primary">
                            Continue
                        </button>
                    </div>
                </div>
                <div id="mystep3" class="box-border order-first w-full text-black border-solid md:w-3/4 md:pl-10 md:order-none">
                    <div style="cursor:pointer" class="goto2 flex space-x-2 items-center content-center hover:bg-gradient-to-bl focus:ring-4">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </span>
                        <span>Back to Step 2</span>
                    </div>
                    {{-- <h2 class="m-0 text-xl font-extrabold leading-tight border-0 border-gray-300 lg:text-3xl md:text-2xl">
                        Give customers a phone number so they can call your business
                    </h2>
                    <p class="pt-4 pb-8 m-0 leading-7 text-gray-700 border-0 border-gray-300 sm:pr-12 xl:pr-32 lg:text-sm">
                        Add the phone number of <span class='bname'></span> to help customers connect with you.                    
                    </p> --}}
                    <div class="mt-2">
                        
                        <div class="w-full d-flex flex justify-content-between card p-4">
                            <div class="w-1/2">
                                <h4>Loan Type</h4>
                                <select onchange="getLoanPicked()" id="selectedLoan" type="text" name="loan_type" minlength="6" class="w-full" >
                                    <option value="">--Choose--</option>        
                                    <option value="Personal">Personal Loan</option>        
                                    <option value="Small Business Loan">Small Business Loan</option>        
                                    <option value="Small-Medium Enterprise Business Loan">Small-Medium Enterprise Business Loan</option>        
                                </select>
                            </div>
                            <div id="more_loans">
                                <br>
                                <hr>
                                <div class="w-1/2">
                                    <h4>Personal Loan Type</h4>
                                    <select type="text" name="personal_loan_type" minlength="6" class="w-full" >
                                        <option value="Salary Advance">Salary Advance</option>        
                                        <option value="Collateral Loan">Collateral Loan</option>        
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="goto4 btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
                {{-- <div id="mystep4" class="box-border order-first w-full text-black border-solid md:w-3/4 md:pl-10 md:order-none">
                    <div style="cursor:pointer" class="goto3 flex space-x-2 items-center content-center hover:bg-gradient-to-bl focus:ring-4">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </span>
                        <span>Back to Step 3</span>
                    </div>
                    <h2 class="m-0 text-xl font-extrabold leading-tight border-0 border-gray-300 lg:text-3xl md:text-2xl">
                        Let the Customers search & find your business in specific Categories
                    </h2>
                    <p class="pt-4 pb-8 m-0 leading-7 text-gray-700 border-0 border-gray-300 sm:pr-12 xl:pr-32 lg:text-sm">
                        We’ll use this information to help you claim your Yelp page. Your business will come up automatically if it is already listed.
                    </p>
                    <div class="mt-2">
                        <label class="block text-gray-700">Business Categories</label>
                        <input type="hidden" name="category_ids" id="category_ids" placeholder="Choose" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none">
                        <div id="selectedCats" class="py-4">

                        </div>
                        <div class="border-t border-gray-200 rounded p-8">
                            <p class="py-4 text-xs">Select categories matching your business/company:</p>
                            
                        </div>
                        <button type="button" class="goto5 text-white mt-2 bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Continue
                        </button>
                    </div>
                </div>
                <div id="mystep5" class="box-border order-first w-full text-black border-solid md:w-3/4 md:pl-10 md:order-none">
                    <div style="cursor:pointer" class="goto4 flex space-x-2 items-center content-center hover:bg-gradient-to-bl focus:ring-4">
                        <span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                            </svg>
                        </span>
                        <span>Back to Step 4</span>
                    </div>
                    <h2 class="m-0 text-xl font-extrabold leading-tight border-0 border-gray-300 lg:text-3xl md:text-2xl">
                        How you are going to be login into Vokamba
                    </h2>
                    <p class="pt-4 pb-8 m-0 leading-7 text-gray-700 border-0 border-gray-300 sm:pr-12 xl:pr-32 lg:text-sm">
                        You will be using this information to help you login to your Vokamba business dashboard.
                    </p>
                    <div class="mt-2">
                        <div class="flex">
                            <div class="w-1/2">
                                <label class="block text-gray-700">First Name</label>
                                <input type="text" name="fname" id="" placeholder="Use your email" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" >
                            </div>
                            <div class="w-1/2">
                                <label class="block text-gray-700">Last Name</label>
                                <input type="text" name="lname" id="" placeholder="Use your email" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" >
                            </div>
                        </div>
                        <label class="block text-gray-700">New Username</label>
                        <input type="text" name="username" id="" placeholder="Use your email" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" >
                        
                        <label class="block text-gray-700">New Password</label>
                        <input type="text" name="password" id="" placeholder="New Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" >
                        
                        <label class="block text-gray-700">Confirm Password</label>
                        <input type="text" name="confirmed_password" id="" placeholder="Re-type Password" minlength="6" class="w-full px-4 py-3 rounded-lg bg-gray-200 mt-2 border focus:border-blue-500 focus:bg-white focus:outline-none" >
                        <button type="submit" class="text-white mt-2 bg-gradient-to-br from-purple-600 to-blue-500 hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                            Continue
                        </button>
                    </div>
                </div> --}}
            </form>
        </div>
    </div>
    <!-- pickdate -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script type="text/javascript">

            $("#mystep2").hide();
            $("#mystep3").hide();
            $("#mystep4").hide();
            $("#mystep5").hide();
            $("#more_loans").hide();
            
            $(".goto1").click(() => {
                $("#mystep1").show();
                $("#mystep2").hide();
                $("#mystep3").hide();
                $("#mystep4").hide();
                $("#mystep5").hide();
            });

            $(".goto2").click(() => {
                var inputField = document.getElementById("biz_name");
                $('.bname').html("<strong>"+inputField.value+"</strong>")
                if (inputField.value === '') {
                        inputField.style.borderColor = "red";
                        inputField.classList.add("shake");
                    setTimeout(function() {
                        inputField.classList.remove("shake");
                    }, 500);
                } else {
                    $("#mystep2").show();
                    $("#mystep1").hide();
                    $("#mystep3").hide();
                    $("#mystep4").hide();
                    $("#mystep5").hide();
                }
            });

            $(".goto3").click(() => {
                var inputField = document.getElementById("biz_email");
                if (inputField.value === '') {
                    inputField.style.borderColor = "red";
                    inputField.classList.add("shake");
                    setTimeout(function() {
                        inputField.classList.remove("shake");
                    }, 500);
                } else {
                    $("#mystep1").hide();
                    $("#mystep2").hide();
                    $("#mystep3").show();
                    $("#mystep4").hide();
                    $("#mystep5").hide();
                }
            });

            $(".goto4").click(() => {
                var inputField = document.getElementById("selectedLoan");
                if (inputField.value === '') {
                    inputField.style.borderColor = "red";
                    inputField.classList.add("shake");
                    setTimeout(function() {
                        inputField.classList.remove("shake");
                    }, 500);
                } else {
                    $("#mystep1").hide();
                    $("#mystep2").hide();
                    $("#mystep3").hide();
                    $("#mystep4").show();
                    $("#mystep5").hide(); 
                }
            });

            $(".goto5").click(() => {
                $("#mystep1").hide();
                $("#mystep2").hide();
                $("#mystep3").hide();
                $("#mystep4").hide();
                $("#mystep5").show();
            });
            
            function rangeSlide(value) {
                document.getElementById('rangeValue').innerHTML = 'K'+value;
            }
            function getLoanPicked() {
                // Get the select element
                var selectElement = document.getElementById("selectedLoan");
                
                // Get the selected option value
                var selectedValue = selectElement.value;
                
                if(selectedValue === 'Personal'){
                    $("#more_loans").show();
                }else{
                    $("#more_loans").hide();
                }
            }
        </script>
</div>
