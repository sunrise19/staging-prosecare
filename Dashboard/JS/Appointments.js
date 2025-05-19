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

    $('.open_report').on('click', function () {
        let t = $(this),
            thisReportDetails = t.siblings('.report_details')
        if (thisReportDetails.hasClass('d-none')) {
            $('.report_details').addClass('d-none')
            $('.open_report').removeClass('open')
            thisReportDetails.removeClass('d-none')
            t.addClass('open')
        } else {
            $('.open_report').removeClass('open')
            $('.report_details').addClass('d-none')
        }
    })

    loadAppointments()

    function loadAppointments() {
        $.ajax({
            async: false,
            url: './API/api_appointments_read.php',
            type: 'POST',
            success: function (data) {
                data != 0 && processData(JSON.parse(data))
            },
            fail: function (data) {
                console.log(data)
                e('Cannot retrieve appointments :/<br><sub>Try again later.</sub>')
            },
            error: function (data) {
                console.log(data)
                e('Cannot retrieve appointments :/<br><sub>Try again later.</sub>')
            }
        })
    }

    function processData(data) {

        $('.appointment_entries').empty()

        data.forEach(element => {
            const status = element[0],
                elementData = element[1]

            $(`.tab_container.${status} .appointment_entries`).append(elementData)

        })

        afterData()
    }

    function afterData() {

        $('.tab_container').each(function () {
            let emptyIndicator = $(this).find('.empty')
            if ($(this).find('.appointment_entries .log_entry').length < 1) {
                emptyIndicator.removeClass('d-none')
            } else {
                emptyIndicator.addClass('d-none')
            }
        })

        $('.view_report').off('click').on('click', function () {
            $('.treament_modal_content').css('background', '#F9F9F9')
            $('.treatment_frame').attr('src', `Appointment-Report-Fragment?id=${$(this).attr('data-id')}`)
            $('.treament_modal_title').text('Consultation Summary')
            $('.treament_modal').fadeIn()
        })

        $('.remove_prescription').off('click').on('click', function () {
            $(this).parent().parent().parent().remove()
            checkPresciptionStyle()
        })


        $('.action_button.accept').on('click', function () {
            Swal.fire({
                title: 'Accepting Appointment',
                allowOutsideClick: false,
                onBeforeOpen: function () { Swal.showLoading() }
            })

            $.ajax({
                url: './API/api_accept_decline_appointment.php?type=Upcoming&id=' + $(this).attr('data-id'),
                type: 'POST',
                success: function (data) {
                    if (data == 1) {
                        s('Appointment accepted successfully')
                    } else {
                        console.log(data)
                        e('Failed to accept appointment:/<br><sub>Try again later.</sub>')
                    }
                },
                fail: function (data) {
                    console.log(data)
                    e('Failed to accept appointment:/<br><sub>Try again later.</sub>')
                },
                error: function (data) {
                    console.log(data)
                    e('Failed to accept appointment:/<br><sub>Try again later.</sub>')
                }
            })
        })

        $('.action_button.decline').on('click', function () {
            Swal.fire({
                title: 'Declining Appointment',
                allowOutsideClick: false,
                onBeforeOpen: function () { Swal.showLoading() }
            })

            $.ajax({
                url: './API/api_accept_decline_appointment.php?type=Declined&id=' + $(this).attr('data-id'),
                type: 'POST',
                success: function (data) {
                    if (data == 1) {
                        s('Appointment declined successfully')
                    } else {
                        console.log(data)
                        e('Failed to decline appointment:/<br><sub>Try again later.</sub>')
                    }
                },
                fail: function (data) {
                    console.log(data)
                    e('Failed to decline appointment:/<br><sub>Try again later.</sub>')
                },
                error: function (data) {
                    console.log(data)
                    e('Failed to decline appointment:/<br><sub>Try again later.</sub>')
                }
            })
        })

        $('.action_button.cancel').on('click', function () {
            Swal.fire({
                title: 'Cancelling Appointment',
                allowOutsideClick: false,
                onBeforeOpen: function () { Swal.showLoading() }
            })

            $.ajax({
                url: './API/api_accept_decline_appointment.php?type=Declined&id=' + $(this).attr('data-id'),
                type: 'POST',
                success: function (data) {
                    if (data == 1) {
                        s('Appointment cancelled successfully')
                    } else {
                        console.log(data)
                        e('Failed to cancel appointment:/<br><sub>Try again later.</sub>')
                    }
                },
                fail: function (data) {
                    console.log(data)
                    e('Failed to cancel appointment:/<br><sub>Try again later.</sub>')
                },
                error: function (data) {
                    console.log(data)
                    e('Failed to cancel appointment:/<br><sub>Try again later.</sub>')
                }
            })
        })

        $('.action_button.reschedule').on('click', function () {
            Swal.fire({
                title: 'Rescheduling Appointment',
                allowOutsideClick: false,
                onBeforeOpen: function () { Swal.showLoading() }
            })

            $.ajax({
                url: './API/api_accept_decline_appointment.php?type=Pending&id=' + $(this).attr('data-id'),
                type: 'POST',
                success: function (data) {
                    if (data == 1) {
                        s('Appointment rescheduled successfully')
                    } else {
                        console.log(data)
                        e('Failed to reschedule appointment:/<br><sub>Try again later.</sub>')
                    }
                },
                fail: function (data) {
                    console.log(data)
                    e('Failed to reschedule appointment:/<br><sub>Try again later.</sub>')
                },
                error: function (data) {
                    console.log(data)
                    e('Failed to reschedule appointment:/<br><sub>Try again later.</sub>')
                }
            })
        })

    }

    function checkPresciptionStyle() {
        $('.prescription_item').first().removeClass('bordered')
        $('.add_prescription span').text('Add ' + ($('.prescription_item').length > 0 ? 'another' : 'a') + ' prescription')
    }

    checkPresciptionStyle()


    $('.my_schedule').off('click').on('click', function () {
        $('.treament_modal_content').css('background', '#FFF')
        $('.treatment_frame').attr('src', 'Doctor-Shedule-Fragment')
        $('.treament_modal_title').text('My Schedule')
        $('.treament_modal').fadeIn()
    })

    $('.book_an_appointment').off('click').on('click', function () {
        $('.treament_modal_content').css('background', '#FFF')
        $('.treatment_frame').attr('src', 'AppointmentModal')
        $('.treament_modal_title').text('Book an Appointment')
        $('.treament_modal').fadeIn()
    })

    $('.close_treament_modal').on('click', function () {
        $('.treatment_frame').attr('src', '')
        $('.treament_modal').fadeOut()
        loadAppointments()
    })


    $('.submit_report').on('click', function () {

        const patient_complaint = $('.patient_complaint').val(),
            observations = $('.observations').val(),
            diagnosis = $('.diagnosis').val(),
            recommended_tests = $('.recommended_tests').val()

        let prescription = []

        $('.prescription_item').each(function () {
            let t = $(this)
            prescription.push({
                dosage_form: t.find('.dosage_form').text(),
                drug_name: t.find('.drug_name').text(),
                drug_strength: t.find('.drug_strength').text(),
                frequency: t.find('.frequency').text(),
                duration: t.find('.duration').text(),
            })
        })

        Swal.fire({
            title: 'Submitting Report',
            allowOutsideClick: false,
            onBeforeOpen: function () { Swal.showLoading() }
        })

        const formData = {
            id: APPOINTMENT_ID,
            hcp_id: HCP_ID,
            patient_id: PATIENT_ID,
            patient_complaint: patient_complaint,
            observations: observations,
            diagnosis: diagnosis,
            recommended_tests: recommended_tests,
            prescription: JSON.stringify(prescription),
        }

        $.ajax({
            url: './API/api_submit_report.php',
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data == 1) {
                    Swal.fire({
                        title: 'Report Submitted Successfully',
                        type: 'success'
                    })
                } else {
                    console.log(data)
                    e('Failed to submit report:/<br><sub>Try again later.</sub>')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Failed to submit report:/<br><sub>Try again later.</sub>')
            },
            error: function (data) {
                console.log(data)
                e('Failed to submit report:/<br><sub>Try again later.</sub>')
            }
        })

    })


    $('.add_prescription').on('click', function () {
        const style = $('.prescriptions_list').last().find('.prescription_item').length > 0 ? 'bordered' : ''
        const newPrescription = `
            <div class="prescription_item ${style}">
                <div class="l2r" style="gap: 20px;">
                    <div class="t2b w-100">
                        <span class="se_title">Dosage Form</span>
                        <span class="se_status dosage_form" contenteditable="true"></span>
                    </div>
                    <div class="t2b w-100">
                        <span class="se_title">Drug Name</span>
                        <span class="se_status drug_name" contenteditable="true"></span>
                    </div>
                    <div class="t2b w-100">
                        <span class="se_title">Drug Strength</span>
                        <span class="se_status drug_strength" contenteditable="true"></span>
                    </div>
                </div>
                <div class="l2r" style="gap: 20px">
                    <div class="t2b w-100">
                        <span class="se_title">Frequency</span>
                        <span class="se_status frequency" contenteditable="true"></span>
                    </div>
                    <div class="t2b w-100">
                        <span class="se_title">Duration</span>
                        <span class="se_status duration" contenteditable="true"></span>
                    </div>
                    <div class="t2b w-100">
                        <div class="l2r remove_prescription">
                            <i class="bx bx-trash"></i>
                            Remove Prescription
                        </div>
                    </div>
                </div>
            </div>
        `
        $('.prescriptions_list').last().append(newPrescription)
        checkPresciptionStyle()
        afterData()
    })

    function s(s) {
        loadAppointments()
        Swal.fire({
            title: s,
            type: 'success'
        })
    }

    function e(e) {
        Swal.fire({
            title: 'Oops',
            html: e,
            type: 'error'
        })
    }

})