$(document).ready(function() {

    loadLastMessages()

    enableChatActions()

})

    let HAS_LOADED_LAST_MESSAGES = false

    let lastMessageInView = ''

    let AUDIO_ELEMENT = $('.audio-element'),
        AUDIO_ELEMENT_SOURCE = document.getElementsByClassName("audio-element")[0].getElementsByTagName("source")[0];


    function enableChatActions() {

        $('.back_to_chatlist').off('click').on('click', function(){
            $('.chat-leftsidebar').removeClass('d-none')
            $('.user-chat').addClass('d-none')
        })

        $('.open_chat').off('click').on('click', function() {

            $('.user-chat-nav').show()
            $('.chat-input-section').show()
            $('.chat_parent').css('background', 'none')
            $('.contacts_btn').hide()

            var t = $(this),
                name = t.find('h5').text(),
                type = t.attr('data-type'),
                id = t.attr('id') || '',
                user = t.attr('data-user'),
                photo = t.find('.avatar-xs').attr('src'),
                patientID = t.attr('data-patient-id')

            lastMessageInView = id

            $('.open_profile').off('click')

            if(type === 'Patient'){
                $('.open_profile').on('click', function(){
                    $('.treatment_frame').attr('src', `PatientInfo?Clear=true&ID=${patientID}`)
                    $('.treament_modal_title').text(name)
                    $('.treament_modal').removeClass('sm').fadeIn()
                })
            }


            $('.chat-leftsidebar').addClass('d-none')
            $('.user-chat').removeClass('d-none')
            
            if(t.hasClass('from_contacts_list')){
                let target = $('.open_chat.from_chat_list[data-user="'+user+'"]')
                if(target.length > 0){
                    target.click()
                }else{
                    theElse()
                }
            }else{
                theElse()
            }
            
            function theElse(){
                if (!t.hasClass('active')) {
                    $('.chat-output').empty()
                    $('.open_chat').removeClass('active')
                    //t.addClass('active')
                    $('.active_chat_name').text(name)
                    $('.active_chat_photo').attr('src', photo)
                    // $('.user_type').html(type)
                    CHAT_IDENTIFIER = id
                    RECEIVER = user
                    if(id != ''){
                        // if(!HAS_LOADED_LAST_MESSAGES){
                            loadAllMessages(id)
                        // }
                    }
                }else{
                    markAsRead(id)
                }
            }

            
        })

    }

    $('.contacts_btn').click(function() {
        $('.nav-link[data-open="contacts"]').click()
    })

    $('.start_new_chat').click(function() {
        $(this).addClass('d-none')
        $('.back_to_recents').removeClass('d-none')
        $('.nav-link[data-open="contacts"]').click()
    })

    $('.back_to_recents').click(function() {
        $(this).addClass('d-none')
        $('.start_new_chat').removeClass('d-none')
        $('.nav-link[data-open="chat"]').click()
    })


    $('.nav-link').click(function() {
        var t = $(this),
            open = t.attr('data-open')

        if (!t.hasClass('active')) {
            $('.nav-link').removeClass('active')
            t.addClass('active')
            $('.tab-pane').hide()
            $('#' + open).show()
        }

    })

    $('.chat-send').click(function() {
        doSendChat()
    })
    
    $('.chat-input').focus(function(){
        $(this).on('keypress',function(e) {
            if(e.which == 13) {
                doSendChat()
            }
        });
        
    })
    
    $('.find_contact').keyup(function(){
        
        var c = $(this).val().toLowerCase()
        
        if(c == ''){
            $('.open_chat').show()
        }else{
            $('.open_chat').each(function(){
                var t = $(this)
                if(t.find('h5').text().toLowerCase().indexOf(c) > -1){
                    t.show()
                }else{
                    t.hide()
                }
            })
        }
        
    })
    
    $('.open_chat_search').click(function(){
        // $(this).find('.dropdown-menu').toggle()
        $('.in_chat_search').focus()
    })
    
    $('.in_chat_search').click(function(){
        setTimeout(() => {
            $(this).parent().parent().parent().parent().show()
            $(this).focus()
        }, 300);
        
    })
    
     $('.in_chat_search').keyup(function(){
        
        var c = $(this).val().toLowerCase()
        
        if(c == ''){
            $('.conversation-list').parent().show()
        }else{
            $('.conversation-list').each(function(){
                var t = $(this)
                if(t.find('.chat-message').text().toLowerCase().indexOf(c) > -1){
                    t.parent().show()
                }else{
                    t.parent().hide()
                }
            })
        }
        
    })
    
    function doSendChat(){
        var text = $('.chat-input').val()
        if (text != '') {

            $('.chat-input').val('').focus()

            sendMessage(text, 'message')

        }
    }

    $('.add_files').click(function() {
        $('#upload_files')[0].click()
    })

    $('#upload_files').on("change", function() {
        checkForAttachedFile()
    });

    function checkForAttachedFile(){
        var myfiles = document.getElementById("upload_files"),
            files = myfiles.files,
            data = new FormData(),
            file_names = [],
            file_sizes = [],
            file_links = []

        for (i = 0; i < files.length; i++) {

            if (files[i].size < 100000000) {
                data.append('file' + i, files[i]);
                file_names.push(files[i].name)
                file_sizes.push(formatFileSize(files[i].size))
                console.log(files[i].name + ' -> ' + formatFileSize(files[i].size))
            }else{
                alert('File too large. Must be less than 100MB')
            }
        }

        $.ajax({
            url: './API/upload_files.php',
            type: 'POST',
            contentType: false,
            data: data,
            processData: false,
            cache: false
        }).done(function(data) {

            data.split(',').forEach(link => {
                file_links.push(link)
            });

            file_names.forEach((file_name, index) => {
                sendMessage([file_name, file_sizes[index], file_links[index]], 'attachment')
            });

        });
    }

    function sendMessage(text, type) {

        $('.chat-output').append('<li class="right to_remove"><div class="conversation-list"><div class="ctext-wrap"><p class="chat-message">'+(type == 'message' ? text : text[0])+'</p><p class="chat-time mb-0">Sending...</p></div></div></li>')

        $('.chat-output').parent().animate({ scrollTop: $('.chat-output')[0].scrollHeight }, 0)

        if (CHAT_IDENTIFIER == '') {
            ROOMS_DB
                .add({
                    users: [FIRE_ID, RECEIVER]
                }).then(function(doc) {
                    CHAT_IDENTIFIER = doc.id
                    proceed(true)
                })

        } else {
            proceed(false)
        }

        function proceed(loadMessages) {

            var timestamp = firebase.firestore.FieldValue.serverTimestamp()

            MESSAGES_DB.add({
                identifier: CHAT_IDENTIFIER,
                sender: FIRE_ID,
                timestamp: timestamp,
                type: type,
                message: type == 'message' ? text : text[0],
                size: type == 'message' ? '' : text[1],
                link: type == 'message' ? '' : text[2]
            }, { merge: true }).then(function() {

                loadMessages ? loadAllMessages(CHAT_IDENTIFIER) : ''

                ROOMS_DB
                    .doc(CHAT_IDENTIFIER)
                    .update({
                        lastMessage: type == 'message' ? text : text[0],
                        type: type,
                        lastTimestamp: timestamp,
                        read: false,
                        lastSender: FIRE_ID
                    })

            }).catch(function(err) {
                $('.chat-input').val(text + '. ' + $('.chat-input').val()).focus()
                console.log('Message not sent => ' + err)
            })

        }
    }

    function formatFileSize(size) {
        size = Number(size)
        if (size <= 1000000) {
            return Math.round(size / 1000) + 'KB'
        } else if (size > 1000000 && size <= 1000000000) {
            return Math.round(size / 1000000) + 'MB'
        } else if (size > 1000000000) {
            return Math.round(size / 1000000000) + 'GB'
        }
    }

    function loadLastMessages() {

        var target = $('#chat').find('.simplebar-content')

        lastMessageInView = $('.open_chat.active').attr('id')

        ROOMS_DB
            .where('users', 'array-contains-any', [FIRE_ID])
            .orderBy('lastTimestamp', 'desc')
            .onSnapshot((querySnapshot) => {

                // target.empty()
                
                var i = 0,
                    output = '',
                    rawNames = []

                querySnapshot.forEach((doc) => {
                    
                    ++i

                    var data = doc.data(),
                        id = doc.id,
                        users = data.users,
                        lastMessage = data.lastMessage,
                        lastTimestamp = data.lastTimestamp,
                        type = data.type,
                        unread = data.lastSender != FIRE_ID && data.read == false ? 'unread' : ''
                        output += '<li class="open_chat '+unread+' from_chat_list" id="' + id + '" data-type="Loading...">' +
                        '<a href="javascript: void(0);">' +
                        '<div class="d-flex">' +
                        '<div class="flex-shrink-0 align-self-center me-3" style=" display: none; ">' +
                        '<i class="mdi mdi-circle text-success font-size-10"></i>' +
                        '</div>' +
                        '<div class="flex-shrink-0 align-self-center me-3">' +
                        '<img src="IMG/empty.png" class="rounded-circle avatar-xs" alt="">' +
                        '</div>' +
                        '<div class="flex-grow-1 overflow-hidden">' +
                        '<h5 class="text-truncate font-size-14 mb-1"></h5>' +
                        '<p class="text-truncate mb-0">' + (type == 'attachment' ? '<i class="bx bx-file" style=" transform: translateY(1px); "></i>&nbsp; ' : '') + lastMessage + '</p>' +
                        '</div>' +
                        '<div class="font-size-11 chat_time">' + formatDate(lastTimestamp.toDate(), false) + '</div>' +
                        '</div>' +
                        '</a>' +
                        '</li>'

                    rawNames.push([id, users])

                    
                });


                target.html(output)
                enableChatActions()

                if(querySnapshot.docs.length == 0){
                    target.append('<span class="py-3 d-block">No recent chats :/</span>')
                }

                rawNames.forEach(data => {
                    id = data[0]
                    users = data[1]
                    users[0] == FIRE_ID ? getUserName(id, users[1]) : getUserName(id, users[0])
                });

                if(!HAS_LOADED_LAST_MESSAGES){
                    setTimeout(() => {
                        //$('.open_chat[id="'+lastMessageInView+'"]').length == 1 ? $('.open_chat[id="'+lastMessageInView+'"]').click() : target.find($('.open_chat')).first().click()
                        HAS_LOADED_LAST_MESSAGES = true
                    }, 500);
                }else{
                    $('.open_chat[id="'+lastMessageInView+'"]').length == 1 ? $('.open_chat[id="'+lastMessageInView+'"]').addClass('active') : target.find($('.open_chat')).first().addClass('active')
                }



            });
    }

    function markAsRead(identifier){
        try{
            ROOMS_DB
            .doc(identifier)
            .get()
            .then(function(doc){
                console.log(FIRE_ID)
                console.log(doc.data())
                if(doc.data().lastSender != FIRE_ID){
                    ROOMS_DB
                    .doc(identifier)
                    .update({
                        read: true
                    })
                    .catch(function (e){
                        console.log(e)
                    })
                }
            })
        }catch(e){
            console.trace(e)
        }
    }

    function loadAllMessages(identifier) {

        markAsRead(identifier)

        MESSAGES_DB
            .where('identifier', '==', identifier)
            .orderBy('timestamp', 'asc')
            .onSnapshot((querySnapshot) => {

                // $('.chat-output').empty()

                var dt = [],
                    output  = ''

                querySnapshot.forEach((doc) => {

                    var data = doc.data(),
                        id = doc.id,
                        message = data.message,
                        timestamp = data.timestamp,
                        position = data.sender == FIRE_ID ? 'class="right"' : '',
                        formattedDate = formatDate(timestamp.toDate(), true),
                        type = data.type,
                        link = (type == 'attachment' ? data.link : ''),
                        size = (type == 'attachment' ? data.size : '')

                    if (dt.indexOf(formattedDate) > -1) {;
                    } else {

                        dt.push(formattedDate)

                        var time = '<li>' +
                            '<div class="chat-day-title">' +
                            '<span class="title">' + formattedDate + '</span>' +
                            '</div>' +
                            '</li>'

                        output += time

                    }

                    output += '<li id="' + id + '" ' + position + '>' +
                        '<div class="conversation-list">' +
                        '<div class="dropdown" style="display:none">' +
                        '<a class="dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                        '<i class="bx bx-dots-vertical-rounded"></i>' +
                        '</a>' +
                        '<div class="dropdown-menu">' +
                        '<a class="dropdown-item">Delete</a>' +
                        '</div>' +
                        '</div>' +
                        '<div class="ctext-wrap">' +
                        '<div class="conversation-name" style="display:none"></div>' +
                        '<p class="chat-message">'
                        if(type == 'attachment'){
                            if(link.endsWith('.wav')){
                                // output +=  '<span class="play_vn"><i class="bx bx-play"></i></span>'
                                output +=  '<audio class="in_chat_audio" controls><source src="./CHAT_STORAGE/' + link + '" type="audio/wav"></audio><br>'
                            }else if(link.endsWith('.png') || link.endsWith('.jpg') || link.endsWith('.svg')){
                                output +=  '<img class="in_chat_image" src="./CHAT_STORAGE/' + link + '"/><br>'
                            }
                            output +=  '<a href="./CHAT_STORAGE/' + link + '" target="_blank">' + message + '</a> <sub> &bull; ' + size + '</sub>'
                        }else{
                            output += message
                        }
                        output += '</p>' +
                        '<p class="chat-time mb-0">' + formatTimeStampToTime(timestamp) + '</p>' +
                        '</div>' +
                        '</div>' +
                        '</li>'

                    // $('#' + id).remove()
                    
                })
                
                $('.chat-output').html(output)
                $('.chat-output').parent().animate({ scrollTop: $('.chat-output')[0].scrollHeight }, 0)
                inChatActions()
            })
    }


    function inChatActions(){
        $('.play_vn').off().click(function(){
            AUDIO_ELEMENT.attr('src',  $(this).siblings('a').attr('href'))
            AUDIO_ELEMENT[0].load()
            AUDIO_ELEMENT[0].play()
        })
    }

    function getUserName(id, user_id) {

        user_id = user_id.replace('PROSE-','')

        $('[data-user="' + user_id + '"]').attr('id', id)
        
        $.ajax({
            url: './API/get_user_name.php',
            data: { data: [user_id] },
            type: 'POST',
            success: function(data) {
                if (data != '0') {
                    var target = $('#' + id),
                        dataArray = data.split(',')
                    target.find('h5').text(dataArray[0])
                    target.attr('data-type', dataArray[1])
                    target.attr('data-user', 'PROSE-'+user_id)
                    target.find('.avatar-xs').attr('src', 'IMG/' + dataArray[2])
                    target.attr('data-patient-id', dataArray[3])
                }
            },
            fail: function(data) {
                console.log(data)
            },
            error: function(data) {
                console.log(data)
            }
        })

    }

    function formatDate(someDateTimeStamp, withToday) {
        var dt = new Date(someDateTimeStamp),
            date = dt.getDate(),
            month = months[dt.getMonth()],
            timeDiff = someDateTimeStamp - Date.now(),
            diffDays = new Date().getDate() - date,
            diffMonths = new Date().getMonth() - dt.getMonth(),
            diffYears = new Date().getFullYear() - dt.getFullYear();

        if (diffYears === 0 && diffDays === 0 && diffMonths === 0) {
            if (withToday) {
                return "Today";
            } else {
                return someDateTimeStamp.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }).toUpperCase();
            }
        } else if (diffYears === 0 && diffDays === 1) {
            return "Yesterday";
        } else if (diffYears === 0 && diffDays === -1) {
            return month + " " + date + ", " + new Date(someDateTimeStamp).getFullYear();
            // return "Tomorrow";
            // } else if (diffYears === 0 && (diffDays < -1 && diffDays > -7)) {
        } else if (diffYears === 0 && (diffDays > 1 && diffDays < 7)) {
            return fulldays[dt.getDay()];
        } else if (diffYears >= 1) {
            return month + " " + date + ", " + new Date(someDateTimeStamp).getFullYear();
        } else {
            return month + " " + date + ", " + new Date(someDateTimeStamp).getFullYear();
        }
    }

    function formatTimeStampToDate(data) {
        var dateArray = data.toDate().toDateString().split(' ')
        return dateArray[0] + ', ' + dateArray[1] + ' ' + dateArray[2] + ' ' + dateArray[3]
    }

    function formatTimeStampToTime(data) {
        return data.toDate().toLocaleTimeString([], { hour: '2-digit', minute: '2-digit', hour12: true }).toUpperCase()
    }

    $('.close_treament_modal').on('click', function(){
        $('.treatment_frame').attr('src', '')
        $('.treament_modal').fadeOut()
    })