<?php
require __DIR__ . '/vendor/autoload.php';
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$config = require('config.php');

// create a log channel for debugging
$log = new Logger('app');
$log->pushHandler(new StreamHandler('app.log', Logger::INFO));

//split the data we get from the frontend
list($type, $data) = explode(';', $_POST['imageData']);
$data =  substr($data, strpos($data, ",") + 1);
//name our new file
$name = md5($_POST['imageData']);

if ($type === 'data:image/png' || $type === 'data:image/jpeg') {
  $ext = substr($type, strpos($type, "/") + 1);
  $path = "./img/$name.$ext";

  file_put_contents($path, base64_decode($data));
}

// create curl resource
$ch = curl_init();
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Authorization: Bearer ' . $config['clarifai_token'],
    'Content-Type: multipart/form-data'
]);
curl_setopt($ch, CURLOPT_VERBOSE, false);
curl_setopt($ch, CURLOPT_SAFE_UPLOAD, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, [
  'encoded_data' => $data
]);
curl_setopt($ch, CURLOPT_URL, 'https://api.clarifai.com/v1/tag/');

//return the transfer as a string
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

//get the clarifai data
$resp = curl_exec($ch);
$resp_json = json_decode($resp, true);

//print_r($resp_json);
//close curl resource to free up system resources
curl_close($ch);

//the array where we store the full results,
//tags with associated co2 data
$found = [];

$file = fopen("./master_list.tsv","r");
$rownum = 0;
while (($row = fgetcsv($file, 0, "\t")) !== false) {
  $rownum++;
  //skip the first row
  if ($rownum == 1) {
    continue;
  }

  //check each result tag against the row
  foreach ($resp_json['results'][0]['result']['tag']['classes'] as $tag) {
    //match the full, freestanding tag, case insensitive
    $pattern = "/\b" . $tag . "\b/i";
    //reset matches
    $matches = [];

    //try to find the tag word inside the first column of the row
    preg_match($pattern, $row[0], $matches);

    //if a match exists
    if (!empty($matches[0])) {
      //check if we already have the tag as array key
      if (!array_key_exists($tag, $found)) {
        //if not create a new array to store the co2 data
        $found[$tag] = [];
      }
      //add result to array
      array_push($found[$tag], $row);
    }
  }
}

//close our resource file
fclose($file);

//return result to front-end
echo json_encode($found);
