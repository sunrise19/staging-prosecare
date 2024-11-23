$(document).ready(function() {

    $('#proceed').click(function(e) {

        e.preventDefault()

        var email = $('#email').val()

        if (email == '') {
            error('Provide Your Email Address', $('#email').parent())
            return
        } else if (!VALIDATE_EMAIL(email)) {
            error('Invalid Email Provided', $('#email').parent())
            return
        }

        Swal.fire({
            title: "Processing",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        var formData = [email]

        $.ajax({
            async: false,
            url: './STATIC_API/api_forgotpassword.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                console.log(data)
                if (data?.trim().startsWith('1,')) {
                    $('#dynamic').html('')
                    Swal.fire({
                        title: 'Success',
                        html: 'We\'ve sent a 5 digit code to <br><b>' + email + '</b>',
                        type: "success",
                    }).then(()=> {
                        window.location.href=data?.trim().substring(2)
                    })
                } else if (data == '0') {
                    error('This email is not registered with ProseCare', '')
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



})