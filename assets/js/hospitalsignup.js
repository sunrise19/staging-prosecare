$(document).ready(function() {

    var PHONE_MIN = 5,
        PHONE_MAX = 10

    $('#country').change(function() {
        var country = $(this).val()
        if (country != '') {
            var States = '<option disabled selected>State</option>',
                country = CountryStates[country]
            country.States.forEach(state => {
                States += '<option value="' + state + '">' + state + '</option>'
            });
            $('#state').html(States)

            $('#code').find('option').attr('selected', false).each(function() {
                if ($(this).attr('value') == country.Code) {
                    $(this).attr('selected', true)
                }
            })

            PHONE_MIN = country.PhoneMin
            PHONE_MAX = country.PhoneMax

            $('#phone').attr('placeholder', 'Phone Number (e.g ' + country.PhoneSample + ')')
        }

    })

    $('#state').change(function() {
        var country = $('#country').val(),
            state = $(this).val()
        if (country != '') {
            if (state != '') {
                var LGAs = '<option disabled selected>Local Government Area</option>'
                CountryStates[country].LGAs[state].forEach(lga => {
                    LGAs += '<option value="' + lga + '">' + lga + '</option>'
                });
                $('#lga').html(LGAs)
            }
        }
    })

    $('#hospital_sign_up').click(function(e) {

        e.preventDefault()

        var name = $('#name').val(),
            email = $('#email').val(),
            country = $('#country').val(),
            state = $('#state').val(),
            lga = $('#lga').val(),
            code = $('#code').val(),
            phone = $('#phone').val().replace(/e/g, ''),
            cadre = $('#cadre').val(),
            password = $('#password').val()

        $('#phone').val(phone)

        if (name == '') {
            error('Provide Hospital Name', $('#name').parent());
            return;
        } else if (email == '') {
            error('Provide Hospital Email', $('#email').parent())
            return
        } else if (!VALIDATE_EMAIL(email)) {
            error('Invalid Email Provided', $('#email').parent())
            return
        } else if (country == '' || country == null) {
            error('Provide Country', $('#country').parent())
            return
        } else if (state == '' || state == null) {
            error('Provide State', $('#state').parent())
            return
        } else if (lga == '' || lga == null) {
            error('Provide Local Government Area', $('#lga').parent())
            return
        } else if (code == '' || code == null) {
            error('Provide Country Code', $('#code').parent())
            return
        } else if (phone == '') {
            error('Provide Phone Number', $('#phone').parent())
            return
        } else if (phone.length < PHONE_MIN || phone.length > PHONE_MAX) {
            error('Phone Number provided is invalid<br><sub>Must be more than <b>' + (PHONE_MIN - 1) +
                '</b> and less than <b>' + (PHONE_MAX + 1) + '</b> numbers</sub>', $('#phone').parent())
            return
        } else if (isNaN(Number(phone))) {
            error('Phone Number provided is invalid<br><sub>You entered an invalid character</sub>', $('#phone').parent())
            return
        } else if (cadre == '' || cadre == null) {
            error('Provide Hospital Cadre', $('#cadre').parent())
            return
        } else if (password == '') {
            error('Provide Password', $('#password').parent())
            return
        } else if (password.length < 8 || password.length > 32) {
            error('Password must be more than 7 and less than 32 characters', $('#password').parent())
            return
        } else if (!VALIDATE_PASSWORD(password)) {
            error('Password must have at least one number and one special character', $('#password').parent())
            return
        }

        Swal.fire({
            title: "Creating Hospital Account",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        var formData = [name, email, country, state, lga, code, phone, cadre, password]

        $.ajax({
            async: false,
            url: './STATIC_API/api_hospital.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    success('Success', 'Your registration was successful<br>Let\'s get your account verified')
                    setTimeout(() => {
                        window.location.href = './VerifyAccount'
                    }, 2000);
                } else if (data == 'phone_used') {
                    error('This phone number has already been used', '')
                } else if (data == 'email_used') {
                    error('This email has already been used', '')
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