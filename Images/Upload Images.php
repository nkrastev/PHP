<?php

//process uploaded image from simpleUpload.js library

//requirements: PHP 5.5+, jQuery 1.9+

//input data
$largeFiles = 'Insert path';
$midFiles=    'Insert path';
$smallFiles = 'Insert path';
$id=$_GET['id'];

$trName=$_FILES['file']['name'];
$trSize=$_FILES['file']['size'];

//connect to DB
define('MYSQL_HOST', 'data to connect');
define('MYSQL_USER', 'data to connect');
define('MYSQL_PASS', 'data to connect');
define('MYSQL_DATABASE', 'data to connect');
$mysqli = mysqli_connect(MYSQL_HOST, MYSQL_USER, MYSQL_PASS, MYSQL_DATABASE);
mysqli_set_charset($mysqli, 'utf8mb4');

//insert new record and get the ID for the image names
$sql = "INSERT INTO site_files (langID, fatherType, fatherID, file_type, file_name, file_ext, file_mime, file_size, active, adminID, file_width, file_height, video_status, fileUploaded) 
                       VALUES  (0,      2,          '$id',    'image',   '$trName', 'jpg',    'image/jpeg', '$trSize', 1,   0,       800,   600,   'Q', now())";
$mysqli->query($sql);

//get the ID for the inserted image
$result = $mysqli->query("SELECT fileID FROM `site_files` WHERE fatherID='$id' AND file_name='$trName' ORDER BY fileID DESC");
$row   = mysqli_fetch_row($result);
$idForFileName=$row[0];


//new image names the ID is from DB!!!
$largeImgName='Th2file_'.$idForFileName.'.jpg';
$midImgName=  'Th3file_'.$idForFileName.'.jpg';
$smallImgName='Th1file_'.$idForFileName.'.jpg';

echo '<pre>';

//save large file passed from jQuery upload
if (move_uploaded_file($_FILES['file']['tmp_name'],$largeFiles.$largeImgName)) { echo 'Upload success<br>';}

//mid image
$midImage = imagecreatefromjpeg($largeFiles.$largeImgName);
$imgResized = imagescale($midImage , 260, 165);
imagejpeg($imgResized, $midFiles.$midImgName, 100);

//small image
$smallImage = imagecreatefromjpeg($largeFiles.$largeImgName);
$imgResized = imagescale($smallImage , 80, 50);
imagejpeg($imgResized, $smallFiles.$smallImgName, 100);


//print results from upload and ID of the product for debugging
//echo 'Product ID from get request >'.$id."<br>";

//print_r($_FILES);

// echo 'File name: '.$largeImgName."<br>";
// echo 'File type: '.$_FILES['file']['type']."<br>";
// echo 'Temp name: '.$_FILES['file']['tmp_name']."<br>";
// echo 'Errors: '.$_FILES['file']['error']."<br>";
// echo 'Size: '.$_FILES['file']['size']."<br>";

echo '<pre>';
echo $largeImgName.' created<br>';
echo $midImgName.' created<br>';
echo $smallImgName.' created<br>';
echo '</pre>';

echo '<hr>v7.0<br>';

?>