function get_valuess() {
    alert("amount:")
}


const my_form = document.getElementById('form_calculater');
my_form.addEventListener('submit', calculator);
const form_btn = document.getElementById('get_summary');
/**/

//


function national() {
    var nationality = document.querySelector('input[name = "nationality"]:checked');
    var customer_type = document.querySelector('input[name = "customer_type"]:checked');


    if (customer_type.value == "new_c") {
        var c_type = "new_customer";
        if (nationality.value == "zambian") {
            var national = "zambian";


        } else if (nationality.value == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }


    } else if (customer_type.value == "old_c") {
        var c_type = "old_customer";
        if (nationality.value == "zambian") {
            var national = "zambian";


        } else if (nationality.value == "not_zambian") {
            var national = "not_zambia";

        } else {
            console.log('error_nationality')
        }

    } else {
        console.log('error_customer')
    }
    //nationality

}

function calculator() {
    event.preventDefault();

    var customer_type = document.querySelector('input[name = "customer_type"]:checked');
    //durarion part
    var get_duration = document.getElementById('time_duration');
    var amount_r = document.getElementById('update_side').value;
    var get_age = document.getElementById('slider_age').value;
    let fname = document.getElementById('fname').value;
    var last_name = document.getElementById('lname').value;
    var phone = document.getElementById('phone').value;
    const result_amount = document.getElementById('result_amount');
    const res_namee = document.getElementById('res_namee');
    const loantype = document.getElementById('loant');
    const agely = document.getElementById('agely');
    const returns = document.getElementById('returns');
    const duration_res = document.getElementById('duration_returns');
    const mobily = document.getElementById('mobily');



    /*var fname = document.getElementById('fname').value;
    var last_name = document.getElementById('lname').value;
    // var email = document.getElementById('emailyy').value;
    var phone = document.getElementById('phone').value;
    var duration = document.getElementById('durationn').value;
    var type = document.getElementById('typel').value;
    var gender = document.getElementById('genderry').value;
    */
    // const returns = "not yet"; //document.getElementById('returns').value;

    $('#calc').modal('show');
    var checked_persona = document.querySelector('input[name = "package_personal"]:checked');
    const check_package = document.querySelector('input[name = "package"]:checked');

    if (check_package.value == "personal") {
        var package_check = "Personal";


        if (checked_persona.value == "salary_advance") {

            var personal_check = ", Salary Advance";
            var loantypey = "Salary Advance";
            //amount

        } else if (checked_persona.value == "collateral") {
            var personal_check = ", collateral";
            var loantypey = "Collateral Loan";
        } else {
            console.log('chill');
            var personal_check = "";
            var loantypey = "error";
            // apply_btn.disabled = true;

        }

    } else if (check_package.value == "sme") {
        //var package_check = "sme";
        // var personal_check = "";
        var loantypey = "Small Medium Enterprise Loan"
            //amount

    } else if (check_package.value == "sml") {
        //var package_check = "sml";
        // var personal_check = "";
        var loantypey = "Small Business Loan"
            //var dulater = amount_r * get_duration.value
    } else {
        console.log('error! cant get packages');
        var personal_check = "";


    }

    if (customer_type.value == "new_c") {
        var c_type = "new_customer";


    } else if (customer_type.value == "old_c") {
        var c_type = "old_customer";

    } else {
        console.log('error_customer')
    }

    result_amount.innerHTML = amount_r;

    document.getElementById('agely').innerHTML = document.getElementById('update_age').value;
    document.getElementById('duration_returns').innerHTML = document.getElementById('time_duration').value; + ' (Months)'
    document.getElementById('mobily').innerHTML = document.getElementById('phone').value;
    document.getElementById('result_amount').innerHTML = number_format(slider_amount.value);
    document.getElementById('res_namee').innerHTML = fname + ' ' + last_name;
    document.getElementById('returns').innerHTML = result_payment.innerHTML
    document.getElementById('loant').innerHTML = loantypey;
    // duration_res.innerHTML = dulater + ;


}


/* 
function send() {
    event.preventDefault();
    alert('rates not fed yet');
    //alert(gender + type + purpose + phone + emaily + last_name + fname + amount);
    var params = "fname=" + fname + "&last_name=" + last_name + "&emaily=" + emaily + "&phone=" + phone + "&purpose=" + purpose + "&message=" + message + "&submit";

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'includes/logic/contact.php', true);
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    xhr.onload = function() {
        console.log(this.response);

    }

    xhr.send(params)
        //my_form.reset();

    if (this.readyState == 4 && this.status == 200) {
        let requestObject = null;


        try {
            requestObject = JSON.parse(xhr.responseText)
                //loadingText.style.display = "none"


            console.log(requestObject)
            console.log(requestObject['name'])


        } catch (e) {
            console.error("could not parse JSON")
            console.warn(this.response)
            form.formContainer.style.overflow = "block"

            console.log("Internal server error Please try again or check your connection");

        }

        if (requestObject == null || requestObject['ok'] == false) {
            console.log("Internal server error Please try again or check your connection");
            loader.style.display = "none"
        } else {
            handleResponse(requestObject)
        }

    }
}
} 

}*/