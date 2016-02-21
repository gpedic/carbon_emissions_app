<?PHP
require "vendor/autoload.php";
$config = require("config.php");
use Abraham\TwitterOAuth\TwitterOAuth;

$twitteruser = "garyyauchan";
$notweets = $_POST['num_of_tweet'];

$connection = new TwitterOAuth(
  $config['twitter_consumer_key'],
  $config['twitter_consumer_secret'],
  $config['twitter_access_token'],
  $config['twitter_access_token_secret']
);

$query = $_POST['hashtag'];

// $tweets = $connection->get("statuses/user_timeline", array('count' => $notweets, 'exclude_replies' => true, 'screen_name' => $twitteruser));
$tweets = $connection->get("search/tweets", array('count' => $notweets, 'exclude_replies' => true, 'q' => $query));


echo json_encode($tweets);

?>
