<?php

//input data
$largeFiles = 'insert paths';
$midFiles=    'insert paths';
$smallFiles = 'insert paths';
$id=$_GET['id'];

$largeFileName=$_FILES['file']['name'];

//new image names the ID is from DB!!!
$largeImgName='Th2file_'.$id.'.jpg';
$midImgName='Th3file_'.$id.'.jpg';
$smallImgName='Th1file_'.$id.'.jpg';

echo '<pre>';

//save large file passed from jQuery upload
if (move_uploaded_file($_FILES['file']['tmp_name'],$largeFiles.$largeImgName)) { echo 'Upload success<br>';}

//mid image
$midImage = imagecreatefromjpeg($largeFiles.$largeImgName);
$imgResized = imagescale($midImage , 260, 165);
imagejpeg($imgResized, $midFiles.$midImgName, 100);

//small image
$smallImage = imagecreatefromjpeg($largeFiles.$largeImgName);
$imgResized = imagescale($smallImage , 260, 165);
imagejpeg($imgResized, $smallFiles.$smallImgName, 100);


//print results from upload and resizing
echo 'Product ID from get request >'.$id."<br>";

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

echo 'v6.5<br>';

?>