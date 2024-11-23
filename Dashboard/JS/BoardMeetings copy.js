$(document).ready(function() {

    $.ajax({
        url: 'https://graph.microsoft.com/v1.0/me/onlineMeetings',
        data: {
            "startDateTime": "2019-07-12T14:30:34.2444915-07:00",
            "endDateTime": "2019-07-12T15:00:34.2464912-07:00",
            "subject": "User Token Meeting"
        },
        type: 'POST',
        success: function(data) {
            console.log(data)
        }
    })

    loadFilter()
    loadData()

    ZoomMtg.preLoadWasm();
    ZoomMtg.prepareWebSDK();
    // loads language files, also passes any error messages to the ui
    ZoomMtg.i18n.load('en-US');
    ZoomMtg.i18n.reload('en-US');

    ZoomMtg.setZoomJSLib('https://source.zoom.us/2.0.1/lib', '/av');


    var YEAR_MIN = new Date().getFullYear(),
        YEAR_MAX = YEAR_MIN + 10

    timepickerInit($('#time'), "#timepicker")
    timepickerInit($('#endtime'), "#endtimepicker")

    function timepickerInit(elem, target) {
        elem.timepicker({ minuteStep: 5, icons: { up: "mdi mdi-chevron-up", down: "mdi mdi-chevron-down" }, appendWidgetTo: target })
    }

    if (window.location.href.indexOf('#Create') > -1) {
        $('#addModal').modal('show')
    }

    $('.output_dropdown').click(function() {

        var t = $(this)

        if (t.hasClass('bx-chevron-down')) {
            t.parent().siblings('.input').slideDown()
            t.addClass('bx-chevron-up').removeClass('bx-chevron-down')
        } else {
            t.parent().siblings('.input').slideUp()
            t.addClass('bx-chevron-down').removeClass('bx-chevron-up')
        }

    })

    $('.input_item').click(function() {

        var t = $(this),
            id = t.attr('data-id'),
            email = t.text(),
            output = t.parent().siblings('.output').find('.output_contents'),
            data = '<div class="output_data" data-id="' + id + '">' + email + '<i class="remove_data bx bx-x"></i></div>'

        if (t.hasClass('picked')) {
            output.find('[data-id="' + id + '"]').remove()
            t.removeClass('picked')
        } else {
            output.append(data)
            t.addClass('picked')
            $('.remove_data').off('click')
            $('.remove_data').click(function() {
                var tParent = $(this).parent()
                $('.input_item[data-id="' + tParent.attr('data-id') + '"]').removeClass('picked')
                tParent.remove()
                recolor()
            })
        }

        recolor()

        function recolor() {
            t.parent().siblings('.output').css('color', $('.output_data').length > 0 ? 'transparent' : '#495057')
        }

    })


    $('.email_input').keydown(function(e) {

        var t = $(this),
            v = $(this).val()

        if (e.keyCode === 13) {
            var output = t.parent().siblings('.output').find('.output_contents'),
                data = '<div class="output_data">' + v + '<i class="remove_data bx bx-x"></i></div>'
            if (VALIDATE_EMAIL(v)) {

                output.append(data)

                t.val('')

                $('.remove_data').off('click')
                $('.remove_data').click(function() {
                    var tParent = $(this).parent()
                    $('.input_item[data-id="' + tParent.attr('data-id') + '"]').removeClass('picked')
                    tParent.remove()
                    recolor()
                })

            } else {
                Swal.fire({
                    title: "Oops!",
                    html: "Email address is invalid",
                    type: "warning",
                })
            }
        }

        recolor()

        function recolor() {
            t.parent().siblings('.output').css('color', $('.output_data').length > 0 ? 'transparent' : '#495057')
        }

    }).keyup(function() {

        var t = $(this),
            v = $(this).val()

        if (v != '') {
            t.siblings('.input_item').each(function() {
                $(this).text().indexOf(v) > -1 ? $(this).css('display', 'inline-block') : $(this).hide()
            })
        } else {
            t.siblings('.input_item').hide()
        }
    })


    $('#refresh').click(function() {
        loadData()
    })

    $('.shower').change(function() {
        var style = $('#dynamic_style'),
            filter = $(this).val().toLowerCase()
        if (filter == 'all') {
            style.empty()
            window.history.replaceState(null, 'BoardMeetings', './BoardMeetings');
        } else if (filter == 'pending' || filter == 'upcoming' || filter == 'ongoing' || filter == 'completed') {
            style.html('.data-entry{display:none; transform: scale(0); position: absolute;} .data-entry.' + filter + '{display:table-row; transform: scale(1); position: relative;}')
            window.history.replaceState(null, 'BoardMeetings', '?WithFilter=' + capitalizeFirstLetter(filter));
        }
    })

    $('#add-data').click(function() {

        var name = $('#name').val(),
            date = $('#date').val(),
            time = $('#time').val(),
            endtime = $('#endtime').val(),
            description = $('#description').val(),
            reminder = $('#reminder').val(),
            access_type = $('#access_type').val(),
            chairpersons_email = $('#chairpersons_email'),
            participants_email = $('#participants_email'),
            patients_email = $('#patients_email')



        if (name == '') {
            error('Provide Meeting Name', $('#name'));
            return;
        } else if (name.length < 2 || name.length > 100) {
            error('Meeting Name is invalid<br><sub>Must be more than <b>' + (1) +
                '</b> and less than <b>' + (100) + '</b> characters</sub>', $('#name'))
            return
        } else if (date == '') {
            error('Provide Meeting Date', $('#date'));
            return;
        } else if (time == '') {
            error('Provide Meeting Time', $('#time'));
            return;
        } else if (endtime == '') {
            error('Provide Meeting End Time', $('#endtime'));
            return;
        } else if (description == '') {
            error('Provide Meeting Description', $('#description'));
            return;
        } else if (description.length < 10 || description.length > 400) {
            error('Meeting Description is invalid<br><sub>Must be more than <b>' + (10) +
                '</b> and less than <b>' + (400) + '</b> characters</sub>', $('#description'))
            return
        } else if (reminder == '' || reminder == null) {
            error('Provide reminder', $('#reminder'))
            return
        } else if (access_type == '' || access_type == null) {
            error('Provide an access type', $('#access_type'))
            return
        } else if (chairpersons_email.find('.output_data').length < 1) {
            error('Provide a Chairperson', chairpersons_email.parent())
            return
        } else if (participants_email.find('.output_data').length < 1) {
            error('Provide a Participant', participants_email.parent())
            return
        } else if (patients_email.find('.output_data').length < 1) {
            error('Provide a Patient', patients_email.parent())
            return
        }

        chairpersons_email = ''
        participants_email = ''
        patients_email = ''

        $('#chairpersons_email').find('.output_data').each(function() {
            chairpersons_email += $(this).text() + ','
        })

        $('#participants_email').find('.output_data').each(function() {
            participants_email += $(this).text() + ','
        })

        $('#patients_email').find('.output_data').each(function() {
            patients_email += $(this).text() + ','
        })


        Swal.fire({
            title: 'Creating Meeting',
            onBeforeOpen: function() { Swal.showLoading() }
        })

        $('#addModal,#editModal').modal('hide')

        var formData = [name, date, time, description, reminder, access_type, endtime, chairpersons_email, participants_email, patients_email]

        $.ajax({
            async: false,
            url: './API/api_boardmeetings_create.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) { data == '1' ? s('Meeting Creation') : e(data) },
            fail: function(data) { e(data) },
            error: function(data) { e(data) }
        })
    })

    function afterData() {
        $('.delete-data').off('click')
        $('.delete-data').click(function() {
            var t = $(this).parent().parent(),
                id = t.attr('id'),
                title = t.find('td').eq(2).text()

            Swal.fire({
                title: 'Delete Board Meeting',
                html: '<b>' + title + '</b><br><sub style="color: #f44336; text-transform: uppercase">This action cannot be undone</sub>',
                type: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? del() : t.dismiss === Swal.DismissReason.cancel
            })

            function del() {

                Swal.fire({
                    title: 'Deleting Board Meeting',
                    onBeforeOpen: function() { Swal.showLoading() }
                })

                var formData = [id]

                $.ajax({
                    async: false,
                    url: './API/api_boardmeetings_delete.php',
                    data: { data: formData },
                    type: 'POST',
                    success: function(data) { data == '1' ? s('Deletion') : e(data) },
                    fail: function(data) { e(data) },
                    error: function(data) { e(data) }
                })

            }
        })


        $('.join-meeting').off('click')
        $('.join-meeting').click(function() {

            var t = $(this),
                mn = t.attr('data-mn'),
                meetingNumber = Number(mn + mn + mn) * 2,
                userEmail = t.attr('data-email'),
                userPassword = t.attr('data-password'),
                frame = $('#video_conf_frame')

            $('.video_conf_frame_back').fadeIn()
            frame.attr('src', 'https://peercalls.com/call/' + meetingNumber)

            frame.load(function() {
                var contents = $(this).contents()
                contents.find('input[name="nickname"]').val(AUTH_NAME)
            })

            // window.open('https://peercalls.com/call/' + meetingNumber, '_blank');

        })


        /*
        $('.join-meeting').off('click')
        $('.join-meeting').click(function() {

            var t = $(this),
                meetingNumber = Number(t.attr('data-mn') + t.attr('data-mn') + t.attr('data-mn')) * 2,
                userEmail = t.attr('data-email'),
                userPassword = t.attr('data-password')

            console.log(meetingNumber)
            console.log(userEmail)
            console.log(userPassword)

            $.ajax({
                type: 'POST',
                url: 'https://oncopadi.herokuapp.com/',
                data: {
                    "meetingNumber": meetingNumber,
                    "role": 0
                },
                success: function(data) {
                    var signature = data.signature

                    console.log(signature)

                    ZoomMtg.init({
                        debug: true,
                        leaveUrl: './Thanks-For-Joining',
                        isSupportAV: true,
                        disablePreview: true,
                        success: (success) => {

                            console.log(success)

                            $('#zmmtg-root').show()

                            ZoomMtg.join({
                                signature: signature,
                                apiKey: 'q7n3ZDIvSVaCMQ2a84wnrw',
                                meetingNumber: meetingNumber,
                                userName: userEmail,
                                passWord: userPassword,
                                success: (success) => {
                                    console.log(success)
                                },
                                error: (error) => {
                                    console.log(error)
                                }
                            })

                        },
                        error: (error) => {
                            console.log(error)
                        }
                    })
                },
            })


        })

        */
    }

    function loadData() {

        $.ajax({
            async: false,
            url: './API/api_boardmeetings_read.php',
            type: 'POST',
            success: function(data) {
                $('.main_output').html(data)
                afterData()
            },
            fail: function(data) {
                console.log(data)
                $('.main_output').html('<td>Oops!</td><td>Data retrieval failed :/</td>')
            },
            error: function(data) {
                console.log(data)
                $('.main_output').html('<td>Oops!</td><td>An error occurred :/</td>')
            }
        })

    }

    function clearForm() {
        $('input,textarea').val('')
        $('select').find('option').attr('selected', false)
        $('select').find('option').first().attr('selected', true)
    }

    function s(s) {
        Swal.fire({
            title: s + ' successful',
            type: 'success'
        })
        clearForm()
        loadData()
    }

    function e(e) {
        console.log(e)
        Swal.fire({
            title: 'Oops',
            html: 'Deletion Failed',
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

    function loadFilter() {
        const urlParams = new URLSearchParams(window.location.search);
        const filter = urlParams.get('WithFilter') != null ? urlParams.get('WithFilter').toLowerCase() : urlParams.get('WithFilter')
        var style = $('#dynamic_style')

        if (filter != null) {
            if (filter == 'pending' || filter == 'upcoming' || filter == 'ongoing' || filter == 'completed') {
                style.html('.data-entry{display:none; transform: scale(0); position: absolute;} .data-entry.' + filter + '{display:table-row; transform: scale(1); position: relative;}')
                $('.shower').find('option').attr('selected', false)
                $('.shower').find('option').each(function() {
                    if ($(this).attr('value') == filter) {
                        $(this).attr('selected', true)
                        return
                    }
                })
            }
        }
    }

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    function VALIDATE_EMAIL(email) {
        var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        var result = true
        if (!re.test(email)) {
            result = false
        }
        return result;
    }

})