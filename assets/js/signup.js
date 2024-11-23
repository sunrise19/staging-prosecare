$(document).ready(function() {

    $('#proceed').click(function(e) {

        e.preventDefault()

        var email = $('#email').val(),
            password_a = $('#passworda').val(),
            password_b = $('#passwordb').val()

        if (email == '') {
            error('No Email Address Provided', $('#email').parent())
            return
        } else if (!VALIDATE_EMAIL(email)) {
            error('Invalid Email Provided', $('#email').parent())
            return
        }else if (password_a == '') {
            error('Provide New Password', $('#passworda').parent())
            return
        } else if (password_a.length < 8 || password_a.length > 16) {
            error('Password must be more than 8 and less than 16 characters', $('#passworda').parent())
            return
        } 
        /*
        else if (!VALIDATE_PASSWORD(password_a)) {
            error('Password must have at least <b>one number</b> and <b>one special character</b>', $('#passworda').parent())
            return
        }
        */

        if (password_a != password_b) {
            error('Passwords do not match', $('#passworda,#passwordb').parent())
            return
        }

        if (TYPE == '') {
            error('Invalid Request', '')
            return
        }

        Swal.fire({
            title: "Processing",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        var formData = [email, password_a, TYPE]

        $.ajax({
            async: false,
            url: './STATIC_API/api_signup.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    Swal.close()
                    window.location.href='./VerifyAccount?EMAIL='+email
                    /*
                    $('input').val('')
                    $('.full-form').addClass('col-xl-7')
                    $('.hide-on-success').slideUp()
                    $('.form-success').slideDown()
                    setTimeout(() => {
                        $('.hide-on-success').remove()
                    }, 3000);
                    */
                } else if (data == '2') {
                    error('This email is already registered', '')
                } else if (data == '3') {
                    error('Invalid account type selected', '')
                    setTimeout(() => {
                        window.location.href = './AccountType'
                    }, 1500);
                } else {
                    console.log(data)
                    error('An error occurred.<br>Please try again later', '')
                }
            },
            fail: function(data) {
                console.log(data)
                error('A weird error occurred.<br>Please try again later', '')
            }
        })


    })

})