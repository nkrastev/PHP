<?php
require "lib/autoload.php";
require "Config.php";

$mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DATABASE);
mysqli_set_charset($mysqli, 'utf8mb4');
$clearTheTable='TRUNCATE TABLE site_newsletters';
$mysqli->query($clearTheTable);


use MailchimpAPI\Mailchimp;
$mailchimp = new Mailchimp($apiKey);

$response = $mailchimp->campaigns()->get(["count" => 100, "sort_field"=>'create_time', 'sort_dir'=>'DESC']);
$json = json_decode($response->getBody(), true);

$camp = $response->deserialize()->campaigns;

foreach($camp as $items)
{
    if ($items->status=='sent')
    {
        //lang check depending on mailchimp list id
        $langId=0;
        if ($items->recipients->list_id==$englishList)
        {
            $langId=1;
        } 
        if ($items->recipients->list_id==$bulgarianList)
        {
            $langId=3;
        }
        if ($items->recipients->list_id==$danishList)
        {
            $langId=2;
        }     
        //prepare data
        $dataSubject=$items->settings->subject_line;
        $dataUrl=$items->long_archive_url;

        //insert in DB

        $sql = "INSERT INTO site_newsletters (lang, subject, url) VALUES ($langId, '$dataSubject', '$dataUrl')";
        $mysqli->query($sql);
    }
}
