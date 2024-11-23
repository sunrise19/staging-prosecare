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
        ACTIVE_SURGERY_ID = '',
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

            var surgery = $('#surgery').val(),
                surgery_type = $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [surgery, surgery_type, day, month, year, '', '', date]
    
            $.ajax({
                async: false,
                url: './API/api_surgery_create.php',
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

        }else if(CANCER_TYPE == 'head_and_neck'){

            var surgery = $('#surgery').val(),
                surgery_type = $('#surgery_type').val() == 'other' ? 'other-'+$('#surgery_type_other').val() : $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                examination = $('#examination').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [surgery, surgery_type, day, month, year, examination, '', date]
    
            $.ajax({
                async: false,
                url: './API/api_surgery_create.php',
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

        }else if(CANCER_TYPE == 'female_pelvic'){

            var surgery = $('#surgery').val(),
                surgery_pre = $('#surgery_pre').val(),
                surgery_type = $('#surgery_type').val() == 'other' ? 'other-'+$('#surgery_type_other').val() : $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_pre == '' || surgery_pre == null) {
                    error('Select an option for Pre-radiotherapy surgery', $('#surgery_pre'))
                    return
                } else if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [surgery, surgery_type, day, month, year, '', surgery_pre, date]
    
            $.ajax({
                async: false,
                url: './API/api_surgery_create.php',
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

        }else if(CANCER_TYPE == 'male_pelvic'){

            var surgery = $('#surgery').val(),
                surgery_type = $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            } 
    
    
            Swal.fire({
                title: 'Logging Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [surgery, surgery_type, day, month, year, '', '', date]
    
            $.ajax({
                async: false,
                url: './API/api_surgery_create.php',
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

        }

    })

    $('#update-data').on('click', function() {

        let date_elem = $('.ui-state-active'),
            date_elem_parent = date_elem.parent()

        if(date_elem.length < 1 || ACTIVE_SURGERY_ID == ''){
            error('Select a date first', '')
            return
        }

        if(CANCER_TYPE == 'breast'){
            
            var surgery = $('#surgery').val(),
                surgery_type = $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            } 
     
    
            Swal.fire({
                title: 'Updating Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [surgery, surgery_type, day, month, year, '', '', date, ACTIVE_SURGERY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_surgery_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Surgery Log', 'Update')
                        s('Surgery Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'head_and_neck'){

            var surgery = $('#surgery').val(),
                surgery_type = $('#surgery_type').val() == 'other' ? 'other-'+$('#surgery_type_other').val() : $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                examination = $('#examination').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            }
     
    
            Swal.fire({
                title: 'Updating Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
        
            var formData = [surgery, surgery_type, day, month, year, examination, '', date, ACTIVE_SURGERY_ID]


            $.ajax({
                async: false,
                url: './API/api_surgery_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Surgery Log', 'Update')
                        s('Surgery Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'female_pelvic'){

            var surgery = $('#surgery').val(),
                surgery_pre = $('#surgery_pre').val(),
                surgery_type = $('#surgery_type').val() == 'other' ? 'other-'+$('#surgery_type_other').val() : $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_pre == '' || surgery_pre == null) {
                    error('Select an option for Pre-radiotherapy surgery', $('#surgery_pre'))
                    return
                } else if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            } 
     
    
            Swal.fire({
                title: 'Updating Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [surgery, surgery_type, day, month, year, '', surgery_pre, date, ACTIVE_SURGERY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_surgery_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Surgery Log', 'Update')
                        s('Surgery Updated')
                    } else {
                        console.log(data)
                        e(data)
                    }
                },
                fail: function(data) { e(data) },
                error: function(data) { e(data) }
            })

        }else if(CANCER_TYPE == 'male_pelvic'){

            var surgery = $('#surgery').val(),
                surgery_type = $('#surgery_type').val(),
                day = $('#day').val(),
                month = $('#month').val(),
                year = $('#year').val(),
                date = date_elem.text() + '-' + date_elem_parent.attr('data-month') + '-' + date_elem_parent.attr('data-year')
    
    
            if (surgery == '' || surgery == null) {
                error('Provide a surgery option', $('#surgery'))
                return
            } else if (surgery == 'Yes') {

                if (surgery_type == '' || surgery_type == null) {
                    error('Provide a surgery type', $('#surgery_type'))
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
                }

            } 
     
    
            Swal.fire({
                title: 'Updating Surgery',
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })
    
            $('#addModal,#editModal').modal('hide')
    
            var formData = [surgery, surgery_type, day, month, year, '', '', date, ACTIVE_SURGERY_ID]
    
            $.ajax({
                async: false,
                url: './API/api_surgery_update.php',
                data: { data: formData },
                type: 'POST',
                success: function(data) {
                    if (data == '1') {
                        log('Updated a Surgery Log', 'Update')
                        s('Surgery Updated')
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
                ACTIVE_SURGERY_ID = id
                $('#add-data').hide()
                $('#update-data').show()
                $('.empty_state').hide()
                $('.side_effect_items').show()
            }else{
                $('.empty_state').show()
                $('.side_effect_items').hide()
                $('.es_message').text('No surgery logged on this day.')
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

        let URL = 'api_surgery_get_one'

        if(CANCER_TYPE == 'breast'){ URL = 'api_surgery_get_one' }
        else if(CANCER_TYPE == 'head_and_neck'){ URL = 'api_surgery_get_one' }
        else if(CANCER_TYPE == 'female_pelvic'){ URL = 'api_surgery_get_one' }
        else if(CANCER_TYPE == 'male_pelvic'){ URL = 'api_surgery_get_one' }

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

        $('.current-state').html('Details of Surgery')
        // $('.sub-state').html('Saved on <b>' + data[2] + '</b> at <b>' + data[3] + '</b>')
        $('.sub-state').html('Showing treatments logged on ' + data[2])


        if(CANCER_TYPE == 'breast'){
            selectOption('#surgery', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            selectOption('#surgery_type', data[5])
            selectOption('#day', data[6])
            selectOption('#month', data[7])
            selectOption('#year', data[8])
        }else if(CANCER_TYPE == 'head_and_neck'){
            selectOption('#surgery', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            selectOption('#surgery_type', data[5].startsWith('other-') ? 'other' : data[5])
            $('#surgery_type_other').focus().val(data[5].startsWith('other-') ? data[5].slice(6) : '').blur()
            selectOption('#day', data[6])
            selectOption('#month', data[7])
            selectOption('#year', data[8])
            $('#examination').focus().val(data[9]).blur()
        }else if(CANCER_TYPE == 'female_pelvic'){
            selectOption('#surgery', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            selectOption('#surgery_type', data[5].startsWith('other-') ? 'other' : data[5])
            $('#surgery_type_other').focus().val(data[5].startsWith('other-') ? data[5].slice(6) : '').blur()
            selectOption('#day', data[6])
            selectOption('#month', data[7])
            selectOption('#year', data[8])
            selectOption('#surgery_pre', data[10])
        }else if(CANCER_TYPE == 'male_pelvic'){
            selectOption('#surgery', data[4])
            if(data[4] == 'Yes'){
                $('.show_on_change').css('display', 'block')
            }else{
                $('.show_on_change').hide()
            }
            selectOption('#surgery_type', data[5].startsWith('other-') ? 'other' : data[5])
            $('#surgery_type_other').focus().val(data[5].startsWith('other-') ? data[5].slice(6) : '').blur()
            selectOption('#day', data[6])
            selectOption('#month', data[7])
            selectOption('#year', data[8])
            
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
            url: './API/api_surgery_read.php',
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
        $('.current-state').html('Log Surgery')
        $('.sub-state').html('No surgery has been logged on this day. Log them below')
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