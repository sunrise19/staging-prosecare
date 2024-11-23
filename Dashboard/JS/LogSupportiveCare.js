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
        ACTIVE_SUPPORTIVE_CARE_ID = '',
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

        if(CANCER_TYPE == 'head_and_neck'){

            var hospital_admission = $('#hospital_admission').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                due_to_side_effects = $('#due_to_side_effects').val(),
                dietary_support = $('#dietary_support').val(),
                gastronomy = $('#gastronomy').val(),
                PNT = $('#PNT').val(),
                high_protein_diet = $('#high_protein_diet').val(),
                dental_care = $('#dental_care').val(),
                tips = $('#tips').val(),
                tube = $('#tube').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    

            if (hospital_admission == '' || hospital_admission == null) {
                error('Provide entry for hospital admission', $('#hospital_admission'))
                return
            } else if (day == '' || day == null) {
                error('Provide Day of Surgery', $('#day').parent());
                return;
            } else if (month == '' || month == null) {
                error('Provide Month of Surgery', $('#month').parent());
                return;
            } else if (year == '' || year == null) {
                error('Provide Year of Surgery', $('#year').parent());
                return;
            } else if (due_to_side_effects == '' || due_to_side_effects == null) {
                error('Provide an option', $('#due_to_side_effects').parent());
                return;
            } else if (dietary_support == '' || dietary_support == null) {
                error('Provide an option for dietary support', $('#dietary_support').parent());
                return;
            } else if (gastronomy == '' || gastronomy == null) {
                error('Provide an option for gastronomy', $('#gastronomy').parent());
                return;
            } else if (PNT == '' || PNT == null) {
                error('Provide an option for PNT', $('#PNT').parent());
                return;
            } else if (high_protein_diet == '' || high_protein_diet == null) {
                error('Provide an option for high protein diet', $('#high_protein_diet').parent());
                return;
            } else if (dental_care == '' || dental_care == null) {
                error('Provide an option for dental care', $('#dental_care').parent());
                return;
            } else if (tips == '' || tips == null) {
                error('Provide an option for oral hygiene tips and care', $('#tips').parent());
                return;
            } else if (tube == '' || tube == null) {
                error('Provide an option for Feeding gastrostomy tube insertion', $('#tube').parent());
                return;
            }

    
            Swal.fire({
                title: 'Logging Supportive Care',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [hospital_admission, day, month, year, due_to_side_effects, dietary_support, gastronomy, PNT, high_protein_diet, dental_care, tips, tube, date]
    
            $.ajax({
                async: false,
                url: './API/api_supportive_care_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Surgery', 'New Log')
                        s('Supportive Care Logged')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'female_pelvic'){

            var dietary_support = $('#dietary_support').val(),
                dental_care = $('#dental_care').val(),
                tube = $('#tube').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')


            if (dietary_support == '' || dietary_support == null) {
                error('Provide an option for dietary support', $('#dietary_support').parent());
                return;
            } else if (dental_care == '' || dental_care == null) {
                error('Provide an option for dental care', $('#dental_care').parent());
                return;
            } else if (tube == '' || tube == null) {
                error('Provide an option for Feeding gastrostomy tube insertion', $('#tube').parent());
                return;
            }


            Swal.fire({
                title: 'Logging Supportive Care',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })

            $('#addModal,#editModal').modal('hide')

            var formData = ['', '', '', '', '', dietary_support, '', '', '', dental_care, '', tube, date]

            $.ajax({
                async: false,
                url: './API/api_supportive_care_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Surgery', 'New Log')
                        s('Supportive Care Logged')
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

        if(date_elem.length < 1 || ACTIVE_SUPPORTIVE_CARE_ID == ''){
            error('Select a date first', '')
            return
        }

        if(CANCER_TYPE == 'head_and_neck'){

            var hospital_admission = $('#hospital_admission').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                due_to_side_effects = $('#due_to_side_effects').val(),
                dietary_support = $('#dietary_support').val(),
                gastronomy = $('#gastronomy').val(),
                PNT = $('#PNT').val(),
                high_protein_diet = $('#high_protein_diet').val(),
                dental_care = $('#dental_care').val(),
                tips = $('#tips').val(),
                tube = $('#tube').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    

            if (hospital_admission == '' || hospital_admission == null) {
                error('Provide entry for hospital admission', $('#hospital_admission'))
                return
            } else if (day == '' || day == null) {
                error('Provide Day of Surgery', $('#day').parent());
                return;
            } else if (month == '' || month == null) {
                error('Provide Month of Surgery', $('#month').parent());
                return;
            } else if (year == '' || year == null) {
                error('Provide Year of Surgery', $('#year').parent());
                return;
            } else if (due_to_side_effects == '' || due_to_side_effects == null) {
                error('Provide an option', $('#due_to_side_effects').parent());
                return;
            } else if (dietary_support == '' || dietary_support == null) {
                error('Provide an option for dietary support', $('#dietary_support').parent());
                return;
            } else if (gastronomy == '' || gastronomy == null) {
                error('Provide an option for gastronomy', $('#gastronomy').parent());
                return;
            } else if (PNT == '' || PNT == null) {
                error('Provide an option for PNT', $('#PNT').parent());
                return;
            } else if (high_protein_diet == '' || high_protein_diet == null) {
                error('Provide an option for high protein diet', $('#high_protein_diet').parent());
                return;
            } else if (dental_care == '' || dental_care == null) {
                error('Provide an option for dental care', $('#dental_care').parent());
                return;
            } else if (tips == '' || tips == null) {
                error('Provide an option for oral hygiene tips and care', $('#tips').parent());
                return;
            } else if (tube == '' || tube == null) {
                error('Provide an option for Feeding gastrostomy tube insertion', $('#tube').parent());
                return;
            }
     
    
            Swal.fire({
                title: 'Updating Supportive Care',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
        
            var formData = [hospital_admission, day, month, year, due_to_side_effects, dietary_support, gastronomy, PNT, high_protein_diet, dental_care, tips, tube, date, ACTIVE_SUPPORTIVE_CARE_ID]

            $.ajax({
                async: false,
                url: './API/api_supportive_care_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Supportive Care Log', 'Update')
                        s('Supportive Care Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'female_pelvic'){

            var dietary_support = $('#dietary_support').val(),
                dental_care = $('#dental_care').val(),
                tube = $('#tube').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')


            if (dietary_support == '' || dietary_support == null) {
                error('Provide an option for dietary support', $('#dietary_support').parent());
                return;
            } else if (dental_care == '' || dental_care == null) {
                error('Provide an option for dental care', $('#dental_care').parent());
                return;
            } else if (tube == '' || tube == null) {
                error('Provide an option for Feeding gastrostomy tube insertion', $('#tube').parent());
                return;
            }
     
    
            Swal.fire({
                title: 'Updating Supportive Care',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')

            var formData = ['', '', '', '', '', dietary_support, '', '', '', dental_care, '', tube, date, ACTIVE_SUPPORTIVE_CARE_ID]

    
            $.ajax({
                async: false,
                url: './API/api_supportive_care_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Supportive Care Log', 'Update')
                        s('Supportive Care Updated')
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


    $('#datepicker').on('click', function(){
        loadData()
    })
    

    function afterData() {
        
        $('td').off('click').on('click', function(){
            let target = $(this).find('a'),
                id = target.attr('id')

            if(target.hasClass('has_side_effect')){
                getSavedSideEffects(id)
                ACTIVE_SUPPORTIVE_CARE_ID = id
                $('#add-data').hide()
                $('#update-data').show()
                $('.empty_state').hide()
                $('.side_effect_items').show()
            }else{
                $('.empty_state').show()
                $('.side_effect_items').hide()
                $('.es_message').text('No supportive care logged on this day.')
                $('.start_log').show()
                ACTIVE_SUPPORTIVE_CARE_ID = ''    
                $('a').removeClass('ui-state-active')
                target.addClass('ui-state-active')
                clearForm()
                $('#add-data').show()
                $('#update-data').hide()
            }
        })

    }

    function getSavedSideEffects(id){

        let URL = 'api_supportive_care_get_one'

        if(CANCER_TYPE == 'breast'){ URL = 'api_supportive_care_get_one' }
        else if(CANCER_TYPE == 'head_and_neck'){ URL = 'api_supportive_care_get_one' }
        else if(CANCER_TYPE == 'female_pelvic'){ URL = 'api_supportive_care_get_one' }
        else if(CANCER_TYPE == 'male_pelvic'){ URL = 'api_supportive_care_get_one' }

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
                e('Cannot retrieve Supportive Care :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve Supportive Care :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function applyRetrievedData(data){

        $('.current-state').html('Details of Supportive Care')
        // $('.sub-state').html('Saved on <b>' + data[2] + '</b> at <b>' + data[3] + '</b>')
        $('.sub-state').html('Showing treatments logged on ' + data[2])


        if(CANCER_TYPE == 'head_and_neck'){
            $('#hospital_admission').focus().val(data[4]).blur()
            selectOption('#day', data[5])
            selectOption('#month', data[6])
            selectOption('#year', data[7])
            selectOption('#due_to_side_effects', data[8])
            selectOption('#dietary_support', data[9])
            $('#gastronomy').focus().val(data[10]).blur()
            $('#PNT').focus().val(data[11]).blur()
            $('#high_protein_diet').focus().val(data[12]).blur()
            selectOption('#dental_care', data[13])
            selectOption('#tips', data[14])
            selectOption('#tube', data[15])
        }else if(CANCER_TYPE == 'female_pelvic'){
            selectOption('#dietary_support', data[9])
            selectOption('#dental_care', data[13])
            selectOption('#tube', data[15])
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
            url: './API/api_supportive_care_read.php',
            type: 'POST',
            success: function(data) {
                console.log(data)
                if(data != 0){
                    processData(JSON.parse(data))
                    log('Viewed Saved Supportive Care', 'View')
                }
            },
            fail: function(data) {
                console.log(data)
                e('Cannot retrieve Supportive Care :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve Supportive Care :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function clearForm() {
        $('.current-state').html('Log Supportive Care')
        $('.sub-state').html('No supportive care has been logged on this day. Log them below')
        $('input,textarea').val('')
        $('.show_on_change').hide()
        $('.image_to_upload').remove()
        $('.output_contents').empty()
        $('.input_item').hide()
        // $('.sfx_select').removeAttr('style')
        try{$('select.sweetselect').val('').change()}catch(e){}
    }

    function s(s) {
        Swal.fire({
            title: s + ' successfully',
            type: 'success'
        })
        loadData()
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