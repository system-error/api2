<?php

require "src/Models/Auth.php";

$dropbox = new Auth();
$secretId = 'ikiz6cgr39ik285';
$appSecret = 'zhvigzx6iu76d8w';
$callBackUrl = "http://localhost:8080/test/api/test.php";


$request= $dropbox->getAuthorization($secretId,$callBackUrl);



