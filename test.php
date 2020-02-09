<?php

require "src/Models/Request.php";
require "src/Models/Users.php";
require "src/Models/Auth.php";


$dropbox = new Request();
$secretId = 'ikiz6cgr39ik285';
$appSecret = 'zhvigzx6iu76d8w';
$callBackUrl = "http://localhost:8080/test/api/test.php";
$auth = new Auth();

$auth->getAuthorization($secretId,$callBackUrl);

$request= $dropbox->getToken($callBackUrl,$secretId);
echo $request;
$user = new Users();

echo $user->getCurrentAccount();





