$(document).ready(function() {

    var FORM_STAGE = 1

    var YEAR_MAX = new Date().getFullYear(),
        YEAR_MIN = YEAR_MAX - 300

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

    $('#hospital').keyup(function() {

        var v = $(this).val().toLowerCase()

        $('.h_results').hide()

        if (v != '') {

            $('.h_res_item').each(function() {
                if ($(this).text().toLowerCase().indexOf(v) > -1) {
                    $('.h_results').show()
                    $(this).css('display', 'inline-block')
                } else {
                    $(this).hide()
                }
            })

        } else {
            $('.h_res_item').removeClass('active')
        }

    })

    $('.h_res_item').click(function() {
        if (!$(this).hasClass('active')) {
            $('.h_res_item').removeClass('active')
            $(this).addClass('active')
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

    $('#cadre').change(function() {
        var t = $(this),
            v = t.val(),
            elem = $('#ecadre')

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
            $('#hcp_sign_up').text('Finish')
        }else{
            $('#hcp_sign_up').text('Proceed to Step ' + (++page))
            $('.text-primary').html('HCP Sign Up')
            $('.form_stage').show()
        }

    }


    $('#hcp_sign_up').click(function(e) {

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
            gender = $('#gender').val(),
            code = $('#code').val(),
            phone = $('#phone').val().replace(/e/g, ''),
            country = $('#country').val(),
            state = $('#state').val(),
            lga = $('#lga').val(),
            folio = $('#folio').val(),
            specialty = $('#cadre').val() == 'other' ? $('#ecadre').val() : $('#cadre').val(),
            hospital = $('#hospital').val(),
            team = $('#team').val()

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
            }  else if (day == '') {
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
            } else if (gender == '' || gender == null) {
                error('Provide Gender', $('#gender').parent());
                return;
            } 

            gotToForm(2)
            return

        } else if (FORM_STAGE == 2) {

            if (code == '' || code == null) {
                error('Provide Country Code', $('#code').parent())
                return
            } else if (phone == '') {
                error('Provide Phone Number', $('#phone').parent())
                return
            }else if (phone == '') {
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
            } 

            gotToForm(3)
            return

        }else if (FORM_STAGE == 3) {

            // if (folio == '') {
            //     error('Provide Folio Number', $('#folio').parent())
            //     return
            // } else 
            
            if (specialty == '' || specialty == null) {
                error('Provide Cadre', $('#cadre').parent())
                return
            } else if (specialty.length < 3 || specialty.length > 51) {
                error('Specialty is invalid<br><sub>Must be more than <b>' + (3) +
                    '</b> and less than <b>' + (50) + '</b> characters</sub>', $('#cadre').parent())
                return
            } 
            // else if (team == '' || team == null) {
            //     error('Provide Managing Team', $('#team').parent())
            //     return
            // }
    
            Swal.fire({
                title: "Creating HCP Account",
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            var formData = [name, lname, day, month, year, gender, code, phone, country, state, lga, folio, specialty, hospital, team, AUTH]
    
            $.ajax({
                async: false,
                url: './STATIC_API/api_hcp.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        success('Hi ' + name + '👋', 'Your registration was successful<br>Welcome to PROSE Care 🎉')
                        setTimeout(() => {
                            window.location.href = './Dashboard'
                        }, 2000);
                    } else if (data == 'phone_used') {
                        error('This phone number has already been used', '')
                    } else if (data == 'email_used') {
                        error('This email has already been used', '')
                    } else {
                        console.log(data)
                        error('An error occurred.<br>Please try again later', '')
                    }
                },
                fail: function(data) {
                    console.log(data)
                    error('An error occurred.<br>Please try again later', '')
                }
            })

        }
        

    })



})