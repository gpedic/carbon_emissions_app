function reset(){

    // TOGGLE PANELS
    close_to_default();   
}

function close_to_default(){
    // SHOW NAV BAR
    $('#main-nav').animate({bottom: '+=500px'}, 500);

    // CLOSE UP DATA PANEL
    $('.description').animate({bottom: '-=450px'}, 750);

    // HIDE CLOSE BUTTON
    $('#close-button').hide();

    // SHOW COVER
    $('.image-cover').show();
}

function default_to_open(){
    // HIDE NAV BAR
    $('#main-nav').animate({bottom: '-=500px'}, 500);

    // SHOW CLOSE BUTTON
    $('#close-button').show();

    // OPEN UP DATA PANEL
    $('.description').animate({bottom: '+=450px'}, 750);

    // HIDE COVER
    //$('.image-cover').hide();
}

function default_to_library(){
    // HIDE NAV BAR
    $('#main-nav').animate({bottom: '-=500px'}, 500);

    // SHOW LIBRARY
    $('#library').show();

    // SHOW CLOSE BUTTON
    $('#library-close-button').show();

    // HIDE COVER
    $('.image-cover').hide();
}

function library_to_default(){
    // SHOW NAV BAR
    $('#main-nav').animate({bottom: '+=500px'}, 500);

    // HIDE LIBRARY
    $('#library').hide(); 

    // HIDE CLOSE BUTTON
    $('#library-close-button').hide();

    // SHOW COVER
    $('.image-cover').show();
}


function twitter_stream(num_of_tweet, hashtag){
    var formData = new FormData();

    formData.append('num_of_tweet', num_of_tweet);
    formData.append('hashtag', hashtag);

    $.ajax({
        type: 'POST',
        url: 'timeline.php',
        data: formData,
        contentType: false,
        processData: false,
        success: function(data) {
                
                var data = $.parseJSON(data);
                var tweets_html = '';
                //data = data['statuses'];
                
                for (var i = data.length - 1; i >= 0; i--) {
                    var message = data[i]['text'];
                    var from = data[i]['user']['screen_name'];
                    if(typeof data[i]['entities']['media'] !== 'undefined'){
                        var image_url = data[i]['entities']['media'][0]['media_url'];
                        tweets_html += '<div class="lib-item"><img class="lazy" src="'+image_url+'" />';
                        tweets_html += '<div class="text-data">';
                        tweets_html += '<p>From '+from+'</p>';
                        tweets_html += '<p>'+message+'</p>';
                        tweets_html += '</div>';
                        tweets_html += '</div>';
                    }

                };

                $('#twitter-stream').append(tweets_html);   
            
        },
        error: function(data) {
            alert('There was an error uploading your file!');
        }
    });
    
}