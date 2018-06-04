<?php 
  session_start();
  $_SESSION["username"] ="TwitterVideo" ;

  if (isset($_GET['username'])) {
    $_SESSION["username"] = $_GET['username'];
  }

 ?>

<?php

include 'app.php';

include_once('GetTwitterFeed.class.php');

$retrieveUrl = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=". $_SESSION["username"];

$consumer_key = KEY; // twitter api consumer key
$consumer_key_secret = SECRET; //twiitter consumer secret

$objTwitter = new GetTwitterFeed($retrieveUrl, $consumer_key, $consumer_key_secret);

$raw_feed = json_decode($objTwitter->getJsonFeed(),TRUE);

$count_feed = count($raw_feed);

 // echo json_encode($raw_feed);
 // exit();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">

    <title>Toad</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.1/css/bootstrap.min.css">

    <!-- Custom styles for this template -->
    <link href="app.css" rel="stylesheet">
  </head>

  <body>

    <nav class="site-header sticky-top py-1">
      <div class="container d-flex flex-column flex-md-row justify-content-between">
        <a class="py-2 d-none d-md-inline-block" href="#">T</a>
        <a class="py-2" href="#">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mx-auto"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
        </a>
        <a class="py-2 d-none d-md-inline-block" href="#">A</a>
        <a class="py-2 d-none d-md-inline-block" href="#">D</a>
        <!-- <a class="py-2 d-none d-md-inline-block" href="#">Tour</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Product</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Features</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Enterprise</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Support</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Pricing</a>
        <a class="py-2 d-none d-md-inline-block" href="#">Cart</a> -->
      </div>
    </nav>

    <div class="position-relative overflow-hidden p-3 p-md-5 m-md-3 text-center bg-light">
      <div class="col-md-5 p-lg-5 mx-auto my-5">
        <form method="GET" accept="">
            <div class="input-group mb-3">
                  <input type="text" class="form-control" name="username" placeholder="Search for videos via a handle username " aria-label="Search username" aria-describedby="basic-addon2">
                  <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Get Video</button>
                  </div>
                </div>
        </form >
        <h3 class="display-7 font-weight-normal">How it works:</h3>
        <p class=" font-weight-normal">
1. It goes to your timeline and fetch every recent tweets.<br>
2. Strips down the tweets and fetch out the video content<br>
3. Present all video content to you.
<br>
<small>SO, if you see a video you like, just retweet it. <br>
come back to the app<br>
And it will be listed <br>
then you download .</small></p>
        <a class="btn btn-outline-secondary" href="#video">Thank you.</a>
      </div>
      <div class="product-device box-shadow d-none d-md-block"></div>
      <div class="product-device product-device-2 box-shadow d-none d-md-block"></div>
    </div>
    
  <div id="svideo" class="mx-5 px-5">
        <div class=" col-sm-12 col-md-12"> <img src="">
                <div class="row">
                    <?php
                        for($counter = 0; $counter <= $count_feed; $counter++){

                            if(isset($raw_feed[$counter]['extended_entities']['media'][0]['video_info']) ){
                                $strip_feed = $raw_feed[$counter]['extended_entities']['media'][0]['video_info']['variants'];

                                foreach($strip_feed as $strip){
                                    if($strip['content_type'] != "application/x-mpegURL" && $strip['bitrate'] == 832000  ){
                                        echo "<div class='col-md-6 bg-light'><img src='" . $raw_feed[$counter]['user']['profile_image_url']. "'><h2></h2>
                                        <p class='lead'>". $raw_feed[$counter]['text'] ."</p>
                                         <p><video width='100%' height='500px' controls>
                                          <source src='" . $strip['url'] . "' type='" . $strip['content_type'] . "'>
                                         
                                        Your browser does not support the video tag.
                                        </video> </p>";

                                        echo " <p><a class='btn btn-successs' href='" . $strip['url'] ."' role='button'>Download</a></p></div>" ;

                                    }
                                }
                            }   
                        }

                    ?>
                </div>
        </div>
  </div>



    

    <footer class="container py-5">
      <div class="row">
        <div class="col-12 col-md">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="d-block mb-2"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
          <small class="d-block mb-3 text-muted">&copy; 2017-2018</small>
        </div>
        <!-- s -->
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
    <script src="../../assets/js/vendor/popper.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <script>
      Holder.addTheme('thumb', {
        bg: '#55595c',
        fg: '#eceeef',
        text: 'Thumbnail'
      });
    </script>
  </body>
</html>
