$(document).ready(function() {

    $('#cert_proceed').click(function(e) {

        e.preventDefault()

        let date = $('#date').val(),
            name = $('#name').val(),
            witness_name = $('#witness_name').val(),
            sendToEmail = $('#consent').is(':checked')

        if (!date || date == '') {
            error('Date is invalid', '')
            return
        }

        if (!name || name == '') {
            error('Please enter your name', '')
            return
        }

        if (!witness_name || witness_name == '') {
            error('Please enter your witness name', '')
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

        var formData = [AUTH, date, name, witness_name, sendToEmail.toString()]

        $.ajax({
            async: false,
            url: './STATIC_API/api_consent_cert.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    success('Success', 'Consent Form Signed')
                    setTimeout(() => {
                        window.location.href = './NewPatient?WithAuth='+AUTH
                    }, 2000);
                } else if (data == '2') {
                    error('Your request is invalid', '')
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
                error('An error occurred.<br>Please try again later', '')
            }
        })

    })

    $('#proceed').click(function(e) {

        e.preventDefault()

        var consent = $('#consent')

        if (!consent.is(':checked')) {
            error('You need to sign the consent form', '')
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

        var formData = [AUTH]

        $.ajax({
            async: false,
            url: './STATIC_API/api_consent.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    success('Success', 'Consent Form Signed')
                    setTimeout(() => {
                        // window.location.href = './NewPatient?WithAuth='+AUTH
                        // window.location.href = './UploadConsentForm?WithAuth='+AUTH
                        window.location.href = './ConsentCertificate?WithAuth='+AUTH
                    }, 2000);
                } else if (data == '2') {
                    error('Your request is invalid', '')
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