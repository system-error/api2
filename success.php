<?php
require "config.php";
session_start();

require "src/Models/Request.php";
require "src/Models/Users.php";
require "src/Models/Files.php";
require "src/Models/Entry.php";

$token = new Request();
$token = $token->getToken($callBackUrl,$secretId,$appSecret);
$user = new Users($token);
$files = new Files($token);
$entry = new Entry();
//$token = $_SESSION["accessToken"];



//$test =$user->getCurrentAccount();
//print_r($test);
//echo "<br>";
//echo $test['name']['given_name'];
//echo "<br>";
//
//$test = $user->getAccount($test['account_id']);
//print_r($test);

echo "<br>";
echo "<br>";



//$thefiles = $files->getMetadata('/Chapter 1b.pptx',false,false,false);
//print_r($files);
//echo "<br>";
//echo "<br>";
//$thefiles = $files->listFolder('',true,false,false,false,true,true);
//print_r($files);
//echo "<br>";
//echo count($thefiles['entries']);
//echo "<br>";
//echo $thefiles['has_more'];
//echo "<br>";
//echo "<br>";
//$thefiles = $files->listFolderContinue($thefiles['cursor']);
//print_r($thefiles);
//echo "<br>";
//echo "<br>";




//$thefiles = $files->copy('/Chapter 1b.pptx','/python/Chapter 1b.pptx',false,false,false);
//print_r($thefiles);

//$file1 = array('/python/' => '/cyberCrime/');
//$file2 = array('/python/FSM.py' => '/cyberCrime/FSM.py');
//$file3 = array('/python/states.py'=>'/cyberCrime/states.py');
//'from_path' => '/python/states.py','to_path'=>'/cyberCrime/states.py'



$entries = [$entry->getEntries('/python/FSM.py','/cyberCrime/FSM.py'),$entry->getEntries('/python/states.py','/cyberCrime/states.py')] ;

$thefiles = $files->copyBatch($entries,false);
print_r($thefiles);


























//if(isset($_POST['submit'])){
//    $token =  $_POST['token'];
//    $user1 = $user->getCurrentAccount($token->access_token);
//    print_r($user1);
//}else{
//    echo "Now token";
//}

//$token = 'TB9EqqtY0LMAAAAAAAAKdSZIesB5hbeaCRlM-medSu_BSICZiNJyhooNf9MRZy23';


