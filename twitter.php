<?PHP
require "vendor/autoload.php";
$config = require("config.php");
use Abraham\TwitterOAuth\TwitterOAuth;

// TEXT
$message = $_POST['message'];

// IMAGE
//split the data we get from the frontend
list($type, $data) = explode(';', $_POST['imageData']);

//name our new file
//$name = md5($data);

//get
$data =  substr($data, strpos($data, ",") + 1);
// $image_data = explode(",",$data);

$connection = new TwitterOAuth(
  $config['twitter_consumer_key'],
  $config['twitter_consumer_secret'],
  $config['twitter_access_token'],
  $config['twitter_access_token_secret']
);
//$content = $connection->get("account/verify_credentials");
//$statues = $connection->post("statuses/update", ["status" => "hello world"]);

$media1 = $connection->upload('media/upload', ['media_data' => 'data:image/gif;base64,R0lGODlhEAAQAMQAAORHHOVSKudfOulrSOp3WOyDZu6QdvCchPGolfO0o/XBs/fNwfjZ0frl3/zy7////wAAAAAAAAAAAAA'];


//$media2 = $connection->upload('media/upload', ['media' => 'img/library/2.jpg']);
$parameters = [
    'status' => $message,
    'media_ids' => $media1->media_id_string],
];
$result = $connection->post('statuses/update', $parameters);


?>
