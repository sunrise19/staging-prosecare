$(document).ready(function () {

    afterData()

    try{
        $('.type_'+CANCER_TYPE).removeClass('to_remove')   
        $('.to_remove').remove()   
    }catch(e){}

    function afterData() {
        $('.delete-data').off('click')
        $('.delete-data').click(function () {
            var t = $(this).parent().parent(),
                id = t.attr('id'),
                user_id = t.attr('user-id'),
                title = t.find('td').eq(0).text() + ' &bull; ' + t.find('td').eq(1).text()

            Swal.fire({
                title: 'Delete Patient',
                html: '<b>' + title + '</b><br><sub style="color: #f44336; text-transform: uppercase">This action cannot be undone</sub>',
                type: 'warning',
                showCancelButton: !0,
                confirmButtonText: 'Delete',
                cancelButtonText: 'Cancel',
                confirmButtonClass: 'btn btn-danger mt-2',
                cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                buttonsStyling: !1
            }).then(function (t) {
                t.value ? deleteHCP(id, user_id, false) : t.dismiss === Swal.DismissReason.cancel
            })


        })


        function deleteHCP(id, user_id, hide_iframe) {

            Swal.fire({
                title: 'Deleting Patient',
                onBeforeOpen: function () { Swal.showLoading() }
            })

            var formData = [id, user_id]

            console.log(formData)

            $.ajax({
                async: false,
                url: './API/api_patient_delete.php',
                data: { data: formData },
                type: 'POST',
                success: function (data) {
                    if (data == '1') {
                        if (hide_iframe) {
                            hideIframe()
                        }
                        s('Deletion')
                    } else {
                        console.log('Failed here')
                        e(data)
                    }
                },
                fail: function (data) { e(data) },
                error: function (data) { e(data) }
            })

        }


        $('.view-data').off('click').click(function () {

            let user_id = $(this).attr('id'),
                name = $(this).attr('data-name')

            Swal.fire({
                type: 'info',
                title: 'View More',
                html: '<span class="font-size-15">Select what info you want to view for <b>' + name + '</b></span>',
                showDenyButton: true,
                showCancelButton: true,
                confirmButtonText: 'Side Effects',
                denyButtonText: 'Profile',
                cancelButtonText: 'Treatments',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $('.snt').text('PATIENT SIDE EFFECTS')
                    profile(user_id, 'Patient-SE-Fragment', name)
                } else if (result.isDenied) {
                    $('.snt').text('PATIENT PROFILE')
                    profile(user_id, 'Patient-Fragment', name)
                } else {
                    $('.snt').text('PATIENT TREATMENTS')
                    profile(user_id, 'Patient-T-Fragment', name)
                    // Swal.fire(
                    //     'Good job!',
                    //     'You clicked the button!',
                    //     'success'
                    // )
                }
            })


            function profile(id, page, name) {
                $('.hcp_frame_back').slideDown()
                $('.main_table').slideUp()
                $('#hcp_frame').attr('src', './' + page + '?id=' + id + '&name=' + name)

                $("#hcp_frame").on('load', function () {
                    $(this).contents().on("click", function (e) {
                        if ($(e.target).hasClass('delete_profile')) {

                            var t = $(e.target),
                                id = t.attr('id'),
                                user_id = t.attr('user_id'),
                                title = t.siblings('.hcp_name').text()

                            Swal.fire({
                                title: 'Delete Patient',
                                html: '<b>' + title + '</b><br><sub style="color: #f44336; text-transform: uppercase">This action cannot be undone</sub>',
                                type: 'warning',
                                showCancelButton: !0,
                                confirmButtonText: 'Delete',
                                cancelButtonText: 'Cancel',
                                confirmButtonClass: 'btn btn-danger mt-2',
                                cancelButtonClass: 'btn btn-secondary ml-2 mt-2',
                                buttonsStyling: !1
                            }).then(function (t) {
                                t.value ? deleteHCP(id, user_id, true) : t.dismiss === Swal.DismissReason.cancel
                            })

                        }
                    })
                })
            }
        })

    }

    $('.treatment_item').on('click', function(){
        $('.treatment_frame').attr('src', `${$(this).attr('data-frame')}?id=${USER_ID}`)
        $('.treament_modal_title').text($(this).text())
        $('.treament_modal').removeClass('sm').fadeIn()
    })

    $('.assign_patient').off('click').on('click', function () {
        $('.treament_modal_content').css('background', '#FFF')
        $('.treatment_frame').attr('src', `AssignPatientModal?PatientUserID=${USER_ID}`)
        $('.treament_modal_title').text('Assign Patient')
        $('.treament_modal').addClass('sm').fadeIn()
    })

    $('.close_treament_modal').on('click', function(){
        $('.treatment_frame').attr('src', '')
        $('.treament_modal').fadeOut()
    })

    $('.hcp_frame_close').click(function () {
        hideIframe()
    })

    function hideIframe() {
        $('.hcp_frame_back').slideUp()
        $('.main_table').slideDown()
        $('#hcp_frame').attr('src', '')
        $('.snt').text('ALL PATIENTS')
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

    $(".exportToExcel").click(function () {

        let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
            name: 'PROSE CARE PATIENTS.xlsx', // fileName you could use any name
            sheet: {
                name: 'Sheet 1' // sheetName
            }
        });
    });

    $('.exportToPDF').click(function () {

        $('title').html('PROSE CARE PATIENTS')

        $('.print-header').show()
        $('.sweetselect,input').addClass('noborder')

        try {
            document.execCommand('print', false, null);
        }
        catch (e) {
            window.print();
        }

        $('.print-header').hide()
        $('.sweetselect,input').removeClass('noborder')

    })

    $('.toggle_data').click(function () {
        $('.s_toggle').toggle()
    })

    $('.tab_item').on('click', function () {
        let t = $(this),
            tab = t.attr('data-tab')

        if (!tab) return

        $('.tab_item').removeClass('active')
        t.addClass('active')

        $('.tab_container').hide()
        $('.tab_container.' + tab).show()
    })

    let colors = {
        None: '#001B29',
        Mild: '#27AE60',
        Moderate: '#FF9409',
        Severe: '#EB5757',
        Other: '#8d2d90',
        _empty: '#ced4da'
        }

    $('#datepicker').datepicker({
        dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
        maxDate: new Date(),
        changeMonth: true,
        changeYear: true,
        showAnim: '',
        dateFormat: 'd M, yy',
        monthNamesShort: $.datepicker?.regional["en"].monthNames,
        afterAdjustDate: function(item){
            alert(item);
        },
        onChangeMonthYear: function (item) {
            loadSideEffects()
        },
        onSelect: function(selectedDate) {
            loadSideEffects()
        }
    })


    // $('#datepicker').datepicker({
    //     dayNamesMin: ["S", "M", "T", "W", "T", "F", "S"],
    //     maxDate: TODAY
    // });


    // $('#datepicker').datepicker("option", "changeMonth", true);
    // $('#datepicker').datepicker("option", "changeYear", true);
    // $('#datepicker').datepicker("option", "dateFormat", "d M, yy"); /** dateFormat: 'dd MM yy' */
    // $('#datepicker').datepicker("option", "showAnim", "");
    // $('#datepicker').datepicker("option", "monthNamesShort", $.datepicker.regional["en"].monthNames);


    // $('#datepicker').on('click', function () {
    //     loadSideEffects()
    // })

    function loadSideEffects() {

        $.ajax({
            async: false,
            url: './API/api_side_effects_read.php?id='+USER_ID+'&patient_id='+PATIENT_ID,
            type: 'POST',
            success: function (data) {
                console.log(data)
                if (data != 0) {
                    processData(JSON.parse(data))
                    setTimeout(() => {
                        processData(JSON.parse(data))
                    }, 1000);
                    log('Viewed Saved Side Effects', 'View')
                }
            },
            fail: function (data) {
                console.log(data)
                e('Cannot retrieve side effects :/<br><sub>Try again later.</sub>')
            },
            error: function (data) {
                console.log(data)
                e('Cannot retrieve side effects :/<br><sub>Try again later.</sub>')
            }
        })

        function processData(data) {
            // console.log(data)


            data.forEach(item => {

                let id = item[0],
                    arr = item[1].split('-'),
                    day = arr[0],
                    month = arr[1],
                    year = arr[2]

                    // console.log(day, month, year, $('.ui-datepicker-calendar a').length)

                    $('.ui-datepicker-calendar a').each(function () {
                        let t = $(this),
                            p = t.parent(),
                            this_day = t.text(),
                            this_month = p.attr('data-month'),
                            this_year = p.attr('data-year')
                        
                        t.removeAttr('href')

                        if (
                            this_day === day
                            &&
                            this_month === month
                            &&
                            this_year === year
                        ) {
                            t.addClass('ui-state-default ui-state-highlight has_side_effect')
                            t.attr('id', id)
                        }
                    })

            });


            afterData()
        }

        function afterData() {

            $('td').off('click').on('click', function () {
                let target = $(this).find('a'),
                    id = target.attr('id')

                console.log(target.hasClass('has_side_effect'))

                if (target.hasClass('has_side_effect')) {
                    getSavedSideEffects(id)
                    ACTIVE_SIDE_EFFECT_ID = id
                    $('#add-data').hide()
                    $('#update-data').show()
                    $('.empty_state').hide()
                    $('.side_effect_items').show()
                } else {
                    $('.empty_state').show()
                    $('.side_effect_items').hide()
                    $('.es_message').text('No side effects logged on this day.')
                    $('.start_log').show()
                    ACTIVE_SIDE_EFFECT_ID = ''
                    $('a').removeClass('ui-state-active')
                    target.addClass('ui-state-active')
                    clearForm()
                    $('#add-data').show()
                    $('#update-data').hide()
                }
            })

        }

        function getSavedSideEffects(id) {

            let URL = 'api_side_effects_get_one'

            if (CANCER_TYPE == 'breast') { URL = 'api_side_effects_get_one_breast' }
            else if (CANCER_TYPE == 'head_and_neck') { URL = 'api_side_effects_get_one_head_and_neck' }
            else if (CANCER_TYPE == 'female_pelvic') { URL = 'api_side_effects_get_one_female_pelvic' }
            else if (CANCER_TYPE == 'male_pelvic') { URL = 'api_side_effects_get_one_male_pelvic' }

            $.ajax({
                async: false,
                url: './API/' + URL + '.php?id=' + id+'&user='+USER_ID+'&patient_id='+PATIENT_ID,
                type: 'POST',
                success: function (data) {
                    console.log(data)
                    if (data != 0) {
                        applyRetrievedData(JSON.parse(data))
                    }
                },
                fail: function (data) {
                    console.log(data)
                    e('Cannot retrieve side effects :/<br><sub>Try again later.</sub>')
                },
                error: function (data) {
                    console.log(data)
                    e('Cannot retrieve side effects :/<br><sub>Try again later.</sub>')
                }
            })

        }

        function applyRetrievedData(data) {

            $('.current-state').html('Details of Saved Side Effects').hide()
            // $('.sub-state').html('Side effects logged on ' + data[2] + '</b> at <b>' + data[3] + '</b>')
            $('.sub-state').html('Side effects logged on ' + data[2])

            if (CANCER_TYPE == 'breast') {
                selectOption('#b_hair_loss', data[4])
                selectOption('#b_arm_swelling', data[5])
                selectOption('#b_swallowing_difficulty', data[6])
                selectOption('#b_chest_pain', data[7])
                selectOption('#b_breast_swelling', data[8] != 'None' ? 'other' : 'None')
                $('#b_breast_swelling_other').focus().val(data[8] != 'None' ? data[8] : '').blur()
                selectOption('#b_breast_pain', data[9])
                selectOption('#b_sensation_loss', data[10])
                selectOption('#b_skin_color', data[11])
                selectOption('#b_tired_or_weak', data[12])
                $('#b_weight').focus().val(data[13]).blur()
                $('#b_hb').focus().val(data[14]).blur()
                $('#b_pcv').focus().val(data[15]).blur()
                $('#b_anc').focus().val(data[16]).blur()
                $('#b_platelet').focus().val(data[17]).blur()
                $('#b_note').focus().val(data[18]).blur()
                $('#b_wbc').focus().val(data[19]).blur()
            } else if (CANCER_TYPE == 'head_and_neck') {
                selectOption('#hn_mouth_sore', data[4])
                selectOption('#hn_diff_in_swallowing', data[5])

                selectOption('#hn_loss_of_smell', data[6] != 'None' ? 'other' : 'None')
                $('#hn_loss_of_smell_other').focus().val(data[6] != 'None' ? data[6] : '').blur()

                selectOption('#hn_taste_changes', data[7])
                selectOption('#hn_dry_mouth', data[8])

                selectOption('#hn_mouth_cracking', data[9] != 'None' ? 'other' : 'None')
                $('#hn_mouth_cracking_other').focus().val(data[9] != 'None' ? data[9] : '').blur()

                selectOption('#hn_voice_change', data[10])
                selectOption('#hn_appetite_changes', data[11])

                selectOption('#hn_nausea', data[12] != 'None' ? 'other' : 'None')
                $('#hn_nausea_other').focus().val(data[12] != 'None' ? data[12] : '').blur()

                selectOption('#hn_vomiting', data[13])
                selectOption('#hn_skin_color_changes', data[14])
                selectOption('#hn_tired_or_weak', data[15])
                $('#hn_weight').focus().val(data[16]).blur()
                $('#hn_note').focus().val(data[17]).blur()
                selectOption('#hn_on_chemo', data[18])
            } else if (CANCER_TYPE == 'female_pelvic') {
                selectOption('#fp_loose_stool', data[4])

                selectOption('#fp_nausea', data[5] != 'None' ? 'other' : 'None')
                $('#fp_nausea_other').focus().val(data[5] != 'None' ? data[5] : '').blur()

                selectOption('#fp_vomiting', data[6])
                selectOption('#fp_skin_color', data[7])
                selectOption('#fp_anus_changes', data[8])
                selectOption('#fp_blood_in_urine', data[9])
                selectOption('#fp_diff_urinating', data[10])
                selectOption('#fp_painful_urine', data[11])
                selectOption('#fp_feel_like_urine', data[12])
                selectOption('#fp_urine_control', data[13])
                selectOption('#fp_urine_rate', data[14])
                selectOption('#fp_vag_dry', data[15])
                selectOption('#fp_stool_leak', data[16])
                selectOption('#fp_tired_or_weak', data[17])
                $('#fp_weight').focus().val(data[18]).blur()
                $('#fp_note').focus().val(data[19]).blur()
                selectOption('#fp_on_chemo', data[20])
            } else if (CANCER_TYPE == 'male_pelvic') {
                selectOption('#mp_blood_in_urine', data[4])
                selectOption('#mp_diff_urinating', data[5])
                selectOption('#mp_painful_urine', data[6])
                selectOption('#mp_urine_rate', data[7])
                selectOption('#mp_feel_like_urine', data[8])
                selectOption('#mp_urine_control', data[9])

                selectOption('#mp_nausea', data[10] != 'None' ? 'other' : 'None')
                $('#mp_nausea_other').focus().val(data[10] != 'None' ? data[10] : '').blur()

                selectOption('#mp_vomiting', data[11])
                selectOption('#mp_loose_stool', data[12])
                selectOption('#mp_anus_changes', data[13])

                selectOption('#mp_blood_from_anus', data[14] != 'None' ? 'other' : 'None')
                $('#mp_blood_from_anus_other').focus().val(data[14] != 'None' ? data[14] : '').blur()

                selectOption('#mp_diff_stooling', data[15])

                selectOption('#mp_belly_tight', data[16] != 'None' ? 'other' : 'None')
                $('#mp_belly_tight_other').focus().val(data[16] != 'None' ? data[16] : '').blur()

                selectOption('#mp_stool_leak', data[17])


                selectOption('#mp_erection', data[18] != 'None' ? 'other' : 'None')
                $('#mp_erection_other').focus().val(data[18] != 'None' ? data[18] : '').blur()


                selectOption('#mp_diff_in_releases', data[19] != 'None' ? 'other' : 'None')
                $('#mp_diff_in_releases_other').focus().val(data[19] != 'None' ? data[19] : '').blur()

                selectOption('#mp_decreased_desire', data[20] != 'None' ? 'other' : 'None')
                $('#mp_decreased_desire_other').focus().val(data[20] != 'None' ? data[20] : '').blur()

                selectOption('#mp_painful_sex', data[21] != 'None' ? 'other' : 'None')
                $('#mp_painful_sex_other').focus().val(data[21] != 'None' ? data[21] : '').blur()

                selectOption('#mp_tired_or_weak', data[22])

                $('#mp_weight').focus().val(data[23]).blur()
                $('#mp_note').focus().val(data[24]).blur()

                selectOption('#mp_on_chemo', data[25])
            }

            $('.extender').remove()
            $('.sweetselect.sfx_select').each(function(){
                $(this).hide()
                $(this).before('<div class="extender">'+$(this).find('option:selected').text()+'</div>')
            })
        }

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
            if (value != '') {
                if (value == 'None') { changeColor($(element), colors.None) }
                else if (value == 'Mild') { changeColor($(element), colors.Mild) }
                else if (value == 'Moderate') { changeColor($(element), colors.Moderate) }
                else if (value == 'Severe') { changeColor($(element), colors.Severe) }
                else if (value == 'other') { changeColor($(element), colors.Other); $(element).siblings('.simple_flex').show() }

            } else {
                changeColor($(element), colors._empty)
            }
        }

        function changeColor(elem, color){
            elem.css({
                'border-color': color,
                'background': color,
                'color': '#fff'
                // 'background': color+'0f'
            })
        }

    }


})