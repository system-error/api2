<?php
require "config.php";
session_start();

require "src/Models/Request.php";
require "src/Models/Users.php";
require "src/Models/Files.php";
require "src/Models/Entry.php";
require "src/Models/Thumbnail.php";


$token = new Request();
$token = $token->getToken($callBackUrl,$secretId,$appSecret);
$user = new Users($token);
$files = new Files($token);

//$token = $_SESSION["accessToken"]; if I want it



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




//$entries = [Entry::getEntries('/python/FSM_OOP.py','/cyberCrime/FSM_OOP.py'),Entry::getEntries('/python/FSM.py','/cyberCrime/FSM.py'),Entry::getEntries('/python/states.py','/cyberCrime/states.py')] ;
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

//$thefiles = $files->createFolder("/python/test1",false);
//print_r($thefiles);

//$paths = array('/python/test','/python/test1','/python/tes2');

//$thefiles = $files->createFolderBatch($paths,false,false);
//print_r($thefiles);



//$thefiles = $files->deleteFiles("/test.txt");
//print_r($thefiles);

//$paths = array('/test1.txt','/test2.txt','/test3.txt');
//
//$paths = Entry::getMultiplePaths($paths);
//print_r($paths);
//echo "<br>";
//echo "<br>";
//$thefiles = $files->deleteFilesBatch($paths);
//print_r($thefiles);


//$thefiles =$files->downloadFile('/Chapter4.pptx');
//$thefiles =$files->downloadZip('/python');
//echo $thefiles;
//print_r($thefiles);
//$thefiles =$files->getPrieview('id:lzJrbPHQIYAAAAAAAADWjQ');
//$thefiles =$files->getMetadata('/templates.xlsx');
//print_r($thefiles);
//$thefiles =$files->getTemporaryLink('/templates.xlsx');
//$thefiles =$files->getTemporaryUploadLink('/templates.xlsx');
//print_r($thefiles);
//print_r($thefiles['link']);

//$test = Entry::getCommitInfo('/test.txt');
//$thefiles =$files->getTemporaryUploadLink($test);
//echo $thefiles['link'];
//print_r($thefiles);
//print_r($test);





$tmumbs = array(new Thumbnail('/python/images-6.jpg'));

$testaki = Entry::getThumbnailParameters($tmumbs);

$giapame = $files->getThumbnail($testaki);

print_r($giapame);













//if(isset($_POST['submit'])){
//    $token =  $_POST['token'];
//    $user1 = $user->getCurrentAccount($token->access_token);
//    print_r($user1);
//}else{
//    echo "Now token";
//}

//$token = 'TB9EqqtY0LMAAAAAAAAKdSZIesB5hbeaCRlM-medSu_BSICZiNJyhooNf9MRZy23';


