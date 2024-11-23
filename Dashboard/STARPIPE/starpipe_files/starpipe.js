$(document).ready(function () {

    const LOADER_TEXT = '<h3 style="width: 100%; text-align: center; margin-top: 50px">Loading...</h3>'

    $('.chakra-accordion__item:not(.no_dropdown)').on('click', function () {
        let t = $(this),
            thisButton = t.find('.chakra-accordion__button'),
            thisIcon = t.find('.chakra-accordion__icon'),
            thisCollapse = t.find('.chakra-collapse')

        const isExpanded = thisButton.attr('aria-expanded') == 'true'

        thisCollapse.attr('style', isExpanded ? 'overflow: hidden; display: none; opacity: 0; height: 0px;' : '')

        thisIcon.css('transform', `rotate(${isExpanded ? 0 : 180}deg)`)
        thisButton.attr('aria-expanded', !isExpanded)

    })

    $('#send_comment').click(function () {

        let comment = $('#new_comment_area').val().trim(),
            timestamp = new Date().getTime()

        if (comment == '') {
            Swal.fire({ title: 'Oops', html: 'Provide a comment', type: 'error' })
            return
        }

        if (!SECTION) {
            Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
            return
        }


        Swal.fire({
            title: 'Adding Comment',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        const formData = [SECTION, comment, timestamp]

        $.ajax({
            async: false,
            url: '../API/api_add_comment.php',
            data: { data: formData },
            type: 'POST',
            success: function (data) {
                if (data == '1') {
                    $('#new_comment_area').val('')
                    Swal.fire({ title: 'Success', html: 'Comment added successfully', type: 'success' })
                    loadComments()
                } else {
                    console.log(data)
                }
            },
            fail: function (data) {
                Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                console.log(data)
            },
            error: function (data) {
                Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                console.log(data)
            }
        })

    })


    function loadComments() {

        $('#main_comments_list').html(LOADER_TEXT)

        $.ajax({
            async: false,
            url: '../API/api_read_comments.php?id=' + SECTION,
            type: 'POST',
            success: function (data) {
                if (data != 0) {
                    $('#main_comments_list').html(data)
                }
                afterData()
            },
            fail: function (data) {
                console.log(data)
                e('Cannot retrieve complaints :/<br><sub>Try again later.</sub>')
            },
            error: function (data) {
                console.log(data)
                e('Cannot retrieve complaints :/<br><sub>Try again later.</sub>')
            }
        })

    }

    loadComments()

    function afterData() {

        $('#comment_count').html(`Comments (${$('#main_comments_list').find('.complaint_item_parent').length})`)

        $('.delete_comment').off('click').on('click', function () {

            const comment_id = $(this).attr('data-comment')

            Swal.fire({
                title: 'Delete Comment',
                html: 'Are you sure you want to delete this comment?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Proceed',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                buttonsStyling: true
            }).then(function (t) {
                t.value ? deleteComment() : t.dismiss === Swal.DismissReason.cancel
            })

            function deleteComment() {

                $.ajax({
                    async: false,
                    url: '../API/api_delete_comment.php?id=' + comment_id,
                    type: 'POST',
                    success: function (data) {
                        if (data == '1') {
                            Swal.fire({ title: 'Success', html: 'Comment deleted successfully', type: 'success' })
                            loadComments()
                        } else {
                            console.log(data)
                        }
                    },
                    fail: function (data) {
                        Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                        console.log(data)
                    },
                    error: function (data) {
                        Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                        console.log(data)
                    }
                })

            }
        })
    }

    $('#start_course').on('click', function () {
        window.location.href = './?SECTION=1&LESSON=1';
    })

    $('.video_holder, .video_holder iframe').css('min-height', 0.85 * $(window).height())

    $('.modal_trigger').on('click', function () {
        let t = $(this)
        target = t.attr('data-target')

        if (!target) return

        $(`.star_modal[data-id="${target}"]`).fadeIn().css('display', 'flex')
    })

    $('.modal_close span').on('click', function () {
        $(this).parent().parent().parent().fadeOut()
    })

    $('#get_certificate').on('click', function () {

        const name = $('#certificate_full_name').val()

        if (name == '') {
            Swal.fire({ title: 'Oops', html: 'Please provide your full name', type: 'error' })
            return
        }

        Swal.fire({
            title: 'Preparing Certificate',
            onBeforeOpen: function () { Swal.showLoading() }
        })

        $.ajax({
            async: false,
            url: '../API/api_update_starpipe_download.php?name=' + name,
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data.endsWith('1')) {
                    window.location.reload()
                } else {
                    Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                }
            },
            fail: function (data) {
                Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                console.log(data)
            },
            error: function (data) {
                Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                console.log(data)
            }
        })


    })

    SHOULD_DOWNLOAD_CERTIFICATE && generateCertificate()

    $('#download_certificate').on('click', function(){
        if($(`.star_modal[data-id="download_certificate"]`).length == 0){
            generateCertificate()   
        }
    })

})

let player;

function onYouTubeIframeAPIReady() {
    player = new YT.Player('player', {
        height: window.innerHeight * 0.85,
        width: window.innerWidth * (['', '8'].includes(SECTION) ? 0.79 : 0.85),
        videoId: VIDEO_ID,
        playerVars: {
            'playsinline': 1
        },
        events: {
            'onReady': onPlayerReady,
            'onStateChange': onPlayerStateChange
        }
    });
}

function onPlayerReady(event) {
    SHOULD_AUTOPLAY && event.target.playVideo();
}

let done = false

function onPlayerStateChange(event) {
    if (event.data == 0) {

        $.ajax({
            async: false,
            url: `../API/api_update_starpipe_progress.php`,
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data == '0') {
                    Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                    return
                }

                window.location.href = data;

            },
            fail: function (data) {
                Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                console.log(data)
            },
            error: function (data) {
                Swal.fire({ title: 'Oops', html: 'An error occurred', type: 'error' })
                console.log(data)
            }
        })
    }

    document.querySelector('button[data-dismiss="modal"]')?.addEventListener("click", function () {
        try {
            player.pauseVideo()
        } catch (e) {
            player.stopVideo()
        }
    })
}

// Load the YouTube Player API asynchronously
const tag = document.createElement('script')
tag.src = 'https://www.youtube.com/iframe_api'
const firstScriptTag = document.getElementsByTagName('script')[0]
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag)
