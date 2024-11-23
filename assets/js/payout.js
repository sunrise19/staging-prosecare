$(document).ready(function() {

    // Trigger Paystack modal when 'Pay Now' is clicked
    $('#proceed').click(function(e) {
        e.preventDefault();

        var amount = $('#amount').val();

        if (amount == '') {
            error('Kindly enter an amount', $('#amount').parent());
            return;
        }

        Swal.fire({
            title: "Processing",
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        });

        var formData = [amount];
console.log("formData: ", formData)
        $.ajax({
            async: false,
            url: '../../STATIC_API/api_payment.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                var response = JSON.parse(data); // Parse the JSON response from the server

                if (response.status === 'success') {
                    // Handle success: redirect to Paystack authorization URL
                    window.location.href = response.url; // Redirect to Paystack URL
                } else {
                    // Handle error: show error message
                    error(response.message || 'An error occurred.<br>Please try again later');
                }
            },
            fail: function(data) {
                console.log(data);
                error('This is really weird.<br>Please try again later', '');
            }
        });
    });

});
