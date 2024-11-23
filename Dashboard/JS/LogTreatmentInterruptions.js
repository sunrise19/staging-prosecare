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
        ACTIVE_INTERRUPTION_ID = '',
        TODAY = new Date(),
        SELECTED_DATE = ''

  
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
        $('.side_effect_items[data-type="'+$(this).attr('data-type')+'"]').show()
        $('.current-state').text('Log Missed '+$(this).attr('data-type')+'therapy')
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


    $('#add-chemo-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        // if(date_elem.length < 1){
        if(!SELECTED_DATE){
            error('Select a date first', '')
            return
        }


        var missed = $('#missed').val(),
            reason = $('#reason').val(),
            date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')


        if (missed == '' || missed == null) {
            error('Provide an option', $('#missed'))
            return
        } else if (missed == 'Yes') {

            if (reason == '' || reason == null) {
                error('Provide a reason', $('#reason'))
                return
            } 

        } 


        Swal.fire({
            title: 'Logging Treatment Interrruption',
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        $('#addModal,#editModal').modal('hide')

        var formData = ['chemo', missed, reason, '', SELECTED_DATE]

        $.ajax({
            async: false,
            url: './API/api_interruptions_create.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    log('Logged Surgery', 'New Log')
                    s('Surgery Logged')
                } else {
                    console.log(data)
                    e(data)
                }
            },
            fail: function(data) { e(data) },
            error: function(data) { e(data) }
        })

        

    })

    $('#add-radio-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        // if(date_elem.length < 1){
        if(!SELECTED_DATE){
            error('Select a date first', '')
            return
        }


        var missed = $('#r-missed').val(),
            reason = $('#r-reason').val(),
            change = $('#r-change').val(),
            date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')


        if (missed == '' || missed == null) {
            error('Provide an option', $('#r-missed'))
            return
        } else if (missed == 'Yes') {

            if (reason == '' || reason == null) {
                error('Provide a reason', $('#r-reason'))
                return
            } else if (change == '' || change == null) {
                error('Provide a change text', $('#r-change'))
                return
            } 

        } 


        Swal.fire({
            title: 'Logging Treatment Interrruption',
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        $('#addModal,#editModal').modal('hide')

        var formData = ['radio', missed, reason, change, SELECTED_DATE]

        $.ajax({
            async: false,
            url: './API/api_interruptions_create.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    log('Logged Surgery', 'New Log')
                    s('Surgery Logged')
                } else {
                    console.log(data)
                    e(data)
                }
            },
            fail: function(data) { e(data) },
            error: function(data) { e(data) }
        })

    })

    $('#update-chemo-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        // if(date_elem.length < 1 || ACTIVE_INTERRUPTION_ID == ''){
        if(!SELECTED_DATE || ACTIVE_INTERRUPTION_ID == ''){
            error('Select a date first', '')
            return
        }
            
        var missed = $('#missed').val(),
            reason = $('#reason').val(),
            date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')


        if (missed == '' || missed == null) {
            error('Provide an option', $('#missed'))
            return
        } else if (missed == 'Yes') {

            if (reason == '' || reason == null) {
                error('Provide a reason', $('#reason'))
                return
            } 

        }


        Swal.fire({
            title: 'Updating Treatment Interruption',
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        $('#addModal,#editModal').modal('hide')

        var formData = ['chemo', missed, reason, '', SELECTED_DATE, ACTIVE_INTERRUPTION_ID]

        $.ajax({
            async: false,
            url: './API/api_interruptions_update.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    log('Updated a Treatment Interruption', 'Update')
                    s('Treatment Interruption Updated')
                } else {
                    console.log(data)
                    e(data)
                }
            },
            fail: function(data) { e(data) },
            error: function(data) { e(data) }
        })

        

    })

    $('#update-radio-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        // if(date_elem.length < 1 || ACTIVE_INTERRUPTION_ID == ''){
        if(!SELECTED_DATE || ACTIVE_INTERRUPTION_ID == ''){
            error('Select a date first', '')
            return
        }
            
        var missed = $('#r-missed').val(),
            reason = $('#r-reason').val(),
            change = $('#r-change').val(),
            date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')


        if (missed == '' || missed == null) {
            error('Provide an option', $('#r-missed'))
            return
        } else if (missed == 'Yes') {

            if (reason == '' || reason == null) {
                error('Provide a reason', $('#r-reason'))
                return
            } else if (change == '' || change == null) {
                error('Provide a change text', $('#r-change'))
                return
            }

        }


        Swal.fire({
            title: 'Updating Treatment Interruption',
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        $('#addModal,#editModal').modal('hide')

        var formData = ['radio', missed, reason, change, SELECTED_DATE, ACTIVE_INTERRUPTION_ID]

        $.ajax({
            async: false,
            url: './API/api_interruptions_update.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    log('Updated a Treatment Interruption', 'Update')
                    s('Treatment Interruption Updated')
                } else {
                    console.log(data)
                    e(data)
                }
            },
            fail: function(data) { e(data) },
            error: function(data) { e(data) }
        })

        

    })


    $('#datepicker').on('click', function(){
        loadData()
    })
    

    function afterData() {
        
        $('td').off('click').on('click', function(){
            let target = $(this).find('a'),
                id = target.attr('id')

            SELECTED_DATE = target.text() + '-' + $(this).attr('data-month') + '-' + $(this).attr('data-year')

            if(target.hasClass('has_side_effect')){
                getSavedSideEffects(id)
                ACTIVE_INTERRUPTION_ID = id
                $('#add-chemo-data,#add-radio-data').hide()
                $('#update-chemo-data,#update-radio-data').show()
                $('.empty_state').hide()
                // $('.side_effect_items').show()
            }else{
                $('.empty_state').show()
                $('.side_effect_items').hide()
                $('.es_message').text('No treatment interruption logged on this day.')
                $('.start_log').show()
                ACTIVE_INTERRUPTION_ID = ''    
                $('a').removeClass('ui-state-active')
                target.addClass('ui-state-active')
                clearForm()
                $('#add-chemo-data,#add-radio-data').show()
                $('#update-chemo-data,#update-radio-data').hide()
            }
        })

    }

    function getSavedSideEffects(id){

        let URL = 'api_interruptions_get_one'

        $('.side_effect_items').hide()

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
                e('Cannot retrieve Surgery :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve Surgery :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function applyRetrievedData(data){

        $('.current-state').html('Details of Treatment Interruption')
        // $('.sub-state').html('Saved on <b>' + data[2] + '</b> at <b>' + data[3] + '</b>')
        $('.sub-state').html('Showing treatments logged on ' + data[2])

        $('.side_effect_items').hide()
        $('.side_effect_items[data-type="'+data[4]+'"]').show()

        console.log(data[4] + ' type' )
        if(data[4] == 'chemo'){
            selectOption('#missed', data[5])
            if(data[5] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            $('#reason').focus().val(data[6]).blur()
        }else{
            selectOption('#r-missed', data[5])
            if(data[5] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            $('#r-reason').focus().val(data[6]).blur()
            $('#r-change').focus().val(data[7]).blur()
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
            url: './API/api_interruptions_read.php',
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
        $('.current-state').html('Log Treatment Interruption')
        $('.sub-state').html('No treatment interruption has been logged on this day. Log them below')
        $('input,textarea').val('')
        $('.show_on_change').hide()
        $('.image_to_upload').remove()
        $('.output_contents').empty()
        $('.input_item').hide()
        //$('.sfx_select').removeAttr('style')
        try{$('select.sweetselect').val('').change()}catch(e){}
    }

    function s(s) {
        Swal.fire({
            title: s + ' successfully',
            type: 'success',
            html: 'We\'ll refresh your data shortly'
        })
        setTimeout(() => {
            window.location.reload()
        }, 1500);
        // loadData()
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