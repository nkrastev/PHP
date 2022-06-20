<?php

$key = 'YourMegaGigaSecretKey';
$iv = mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC), MCRYPT_DEV_URANDOM);

$encryptedData = base64_encode($iv . mcrypt_encrypt(MCRYPT_RIJNDAEL_128, hash('sha256', $key, true),$plainData,MCRYPT_MODE_CBC,$iv));

?>
