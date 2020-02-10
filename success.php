<?php

session_start();

require "src/Models/Request.php";
require "src/Models/Users.php";
require "config.php";
$user = new Users();
$dropbox = new Request();
$request= $dropbox->getToken($callBackUrl,$secretId,$appSecret);
$token = json_decode($request);

//$oauth_token = $_SESSION["accessToken"];
//echo "<br>";
//print_r($_SESSION);

if(!isset($token->access_token)){
    $myfile = fopen("myText.txt", "r");
// Output one line until end-of-file
    while(!feof($myfile)) {
        $access_token =  fgets($myfile);
    }
//    echo $access_token;
    $user1 = $user->getCurrentAccount($access_token);
    fclose($myfile);
}else{
    $content =  $token->access_token;
    $fp = fopen("myText.txt","wb");
    fwrite($fp,$content);
    fclose($fp);
    $user1 = $user->getCurrentAccount($token->access_token);
}

print_r($user1);


//if(isset($_POST['submit'])){
//    $token =  $_POST['token'];
//    $user1 = $user->getCurrentAccount($token->access_token);
//    print_r($user1);
//}else{
//    echo "Now token";
//}

//$token = 'TB9EqqtY0LMAAAAAAAAKdSZIesB5hbeaCRlM-medSu_BSICZiNJyhooNf9MRZy23';


