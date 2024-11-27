$(document).ready(function () {

    $('.tab_item').on('click', function () {
        let t = $(this),
            tab = t.attr('data-tab')

        if (!tab) return

        $('.tab_item').removeClass('active')
        t.addClass('active')

        $('.tab_container').hide()
        $('.tab_container.' + tab).show()
    })

    $('.vt_item').on('click', function () {
        let t = $(this),
            tab = t.attr('data-tab')

        if (!tab) return

        $('.vt_item').removeClass('active')
        t.addClass('active')

        $('.vertical_section').hide()
        $('.vertical_section.' + tab).show()
    })


    $('.file_selector').on('click', function () {
        $(this).siblings('input[type="file"]').click()
    })

    $('.file_selector_input').change(function (e) {

        var t = $(this),
            column_name = t.attr('id'),
            output = t.siblings('.file_selector'),
            link = t.siblings('a'),
            linkIcon = link.find('img'),
            files = e.target.files,
            data = new FormData(),
            file_names = [],
            file_sizes = []

        for (i = 0; i < files.length; i++) {

            if (files[i].size < 10000000) {
                data.append('file' + i, files[i]);
                file_names.push(shortenFileName(files[i].name))
                file_sizes.push(formatFileSize(files[i].size))
                console.log(files[i].name + ' -> ' + formatFileSize(files[i].size))
            } else {
                Swal.fire({
                    title: "Oops!",
                    html: "File too large. Must be less than 100MB",
                    type: "info"
                })
                return
            }
        }

        const targetButton = $('.updatespecialization_hcp'),
            isEditing = targetButton.attr('data-editing') == 'true',
            hcp_user_id = targetButton.attr('data-hcp')

        $.ajax({
            url: './API/upload_hcp_files.php?column_name=' + column_name + '&file_name=' + file_names[0] + '&editing=' + isEditing + '&user_id=' + hcp_user_id,
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
        }).done(function (data) {

            if (data != '') {
                output.val(file_names[0])
                link.attr('href', 'HCP_FILES/' + data)
                linkIcon.removeClass('d-none')
            }

            Swal.fire({
                title: data != '' ? 'Success' : 'Oops!',
                html: data != '' ? 'File Uploaded Successfully' : 'Failed to Upload file',
                type: data != '' ? 'success' : 'error'
            })

        });
    })


    function shortenFileName(fileName, maxLength = 30) {
        if (fileName.length <= maxLength) {
            return fileName;
        }

        var extensionIndex = fileName.lastIndexOf('.');
        var extension = fileName.substring(extensionIndex);
        var fileNameWithoutExtension = fileName.substring(0, extensionIndex);
        var shortenedFileName = fileNameWithoutExtension.substring(0, maxLength - extension.length) + '...' + extension;

        return shortenedFileName?.replaceAll(',', '_')
    }


    function formatFileSize(size) {
        size = Number(size)
        if (size <= 1000000) {
            return Math.round(size / 1000) + 'KB'
        } else if (size > 1000000 && size <= 1000000000) {
            return Math.round(size / 1000000) + 'MB'
        } else if (size > 1000000000) {
            return Math.round(size / 1000000000) + 'GB'
        }
    }

    let A_URL = window.location.href

    var REMINDER_ID_IN_EDIT_MODE = ''

    if (A_URL.indexOf('#DiseaseCharacteristics') > -1 || A_URL.indexOf('#Update') > -1) {
        $('.profile_card').hide();
        $('.edit_section').show()
        // $('html, body').animate({
        //   scrollTop: $("#DiseaseCharacteristics").offset().top
        // });
    }

    $('.open_settings').click(function () {
        let t = $(this),
            type = t.attr('data-type'),
            target = $('.view_state[data-type="' + type + '"]')

        $('.view_state').hide()

        console.log(type)

        if (type != null && target.length == 1) {
            target.show()
        } else {
            $('.view_state[data-type="empty"]').show()
        }

    })

    $('select').each(function () {

        var d = $(this).attr('data-default'),
            found = false

        if (d != undefined) {
            $(this).find('option').attr('selected', false).each(function () {
                if ($(this).attr('value').toLowerCase() == d.toLowerCase()) {
                    $(this).attr('selected', true)
                    found = true
                    return
                }
            })
            if (!found) {
                $(this).parent().parent().siblings('.other_div').show()
                $(this).find('option[value="other"]').attr('selected', true)
            }
            $(this).html($(this).html())
        }

    })

    $('#hospital').keyup(function () {

        var v = $(this).val().toLowerCase()

        $('.h_results').hide()

        if (v != '') {

            $('.h_res_item').each(function () {
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

    $('.h_res_item').click(function () {
        if (!$(this).hasClass('active')) {
            $('.h_res_item').removeClass('active')
            $(this).addClass('active')
        }
    })

    $('.delete_bank').click(function () {

        console.log('clicked...')

        let t = $(this),
            id = t.attr('id'),
            parent = t.parent().parent().parent().parent().parent()

        Swal.fire({
            title: "Delete Bank Account",
            // html: "",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ml-2 mt-2",
            buttonsStyling: !1
        }).then(function (t) {
            t.value ? doDelete(id)
                : t.dismiss === Swal.DismissReason.cancel
        })

        function doDelete(id) {

            $.ajax({
                async: false,
                url: './API/api_delete_bank.php?id=' + id,
                type: 'POST',
                success: function (data) {
                    console.log(data)
                    if (data.trim() == '1') {
                        s2('Reminder Deletion')
                        parent.remove()
                    } else {
                        e('Reminder Deletion')
                    }
                },
                fail: function (data) {
                    console.log(data)
                    e('Reminder Deletion')
                },
                error: function (data) {
                    console.log(data)
                    e('Reminder Deletion')
                }
            })
        }
    })

    $('.delete').click(function () {
        let t = $(this).parent().parent(),
            id = t.parent().attr('id'),
            name = t.find('.rem_desc').text()
        Swal.fire({
            title: "Delete",
            html: "Confirm deletion of reminder for <br> <b>" + name + "</b>",
            type: "warning",
            showCancelButton: !0,
            confirmButtonText: "Delete",
            cancelButtonText: "Cancel",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ml-2 mt-2",
            buttonsStyling: !1
        }).then(function (t) {
            t.value ? doDelete(id)
                : t.dismiss === Swal.DismissReason.cancel
        })

        function doDelete(id) {

            $.ajax({
                async: false,
                url: './API/api_delete_reminder.php?id=' + id,
                type: 'POST',
                success: function (data) {
                    console.log(data)
                    if (data.trim() == '1') {
                        s3('Reminder Deletion')
                    } else {
                        e('Reminder Deletion')
                    }
                },
                fail: function (data) {
                    console.log(data)
                    e('Reminder Deletion')
                },
                error: function (data) {
                    console.log(data)
                    e('Reminder Deletion')
                }
            })
        }
    })

    $('.edit').click(function () {
        let t = $(this).parent().parent(),
            id = t.parent().attr('id'),
            name = t.find('.rem_desc').text(),
            time = t.find('.rem_time').text().split(' '),
            hour = time[0].split(':')[0],
            minute = time[0].split(':')[1],
            ampm = time[1]

        REMINDER_ID_IN_EDIT_MODE = id

        $('.view_state').hide()
        $('.view_state[data-type="update_reminder"]').show()

        selectOption('#u-description', name)
        selectOption('#u-hour', hour)
        selectOption('#u-minute', minute)
        selectOption('#u-ampm', ampm)

    })

    $('.updatereminder').click(function (evt) {

        evt.preventDefault();

        var description = $('#u-description').val(),
            hour = $('#u-hour').val(),
            minute = $('#u-minute').val(),
            ampm = $('#u-ampm').val()

        if (description == '' || description == null) {
            error('Please provide a description', $('#u-description'));
            return;
        } else if (hour == '' || hour == null) {
            error('Provide reminder hour', $('#u-hour'));
            return;
        } else if (minute == '' || minute == null) {
            error('Provide reminder minute', $('#u-minute'));
            return;
        } else if (ampm == '' || ampm == null) {
            error('Provide reminder AM/PM', $('#u-ampm'));
            return;
        }

        Swal.fire({
            title: 'Updating Reminder',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_update_reminder.php',
            data: { data: [description, hour, minute, ampm, REMINDER_ID_IN_EDIT_MODE] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s3('Reminder Update')
                } else {
                    e('Reminder Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Reminder Update')
            },
            error: function (data) {
                console.log(data)
                e('Reminder Update')
            }
        })

    })

    $('.setreminder').click(function (evt) {

        evt.preventDefault();

        var description = $('#description').val(),
            hour = $('#hour').val(),
            minute = $('#minute').val(),
            ampm = $('#ampm').val()

        if (description == '' || description == null) {
            error('Please provide a description', $('#description'));
            return;
        } else if (hour == '' || hour == null) {
            error('Provide reminder hour', $('#hour'));
            return;
        } else if (minute == '' || minute == null) {
            error('Provide reminder minute', $('#minute'));
            return;
        } else if (ampm == '' || ampm == null) {
            error('Provide reminder AM/PM', $('#ampm'));
            return;
        }

        Swal.fire({
            title: 'Setting Reminder',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_set_reminder.php',
            data: { data: [description, hour, minute, ampm] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s3('Reminder Creation')
                } else {
                    e('Reminder Creation')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Reminder Creation')
            },
            error: function (data) {
                console.log(data)
                e('Reminder Creation')
            }
        })

    })


    function selectOption(element, value) {
        $(element).find('option').attr('selected', false)
        $(element).find('option').each(function () {
            if ($(this).attr('value') == value) {
                $(this).attr('selected', true)
            } else {
                $(this).attr('selected', false)
            }
        })
        let context = $(element).html()
        $(element).html(context)
    }


    $('.tiny_image').click(function () {
        $(this).siblings('input[type="file"]').click()
    })

    $('.photo_input').change(function (e) {
        var t = $(this),
            fileList = e.target.files
        let file = null;
        for (let i = 0; i < fileList.length; i++) {
            if (fileList[i].type.match(/^image\//)) {
                file = fileList[i];
                break;
            }
        }
        if (file != null) {
            t.siblings('.raw_image').remove()
            t.before('<img class="raw_image" style="display: none">')
            t.siblings('.tiny_image,.raw_image').attr('src', URL.createObjectURL(file))
        } else {
            Swal.fire({
                title: "Oops!",
                html: "No photo selected",
                type: "info"
            })
        }
    })

    $('#update_photo,#update_signature,#update_consent').click(function (e) {

        e.preventDefault();

        var t = $(this),
            dataType = t.attr('data-type')

        if (t.siblings('.raw_image').length > 0) {
            t.before('<canvas style="display: none"></canvas>')
            const image = t.siblings('.raw_image')[0],
                canvas = t.siblings('canvas')[0],
                maxWidth = 400,
                scaleSize = maxWidth / image.width;
            canvas.width = maxWidth
            canvas.height = image.height * scaleSize
            canvas.getContext('2d').drawImage(image, 0, 0, canvas.width, canvas.height)

            var canvasData = canvas.toDataURL(image, 'image/jpeg')

            $.ajax({
                async: false,
                url: './API/api_uploadimage.php',
                data: { images: canvasData },
                type: 'POST',
                success: function (data) {

                    var dataArray = data.replace(',', '').split('%')
                    if (dataArray[0] == '1') {
                        t.siblings('.tiny_image').attr('src', 'IMG/' + dataArray[1])
                        t.siblings('.raw_image,canvas').remove()

                        var formData = [dataArray[1]]

                        $.ajax({
                            async: false,
                            url: './API/api_profile_update' + dataType + '.php',
                            data: { data: formData },
                            type: 'POST',
                            success: function (data) {
                                if (data == '1') {
                                    if (dataType == 'photo') {
                                        s2('Profile Photo Update ')
                                    } else if (dataType == 'signature') {
                                        s2('Laboratory Test Update ')
                                    } else if (dataType == 'consent') {
                                        s2('Consent Form Update ')
                                    }
                                } else {
                                    console.log(data)
                                    Swal.fire({
                                        title: "Oops",
                                        html: "An error occurred",
                                        type: "error"
                                    })
                                }
                            },
                            fail: function (data) {
                                console.log(data)
                                Swal.fire({
                                    title: "Oops",
                                    html: "An error occurred",
                                    type: "error"
                                })
                            }
                        })
                    }
                }
            })

        } else {
            Swal.fire({
                title: "Oops!",
                html: "No photo selected",
                type: "info"
            })
        }


    })

    $('.ep').click(function () {
        $('.profile_card').hide()
        $('.edit_section').show()
    })

    $('.close_edit').click(function () {
        $('.profile_card').show()
        $('.edit_section').hide()
    })


    $('.updatepassword').click(function (evt) {

        evt.preventDefault();

        var password = $('#password').val(),
            passworda = $('#passworda').val(),
            passwordb = $('#passwordb').val()

        if (password == '') {
            error('Provide Current Password', $('#password'));
            return;
        } else if (password == '') {
            error('Provide Password', $('#password'))
            return
        } else if (passworda.length < 8 || passworda.length > 16) {
            error('New Password must be more than 8 and less than 16 characters', $('#passworda'))
            return
        }
        // else if (!VALIDATE_PASSWORD(passworda)) {
        //     error('Password must have at least one number and one special character', $('#passworda'))
        //     return
        // } 
        else if (passworda !== passwordb) {
            error('New Passwords Do Not Match', $('#passworda,#passwordb'));
            return;
        } else if (password == passworda) {
            error('Old password cannot be used as new password', $('#password,#passworda,#passwordb'));
            return;
        }

        Swal.fire({
            title: 'Updating Password',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_password_update.php',
            data: { data: [password, passworda] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                data == '1' ? s2('Password Update') : e('Password Update')
            },
            fail: function (data) {
                console.log(data)
                e('Password Update')
            },
            error: function (data) {
                console.log(data)
                e('Password Update')
            }
        })

    })

    // START OF HOSPITAL

    $('.updateprofile_hospital').click(function (evt) {

        evt.preventDefault();

        var name = $('#name').val(),
            code = $('#code').val(),
            phone = $('#phone').val(),
            email = $('#email').val(),
            cadre = $('#cadre').val(),
            lga = $('#lga').val(),
            state = $('#state').val(),
            country = $('#country').val()

        if (name == '' || name.length < 3) {
            error('Hospital Name is invalid', $('#fname'));
            return;
        }
        /* else if (code == '' || code.length < 2) {
            error('Country Code is invalid', $('#code'));
            return;
        } */
        else if (phone == '' || phone.length < 3) {
            error('Phone Number is invalid', $('#phone'));
            return;
        } else if (!VALIDATE_EMAIL(email)) {
            error('Email address is invalid', $('#email'));
            return;
        } else if (cadre == '' || cadre == null) {
            error('Cadre is invalid', $('#cadre'));
            return;
        } else if (lga == '' || lga.length < 3) {
            error('LGA is invalid', $('#lga'));
            return;
        } else if (state == '' || state.length < 3) {
            error('State is invalid', $('#state'));
            return;
        } else if (country == '' || country.length < 3) {
            error('Country is invalid', $('#country'));
            return;
        }


        Swal.fire({
            title: 'Updating Profile',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_hospital.php',
            data: { data: [name, code, phone, email, cadre, lga, state, country] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s2('Profile Update')
                    $('.auth_name').text(name)
                } else {
                    e('Profile Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Profile Update')
            },
            error: function (data) {
                console.log(data)
                e('Profile Update')
            }
        })

    })

    // END OF HOSPITAL


    // START OF HCP
    $('.updateprofile_hcp').click(function (evt) {

        evt.preventDefault();

        var fname = $('#fname').val(),
            lname = $('#lname').val(),
            code = $('#code').val(),
            phone = $('#phone').val(),
            email = $('#email').val(),
            day = $('#day').val(),
            month = $('#month').val(),
            year = $('#year').val(),
            lga = $('#lga').val(),
            state = $('#state').val(),
            country = $('#country').val(),
            cadre = $('#cadre').val(),
            team = $('#managing_team').val(),
            hospital = $('#hospital').val(),
            folio = $('#folio').val() || '',
            gender = $('#gender').val()

        if (fname == '' || fname.length < 3) {
            error('First Name is invalid', $('#fname'));
            return;
        } else if (lname == '' || lname.length < 3) {
            error('Last Name is invalid', $('#lname'));
            return;
        }
        /* else if (code == '' || code.length < 2) {
            error('Country Code is invalid', $('#code'));
            return;
        } */
        else if (phone == '' || phone.length < 3) {
            error('Phone Number is invalid', $('#phone'));
            return;
        } else if (!VALIDATE_EMAIL(email)) {
            error('Email address is invalid', $('#email'));
            return;
        } else if (Number.isNaN(Number(day)) || day == '' || Number(day) > 31) {
            error('Day of Birth is invalid', $('#day'));
            return;
        } else if (month == '' || month == null) {
            error('Month of Birth is invalid', $('#month'));
            return;
        } else if (Number.isNaN(Number(year)) || year == '' || Number(year) > 2022) {
            error('Year of Birth is invalid', $('#year'));
            return;
        } 
        /* else if (team == '') {
            error('Managing Team is invalid', $('#team'));
            return;
        }  */
        else if (lga == '' || lga.length < 3) {
            error('Town/City is invalid', $('#lga'));
            return;
        } else if (state == '' || state.length < 3) {
            error('State is invalid', $('#state'));
            return;
        } else if (country == '' || country.length < 3) {
            error('Country is invalid', $('#country'));
            return;
        } else if (cadre == '' || cadre == null) {
            error('Specialty is invalid', $('#cadre'));
            return;
        } else if (hospital == '' || !hospital) {
            error('Hospital is invalid', $('#hospital'));
            return;
        }
        // else if (folio == '' || folio == null) {
        //     error('Folio Number is invalid', $('#folio'));
        //     return;
        // } 
        else if (gender == '' || gender == null) {
            error('Gender is invalid', $('#gender'));
            return;
        }


        Swal.fire({
            title: 'Updating Profile',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_hcp.php',
            data: { data: [fname, lname, code, phone, email, team, lga, state, country, cadre, hospital, day, month, year, folio, gender] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s2('Profile Update')
                    $('.auth_name').text(fname + ' ' + lname)
                    $('.tab_item[data-tab="NextofKinInformation"]').click()
                } else {
                    e('Profile Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Profile Update')
            },
            error: function (data) {
                console.log(data)
                e('Profile Update')
            }
        })

    })

    //START OF HCP SPECIALIZATION
    $('.updatespecialization_hcp').click(function (evt) {

        evt.preventDefault();

        let cadre = $('#cadre').val(),
            hospital = $('#hospital').val(),
            practicing_mdcn_expiry = $('#practicing_mdcn_expiry').val(),
            mdcn_registration_expiry = $('#mdcn_registration_expiry').val(),
            fellowship_license_expiry = $('#fellowship_license_expiry').val(),
            isEditing = $(this).attr('data-editing') == 'true',
            hcp_user_id = $(this).attr('data-hcp')


        Swal.fire({
            title: 'Updating',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_hcp_specialization.php?editing=' + isEditing + '&user_id=' + hcp_user_id,
            data: { data: [cadre, hospital, practicing_mdcn_expiry, mdcn_registration_expiry, fellowship_license_expiry] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    Swal.fire({
                        title: 'Update successful',
                        type: 'success',
                        confirmButtonText: "Okay",
                        confirmButtonClass: "btn btn-success mt-2",
                        buttonsStyling: !1
                    }).then(() => {
                        if(isEditing){
                            window.location.href = 'Hospital-Home'
                        }
                    })
                } else {
                    e('Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Update')
            },
            error: function (data) {
                console.log(data)
                e('Update')
            }
        })

    })
    //END OF HCP SPECIALIZATION

    $('.updateprofile_hcp_hospital').click(function (evt) {

        evt.preventDefault();

        var hospital = $('#hospital').val()

        Swal.fire({
            title: 'Updating Hospital',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        if ($('.h_res_item.active').length == 1) {
            hospital = 'id-' + $('.h_res_item.active').attr('value')
        }

        $.ajax({
            async: false,
            url: './API/api_profile_hcp_hospital.php',
            data: { data: [hospital] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s2('Hospital Update')
                } else {
                    e('Hospital Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Hospital Update')
            },
            error: function (data) {
                console.log(data)
                e('Hospital Update')
            }
        })

    })

    // END OF HCP



    // START OF PATIENTS
    $('.updateprofile_patient').click(function (evt) {

        evt.preventDefault();

        var fname = $('#fname').val(),
            lname = $('#lname').val(),
            gender = $('#gender').val(),
            age = $('#age').val(),

            code = $('#code').val(),
            phone = $('#phone').val(),
            email = $('#email').val(),

            day = $('#day').val(),
            month = $('#month').val(),
            year = $('#year').val(),

            country = $('#country').val(),
            state = $('#state').val(),
            lga = $('#lga').val(),
            ethnicity = $('#ethnicity').val(),

            income = $('#income').val(),
            education = $('#education').val(),
            device = $('#device').val(),
            religion = $('#religion').val(),

            reporter = $('#reporter').val(),
            relationship = $('#relationship').val(),
            managing_team = $('#managing_team').val(),
            pin = $('#pin').val(),
            hospital = $('#hospital').val()


        if (fname == '' || fname.length < 3) {
            error('First Name is invalid', $('#fname'));
            return;
        } else if (lname == '' || lname.length < 3) {
            error('Last Name is invalid', $('#lname'));
            return;
        } else if (gender == '' || gender == null) {
            error('Gender is invalid', $('#gender'));
            return;
        } else if (age == '' || age == null || age < 0) {
            error('Age is invalid', $('#age'));
            return;
        }
        /* else if (code == '' || code.length < 2) {
            error('Country Code is invalid', $('#code'));
            return;
        }  */
        else if (phone == '' || phone.length < 3) {
            error('Phone Number is invalid', $('#phone'));
            return;
        } else if (!VALIDATE_EMAIL(email)) {
            error('Email address is invalid', $('#email'));
            return;
        } else if (Number.isNaN(Number(day)) || day == '' || Number(day) > 31) {
            error('Day of Birth is invalid', $('#day'));
            return;
        } else if (month == '' || month == null) {
            error('Month of Birth is invalid', $('#month'));
            return;
        } else if (Number.isNaN(Number(year)) || year == '' || Number(year) > 2022) {
            error('Year of Birth is invalid', $('#year'));
            return;
        } else if (country == '' || country.length < 3) {
            error('Country is invalid', $('#country'));
            return;
        } else if (country == '' || country.length < 3) {
            error('Country is invalid', $('#country'));
            return;
        } else if (state == '' || state.length < 3) {
            error('State is invalid', $('#state'));
            return;
        } else if (lga == '' || lga.length < 3) {
            error('LGA is invalid', $('#lga'));
            return;
        } else if (ethnicity == '' || ethnicity < 2) {
            error('Street is invalid', $('#ethnicity'));
            return;
        } else if (income == '' || income < 2) {
            error('Income level is invalid', $('#income'));
            return;
        } else if (education == '' || education < 2) {
            error('Education level is invalid', $('#education'));
            return;
        } else if (device == '' || device < 2) {
            error('Device is invalid', $('#device'));
            return;
        } else if (religion == '' || religion < 2) {
            error('Religion is invalid', $('#religion'));
            return;
        } else if (reporter == '' || reporter == null) {
            error('Side effects reporter is invalid', $('#reporter'));
            return;
        } 
        else if (relationship == '' || relationship == null) {
            error('Relationship with caregiver is invalid', $('#relationship'));
            return;
        }
        else if (hospital == '' || !hospital) {
            error('No hospital selected', $('#hospital'));
            return;
        }
        /*
        else if (managing_team == '' || managing_team == null) {
            error('Managing Team is invalid', $('#managing_team'));
            return;
        } else if (pin == '' || pin == null) {
            error('PIN is invalid', $('#pin'));
            return;
        }
        */

        Swal.fire({
            title: 'Updating Profile',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_patient.php',
            data: { data: [fname, lname, gender, age, code, phone, email, day, month, year, country, state, lga, ethnicity, income, education, device, religion, reporter, relationship, managing_team, pin, hospital] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s2('Profile Update')
                    $('.auth_name').text(fname + ' ' + lname)
                    $('.tab_item[data-tab="NextofKinInformation"]').click()
                } else {
                    e('Profile Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Profile Update')
            },
            error: function (data) {
                console.log(data)
                e('Profile Update')
            }
        })

    })
    // END OF PATIENTS


    // START OF NEXT OF KIN
    
    $('.updatenextofkin').click(function (evt) {

        evt.preventDefault();

        var name = $('#name_n').val(),
            name_n_l = $('#name_n_l').val(),
            email_n = $('#email_n').val(),
            code = $('#code_n').val(),
            phone = $('#phone_n').val(),
            gender_n = $('#gender_n').val(),
            relationship_n = $('#relationship_n').val(),
            address_n = $('#address_n').val(),
            country_n = $('#country_n').val()

        if (name == '') {
            error('Next of Kin First Name is invalid', $('#name'));
            return;
        }

        if (name_n_l == '') {
            error('Next of Kin Last Name is invalid', $('#name_n_l'));
            return;
        }

        if (email_n == '') {
            error('Next of Kin Email is invalid', $('#email_n'));
            return;
        }
        /* if (code == '' || code.length < 2) {
            error('Next of Kin Country Code is invalid', $('#code_n'));
            return;
        } */
        if (phone == '' || phone.length < 3) {
            error('Next of Kin Phone Number is invalid', $('#phone_n'));
            return;
        }
        if (gender_n == '' || !gender_n) {
            error('Next of Kin Gender is invalid', $('#gender_n'));
            return;
        }
        if (relationship_n == '' || !relationship_n) {
            error('Next of Kin Relationship is invalid', $('#relationship_n'));
            return;
        }
        if (address_n == '' || address_n.length < 3) {
            error('Next of Kin Address is invalid', $('#address_n'));
            return;
        }
        if (country_n == '' || country_n.length < 3) {
            error('Next of Kin Country is invalid', $('#country_n'));
            return;
        }

        Swal.fire({
            title: 'Updating Next Of Kin',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_next_of_kin.php',
            data: { data: [name, name_n_l, email_n, code, phone, gender_n, relationship_n, address_n, country_n] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s2('Next Of Kin Update')
                    $('.tab_item[data-tab="DiseaseCharacteristics"]').click()
                    $('.tab_item[data-tab="Specialization"]').click()
                } else {
                    e('Next Of Kin Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Next Of Kin Update')
            },
            error: function (data) {
                console.log(data)
                e('Next Of Kin Update')
            }
        })

    })
    // END OF NEXT OF KIN


    // START OF ANTHROPOMETRY
    $('.updatanthropometry').click(function (evt) {

        evt.preventDefault();

        var height = $('#height').val().replace("'", "foot"),
            weight = $('#weight').val(),
            bmi = $('#bmi').val(),
            waist = $('#waist').val(),
            head = $('#head').val()

        if (height == '') {
            error('Height is invalid', $('#height'));
            return;
        } else if (weight == '') {
            error('Weight is invalid', $('#weight'));
            return;
        } else if (bmi == '') {
            error('BMI is invalid', $('#bmi'));
            return;
        } else if (waist == '') {
            error('Waist is invalid', $('#waist'));
            return;
        } else if (head == '') {
            error('Head is invalid', $('#head'));
            return;
        }

        Swal.fire({
            title: 'Updating Anthropometry',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_anthropometry.php',
            data: { data: [height, weight, bmi, waist, head] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s2('Anthropometry Update')
                } else {
                    e('Anthropometry Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Anthropometry Update')
            },
            error: function (data) {
                console.log(data)
                e('Anthropometry Update')
            }
        })

    })
    // END OF ANTHROPOMETRY


    // START OF DISEASE CHARACTERISTICS
    $('.updatediseasecharactistics').click(function (evt) {

        evt.preventDefault();

        var age_when_diagnosed = $('#age_when_diagnosed').val(),
            initial_cancer = $('#initial_cancer').val(),
            histology = $('#histology').val(),
            cancer_grade = $('#cancer_grade').val(),
            cancer_stage = $('#cancer_stage').val(),
            comorbidity = $('#comorbidity').val(),
            isEditing = $(this).attr('data-editing') == 'true',
            patient_user_id = $(this).attr('data-patient')

        if (age_when_diagnosed == '') {
            error('Age when diagnosed is invalid', $('#age_when_diagnosed'));
            return;
        } else if (initial_cancer == '') {
            error('Initial Cancer is invalid', $('#initial_cancer'));
            return;
        } else if (histology == '') {
            error('Histology is invalid', $('#histology'));
            return;
        } else if (cancer_grade == '') {
            error('Cancer Grade is invalid', $('#cancer_grade'));
            return;
        } else if (cancer_stage == '') {
            error('Cancer Stage is invalid', $('#cancer_stage'));
            return;
        } else if (comorbidity == '') {
            error('Comorbidity is invalid', $('#comorbidity'));
            return;
        }

        Swal.fire({
            title: 'Updating Disease Characteristics',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_disease_characteristics.php?editing=' + isEditing + '&user_id=' + patient_user_id,
            data: { data: [age_when_diagnosed, initial_cancer, histology, cancer_grade, cancer_stage, comorbidity] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    Swal.fire({
                        title: 'Update successful',
                        type: 'success',
                        confirmButtonText: "Okay",
                        confirmButtonClass: "btn btn-success mt-2",
                        buttonsStyling: !1
                    }).then(() => {
                        $('.tab_item[data-tab="Anthropometry"]').click()
                        if(isEditing){
                            window.location.href = 'Hospital-Home'
                        }
                    })
                } else {
                    e('Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Update')
            },
            error: function (data) {
                console.log(data)
                e('Update')
            }
        })

    })
    // END OF ANTHROPOMETRY


    // START OF ADMIN

    $('.updateprofile_admin').click(function (evt) {

        evt.preventDefault();

        var fname = $('#fname').val(),
            lname = $('#lname').val(),
            code = $('#code').val(),
            phone = $('#phone').val(),
            email = $('#email').val()

        if (fname == '' || fname.length < 3) {
            error('First Name is invalid', $('#fname'));
            return;
        } else if (lname == '' || lname.length < 3) {
            error('Last Name is invalid', $('#lname'));
            return;
        }
        /* else if (code == '' || code.length < 2) {
            error('Country Code is invalid', $('#code'));
            return;
        }  */
        else if (phone == '' || phone.length < 3) {
            error('Phone Number is invalid', $('#phone'));
            return;
        } else if (!VALIDATE_EMAIL(email)) {
            error('Email address is invalid', $('#email'));
            return;
        }


        Swal.fire({
            title: 'Updating Profile',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: './API/api_profile_admin.php',
            data: { data: [fname, lname, code, phone, email] },
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.trim() == '1') {
                    s2('Profile Update')
                    $('.auth_name').text(fname + ' ' + lname)
                } else {
                    e('Profile Update')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Profile Update')
            },
            error: function (data) {
                console.log(data)
                e('Profile Update')
            }
        })

    })

    $('.open_contact').click(function () {
        Swal.fire({
            title: 'Contact Us',
            html: '<a target="_blank" href="mailto:research@oncopadi.com">research@oncopadi.com</a><br><a target="_blank" href="tel:+2348187527806">+234 818 752 7806</a><br><a target="_blank" href="tel:+2348035530802">+234 803 553 0802</a>',
            type: 'info'
        })
    })




    // END OF ADMIN

    function s(s) {
        Swal.fire({
            title: s + ' successful',
            type: 'success',
            html: "<sub style=\"color: red; text-transform: uppercase\">Reauthentication is required for changes to take effect<sub>",
            showCancelButton: !0,
            confirmButtonText: "Logout Now",
            cancelButtonText: "Later",
            confirmButtonClass: "btn btn-success mt-2",
            cancelButtonClass: "btn btn-danger ml-2 mt-2",
            buttonsStyling: !1
        }).then(function (t) {
            t.value ? window.location.href = '../Logout' :
                t.dismiss === Swal.DismissReason.cancel
        })
    }

    function s2(s) {
        Swal.fire({
            title: s + ' successful',
            type: 'success',
            confirmButtonText: "Okay",
            confirmButtonClass: "btn btn-success mt-2",
            buttonsStyling: !1
        })
    }

    function s3(s) {
        Swal.fire({
            title: s + ' successful',
            type: 'success',
            html: "<sub style=\"color: red; text-transform: uppercase\">We'll need to refresh for changes to take effect<sub>",
            confirmButtonText: "Okay",
            confirmButtonClass: "btn btn-success mt-2",
            buttonsStyling: !1
        }).then(function (t) {
            location.reload();
        })
    }

    function e(e) {
        Swal.fire({
            title: 'Oops',
            html: e + ' failed',
            type: 'error'
        })
    }

    function error(message, element) {
        if (element != '') {
            element.addClass('error')
            setTimeout(() => {
                element.removeClass('error')
            }, 3000);
        }
        Swal.fire({
            title: "Oops!",
            html: message,
            type: "warning",
        })
    }

    function VALIDATE_EMAIL(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var result = true
        if (!re.test(email)) {
            result = false
        }
        return result;
    }

    function VALIDATE_PASSWORD(password) {
        var re = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,16}$/;
        var result = true
        if (!re.test(password)) {
            result = false
        }
        return result;
    }

    $('.multi_select_dropdown').hide()
$("#comorbidity-dropdown").on('change', function() {
  const selectedOption = $(this).val()
 
  if (selectedOption.toLowerCase() === 'yes') {
   $('.multi_select_dropdown').show()
  }else{
    $('.multi_select_dropdown').hide()
  }
});

 // Handle checkbox selection and update the selected items
 $('.multi_select_list input[type="checkbox"]').on('change', function() {
    const selectedOptions = [];
    $('.multi_select_list input[type="checkbox"]:checked').each(function() {
        selectedOptions.push($(this).val()); // Collect all checked options
    });

    // Update the displayed selected items
    if (selectedOptions.length > 0) {
        $('#multi-select-input').val(selectedOptions.join(', '));
    } else {
        $('#multi-select-input').val('Select options');
    }
});

})