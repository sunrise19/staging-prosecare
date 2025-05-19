$(document).ready(function() {

    afterData()

    function afterData() {
        $('.delete-data').off('click')
        $('.delete-data').click(function() {
            var t = $(this).parent().parent(),
                id = t.attr('id'),
                user_id = t.attr('user-id'),
                title = t.find('td').eq(0).text() + ' &bull; ' + t.find('td').eq(1).text()

            Swal.fire({
                title: 'Delete HCP',
                html: '<b>' + title + '</b><br><sub style="color: #f44336; text-transform: uppercase">This action cannot be undone</sub>',
                type: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                buttonsStyling: !1
            }).then(function(t) {
                t.value ? deleleHCP(id, user_id, false) : t.dismiss === Swal.DismissReason.cancel
            })


        })


        function deleleHCP(id, user_id, hide_iframe) {

            Swal.fire({
                title: 'Deleting HCP',
                onBeforeOpen: function() { Swal.showLoading() }
            })

            var formData = [id, user_id]

            $.ajax({
                async: false,
                url: './API/api_hcp_delete.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        if (hide_iframe) {
                            hideIframe()
                        }
                        s('Deletion')
                    } else {
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }


        $('.view-data').off('click')
        $('.view-data').click(function() {
            $('.hcp_frame_back').slideDown()
            $('.main_table').slideUp()
            $('#hcp_frame').attr('src', './HCP-Fragment?id=' + $(this).attr('id'))

            $("#hcp_frame").on('load', function() {
                $(this).contents().on("click", function(e) {
                    if ($(e.target).hasClass('delete_profile')) {

                        var t = $(e.target),
                            id = t.attr('id'),
                            user_id = t.attr('user_id'),
                            title = t.siblings('.hcp_name').text()

                        Swal.fire({
                            title: 'Delete HCP',
                            html: '<b>' + title + '</b><br><sub style="color: #f44336; text-transform: uppercase">This action cannot be undone</sub>',
                            type: 'warning',
                            showCancelButton: !0,
                            confirmButtonText: 'Delete',
                            cancelButtonText: 'Cancel',
                            confirmButtonClass: 'btn btn-danger mt-2',
                            cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                            buttonsStyling: !1
                        }).then(function(t) {
                            t.value ? deleleHCP(id, user_id, true) : t.dismiss === Swal.DismissReason.cancel
                        })

                    }
                })
            })
        })

    }

    $('.hcp_frame_close').click(function() {
        hideIframe()
    })

    function hideIframe() {
        $('.hcp_frame_back').slideUp()
        $('.main_table').slideDown()
        $('#hcp_frame').attr('src', '')
    }

    function loadData() {
        window.location.reload()
    }

    function clearForm() {
        $('input,textarea').val('')
        $('select').find('option').attr('selected', false)
        $('select').find('option').first().attr('selected', true)
    }

    function s(s) {
        clearForm()
        loadData()
        Swal.fire({
            title: s + ' successful',
            type: 'success'
        })
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


    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

})