$(document).ready(function() {

    $('#login').click(function(e) {

        e.preventDefault()

        var email = $('#email').val(),
            password = $('#password').val()

        if (email == '') {
            error('No Email Address Provided', $('#email').parent())
            return
        } else if (!VALIDATE_EMAIL(email)) {
            error('Invalid Email Provided', $('#email').parent())
            return
        } else if (password == '') {
            error('No Password Provided', $('#email').parent())
            return
        }

        Swal.fire({
            title: "Authenticating",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        var formData = [email, password]

        $.ajax({
            async: false,
            url: './STATIC_API/api_login.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    success('Success', 'Welcome back to ProseCare')
                    setTimeout(() => {
                        window.location.href = './Dashboard/'
                    }, 1500);
                } else if (data == '5') {
                    success('Success', 'Welcome back to ProseCare<br>Let\'s verify your account first')
                    setTimeout(() => {
                        window.location.href = './VerifyAccount'
                    }, 1500);
                } else if (data == '909') {
                    success('Success', 'Welcome to ProseCare<br> Kindly change your password in order to proceed')
                    setTimeout(() => {
                        window.location.href = './ChangePassword'
                    }, 1500);
                } else if (data == '6') {
                    console.log(data)
                    error('Your account is currently suspended', '')
                } else if (data == '404') {
                    console.log(data)
                    error('Account not found', '')
                } else {
                    console.log(data)
                    error('Wrong Email or Password', '')
                }
            },
            fail: function(data) {
                console.log(data)
                error('This is really weird.<br>Please try again later', '')
            }
        })

    })



})