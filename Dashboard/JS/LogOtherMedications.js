$(document).ready(function() {

    $('.type_'+CANCER_TYPE).removeClass('to_remove')   
    $('.to_remove').remove()   

    console.log(CANCER_TYPE)

    removeDrug()

    function removeDrug(){
        $('.remove_drug').click(function(){
            $(this).parent().remove()
        })
    }

    function addNewDrugElement(value){
        $('.drugs_holder')
        .append(
            '<div class="extra_drug mt-2 drop_d to_remove type_breast type_head_and_neck type_male_pelvic type_female_pelvic">'+
                '<label class="i-g-block-label">Drug</label>'+
                '<div class="flex flex_row simple_flex">'+
                    '<input type="text" placeholder="Drug" class="drug_name" value="'+value+'">'+
                '</div>'+
                '<span class="bx bx-x text-danger remove_drug" style="font-size: 30px;"></span>'+
            '</div>')
        removeDrug()
    }

    $('.add_new_drug').click(function(){
        addNewDrugElement('')
    })


    let colors = {
            None: '#001B29',
            Mild: '#27AE60',
            Moderate: '#FF9409',
            Severe: '#EB5757',
            Other: '#8d2d90',
            _empty: '#ced4da'
        },
        ACTIVE_SURGERY_ID = '',
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

        // if(date_elem.length < 1){
        console.log(SELECTED_DATE)
        if(!SELECTED_DATE){
            error('Select a date first', '')
            return
        }
 
        if($('.drug_name').length < 1){
            error('Add a drug first', '')
            return
        }


        var date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year'),
            drugs = [],
            error_found = false

        $('.drug_name').each(function(){
            
            let t = $(this),
                v = t.val()

            if(v != ''){
                drugs.push(v)
            }else{
                error_found = true
            }

        })

        if(error_found){
            error('Provide all drug names', '')
            return
        }
    
    
        Swal.fire({
            title: 'Logging Medication',
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        $('#addModal,#editModal').modal('hide')

        var formData = [JSON.stringify(drugs), SELECTED_DATE]

        $.ajax({
            async: false,
            url: './API/api_other_medications_create.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                if (data == '1') {
                    log('Logged Other Medications', 'New Log')
                    s('Medication Logged')
                } else {
                    console.log(data)
                    e(data)
                }
            },
            fail: function(data) { e(data) },
            error: function(data) { e(data) }
        })

    })

    $('#update-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        // if(date_elem.length < 1 || ACTIVE_SURGERY_ID == ''){
        if(!SELECTED_DATE || ACTIVE_SURGERY_ID == ''){
            error('Select a date first', '')
            return
        }

        var date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year'),
            drugs = [],
            error_found = false

        $('.drug_name').each(function(){
            
            let t = $(this),
                v = t.val()

            if(v != ''){
                drugs.push(v)
            }else{
                error_found = true
            }

        })

        if(error_found){
            error('Provide all drug names', '')
            return
        }
     
    
        Swal.fire({
            title: 'Updating Medication',
            allowOutsideClick: false,
            onBeforeOpen: function() { Swal.showLoading() }
        })

        $('#addModal,#editModal').modal('hide')

        var formData = [JSON.stringify(drugs), SELECTED_DATE, ACTIVE_SURGERY_ID]
console.log(formData)
        $.ajax({
            async: false,
            url: './API/api_other_medications_update.php',
            data: { data: formData },
            type: 'POST',
            success: function(data) {
                console.log(data)
                if (data == '1') {
                    log('Updated a Medication', 'Update')
                    s('Medication Updated')
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
                ACTIVE_SURGERY_ID = id
                $('#add-data').hide()
                $('#update-data').show()
                $('.empty_state').hide()
                $('.side_effect_items').show()
            }else{
                $('.empty_state').show()
                $('.side_effect_items').hide()
                $('.es_message').text('No other medications logged on this day.')
                $('.start_log').show()
                ACTIVE_SURGERY_ID = ''    
                $('a').removeClass('ui-state-active')
                target.addClass('ui-state-active')
                clearForm()
                $('#add-data').show()
                $('#update-data').hide()
            }
        })

    }

    function getSavedSideEffects(id){

        let URL = 'api_other_medications_get_one'

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

        $('.current-state').html('Details of Logged Medication')
        // $('.sub-state').html('Saved on <b>' + data[2] + '</b> at <b>' + data[3] + '</b>')
        $('.sub-state').html('Showing treatments logged on ' + data[2])

        let drugs  = JSON.parse(data[4])

        $('.drug_name').val(drugs[0])

        $('.extra_drug').remove()

        if(drugs.length > 1){

            for (let index = 1; index < drugs.length; index++) {
                addNewDrugElement(drugs[index])
            }
        }

    }

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
            url: './API/api_other_medications_read.php',
            type: 'POST',
            success: function(data) {
                console.log(data)
                if(data != 0){
                    processData(JSON.parse(data))
                    log('Viewed Saved other medications', 'View')
                }
            },
            fail: function(data) {
                console.log(data)
                e('Cannot retrieve other medications :/<br><sub>Try again later.</sub>')
            },
            error: function(data) {
                console.log(data)
                e('Cannot retrieve other medications :/<br><sub>Try again later.</sub>')
            }
        })

    }

    function clearForm() {
        $('.current-state').html('Log Other Medications')
        $('.sub-state').html('No medication has been logged on this day. Log them below')
        $('.extra_drug').remove()
        $('input,textarea').val('')
        $('.show_on_change').hide()
        $('.image_to_upload').remove()
        $('.output_contents').empty()
        $('.input_item').hide()
        $('.sfx_select').removeAttr('style')
        try{$('select.sweetselect').val('').change()}catch(e){}
    }

    function s(s) {
        Swal.fire({
            title: s + ' successfully',
            type: 'success',
            html: 'We\'ll refresh your data shortly.'
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