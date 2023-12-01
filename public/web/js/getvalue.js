// const my_form = document.getElementById('form_calculater');
// my_form.addEventListener('submit', calculator);
// const form_btn = document.getElementById('get_summary');
/**/
var summary = document.getElementById('popFundo_asdf');
var summary_details = document.getElementById('asdf');
var customer_type;
var nationality;
var get_duration;
var amount_r;
var get_age;
let fname;
var last_name;
var phone;
var result_amount;
var res_namee;
var loantype;
var agely;
var returns;
var duration_res;
var mobily;
var PackagePersonalRadio;
var PackagePersonal;
var PackageRadio;
var Package;
var isNewCustomer;
var formData;
var customerType;

//


function national() {
    var nationalityRadios = document.querySelectorAll('input[name = "nationality"]');

    for (const rb of nationalityRadios) {
        if (rb.checked) {
            console.log(rb.value)
            nationality = rb.value;
            break;
        }
    }

    var returning = document.querySelectorAll('input[name = "customer_type"]');
    var customer_type;
    for (const rb of returning) {
        if (rb.checked) {
            console.log(rb.value)
            customer_type = rb.value;
            break;
        }
    }
    if (customer_type == "new_c") {
        var c_type = "new_customer";
        isNewCustomer = true
        if (nationality == "zambian") {
            var national = "zambian";


        } else if (nationality == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }


    } else if (customer_type == "old_c") {
        var c_type = "old_customer";
        isNewCustomer = false
        if (nationality == "zambian") {
            var national = "zambian";


        } else if (nationality == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }

    } else {
        console.log('error_customer')
    }
    //nationality

}

function calculator(e) {
    e.preventDefault();

    // var customer_type = document.querySelector('input[name = "customer_type"]:checked');
    //durarion part

    formData = new FormData(my_form);
    console.log(formData)
    customer_type = document.querySelectorAll('input[name = "customer_type"]');
    get_duration = document.getElementById('time_duration');
    amount_r = document.getElementById('update_side').value;
    get_age = document.getElementById('slider_age').value;
    fname = document.getElementById('fname').value;
    last_name = document.getElementById('lname').value;
    phone = document.getElementById('phone').value;
    result_amount = document.getElementById('result_amount');
    res_namee = document.getElementById('res_namee');
    loantype = document.getElementById('loant');
    agely = document.getElementById('agely');
    returns = document.getElementById('returns');
    duration_res = document.getElementById('duration_returns');
    mobily = document.getElementById('mobily');
    customerType = ""
    PackagePersonalRadio = document.querySelectorAll('input[name = "package_personal"]');
    for (const rb of PackagePersonalRadio) {
        if (rb.checked) {
            console.log(rb.value)
            PackagePersonal = rb.value;
            break;
        }
    }


    packageRadio = document.querySelectorAll('input[name = "package"]');
    for (const rb of packageRadio) {
        if (rb.checked) {
            console.log(rb.value)
            Package = rb.value;
            break;
        }
    }



    for (const rb of customer_type) {
        if (rb.checked) {
            console.log(rb.value)

            customerType = rb.value

            break;
        }
    }




    /*var fname = document.getElementById('fname').value;
    var last_name = document.getElementById('lname').value;
    // var email = document.getElementById('emailyy').value;
    var phone = document.getElementById('phone').value;
    var duration = document.getElementById('durationn').value;
    var type = document.getElementById('typel').value;
    var gender = document.getElementById('genderry').value;
    */
    // const returns = "not yet"; //document.getElementById('returns').value;

    summary.style.display = "block";
    summary_details.style.display = "block";
    var checked_persona = document.querySelector('input[name = "package_personal"]:checked');
    const check_package = document.querySelector('input[name = "package"]:checked');

    if (check_package.value == "personal") {
        var package_check = "personal";


        if (checked_persona.value == "salary_advance") {

            var personal_check = ", Salary Advance";
            loantype.innerHTML = "Salary Advance";
            //amount

        } else if (checked_persona.value == "collateral") {
            var personal_check = ", collateral";
            loantype.innerHTML = "Collateral";
        } else {
            console.log('chill');
            var personal_check = "";
            loantype.innerHTML = "error";
            // apply_btn.disabled = true;

        }

    } else if (check_package.value == "sme") {
        //var package_check = "sme";
        // var personal_check = "";
        loantype.innerHTML = "SMEs"
            //amount

    } else if (check_package.value == "sml") {
        //var package_check = "sml";
        // var personal_check = "";
        loantype.innerHTML = "Small business"
            //var dulater = amount_r * get_duration.value
    } else {
        console.log('error! cant get packages');
        var personal_check = "";


    }

    // if (customer_type.value == "new_c") {
    //     var c_type = "new_customer";


    // } else if (customer_type.value == "old_c") {
    //     var c_type = "old_customer";

    // } else {
    //     console.log('error_customer')
    // }

    result_amount.innerHTML = amount_r;
    res_namee.innerHTML = fname + ' ' + last_name;
    agely.innerHTML = document.getElementById('update_age').value;
    duration_res.innerHTML = get_duration.value;
    mobily.innerHTML = phone;
    returns.innerText = customerType == "new_c" ? "No" : customerType == "old_c" ? "Yes" : "error";





}


function close() {
    event.preventDefault();
    summary.style.display = "none";
}

function OldFunctionToSend() {
    event.preventDefault();
    // send details to php script

    var confirm_amount = document.getElementById('result_amount').innerHTML;
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var confirm_age = document.getElementById('agely').innerHTML
    var confirm_returns = document.getElementById('returns').innerHTML
    var confirm_duration = document.getElementById('duration_returns').innerHTML
    var confirm_mobile = document.getElementById('mobily').innerHTML
    var loan_type = document.getElementById('loant').innerHTML
        //  alert(confirm_age+confirm_returns+confirm_amount+confirm_duration+fname+lname)
    var preloader = document.getElementById('loadery');
    var nationalityRadios = document.querySelectorAll('input[name = "nationality"]');

    for (const rb of nationalityRadios) {
        if (rb.checked) {
            console.log(rb.value)
            nationality = rb.value;
            break;
        }
    }

    var returning = document.querySelectorAll('input[name = "customer_type"]');
    var customer_type;
    var c_typ;
    for (const rb of returning) {
        if (rb.checked) {
            console.log(rb.value)
            customer_type = rb.value;
            break;
        }
    }
    if (customer_type == "new_c") {
        var c_type = "new_customer";
        isNewCustomer = true
        if (nationality == "zambian") {
            var national = "zambian";


        } else if (nationality == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }


    } else if (customer_type == "old_c") {
        var c_type = "old_customer";
        isNewCustomer = false
        if (nationality == "zambian") {
            var national = "zambian";


        } else if (nationality == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }

    } else {
        console.log('error_customer')
    }
    //start preloader
    preloader.style.display = "block";
    //concat
    var params = "fname=" + fname + "&lname=" + lname + "&phone=" + parseInt(confirm_mobile) + "&age=" + confirm_age + "&amount=" + confirm_amount + "&duration=" + confirm_duration + "&returns=" + confirm_returns + "&nationality=" + national + "&customer_type=" + customer_type + "&loan_type=" + loan_type + "&values";
    //alert(params)
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/logic/redirect.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log('here');
            preloader.style.display = "none";

            if (this.responseText == 'order_success') {
                //if(customer_type=="new_c"){
                // window.location = './user/register.php';
                // } else {
                //  window.location = './user/login.php';
                // }
                let requestObject = null;
                if (this.response == 'order_success') {
                    // console.warn(this.response);
                    Swal.fire({
                            title: '<strong>Hello ' + fname + '</strong>',
                            icon: 'success',
                            html: '<b>Your Application has been successfully sent!</b> ' +
                                'we will get back to you soon.',
                            showCloseButton: true,
                            showCancelButton: true,
                            focusConfirm: false,
                            confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                            confirmButtonAriaLabel: 'Thumbs up, great!',
                            cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
                            cancelButtonAriaLabel: 'Thumbs down'
                        })
                        // alert("success");
                    my_form.reset();
                } else {

                    alert(this.response);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong!:  Is your internet connectivity still active ? ',
                        footer: '<a href="faq.php">Why do I have this issue?</a>'
                    })
                }
            } else
            if (this.responseText == 'system_error') {
                console.log(this.responseText);

                Swal.fire(
                    'error?',
                    'Please check your Internet or browser!',
                    'error'
                )


            } else {

                Swal.fire(
                    'error?',
                    'Please check your Internet or browser settings!',
                    'error'
                )
            }

        }

    }
    xhr.send(params);

    // console.log(`LoanAmount:${amount_r} LoanType:${Package} Personal Loan:${PackagePersonal} Duration: ${get_duration.value} isNewCustomer: ${isNewCustomer} Age: ${get_age} First Name:${fname} Last Name:${last_name} Mobile Number:${phone} Nationality:${nationality}`)
    //const searchParams = new URLSearchParams({"LoanAmount":amount_r,"LoanType":Package,"Personal Loan":PackagePersonal,"Duration":customerType == "personal"?`${get_duration.value} days`:customerType == "sml"?`${get_duration.value} weeks`:customerType == "sme"?`${get_duration.value} months`:"","isNewCustomer":isNewCustomer,"Age":get_age,"First Name":fname,"Last Name":last_name,"Mobile Number":phone,"Nationality":nationality})
    /*fetch("./user/oncludes/logic/redirect.php",{method:"POST",body:searchParams}).then(res => res.json()).then(res=>{
           console.log(res)
           //redirect to another page
           if(isNewCustomer){
            window.location = './user/register.php';
           }else{
            window.location = './user/login.php';
           }
    }).catch(err=>console.log(err))*/

}





function send() {
    var confirm_amount = document.getElementById('result_amount').innerHTML;
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var confirm_age = document.getElementById('agely').innerHTML
    var confirm_returns = document.getElementById('returns').innerHTML
    var confirm_duration = document.getElementById('duration_returns').innerHTML
    var confirm_mobile = document.getElementById('mobily').innerHTML
    var loan_type = document.getElementById('loant').innerHTML
        //  alert(confirm_age+confirm_returns+confirm_amount+confirm_duration+fname+lname)
    var preloader = document.getElementById('loadery');
    var nationalityRadios = document.querySelectorAll('input[name = "nationality"]');

    for (const rb of nationalityRadios) {
        if (rb.checked) {
            console.log(rb.value)
            nationality = rb.value;
            break;
        }
    }

    var returning = document.querySelectorAll('input[name = "customer_type"]');
    var customer_type;
    var c_typ;
    for (const rb of returning) {
        if (rb.checked) {
            console.log(rb.value)
            customer_type = rb.value;
            break;
        }
    }
    if (customer_type == "new_c") {
        var c_type = "new_customer";
        isNewCustomer = true
        if (nationality == "zambian") {
            var national = "zambian";


        } else if (nationality == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }


    } else if (customer_type == "old_c") {
        var c_type = "old_customer";
        isNewCustomer = false
        if (nationality == "zambian") {
            var national = "zambian";


        } else if (nationality == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }

    } else {
        console.log('error_customer')
    }
    //start preloader
    preloader.style.display = "block";

    // Submit Form Data
    var form = document.getElementById('form_calculater');
    var formData = new FormData(form);
    console.log(formData);
    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json()).then(data => {
        preloader.style.display = "none";

        // Parse the 'data' JSON string
        const parsedData = JSON.parse(data);

        if (parsedData.hasOwnProperty('loan_id')) {
            // 'loan_id' exists in the parsed data
            const amount = parsedData.amount;

            console.log('Here: ' + amount);

            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'You already have a loan of K' + amount,
                footer: '<a href="faq.php">Why do I have this issue?</a>'
            });
        }else{
            Swal.fire({
                title: '<strong>Hello ' + fname + '</strong>',
                icon: 'success',
                html: '<b>Your Application has been successfully sent!</b> ' + 'we will get back to you soon.',
                showCloseButton: true,
                showCancelButton: true,
                focusConfirm: false,
                confirmButtonText: '<i class="fa fa-thumbs-up"></i> Great!',
                confirmButtonAriaLabel: 'Thumbs up, great!',
                cancelButtonText: '<i class="fa fa-thumbs-down"></i>',
                cancelButtonAriaLabel: 'Thumbs down'
            })
        }
    })
    .catch(error => {
        
        console.log('Here: '+data);
        preloader.style.display = "none";
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Something went wrong! Login to your account and check your current loan request or check your internet connectivity.',
            footer: '<a href="faq.php">Why do I have this issue?</a>'
        })
    });

}