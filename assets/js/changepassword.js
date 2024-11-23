$(document).ready(function() {

    $('#proceed').click(function(e) {

        e.preventDefault()

        var password_a = $('#passworda').val(),
            password_b = $('#passwordb').val()

        if (password_a == '') {
            error('Provide New Password', $('#passworda').parent())
            return
        } else if (password_a.length < 8 || password_a.length > 16) {
            error('Password must be more than 8 and less than 16 characters', $('#passworda').parent())
            return
        } else if (!VALIDATE_PASSWORD(password_a)) {
            error('Password must have at least <b>one number</b> and <b>one special character</b>', $('#passworda').parent())
            return
        }

        if (password_a != password_b) {
            error('Passwords do not match', $('#passworda,#passwordb').parent())
            return
        }

        if (AUTH == '') {
            error('Invalid Request', '')
            return
        }

        Swal.fire({
            title: "Processing",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        var formData = [AUTH, password_a]

        $.ajax({
            async: false,
            url: './STATIC_API/api_changepassword.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    success('Success', 'Password changed successfully')
                    setTimeout(() => {
                        window.location.href = './Login'
                    }, 2000);
                } else if (data == '0') {
                    error('Authentication Failed :/<br><sub>Open the link from your email again</sub>', '')
                } else if (data == '2') {
                    error('This password has been used too many times :/', '')
                } else {
                    console.log(data)
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
        } else if (code.length < 5 || code.length > 5) {
            error('Verification must be 5 characters', $('#code').parent())
            return
        }

        Swal.fire({
            title: "Verifying Account",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        var formData = [code]

        $.ajax({
            async: false,
            url: './STATIC_API/api_verifyaccount.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    success('Success', 'Your account is now verified')
                    setTimeout(() => {
                        window.location.href = './Dashboard/'
                    }, 2000);
                } else if (data == '0') {
                    error('Invalid Verification Code', '')
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