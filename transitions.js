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