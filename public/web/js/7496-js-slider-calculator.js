var apply_btn = document.querySelector('.apply');
var duration = document.getElementById('duration');
var time_frame = document.getElementById('time_frame');
duration.style.display = "block";
apply_btn.disabled = true;
apply_btn.innerHTML = "INPUT DETAILS ABOVE";
//amount part
var slider_amount = document.getElementById('slidatious');
var update_side_amount = document.getElementById('update_side');
//durarion part
var slider_duration = document.getElementById('slidate');
var time_duration = document.getElementById('time_duration');
//results part
var result_amount = document.getElementById('amountatious');
var result_payment = document.getElementById('result_payment');
var result_duration = document.getElementById('result_duration');
//var resul_duration = document.getElementById('rl_duration');
//input parts
//about customer
var _new_person = document.getElementById('new_customer');
var _old_person = document.getElementById('returning_customer');
//var amount = document.getElementById('amount');

//initial directives
slider_amount.value = "0"
apply_btn.disabled = true;
slider_amount.step = 10000;

duration.style.display = "block";
//next page
//slider
var slider_age = document.getElementById('slider_age');
//get values

function number_format(number, decimals, dec_point, thousands_sep) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}

function checker() {
    var resul_duration = document.getElementById('rl_duration');
    var resul_kwacha = document.getElementById('rl_zmw');
    var resul_kwachaa = document.getElementById('rl_zmww');

    var checked_person = document.querySelector('input[name = "package_personal"]:checked');
    var check_package = document.querySelector('input[name = "package"]:checked');
    slider_amount.step = 10000;

    console.log(check_package.value);
    if (check_package.value == "personal") {
        apply_btn.disabled = true;
        dvPassport.style.display = "block";
        duration.style.display = "block";
        time_frame.innerHTML = "Duration in months";
        //duration
        time_duration.value = slider_duration.value;

        //amount
        /*slider_amount.max = "2000000";
        update_side_amount.max = "2000000";
        slider_amount.min = "2000000";
        update_side_amount.min = "0000";
        update_side_amount.value = slider_amount.value;
*/
        console.log(checked_person.value);
        if (checked_person.value == "salary_advance") {
            var my_returns = (slider_amount.value * 0.21) * parseInt(time_duration.value) + parseInt(slider_amount.value);
            // var my_returns = (slider_amount.value * 0.07) * parseInt((time_duration.value)) + parseInt((slider_amount.value));
            result_payment.innerHTML = number_format(my_returns);


            time_frame.innerHTML = "Duration in months";
            //duration
            time_duration.max = "24"
            slider_duration.max = "24";
            time_duration.value = slider_duration.value;
            //amount
            // slider_amount.max = "2000000";
            //update_side_amount.max = "2000000";
            update_side_amount.value = slider_amount.value;
            if (slider_amount.value >= 10000) {
                if (time_duration.value > 0) {
                    apply_btn.disabled = false;
                    //apply_btn.style.backgroundColor = "#cda349"
                    apply_btn.innerHTML = "APPLY NOW";
                } else {
                    apply_btn.disabled = true;
                    apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
                }
            } else {
                apply_btn.disabled = true;
                //
                apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
            }
        } else if (checked_person.value == "collateral") {
            if (slider_amount.value >= 10000) {
                if (time_duration.value > 0) {
                    apply_btn.disabled = false;
                    //apply_btn.style.backgroundColor = "#cda349"
                    apply_btn.innerHTML = "APPLY NOW";
                } else {
                    apply_btn.disabled = true;
                    apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
                }
            } else {
                apply_btn.disabled = true;
                //
                apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
            }
            time_frame.innerHTML = "Duration in months";
            //duration
            time_duration.max = "24"
            slider_duration.max = "24";
            time_duration.value = slider_duration.value;
            resul_duration.innerHTML = "months"
            var my_returns = slider_amount.value * 0.020 * parseInt((time_duration.value)) + parseInt((slider_amount.value));
            result_payment.innerHTML = number_format(my_returns);



            //amount
            //slider_amount.max = "2000000";
            //update_side_amount.max = "2000000";
            //update_side_amount.value = slider_amount.value;


        } else {
            console.log('error');
            //slider_amount.max = "200000000";
            //update_side_amount.max = "200000000";
            result_amount.innerHTML = "slide to pick amount"
            result_payment.innerHTML = "pick amount"
            time_duration.value = slider_duration.value;
            update_side_amount.value = slider_amount.value;
            apply_btn.disabled = true;
            apply_btn.innerHTML = "FINISH ENTERING DETAILS!";


        }


    } else if (check_package.value == "sme") {
        dvPassport.style.display = "none";

        time_frame.innerHTML = "Duration in months";
        resul_duration.innerHTML = "months"

        //duration
        time_duration.max = "12"
        slider_duration.max = "12";
        time_duration.value = slider_duration.value;

        //amount
        slider_amount.max = "200000000";
        update_side_amount.max = "200000000";
        update_side_amount.value = slider_amount.value;

        if (slider_amount.value >= 10000) {
            if (time_duration.value > 0) {
                apply_btn.disabled = false;
                apply_btn.innerHTML = "APPLY NOW";
            } else {
                apply_btn.disabled = true;
                apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
            }
        } else {
            apply_btn.disabled = true;
            //
            apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
        }
        var my_returns = (slider_amount.value * 0.07) * parseInt((time_duration.value)) + parseInt((slider_amount.value));
        result_payment.innerHTML = number_format(my_returns);
    } else if (check_package.value == "sml") {
        if (slider_amount.value >= 10000) {
            if (time_duration.value > 0) {
                apply_btn.disabled = false;
                apply_btn.innerHTML = "APPLY NOW";
            } else {
                apply_btn.disabled = true;
                apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
            }
        } else {
            apply_btn.disabled = true;
            //
            apply_btn.innerHTML = "FINISH UP YOUR OPTIONS";
        }
        dvPassport.style.display = "none";
        time_frame.innerHTML = "Duration in months";
        resul_duration.innerHTML = "months"
            //duration
        time_duration.max = "4"
        slider_duration.max = "4";
        time_duration.value = slider_duration.value;

        //amount
        slider_amount.max = "2000000";
        update_side_amount.max = "2000000";
        update_side_amount.value = slider_amount.value;

        duration.style.display = "block";
        if (slider_duration.value == 1) {
            var my_returns = slider_amount.value * 0.07 + parseInt((slider_amount.value));
            console.log(my_returns)
            result_payment.innerHTML = number_format(my_returns);

        } else if (slider_duration.value == 2) {
            var my_returns = slider_amount.value * 0.07 + parseInt((slider_amount.value));
            console.log(my_returns);
            result_payment.innerHTML = number_format(my_returns);

        } else if (slider_duration.value == 3) {
            var my_returns = slider_amount.value * 0.07 + parseInt((slider_amount.value));
            console.log(my_returns)
            result_payment.innerHTML = number_format(my_returns);

        } else if (slider_duration.value == 4) {
            var my_returns = (slider_amount.value * 0.07) + parseInt((slider_amount.value));
            console.log('4month')
            result_payment.innerHTML = number_format(my_returns);


        } else {
            console.log('no_month')
        }

    } else {
        console.log('error!');
        dvPassport.style.display = "none";
        apply_btn.disabled = true;
        apply_btn.innerHTML = "FINISH ENTERING DETAILS!";

    }
    //console.log(slider_amount);


    //value updates
    time_duration.value = slider_duration.value;
    time_duration.value = slider_duration.value;
    //show results
    result_amount.innerHTML = update_side_amount.value;
    result_amount.innerHTML = number_format(slider_amount.value);
    result_duration.innerHTML = time_duration.value;


}