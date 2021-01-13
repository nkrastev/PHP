<?php
require "lib/autoload.php";
require "Config.php";
use MailchimpAPI\Mailchimp;

$mailchimp = new Mailchimp($apiKey);

$response = $mailchimp->campaigns()->get(["count" => 20, "sort_field"=>'create_time', 'sort_dir'=>'DESC']);
$json = json_decode($response->getBody(), true);

$camp = $response->deserialize()->campaigns;

// foreach($camp as $items)
// {
//     if ($items->recipients->list_id==$englishList && $items->status=='sent')
//     {
//         echo $items->id." ".$items->status." ".$items->long_archive_url;
//         echo "\n";
//         echo $items->recipients->list_id;
//         echo "\n";
//         echo $items->settings->subject_line;

//         echo "\n\n";
//     }
// }

$mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DATABASE);
mysqli_set_charset($mysqli, 'utf8mb4');
//printf("Success... %s\n", mysqli_get_host_info($mysqli));

$sql = "INSERT INTO site_newsletters (lang, subject, url) VALUES ('2', 'Test', 'tempUrl')";

if ($mysqli->query($sql) === TRUE) 
    {
        echo "New record created successfully";
    }
    else
    {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

?>