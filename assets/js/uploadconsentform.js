$(document).ready(function() {


    $('.needsclick').click(function() {
        $('#fallback_input')[0].click()
    })

    let IMAGE_DATA = null

    $('#fallback_input').on("change", function(e) {

        var t = $(this),
            fileList = e.target.files
        let file = null;
        for (let i = 0; i < fileList.length; i++) {
            if (fileList[i].type.match(/^image\//)) {
                file = fileList[i];
                break;
            }
        }

        IMAGE_DATA = URL.createObjectURL(file)

        $('.raw_image').attr('src', URL.createObjectURL(file))

        var myfiles = document.getElementById("fallback_input"),
            files = myfiles.files,
            data = new FormData(),
            file_names = [],
            file_sizes = [],
            file_links = []


        for (i = 0; i < files.length; i++) {

            if (files[i].size < 41000000) {
                data.append('file' + i, files[i]);
                $('.file_name').text(files[i].name)
                file_names.push(files[i].name)
                // file_sizes.push(formatFileSize(files[i].size))
                // console.log(files[i].name + ' -> ' + formatFileSize(files[i].size))
            }
        }

    });

    $('#proceed').click(function(e){
       
        e.preventDefault()

        if(IMAGE_DATA == null){
            error('No file chosen yet :/', '')
        }else{

            Swal.fire({
                title: "Uploading",
                html: "1%",
                allowOutsideClick: false,
                onBeforeOpen: function() { Swal.showLoading() }
            })

            var percentComplete = 0
    
            const image = $('.raw_image')[0],
                    canvas = $('canvas')[0],
                    maxWidth = 3000,
                    scaleSize = maxWidth / image.width;
                canvas.width = maxWidth
                canvas.height = image.height * scaleSize
                canvas.getContext('2d').drawImage(image, 0, 0, canvas.width, canvas.height)
    
                var canvasData = canvas.toDataURL(image, 'image/jpeg')
            
            $.ajax({
                xhr: function() {
                  var xhr = new window.XMLHttpRequest();
              
                  xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                      percentComplete = evt.loaded / evt.total;
                      percentComplete = parseInt(percentComplete * 100);
                      console.log(percentComplete);

                      $('.swal2-content').text(percentComplete + '%')
              
                      if(percentComplete === 100) {
                        console.log('Upload completed')
                      }
              
                    }
                  }, false);
              
                  return xhr;
                },
                url: './api_uploadconsent.php?id='+USER_ID,
                data: { images: canvasData },
                type: 'POST',
                success: function(result) {

                  console.log(result, percentComplete, result.substring(0,1));

                  if(percentComplete === 100 && result.substring(0,1) == '1') {
                    console.log('Upload completed')
                    success('Success', 'Consent form uploaded successfully')
                    setTimeout(() => {
                        window.location.href = 'NewPatient?WithAuth='+AUTH
                    }, 2000);
                  }

                }
            });
        }


    })




})