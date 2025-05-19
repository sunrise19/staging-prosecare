$(document).ready(function() {

    var FORM_STAGE = 1

    var YEAR_MAX = new Date().getFullYear(),
        YEAR_MIN = YEAR_MAX - 300

    var PHONE_MIN = 5,
        PHONE_MAX = 10

    function getInitials(name) {
        return name
            .split(' ')          // Step 1: Split the string by spaces into an array of words
            .map(word => word[0]) // Step 2: Map over the array to get the first letter of each word
            .join('');           // Step 3: Join the array of letters into a single string
    }

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

    $('#occupation,#religion,#education,#device,#relationship').change(function() {
        var t = $(this),
            v = t.val(),
            elem = t.siblings('input')

        v == 'other' ? elem.show() : elem.hide()
    })


    $('.stage_back').click(function() {
        FORM_STAGE > 1 ? gotToForm(FORM_STAGE - 1) : window.location.href = './AccountType'
    })

    function gotToForm(page) {

        var formTitle = ['1 of 3 &middot; Personal details.', '2 of 3 &middot; Contact details', '3 of 3 &middot; Health Details']

        FORM_STAGE = page

        $('.sforms').hide()
        $('#stage' + page).fadeIn()
        $('.form_stage').html(formTitle[page - 1])
        

        page > 1 ? $('.login_link').hide() : $('.login_link').show()
        
        if(page == 3){
            // $('.text-primary').html(formTitle[2])
            // $('.form_stage').hide()
            $('#patient_sign_up').text('Finish')
        }else{
            $('#patient_sign_up').text('Proceed to Step ' + (++page))
            $('.text-primary').html('Patient Sign Up')
            $('.form_stage').show()
        }

    }


    $('#patient_sign_up').click(function(e) {

        e.preventDefault()

        if (AUTH == '' || AUTH == null) {
            error('Invalid Request', '')
            return
        }

        var name = $('#fname').val(),
            lname = $('#lname').val(),
            day = Number($('#day').val()),
            month = $('#month').val(),
            year = $('#year').val(),
            age = $('#age').val(),
            gender = $('#gender').val(),
            education = $('#education').val() == 'other' ? $('#eeducation').val() : $('#education').val(),
            pin = $('#pin').val(),
            country = $('#country').val(),
            state = $('#state').val(),
            lga = $('#lga').val(),
            ethnicity = $('#ethnicity').val(),
            code = $('#code').val(),
            phone = $('#phone').val().replace(/e/g, ''),
            religion = $('#religion').val() == 'other' ? $('#ereligion').val() : $('#religion').val(),
            income = $('#income').val(),
            cancer = $('#cancer').val(),
            device = $('#device').val() == 'other' ? $('#edevice').val() : $('#device').val(),
            reporter = $('#reporter').val(),
            relationship = $('#relationship').val() == 'other' ? $('#erelationship').val() : $('#relationship').val()
            


        $('#phone').val(phone)

        if (FORM_STAGE == 1) {

            if (name == '') {
                error('Provide First Name', $('#fname').parent());
                return;
            } else if (name.length < 2 || name.length > 30) {
                error('First Name is invalid<br><sub>Must be more than <b>' + (1) +
                    '</b> and less than <b>' + (30) + '</b> characters</sub>', $('#fname').parent())
                return
            } else if (lname == '') {
                error('Provide Last Name', $('#lname').parent());
                return;
            } else if (lname.length < 2 || lname.length > 30) {
                error('Last Name is invalid<br><sub>Must be more than <b>' + (1) +
                    '</b> and less than <b>' + (30) + '</b> characters</sub>', $('#lname').parent())
                return
            } else if (day == '') {
                error('Provide Day of Birth', $('#day').parent());
                return;
            } else if (day < 1 || day > 31) {
                error('Day of Birth is invalid<br><sub>Must range from <b>' + (1) + '</b> to <b>' + (31) + '</b></sub>', $('#day').parent())
                return
            } else if (month == '' || month == null) {
                error('Provide Month of Birth', $('#month').parent());
                return;
            } else if (year == '') {
                error('Provide Year of Birth', $('#year').parent());
                return;
            } else if (year < YEAR_MIN || year > YEAR_MAX) {
                error('Year of Birth is invalid<br><sub>Must range from <b>' + (YEAR_MIN) + '</b> to <b>' + (YEAR_MAX) + '</b></sub>', $('#year').parent())
                return
            }else if (age == '') {
                error('Provide Age', $('#age').parent());
                return;
            }  else if (gender == '' || gender == null) {
                error('Provide Gender', $('#gender').parent());
                return;
            } else if (education == '') {
                error('Provide Level of Education', $('#education').parent());
                return;
            } else if (education.length < 2 || education.length > 30) {
                error('Level of Education is invalid<br><sub>Must be more than <b>' + (1) + '</b> and less than <b>' + (30) + '</b> characters</sub>', $('#education').parent())
                return
            } 
            /* else if (pin == '') {
                error('Provide PIN', $('#pin').parent());
                return;
            } 
            else if (pin.length < 2 || pin.length > 10) {
                error('PIN is invalid<br><sub>Must be more than <b>' + (1) +
                    '</b> and less than <b>' + (10) + '</b> characters</sub>', $('#pin').parent())
                return
            } 
            */ 
            
            

            gotToForm(2)
            return

        } else if (FORM_STAGE == 2) {

            if (code == '' || code == null) {
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
            } else if (country == '' || country == null) {
                error('Provide Country', $('#country').parent())
                return
            } else if (state == '' || state == null) {
                error('Provide State', $('#state').parent())
                return
            } else if (lga == '' || lga == null) {
                error('Provide Local Government Area', $('#lga').parent())
                return
            } else if (ethnicity == '') {
                error('Provide Ethnicity', $('#street').parent())
                return
            } else if (ethnicity.length < 3 || ethnicity.length > 30) {
                error('Ethnicity is invalid<br><sub>Must be more than <b>' + (2) +
                    '</b> and less than <b>' + (30) + '</b> characters</sub>', $('#ethnicity').parent())
                return
            } else if (religion == '') {
                error('Provide Religion', $('#religion').parent());
                return;
            } else if (religion.length < 2 || religion.length > 30) {
                error('Religion is invalid<br><sub>Must be more than <b>' + (1) + '</b> and less than <b>' + (30) + '</b> characters</sub>', $('#religion').parent())
                return
            } else if (income == '' || income == null) {
                error('Provide Monthly Income Level', $('#income').parent());
                return;
            }  
            
            gotToForm(3)
            return

        } else if (FORM_STAGE == 3) {

            if (cancer == '' || cancer == null) {
                error('Provide Cancer Type', $('#cancer').parent());
                return;
            } else if (device == '') {
                error('Provide Type of Device', $('#device').parent());
                return;
            } else if (device.length < 2 || device.length > 30) {
                error('Type of Device is invalid<br><sub>Must be more than <b>' + (1) + '</b> and less than <b>' + (30) + '</b> characters</sub>', $('#device').parent())
                return
            } else if (reporter == '' || reporter == null) {
                error('Provide Side Effect Reporter', $('#reporter').parent());
                return;
            } else if (relationship == '') {
                error('Provide Relationship With Caregiver', $('#relationship').parent());
                return;
            } else if (relationship.length < 2 || relationship.length > 30) {
                error('Relationship With Caregiver is invalid<br><sub>Must be more than <b>' + (1) + '</b> and less than <b>' + (30) + '</b> characters</sub>', $('#relationship').parent())
                return
            }

            pin = getInitials(cancer.replaceAll('and', ''))

            signup()

        }
        

        function signup() {

            Swal.fire({
                title: "Creating Patient Account",
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })

            var formData = [name, lname, day, month, year, gender, education, pin, country, state, lga, ethnicity, code, phone, religion, income, cancer, device, reporter, relationship, age, AUTH]

            $.ajax({
                async: false,
                url: './STATIC_API/api_patient.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        success('Hi ' + name + '👋', 'Your registration was successful<br>Welcome to PROSE Care 🎉')
                        setTimeout(() => {
                            window.location.href = './Dashboard/'
                        }, 2000);
                    }else if (data == '2') {
                        error('Unable to create patient account.<br>Request is invalid', '')
                    } else if (data == 'phone_used') {
                        error('This phone number you provided has already been used', '')
                    } else if (data == 'email_used') {
                        error('This email you provided has already been used', '')
                    } else {
                        console.log(data)
                        error('An error occurred.<br>Please try again later', '')
                    }
                },
                fail: function(data) {
                    console.log(data)
                    error('An unexpected error occurred.<br>Please try again later', '')
                }
            })

        }


    })

})