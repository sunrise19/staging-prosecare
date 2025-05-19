$(document).ready(function() {

    $('.type_'+CANCER_TYPE).removeClass('to_remove')   
    $('.to_remove').remove()   

    console.log(CANCER_TYPE)

    let colors = {
            None: '#001B29',
            Mild: '#27AE60',
            Moderate: '#FF9409',
            Severe: '#EB5757',
            Other: '#8d2d90',
            _empty: '#ced4da'
        },
        ACTIVE_CHEMOTHERAPY_ID = '',
        TODAY = new Date()


    
    $('#datepicker').datepicker({
        dayNamesMin: ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"],
        maxDate: TODAY
    });


    $('#datepicker').datepicker("option", "changeMonth", true);
    $('#datepicker').datepicker("option", "changeYear", true);
    $('#datepicker').datepicker("option", "dateFormat", "d M, yy");
    $('#datepicker').datepicker("option", "showAnim", "");

    $('.start_log').click(function(){
        $('.empty_state').hide()
        $('.side_effect_items').show()
    })

    afterData()

    $('.sfx_select').change(function(){
        let t = $(this),
            v = t.val()
        t.siblings('.simple_flex').hide()
        if(v != ''){
            if(v == 'None'){changeColor(t, colors.None)}
            else if(v == 'Mild'){changeColor(t, colors.Mild)}
            else if(v == 'Moderate'){changeColor(t, colors.Moderate)}
            else if(v == 'Severe'){changeColor(t, colors.Severe)}
            else if(v == 'other'){changeColor(t, colors.Other); t.siblings('.simple_flex').show()}
        }else{
            changeColor(t, colors._empty)
        }

    })

    $('.visibility_controller').on('change', function(){
        let v = $(this).val().toLowerCase(),
            t = $('.show_on_change')   

        v === 'yes' ? t.css('display', 'block') : t.hide()
    })

    $('input').keyup(function(){
        inputChange($(this))
    }).focus(function(){
        inputChange($(this))
    }).blur(function(){
        inputChange($(this))
    })

    function inputChange(elem){
        if(elem.val() != ''){
            changeColor(elem, colors.Other)
        }else{
            changeColor(elem, colors.None)
        }
    }

    function changeColor(elem, color){
        /*
        elem.css({
            'border-color': color,
            'background': color,
            'color': '#fff'
            // 'background': color+'0f'
        })
        */
    }
    
    loadData()

    if (window.location.href.indexOf('#Create') > -1) {
        $('#addModal').modal('show')
    }


    $('#add-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        if(date_elem.length < 1){
            error('Select a date first', '')
            return
        }

        if(CANCER_TYPE == 'breast'){

            var b_chemo = $('#b_chemo').val(),
                b_chemo_ind = $('#b_chemo_ind').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_ind == '' || b_chemo_ind == null) {
                    error('Provide a chemotherapy indication', $('#b_chemo_ind'))
                    return
                } else if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, b_chemo_ind, b_chemo_drug, b_chemo_dose, b_chemo_freq, date]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Chemotherapy', 'New Log')
                        s('Chemotherapy Logged')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'head_and_neck'){

            var b_chemo = $('#b_chemo').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, '', b_chemo_drug, b_chemo_dose, b_chemo_freq, date]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Chemotherapy', 'New Log')
                        s('Chemotherapy Logged')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'female_pelvic'){

            var b_chemo = $('#b_chemo').val(),
                b_chemo_ind = $('#b_chemo_ind').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_ind == '' || b_chemo_ind == null) {
                    error('Provide a chemotherapy indication', $('#b_chemo_ind'))
                    return
                } else if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, b_chemo_ind, b_chemo_drug, b_chemo_dose, b_chemo_freq, date]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Chemotherapy', 'New Log')
                        s('Chemotherapy Logged')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'male_pelvic'){

            var b_chemo = $('#b_chemo').val(),
                b_chemo_ind = $('#b_chemo_ind').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_ind == '' || b_chemo_ind == null) {
                    error('Provide a chemotherapy indication', $('#b_chemo_ind'))
                    return
                } else if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, b_chemo_ind, b_chemo_drug, b_chemo_dose, b_chemo_freq, date]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Chemotherapy', 'New Log')
                        s('Chemotherapy Logged')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }

    })


    $('#update-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        if(date_elem.length < 1 || ACTIVE_CHEMOTHERAPY_ID == ''){
            error('Select a date first', '')
            return
        }

        if(CANCER_TYPE == 'breast'){
            
            var b_chemo = $('#b_chemo').val(),
                b_chemo_ind = $('#b_chemo_ind').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_ind == '' || b_chemo_ind == null) {
                    error('Provide a chemotherapy indication', $('#b_chemo_ind'))
                    return
                } else if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            }
     
    
            Swal.fire({
                title: 'Updating Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, b_chemo_ind, b_chemo_drug, b_chemo_dose, b_chemo_freq, date, ACTIVE_CHEMOTHERAPY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Side Effect Log', 'Update')
                        s('Chemotherapy Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'head_and_neck'){

            var b_chemo = $('#b_chemo').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            }
     
    
            Swal.fire({
                title: 'Updating Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, '', b_chemo_drug, b_chemo_dose, b_chemo_freq, date, ACTIVE_CHEMOTHERAPY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Side Effect Log', 'Update')
                        s('Chemotherapy Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'female_pelvic'){

            var b_chemo = $('#b_chemo').val(),
                b_chemo_ind = $('#b_chemo_ind').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_ind == '' || b_chemo_ind == null) {
                    error('Provide a chemotherapy indication', $('#b_chemo_ind'))
                    return
                } else if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            }
     
    
            Swal.fire({
                title: 'Updating Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, b_chemo_ind, b_chemo_drug, b_chemo_dose, b_chemo_freq, date, ACTIVE_CHEMOTHERAPY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Side Effect Log', 'Update')
                        s('Chemotherapy Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'male_pelvic'){

            var b_chemo = $('#b_chemo').val(),
                b_chemo_ind = $('#b_chemo_ind').val(),
                b_chemo_drug = $('#b_chemo_drug').val(),
                b_chemo_dose = $('#b_chemo_dose').val(),
                b_chemo_freq = $('#b_chemo_freq').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (b_chemo == '' || b_chemo == null) {
                error('Provide a chemotherapy option', $('#b_chemo'))
                return
            } else if (b_chemo == 'Yes') {

                if (b_chemo_ind == '' || b_chemo_ind == null) {
                    error('Provide a chemotherapy indication', $('#b_chemo_ind'))
                    return
                } else if (b_chemo_drug == '' || b_chemo_drug == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_drug'))
                    return
                } else if (b_chemo_dose == '' || b_chemo_dose == null) {
                    error('Provide a chemotherapy drug', $('#b_chemo_dose'))
                    return
                } else if (b_chemo_freq == '' || b_chemo_freq == null) {
                    error('Provide a chemotherapy frequency', $('#b_chemo_freq'))
                    return
                }

            }
     
    
            Swal.fire({
                title: 'Updating Chemotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [b_chemo, b_chemo_ind, b_chemo_drug, b_chemo_dose, b_chemo_freq, date, ACTIVE_CHEMOTHERAPY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_chemotherapy_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Side Effect Log', 'Update')
                        s('Chemotherapy Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }

    })


    $('.add_image').click(function() {
        $(this).after('<div class="image_item image_to_upload" style="display: none"><div class="remove_image"></div><img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" class="tiny_image"><input name="file" type="file" multiple="multiple" accept="*" style="display: none"><span class="file_name"></span></div>')
        file_actions()
        $(this).next('.image_item').find('input').click()
    })



    $('#datepicker').on('click', function(){
        loadData()
    })
    

    function afterData() {
        
        $('td').off('click').on('click', function(){
            let target = $(this).find('a'),
                id = target.attr('id')

            if(target.hasClass('has_side_effect')){
                getSavedSideEffects(id)
                ACTIVE_CHEMOTHERAPY_ID = id
                $('#add-data').hide()
                $('#update-data').show()
                $('.empty_state').hide()
                $('.side_effect_items').show()
            }else{
                $('.empty_state').show()
                $('.side_effect_items').hide()
                $('.es_message').text('No chemotherapy logged on this day.')
                $('.start_log').show()
                ACTIVE_CHEMOTHERAPY_ID = ''    
                $('a').removeClass('ui-state-active')
                target.addClass('ui-state-active')
                clearForm()
                $('#add-data').show()
                $('#update-data').hide()
            }
        })

    }

    function getSavedSideEffects(id){

        let URL = 'api_chemotherapy_get_one'

        if(CANCER_TYPE == 'breast'){ URL = 'api_chemotherapy_get_one' }
        else if(CANCER_TYPE == 'head_and_neck'){ URL = 'api_chemotherapy_get_one' }
        else if(CANCER_TYPE == 'female_pelvic'){ URL = 'api_chemotherapy_get_one' }
        else if(CANCER_TYPE == 'male_pelvic'){ URL = 'api_chemotherapy_get_one' }

        $.ajax({
            async: false,
            url: './API/'+URL+'.php?id='+id,
            type: 'POST',
            success: function(data) {
                console.log(data)
                if(data != 0){
                    applyRetrievedData(JSON.parse(data))
                }
            },
            fail: function(data) {
                console.log(data)
                e('Cannot retrieve Chemotherapy :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve Chemotherapy :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function applyRetrievedData(data){

        $('.current-state').html('Details of Chemotherapy')
        // $('.sub-state').html('Saved on <b>' + data[2] + '</b> at <b>' + data[3] + '</b>')
        $('.sub-state').html('Showing treatments logged on ' + data[2])

        if(CANCER_TYPE == 'breast'){
            selectOption('#b_chemo', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            selectOption('#b_chemo_ind', data[5])
            $('#b_chemo_drug').focus().val(data[6]).blur()
            $('#b_chemo_dose').focus().val(data[7]).blur()
            $('#b_chemo_freq').focus().val(data[8]).blur()
        }else if(CANCER_TYPE == 'head_and_neck'){
            selectOption('#b_chemo', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            $('#b_chemo_drug').focus().val(data[6]).blur()
            $('#b_chemo_dose').focus().val(data[7]).blur()
            $('#b_chemo_freq').focus().val(data[8]).blur()
        }else if(CANCER_TYPE == 'female_pelvic'){
            selectOption('#b_chemo', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            selectOption('#b_chemo_ind', data[5])
            $('#b_chemo_drug').focus().val(data[6]).blur()
            $('#b_chemo_dose').focus().val(data[7]).blur()
            $('#b_chemo_freq').focus().val(data[8]).blur()
        }else if(CANCER_TYPE == 'male_pelvic'){
            selectOption('#b_chemo', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            selectOption('#b_chemo_ind', data[5])
            $('#b_chemo_drug').focus().val(data[6]).blur()
            $('#b_chemo_dose').focus().val(data[7]).blur()
            $('#b_chemo_freq').focus().val(data[8]).blur()
        }

        $('.sweetselect.sfx_select').each(function(){
            $(this).siblings('.extender').find('span').html($(this).find('option:selected').text())
        })

    }

    $('.extender').remove()
    $('.sweetselect.sfx_select').each(function(){
        $(this).before('<div class="extender"><span>'+$(this).find('option:selected').text()+'</span><i class="bx bx-chevron-down"></i></div>')
        $(this).css({'filter': 'opacity(0)', 'position' : 'absolute', 'top' : `37.5px`})
    })

    $('.sweetselect.sfx_select').on('change', function(){
        $(this).siblings('.extender').find('span').html($(this).find('option:selected').text())
        $(this).css({'filter': 'opacity(0)', 'position' : 'absolute', 'top' : `37.5px`})
    })

    function selectOption(element, value){
        $(element).find('option').attr('selected', false)
        $(element).find('option').each(function(){
            if($(this).attr('value') == value){
                $(this).attr('selected', true)
            }else{
                $(this).attr('selected', false)
            }
        })
        let context = $(element).html()
        $(element).html(context)
        if(value != ''){
            if(value == 'None'){changeColor($(element), colors.None)}
            else if(value == 'Mild'){changeColor($(element), colors.Mild)}
            else if(value == 'Moderate'){changeColor($(element), colors.Moderate)}
            else if(value == 'Severe'){changeColor($(element), colors.Severe)}
            else if(value == 'other'){changeColor($(element), colors.Other); $(element).siblings('.simple_flex').show()}

        }else{
            changeColor($(element), colors._empty)
        }
    }

    function processData(data){
        console.log(data)

        data.forEach(item => {

            let id = item[0],
                arr = item[1].split('-')
                day = arr[0],
                month = arr[1],
                year = arr[2],

            $('a').each(function(){
                let t = $(this),
                    p = t.parent(),
                    this_day = t.text(),
                    this_month = p.attr('data-month'),
                    this_year = p.attr('data-year')
    
                if(
                    this_day === day
                    &&
                    this_month === month
                    &&
                    this_year === year
                ){
                    t.addClass('ui-state-default ui-state-highlight has_side_effect')
                    t.attr('id', id)

                }
            })
            
        });


        afterData()
    }

    function loadData() {

        $.ajax({
            async: false,
            url: './API/api_chemotherapy_read.php',
            type: 'POST',
            success: function(data) {
                console.log(data)
                if(data != 0){
                    processData(JSON.parse(data))
                    log('Viewed Saved Chemotherapy', 'View')
                }
            },
            fail: function(data) {
                console.log(data)
                e('Cannot retrieve Chemotherapy :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve Chemotherapy :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function clearForm() {
        $('.current-state').html('Log Chemotherapy')
        $('.sub-state').html('No chemotherapy has been logged on this day. Log them below')
        $('input,textarea').val('')
        $('.show_on_change').hide()
        $('.image_to_upload').remove()
        $('.output_contents').empty()
        $('.input_item').hide()
        //$('.sfx_select').removeAttr('style')
        try{$('select.sweetselect').val('').change()}catch(e){}
    }

    function s(s) {
        loadData()
        Swal.fire({
            title: s + ' successfully',
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
        console.log(e)
        Swal.fire({
            title: 'Oops',
            html: e,
            type: 'error'
        })
    }

    function error(message, element) {
        if (element != '') {
            try{
                $('html, body, .card').animate({
                    scrollTop: element.offset().top
                }, 500);
                element.addClass('error')
                setTimeout(() => {
                    element.removeClass('error')
                }, 3000);
            }catch(e){
                console.trace(e)
            }
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