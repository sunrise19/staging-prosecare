$(document).ready(function() {

    const URL = window.location.href

    if (URL.indexOf('/VerifyAccount') > -1) {
        if (EMAIL == '' || !VALIDATE_EMAIL(EMAIL)) {
            Swal.fire({
                title: "Oops!",
                html: "Verification process not initiated.",
                type: "error",
                confirmButtonText: "Back To Login",
            }).then(function(t) {
                window.location.href = './Login'
            })
        } else {
            $('.email_output').html('Provide the verification code sent to <b>' + EMAIL + '</b>')
        }
    }

    $('.parent-outline').focus(function() {
        $(this).parent().addClass('active')
    }).blur(function() {
        $(this).parent().removeClass('active')
    })

})

function VALIDATE_EMAIL(email) {
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    var result = true
    if (!re.test(email)) {
        result = false
    }
    return result;
}

function VALIDATE_PASSWORD(password) {
    var re = /^(?=.*[0-9])(?=.*[!@#$%&?*^()<>:;~` "])[a-zA-Z0-9!@#$%&?*^()<>:;~` "]{8,16}$/;
    var result = true
    if (!re.test(password)) {
        result = false
    }
    return result;
}

function error(message, element) {
    if (element != '') {
        element.addClass('error')
        setTimeout(() => {
            element.removeClass('error')
        }, 3000);
    }
    $('#dynamic').html('')
    Swal.fire({
        title: "Oops!",
        html: message,
        type: "error",
    })
}

function success(title, message) {
    $('#dynamic').html('.swal2-confirm {display: none!important}')
    Swal.fire({
        title: title,
        html: message,
        type: "success",
    })
}

$('.pricing_card').click(function() {
    var price = $(this).attr('data-price')
    if (price != undefined) {
        flutterwave(price)
    }
})

function flutterwave(price) {
    $('.close_payment').show()
    var API_publicKey = "FLWPUBK_TEST-34dee984a64e7b4188a8f4605bff08ee-X";
    paymentModal = getpaidSetup({
        PBFPubKey: API_publicKey,
        customer_email: FLUTTER_EMAIL,
        amount: Number(price),
        currency: "NGN",
        customer_phone: FLUTTER_PHONE,
        txref: new Date().getTime(),
        meta: [{
            metaname: "Customer Name",
            metavalue: $('.user-name').text(),
        }],
        onclose: function() {},
        callback: function(response) {
            var flw_ref = response.tx.flwRef;
            paymentModal.close();
            if (response.tx.chargeResponseCode == "00" || response.tx.chargeResponseCode == "0") {
                placeOrder()
            } else {
                innerAlert('Payment Failed')
            }
        }
    });
}



// WEBSITE
$('.menu').click(function() {
    $('.od,button,.nfty').toggleClass('send_back')
    $('.logo_name').fadeToggle().toggleClass('bright')
    $(this).toggleClass('close_mode')
    $('.nav_links_section').slideToggle()
})

$('.faq_title').click(function() {
    $(this).toggleClass('shown')
    $(this).siblings().toggleClass('shown')
})