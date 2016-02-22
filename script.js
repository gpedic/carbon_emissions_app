$( document ).ready(function() {

    if (window.File && window.FileReader && window.FormData) {
        var $inputField = $('#file-5');

        $inputField.on('change', function(e) {

            var loadingImage = loadImage(
                e.target.files[0],
                function (img) {
                   var rotation6 = img.toDataURL();
                },
                {orientation: 6}
            );
            var loadingImage2 = loadImage(
                e.target.files[0],
                function (img) {
                   var rotation1 = img.toDataURL();
                },
                {orientation: 1}
            );

            readFile(rotation1, rotation6);
            // var file = e.target.files[0];

            // if (file) {
            //     if (/^image\//i.test(file.type)) {
            //         readFile(file);
            //     } else {
            //         alert('Not a valid image!');
            //     }
            // }
        });
    } else {
        alert("File upload is not supported!");
    }

    // LOAD LIBRARY IMAGES
    $(function() {
        $('.lazy').lazy();
    });

    // LOAD LIBRARY
    twitter_stream(15, '#co2 #hackathon');
});

function readFile(file1, file2) {

    processFile(file1, file2);
    // var reader = new FileReader();

    // reader.onloadend = function() {
    //     processFile(reader.result, file.type);
    // }

    // reader.onerror = function() {
    //     alert('There was an error reading the file!');
    // }

    // reader.readAsDataURL(file);
}

function processFile(dataURL, dataURL2) {

    // HIDE BG COVER
    $('.image-cover').addClass('bg');


    var maxWidth = 800;
    var maxHeight = 800;

    var image = new Image();
    image.src = dataURL2;

    image.onload = function() {
        var width = image.width;
        var height = image.height;
        var shouldResize = (width > maxWidth) || (height > maxHeight);

        // if (!shouldResize) {
        //  //sendFile(dataURL);
        //  return;
        // }

        var newWidth;
        var newHeight;

        if (width > height) {
            newHeight = height * (maxWidth / width);
            newWidth = maxWidth;
        } else {
            newWidth = width * (maxHeight / height);
            newHeight = maxHeight;
        }

        var canvas = document.getElementById('canvasID');

        canvas.width = newWidth;
        canvas.height = newHeight;

        var context = canvas.getContext('2d');

        context.drawImage(this, 0, 0, newWidth, newHeight);

        //dataURL = canvas.toDataURL(fileType);

        //console.log(dataURL);
        sendFile(dataURL, dataURL2);


        
    };

    image.onerror = function() {
        alert('There was an error processing your file!');
    };
}

function sendFile(fileData, fileData2) {
    var formData = new FormData();

    formData.append('imageData', fileData2);

    $.ajax({
        type: 'POST',
        url: 'clarifai.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            //alert('Your file was successfully uploaded!');

            console.log(data);

            var data = $.parseJSON(data);
            var message_html = '<br>';
            var message_ul = '<br><ul>';
            var total_co2 = 0;

            for (var i in data) { 

                //var item_detected = data[i];
                console.log(data[i]);
                var item_logged = data[i][0][0];
                var item_co2 = data[i][0][2];
                var item_source = data[i][0][8];
                var item_source_url = data[i][0][9];

                message_ul += '<li>'+i+'</li>';
                message_html += item_logged+' produces about ' + item_co2 + ' Co2 (g) according to <a href="'+item_source_url+'">'+ item_source +'</a>.<br><br>';

                total_co2 = parseFloat(total_co2) + parseFloat(item_co2);
            }

            message_ul += '</ul>';

            $('#text_message').append(message_ul + message_html);

            $('#co2_kg').html(total_co2);

            // TOGGLE PANELS
            default_to_open();


            // AUTO SHARE
            shareFile(fileData, item_logged+' produces about ' + item_co2 + ' Co2 (g)');
        },
        error: function(data) {
            alert('There was an error uploading your file!');
        }
    });
}

function shareFile(fileData, message_html) {
    var formData = new FormData();

    formData.append('imageData', fileData);
    formData.append('message', '#co2 #hackathon ' + message_html);

    $.ajax({
        type: 'POST',
        url: 'twitter.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            //console.log('shared');
            console.log(data);

            // for (var i = data.length - 1; i >= 0; i--) {
            //     data[i]
            // };

            // RELOAD BACK TO LIBRARY
            twitter_stream(1, '#co2 #hackathon');
        },
        error: function(data) {
            console.log(data);
            //alert('There was an error uploading your file!');
        }
    });
}
