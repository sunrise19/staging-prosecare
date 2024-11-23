$(document).ready(function() {

    console.log(EMAIL)

    $('#resend_code').click(function(e) {

        e.preventDefault()

        Swal.fire({
            title: "Resending Verification Code",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })


        $.ajax({
            async: false,
            url: './STATIC_API/api_resendcode.php?EMAIL='+EMAIL,
            type: 'POST',
            success: function(data) {
                console.log(data)
                if (data == '1') {
                    $('#dynamic').html('')
                    Swal.fire({
                        title: 'Success',
                        html: 'Verification code resent successfully',
                        type: "success",
                    })
                } else {
                    error('An error occurred.<br>Please try again later', '')
                }
            },
            fail: function(data) {
                console.log(data)
                error('This is really weird.<br>Please try again later', '')
            }
        })


    })

    $('#verify_account').click(function(e) {

        e.preventDefault()

        var code = $('#code').val()

        if (code == '') {
            error('Provide Verification Code', $('#code').parent())
            return
        } 
        else if (code.length < 5 || code.length > 5) {
            // error('Verification must be 5 characters', $('#code').parent())
            error('Invalid Verification Code', $('#code').parent())
            return
        }
        

        Swal.fire({
            title: "Verifying Account",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        var formData = [code, EMAIL]

        $.ajax({
            async: false,
            url: './STATIC_API/api_verifyaccount.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                console.log(data)
                if (data == '0') {
                    error('Invalid Verification Code', $('#code').parent())
                }else {
                    success('Success', 'Your account is now verified')
                    setTimeout(() => {
                        window.location.href = data
                    }, 2000);
                }
            },
            fail: function(data) {
                console.log(data)
                error('An error occurred.<br>Please try again later', '')
            }
        })

    })



})