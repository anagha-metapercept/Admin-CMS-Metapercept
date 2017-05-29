<?php require_once('inc\top.php'); ?>
  </head>
  <body>
   <?php require_once('inc\header.php'); ?>
        
    <div class="jumbotron">
        <div class="container">
            <div id="details" class="animated fadeInLeft">
                <h1>Anagha's<span> Blog</span></h1>
                <p>Welcome to Anagha's Blog...!</p>
            </div>
        </div>
        <img src="img/top-image.jpg" alt="Top Image">
    </div>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-md-12">
                            <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyD4NBYAmg59_cr7Kx_zdGc7jGcP0J2wIrM'></script><div style='overflow:hidden;height:400px;width:100%;'><div id='gmap_canvas' style='height:400px;width:100%;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://travelaustria.co/'>Pardes Mein Hai Mera Dil in Innsbruck</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=58df9d9f6d6bf4f1144833764828633041d03835'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(18.56443578050341,73.77983621800173),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(18.56443578050341,73.77983621800173)});infowindow = new google.maps.InfoWindow({content:'<strong>Metapercept Technology Services LLP</strong><br>Royal Empress, Baner Road, Baner <br>411007 Pune<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
                        </div>
                        <div class="col-md-12"></div>
                    </div>
                </div>

                <div class="col-md-4">
                    <?php require_once('inc\sidebar.php'); ?>
                </div>
            </div>
        </div>
    </section>
  <?php require_once('inc\footer.php');?>   
  