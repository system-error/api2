<?php
require "src/Models/Auth.php";
require "config.php";
//
$auth = new Auth();

$path = $auth->getAuthorization($secretId,$callBackUrl);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<button type="button"><a href="<?php echo $path ?>"> Login with dropBox</a></button>
<form action="success.php" method="post">
    <input type="text" name="token" id="">
    <button type="submit" class="btn btn-primary" name="submit">Add the token</button>
</form>


</body>
</html>








