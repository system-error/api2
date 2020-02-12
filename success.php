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




//$entries = [$entry->getEntries('/python/FSM_OOP.py','/cyberCrime/FSM_OOP.py'),$entry->getEntries('/python/FSM.py','/cyberCrime/FSM.py'),$entry->getEntries('/python/states.py','/cyberCrime/states.py')] ;
//$thefiles = $files->copyBatch($entries,false);
//print_r($thefiles);
//echo "<br>";
//$checkFiles = $files->copyBatchCheck("dbjid:AADv67hzYk5-MmXvfFI0xTtH6O4MRucJDV4Gj5-IcFtU54USYrxk6Neaam1qARNebTmSZYf_TlguJ1rUV6XfQq_Z");
//print_r($checkFiles);

//$thefiles = $files->copyReferenceGet('/Chapter 1b.pptx');
//
//print_r($thefiles);

//$thefiles = $files->copyReferenceSave("AAAAAAVa1fx6ZnVwaGYzcGpodGQ",'/Chapter 1b.pptx');
//print_r($thefiles);

//$thefiles = $files->createFolder("/python/test",false);
//print_r($thefiles);

//$paths = array('/python/test','/python/test1','/python/tes2');
////$paths = $entry->getMultiplePaths($paths);
//$thefiles = $files->createFolderBatch($paths,false,false);
//print_r($thefiles);



//$thefiles = $files->deleteFiles("/test.txt");
//print_r($thefiles);

$paths = array('/test1.txt','/test2.txt','/test3.txt');

$paths = $entry->getMultiplePaths($paths);

$thefiles = $files->deleteFilesBatch($paths);
print_r($thefiles);




















//if(isset($_POST['submit'])){
//    $token =  $_POST['token'];
//    $user1 = $user->getCurrentAccount($token->access_token);
//    print_r($user1);
//}else{
//    echo "Now token";
//}

//$token = 'TB9EqqtY0LMAAAAAAAAKdSZIesB5hbeaCRlM-medSu_BSICZiNJyhooNf9MRZy23';


