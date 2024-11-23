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
        ACTIVE_RADIOTHERAPY_ID = '',
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

        if(CANCER_TYPE == 'breast' || CANCER_TYPE == 'head_and_neck' || CANCER_TYPE == 'male_pelvic'){

            var target_site = $('#target_site').val(),
                field_type = $('#field_type').val(),
                number_of_fields = $('#number_of_fields').val(),
                size_of_fields = $('#size_of_fields').val(),
                total_dose = $('#total_dose').val(),
                number_of_fractions = $('#number_of_fractions').val(),
                size_of_fractions = $('#size_of_fractions').val(),
                number_of_weeks = $('#number_of_weeks').val(),
                fractional_regimen = $('#fractional_regimen').val(),
                conventional = $('#conventional').val(),
                hypofractionation = $('#hypofractionation').val(),
                hyperfractionation = $('#hyperfractionation').val(),
                other = $('#other').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (target_site == '' || target_site == null) {
                error('Provide target site', $('#target_site').parent())
                return
            } else if (field_type == '' || field_type == null) {
                error('Provide field type', $('#field_type').parent());
                return;
            } else if (number_of_fields == '' || number_of_fields == null) {
                error('Provide number of fields', $('#number_of_fields').parent());
                return;
            } else if (size_of_fields == '' || size_of_fields == null) {
                error('Provide size of fields', $('#size_of_fields').parent());
                return;
            } else if (total_dose == '' || total_dose == null) {
                error('Provide total dose', $('#total_dose').parent());
                return;
            } else if (number_of_fractions == '' || number_of_fractions == null) {
                error('Provide number of fractions', $('#number_of_fractions').parent());
                return;
            } else if (size_of_fractions == '' || size_of_fractions == null) {
                error('Provide a size of fractions', $('#size_of_fractions').parent());
                return;
            } else if (number_of_weeks == '' || number_of_weeks == null) {
                error('Provide number of weeks', $('#number_of_weeks').parent());
                return;
            } else if (fractional_regimen == '' || fractional_regimen == null) {
                error('Provide fractional regimen', $('#fractional_regimen').parent());
                return;
            } else if (conventional == '' || conventional == null) {
                error('Provide conventionals', $('#conventional').parent());
                return;
            } else if (hypofractionation == '' || hypofractionation == null) {
                error('Provide hypofractionation', $('#hypofractionation').parent());
                return;
            } else if (hyperfractionation == '' || hyperfractionation == null) {
                error('Provide hyperfractionation', $('#hyperfractionation').parent());
                return;
            } 
    
            Swal.fire({
                title: 'Logging Radiotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [target_site, field_type, number_of_fields, size_of_fields, total_dose, number_of_fractions, size_of_fractions, number_of_weeks, fractional_regimen, conventional, hypofractionation, hyperfractionation, other, '', '', date]
    
            $.ajax({
                async: false,
                url: './API/api_radiotherapy_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Surgery', 'New Log')
                        s('Radiotherapy Logged')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'female_pelvic'){

            var target_site = $('#target_site').val(),
                field_type = $('#field_type').val(),
                number_of_fields = $('#number_of_fields').val(),
                size_of_fields = $('#size_of_fields').val(),
                total_dose = $('#total_dose').val(),
                number_of_fractions = $('#number_of_fractions').val(),
                size_of_fractions = $('#size_of_fractions').val(),
                number_of_weeks = $('#number_of_weeks').val(),
                fractional_regimen = $('#fractional_regimen').val(),
                conventional = $('#conventional').val(),
                hypofractionation = $('#hypofractionation').val(),
                hyperfractionation = $('#hyperfractionation').val(),
                other = $('#other').val(),
                intent = $('#intent').val(),
                dose = $('#dose').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (target_site == '' || target_site == null) {
                error('Provide target site', $('#target_site').parent())
                return
            } else if (field_type == '' || field_type == null) {
                error('Provide field type', $('#field_type').parent());
                return;
            } else if (number_of_fields == '' || number_of_fields == null) {
                error('Provide number of fields', $('#number_of_fields').parent());
                return;
            } else if (size_of_fields == '' || size_of_fields == null) {
                error('Provide size of fields', $('#size_of_fields').parent());
                return;
            } else if (total_dose == '' || total_dose == null) {
                error('Provide total dose', $('#total_dose').parent());
                return;
            } else if (number_of_fractions == '' || number_of_fractions == null) {
                error('Provide number of fractions', $('#number_of_fractions').parent());
                return;
            } else if (size_of_fractions == '' || size_of_fractions == null) {
                error('Provide a size of fractions', $('#size_of_fractions').parent());
                return;
            } else if (number_of_weeks == '' || number_of_weeks == null) {
                error('Provide number of weeks', $('#number_of_weeks').parent());
                return;
            } else if (fractional_regimen == '' || fractional_regimen == null) {
                error('Provide fractional regimen', $('#fractional_regimen').parent());
                return;
            } else if (conventional == '' || conventional == null) {
                error('Provide conventionals', $('#conventional').parent());
                return;
            } else if (hypofractionation == '' || hypofractionation == null) {
                error('Provide hypofractionation', $('#hypofractionation').parent());
                return;
            } else if (hyperfractionation == '' || hyperfractionation == null) {
                error('Provide hyperfractionation', $('#hyperfractionation').parent());
                return;
            } else if (intent == '' || intent == null) {
                error('Provide intent', $('#intent').parent());
                return;
            } else if (dose == '' || dose == null) {
                error('Provide dose', $('#dose').parent());
                return;
            } 
    
            Swal.fire({
                title: 'Logging Radiotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [target_site, field_type, number_of_fields, size_of_fields, total_dose, number_of_fractions, size_of_fractions, number_of_weeks, fractional_regimen, conventional, hypofractionation, hyperfractionation, other, intent, dose, date]
    
            $.ajax({
                async: false,
                url: './API/api_radiotherapy_create.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Logged Surgery', 'New Log')
                        s('Radiotherapy Logged')
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

        if(date_elem.length < 1 || ACTIVE_RADIOTHERAPY_ID == ''){
            error('Select a date first', '')
            return
        }

        if(CANCER_TYPE == 'breast' || CANCER_TYPE == 'head_and_neck' || CANCER_TYPE == 'male_pelvic'){
            
            var target_site = $('#target_site').val(),
                field_type = $('#field_type').val(),
                number_of_fields = $('#number_of_fields').val(),
                size_of_fields = $('#size_of_fields').val(),
                total_dose = $('#total_dose').val(),
                number_of_fractions = $('#number_of_fractions').val(),
                size_of_fractions = $('#size_of_fractions').val(),
                number_of_weeks = $('#number_of_weeks').val(),
                fractional_regimen = $('#fractional_regimen').val(),
                conventional = $('#conventional').val(),
                hypofractionation = $('#hypofractionation').val(),
                hyperfractionation = $('#hyperfractionation').val(),
                other = $('#other').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (target_site == '' || target_site == null) {
                error('Provide target site', $('#target_site').parent())
                return
            } else if (field_type == '' || field_type == null) {
                error('Provide field type', $('#field_type').parent());
                return;
            } else if (number_of_fields == '' || number_of_fields == null) {
                error('Provide number of fields', $('#number_of_fields').parent());
                return;
            } else if (size_of_fields == '' || size_of_fields == null) {
                error('Provide size of fields', $('#size_of_fields').parent());
                return;
            } else if (total_dose == '' || total_dose == null) {
                error('Provide total dose', $('#total_dose').parent());
                return;
            } else if (number_of_fractions == '' || number_of_fractions == null) {
                error('Provide number of fractions', $('#number_of_fractions').parent());
                return;
            } else if (size_of_fractions == '' || size_of_fractions == null) {
                error('Provide a size of fractions', $('#size_of_fractions').parent());
                return;
            } else if (number_of_weeks == '' || number_of_weeks == null) {
                error('Provide number of weeks', $('#number_of_weeks').parent());
                return;
            } else if (fractional_regimen == '' || fractional_regimen == null) {
                error('Provide fractional regimen', $('#fractional_regimen').parent());
                return;
            } else if (conventional == '' || conventional == null) {
                error('Provide conventionals', $('#conventional').parent());
                return;
            } else if (hypofractionation == '' || hypofractionation == null) {
                error('Provide hypofractionation', $('#hypofractionation').parent());
                return;
            } else if (hyperfractionation == '' || hyperfractionation == null) {
                error('Provide hyperfractionation', $('#hyperfractionation').parent());
                return;
            } 
    
    
            Swal.fire({
                title: 'Updating Radiotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [target_site, field_type, number_of_fields, size_of_fields, total_dose, number_of_fractions, size_of_fractions, number_of_weeks, fractional_regimen, conventional, hypofractionation, hyperfractionation, other, '', '', date, ACTIVE_RADIOTHERAPY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_radiotherapy_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Radiotherapy Log', 'Update')
                        s('Radiotherapy Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'female_pelvic'){

            var target_site = $('#target_site').val(),
                field_type = $('#field_type').val(),
                number_of_fields = $('#number_of_fields').val(),
                size_of_fields = $('#size_of_fields').val(),
                total_dose = $('#total_dose').val(),
                number_of_fractions = $('#number_of_fractions').val(),
                size_of_fractions = $('#size_of_fractions').val(),
                number_of_weeks = $('#number_of_weeks').val(),
                fractional_regimen = $('#fractional_regimen').val(),
                conventional = $('#conventional').val(),
                hypofractionation = $('#hypofractionation').val(),
                hyperfractionation = $('#hyperfractionation').val(),
                other = $('#other').val(),
                intent = $('#intent').val(),
                dose = $('#dose').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (target_site == '' || target_site == null) {
                error('Provide target site', $('#target_site').parent())
                return
            } else if (field_type == '' || field_type == null) {
                error('Provide field type', $('#field_type').parent());
                return;
            } else if (number_of_fields == '' || number_of_fields == null) {
                error('Provide number of fields', $('#number_of_fields').parent());
                return;
            } else if (size_of_fields == '' || size_of_fields == null) {
                error('Provide size of fields', $('#size_of_fields').parent());
                return;
            } else if (total_dose == '' || total_dose == null) {
                error('Provide total dose', $('#total_dose').parent());
                return;
            } else if (number_of_fractions == '' || number_of_fractions == null) {
                error('Provide number of fractions', $('#number_of_fractions').parent());
                return;
            } else if (size_of_fractions == '' || size_of_fractions == null) {
                error('Provide a size of fractions', $('#size_of_fractions').parent());
                return;
            } else if (number_of_weeks == '' || number_of_weeks == null) {
                error('Provide number of weeks', $('#number_of_weeks').parent());
                return;
            } else if (fractional_regimen == '' || fractional_regimen == null) {
                error('Provide fractional regimen', $('#fractional_regimen').parent());
                return;
            } else if (conventional == '' || conventional == null) {
                error('Provide conventionals', $('#conventional').parent());
                return;
            } else if (hypofractionation == '' || hypofractionation == null) {
                error('Provide hypofractionation', $('#hypofractionation').parent());
                return;
            } else if (hyperfractionation == '' || hyperfractionation == null) {
                error('Provide hyperfractionation', $('#hyperfractionation').parent());
                return;
            } else if (intent == '' || intent == null) {
                error('Provide intent', $('#intent').parent());
                return;
            } else if (dose == '' || dose == null) {
                error('Provide dose', $('#dose').parent());
                return;
            }
    
    
            Swal.fire({
                title: 'Updating Radiotherapy',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [target_site, field_type, number_of_fields, size_of_fields, total_dose, number_of_fractions, size_of_fractions, number_of_weeks, fractional_regimen, conventional, hypofractionation, hyperfractionation, other, intent, dose, date, ACTIVE_RADIOTHERAPY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_radiotherapy_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Radiotherapy Log', 'Update')
                        s('Radiotherapy Updated')
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
                ACTIVE_RADIOTHERAPY_ID = id
                $('#add-data').hide()
                $('#update-data').show()
                $('.empty_state').hide()
                $('.side_effect_items').show()
            }else{
                $('.empty_state').show()
                $('.side_effect_items').hide()
                $('.es_message').text('No radiotherapy logged on this day.')
                $('.start_log').show()
                ACTIVE_RADIOTHERAPY_ID = ''    
                $('a').removeClass('ui-state-active')
                target.addClass('ui-state-active')
                clearForm()
                $('#add-data').show()
                $('#update-data').hide()
            }
        })

    }

    function getSavedSideEffects(id){

        let URL = 'api_radiotherapy_get_one'

        if(CANCER_TYPE == 'breast'){ URL = 'api_radiotherapy_get_one' }
        else if(CANCER_TYPE == 'head_and_neck'){ URL = 'api_radiotherapy_get_one' }
        else if(CANCER_TYPE == 'female_pelvic'){ URL = 'api_radiotherapy_get_one' }
        else if(CANCER_TYPE == 'male_pelvic'){ URL = 'api_radiotherapy_get_one' }

        console.log('ID', id)
        $.ajax({
            async: false,
            url: './API/'+URL+'.php?id='+id,
            type: 'POST',
            success: function(data) {
                console.log('get', data)
                if(data != 0){
                    applyRetrievedData(JSON.parse(data))
                }
            },
            fail: function(data) {
                console.log(data)
                e('Cannot retrieve Surgery :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve Surgery :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function applyRetrievedData(data){

        $('.current-state').html('Details of Radiotherapy')
        // $('.sub-state').html('Saved on <b>' + data[2] + '</b> at <b>' + data[3] + '</b>')
        $('.sub-state').html('Showing treatments logged on ' + data[2])

        console.log(data)

        if(CANCER_TYPE == 'breast' || CANCER_TYPE == 'head_and_neck' || CANCER_TYPE == 'male_pelvic'){
            $('#target_site').focus().val(data[4]).blur()
            $('#field_type').focus().val(data[5]).blur()
            $('#number_of_fields').focus().val(data[6]).blur()
            $('#size_of_fields').focus().val(data[7]).blur()
            $('#total_dose').focus().val(data[8]).blur()
            $('#number_of_fractions').focus().val(data[9]).blur()
            $('#size_of_fractions').focus().val(data[10]).blur()
            $('#number_of_weeks').focus().val(data[11]).blur()
            $('#fractional_regimen').focus().val(data[12]).blur()
            $('#conventional').focus().val(data[13]).blur()
            $('#hypofractionation').focus().val(data[14]).blur()
            $('#hyperfractionation').focus().val(data[15]).blur()
            $('#other').focus().val(data[16]).blur()
        }else if(CANCER_TYPE == 'female_pelvic'){
            $('#target_site').focus().val(data[4]).blur()
            $('#field_type').focus().val(data[5]).blur()
            $('#number_of_fields').focus().val(data[6]).blur()
            $('#size_of_fields').focus().val(data[7]).blur()
            $('#total_dose').focus().val(data[8]).blur()
            $('#number_of_fractions').focus().val(data[9]).blur()
            $('#size_of_fractions').focus().val(data[10]).blur()
            $('#number_of_weeks').focus().val(data[11]).blur()
            $('#fractional_regimen').focus().val(data[12]).blur()
            $('#conventional').focus().val(data[13]).blur()
            $('#hypofractionation').focus().val(data[14]).blur()
            $('#hyperfractionation').focus().val(data[15]).blur()
            $('#other').focus().val(data[16]).blur()

            selectOption('#intent', data[17])
            selectOption('#dose', data[18])
            
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
            url: './API/api_radiotherapy_read.php',
            type: 'POST',
            success: function(data) {
                console.log(data)
                if(data != 0){
                    processData(JSON.parse(data))
                    log('Viewed Saved Surgery', 'View')
                }
            },
            fail: function(data) {
                console.log(data)
                e('Cannot retrieve Surgery :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve Surgery :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function clearForm() {
        $('.current-state').html('Log Radiotherapy')
        $('.sub-state').html('No radiotherapy has been logged on this day. Log them below')
        $('input,textarea').val('')
        $('.show_on_change').hide()
        $('.image_to_upload').remove()
        $('.output_contents').empty()
        $('.input_item').hide()
        // $('.sfx_select').removeAttr('style')
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