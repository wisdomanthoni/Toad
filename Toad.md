#### Repository
https://github.com/wisdomanthoni/Toad

### New Projects![TOAD](http://res.cloudinary.com/dwde2t6ef/image/upload/q_100/v1528201901/image_nyufh2.png)

### ABOUT
TOAD is just another simple twitter video downloader. Actually, I'have been learning about Restful APi's recently, and I wanted to do something practical with it.

A friend of mine asked me to extend his Twitter Video Downloader class on https://github.com/xyluz/Twitter-Video-Downloader. 

#### *How It Works*
- ### It goes to your timeline and fetch every recent tweets
> Using Twitter API,  recent tweets from a user is fetched

      include_once('GetTwitterFeed.class.php');
     // this includes the PHP Class that verifies and fetches the feed,  go to http://bit.ly/2xLGFN6 to see GetTwitterFeed.class.php
     
    $retrieveUrl = "https://api.twitter.com/1.1/statuses/user_timeline.json?screen_name=". $_SESSION["username"];
    // retrieveUrl  fetches a user details from twitter 
    
    $consumer_key = KEY; // twitter api consumer key
    $consumer_key_secret = SECRET; //twiitter consumer secret
    
    $objTwitter = new GetTwitterFeed($retrieveUrl, $consumer_key, $consumer_key_secret);
     // An instance of the GetTwitterFeed is created 
     
    $raw_feed = json_decode($objTwitter->getJsonFeed(),TRUE);
    // Returns an array format of recent tweets from a user
    
    $count_feed = count($raw_feed); // counts number of tweets fetched

- ### Strips down the tweets and fetch out the video content

    
                       // Using a for loop I count every feed/tweet fetched
                        for($counter = 0; $counter <= $count_feed; $counter++){
                        //This checks for a tweet witha video content 
                            if(isset($raw_feed[$counter]['extended_entities']['media'][0]['video_info']) ){
                                $strip_feed = $raw_feed[$counter]['extended_entities']['media'][0]['video_info']['variants'];
                                //$strip feed strips down a tweet to get the video contents

                                foreach($strip_feed as $strip){
                                    if($strip['content_type'] != "application/x-mpegURL" && $strip['bitrate'] == 832000  ){
                                        // Presents video here

                                    }
                                }
                            }   
                        }


- ### Present all video content to you
```
// This replaces `Presents video here` in the above code
echo "<div class='col-md-6 bg-light'><img src='" . $raw_feed[$counter]['user']['profile_image_url']. "'><h2></h2>
 <p class='lead'>". $raw_feed[$counter]['text'] ."</p>
 <p><video width='100%' height='500px' controls>
 <source src='" . $strip['url'] . "' type='" . $strip['content_type'] . "'>                                       
 Your browser does not support the video tag.
 </video> </p>";

 echo " <a class='btn btn-success' href='" . $strip['url'] ."' role='button'>Download</a></div>" ;
```
Explain in great detail what your project is about and briefly describe already existing features.

### Technology Stack

- PHP 90%
- HTML and CSS

###  Roadmap
- Extend  TOAD to also fetch images and gifs from a twitter handle
- Also fetch all media content from a twitter Link
- Integrate other media sharing platform on TOAD e.g Dtube
- Improve better in my coding skills and contribute to more projects 

### How to contribute?
 If you want to contribute you can get in touch with me on  [twitter](https://twitter.com/wisdomanthoni "This link will take you away from steemit.com")
   
 ### Where can I test it?
 https://thetoad.herokuapp.com/

#### GitHub Account
https://github.com/wisdomanthoni

