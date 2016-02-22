<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="CO2 Stats">
<meta name="twitter:description" content="Users can take pictures via mobile, we identify what is inside the picture and through our database, we can find the carbon footprint produced or used to manufactured each item.">
<meta name="twitter:image" content="http://169.54.145.209/img/2790901f9fa8b06529b38aeaa6a4a336">
<head>
    <title>#CO2 App Inspector</title>

    <link href="style.css" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-2.2.0.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
     <!-- cdnjs -->
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.6.5/jquery.lazy.min.js"></script>

    <script src="md5.min.js"></script>
    <script src="script.js"></script>
    <script src="transitions.js"></script>

</head>

<body>

	<div class="close-button" id="close-button" onclick="reset();" style="display:none">&times;</div>

    <div class="close-button" id="library-close-button" onclick="library_to_default();" style="display:none">&times;</div>

    <div class="image-cover">
        <canvas id="canvasID"></canvas>
    </div>

    <div class="navbar-more-overlay"></div>
    <nav class="navbar navbar-inverse animate navbar-bottom" id="main-nav">
        <div class="container navbar-more hidden">
            <ul class="nav navbar-nav"></ul>
        </div>
        <div class="container">

            <ul class="nav navbar-nav mobile-bar" style="width: inherit;">
                <li>
                  <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://http://169.54.145.209/" data-via="matikcloud" data-hashtags="co2">Tweet</a>
                  <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
                    <!-- <a href="#" onclick="shareFile();">
                        <span class="menu-icon fa fa-twitter"></span> Share
                    </a> -->
                </li>
                <li>
                    <div class="box">
                        <input type="file" name="file-5[]" id="file-5" class="inputfile inputfile-4 hidden" accept="image/*" />
                        <label for="file-5">
                            <figure>
                            		<img src="img/solarpanel.svg" style="width:100%">
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17">
                                    <path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z" />

                                </svg> -->
                            </figure>
                        </label>
                    </div>
                </li>
                <li>
                    <a href="#navbar-more-show" onclick="default_to_library();">
                        <span class="menu-icon fa fa-bookmark-o"></span> Library
                    </a>
                </li>
            </ul>
        </div>
    </nav>


     <div class="description navbar-bottom" style="bottom:-450px;">
       <div class="box box-panel">
           <div class="box-icon">
               <span>20</span>
           </div>
           <div class="info">
               <h4 class="text-center">Kg</h4>
               <p><img src="img/environment.svg"><img src="img/greenleaf.svg"><img src="img/ladybug.svg">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Corrupti atque, tenetur quam aspernatur corporis at explicabo nulla dolore necessitatibus doloremque exercitationem sequi dolorem architecto perferendis quas aperiam debitis dolor soluta!</p>
           </div>
       </div>
    </div>

    <div class="navbar-top info" id="library" style="display:none;">

        <div class="lib-item">
             <div class="text-data">
                <p>For more info, access, and update to our database, please visit: <a href="https://docs.google.com/spreadsheets/d/1UjpkJjhl7f7H7z2R_MYWNAT-6qlEDi7ahVGibEdqyaY/edit?usp=sharing" target="_blank">CO2 Database Google Sheet</a> for more details.
                </p>
            </div>
        </div>

        <div class="lib-item">
            <img class="lazy" data-src="img/library/tea.jpg" />
                <div class="text-data">
                    <p><ul><li>coffee</li><li>cup</li><li>hot</li><li>drink</li><li>breakfast</li><li>tea</li><li>dawn</li><li>espresso</li><li>saucer</li><li>caffeine</li></ul></p>
                    <p>A cup of tea requires 71g CO2e to manufacture according to <a href="http://www.amazon.com/How-Bad-are-Bananas-Everything/dp/1846688914" target="_blank">"How Bad Are Bananas? Calculated."</a></p>
                    <p>A large latte requires 340g CO2e to manufacture according to <a href="http://www.amazon.com/How-Bad-are-Bananas-Everything/dp/1846688914" target="_blank">"How Bad Are Bananas? Calculated."</a></p>
                </div>
                <div class="calculation">
                    <div class="data-num">52<span>CO2e (g)</span></div>
                    <div class="data-num">340<span>CO2e (g)</span></div>
                    <div class="clear"></div>
                </div>
        </div>
        <div class="lib-item">
            <img class="lazy" data-src="img/library/wedding.jpg" />
                <div class="text-data">
                    <p><ul><li>wedding</li><li>groom</li><li>bride</li><li>ceremony</li><li>woman</li><li>people</li><li>man</li><li>outdoors</li><li>love</li><li>military</li></p>
                    <p>Large Wedding with 300 guests can produce up to 84,500 CO2e (kg) according to <a href="http://www.jpmorganclimatecare.com/">ClimateCare.com</a></p>
                </div>
                <div class="calculation">
                    <div class="data-num">84500<span>CO2e (kg)</span></div>
                    <div class="data-num">&nbsp;<span>&nbsp;</span></div>
                    <div class="clear"></div>
                </div>
        </div>
        <div class="lib-item">
            <img class="lazy" data-src="img/library/tv.jpg" />
                <div class="text-data">
                    <p><ul><li>screen</li><li>monitor</li><li>window</li><li>picture frame</li><li>television</li><li>wood</li><li>no person</li><li>indoors</li><li>family</li><li>computer</li></p>
                    <p>Watching 28" TV per day requires 380g CO2e according to
                        <a href="http://www.amazon.com/How-Bad-are-Bananas-Everything/dp/1846688914" target="_blank">"How Bad Are Bananas? Calculated."</a>
                    </p>
                    <p>32 inch LCD TV (1 hr) requires 88g CO2e according to
                        <a href="http://www.amazon.com/How-Bad-are-Bananas-Everything/dp/1846688914" target="_blank">"How Bad Are Bananas? Calculated."</a>
                    </p>
                </div>
                <div class="calculation">
                    <div class="data-num">380<span>CO2e (g)</span></div>
                    <div class="data-num">88<span>CO2e (g)</span></div>
                    <div class="clear"></div>
                </div>
        </div>

        <div id="twitter-stream">
        </div>

        <!-- <a class="twitter-timeline" href="https://twitter.com/search?q=%23co2%20%40koding" data-widget-id="701451465240481792">Tweets about #co2 @koding</a>
        <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script> -->
    </div>

</body>
</html>
