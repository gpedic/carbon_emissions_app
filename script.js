$( document ).ready(function() {

    if (window.File && window.FileReader && window.FormData) {
        var $inputField = $('#file-5');

        $inputField.on('change', function(e) {
            var file = e.target.files[0];

            if (file) {
                if (/^image\//i.test(file.type)) {
                    readFile(file);
                } else {
                    alert('Not a valid image!');
                }
            }
        });
    } else {
        alert("File upload is not supported!");
    }

    // LOAD LIBRARY IMAGES
    $(function() {
        $('.lazy').lazy();
    });

});

function readFile(file) {
    var reader = new FileReader();

    reader.onloadend = function() {
        processFile(reader.result, file.type);
    }

    reader.onerror = function() {
        alert('There was an error reading the file!');
    }

    reader.readAsDataURL(file);
}

function processFile(dataURL, fileType) {

    // HIDE BG COVER
    $('.image-cover').addClass('bg');


    var maxWidth = 800;
    var maxHeight = 800;

    var image = new Image();
    image.src = dataURL;

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

        dataURL = canvas.toDataURL(fileType);


        //console.log(dataURL);
        sendFile(dataURL);


        // AUTO SHARE
        shareFile(dataURL);
    };

    image.onerror = function() {
        alert('There was an error processing your file!');
    };
}

function sendFile(fileData) {
    var formData = new FormData();

    formData.append('imageData', fileData);

    $.ajax({
        type: 'POST',
        url: 'clarifai.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            if (data.success) {
                alert('Your file was successfully uploaded!');

                console.log(success);


                
                // TOGGLE PANELS
                default_to_open();   
            } else {
                alert('There was an error uploading your file!');
            }
        },
        error: function(data) {
            alert('There was an error uploading your file!');
        }
    });
}

function shareFile(fileData) {
    var formData = new FormData();

    formData.append('imageData', fileData);
    formData.append('message', 'cool #CO2');

    $.ajax({
        type: 'POST',
        url: 'twitter.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
            //console.log('shared');
            console.log(data);
        },
        error: function(data) {
            console.log(data);
            //alert('There was an error uploading your file!');
        }
    });
}

function twitter_stream(){
    $('#twitter-stream').html();
}