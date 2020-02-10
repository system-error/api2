<?php
require "config.php";
session_start();

require "src/Models/Request.php";
require "src/Models/Users.php";
require "src/Models/Files.php";

$user = new Users();

$token = new Request();
//$oauth_token = $_SESSION["accessToken"];
//echo "<br>";
//print_r($_SESSION);
//$toke = new Request();
$token = $token->getToken($callBackUrl,$secretId,$appSecret);


//$test =$user->getCurrentAccount($token);
//print_r($test);
//echo "<br>";
//echo $test['name']['given_name'];
//echo "<br>";
//
//$test = $user->getAccount($test['account_id'],$token);
//print_r($test);

echo "<br>";
echo "<br>";

$files = new Files();

$filesMetadata = $files->get_metadata('/cyberCrime',false,false,false,$token);
print_r($filesMetadata);


//if(isset($_POST['submit'])){
//    $token =  $_POST['token'];
//    $user1 = $user->getCurrentAccount($token->access_token);
//    print_r($user1);
//}else{
//    echo "Now token";
//}

//$token = 'TB9EqqtY0LMAAAAAAAAKdSZIesB5hbeaCRlM-medSu_BSICZiNJyhooNf9MRZy23';


