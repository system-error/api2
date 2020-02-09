<?php




require 'Auth.php';

class Request
{


    public static function getToken(){
        $secretId = 'ikiz6cgr39ik285';
        $appSecret = 'zhvigzx6iu76d8w';
        $callBackUrl = "http://localhost:8080/test/api/test.php";
        $endPoint = "https://api.dropboxapi.com/oauth2/token";
        $auth = new Auth();

        $test = $auth->getAuthorization($secretId,$callBackUrl);

        die();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $test);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $r = curl_exec($ch);
        return $r;
//        curl_close($ch);
//        die();
//        if(isset($_GET['code']) && isset($_GET['state'])){
//            $authorizationCode = $_GET['code'];
//        }
//        $data = ['code'=> $authorizationCode,
//                'grant_type'=>'authorization_code',
//                'redirect_uri'=>$callBackUrl];
//
//        $ch = curl_init($endPoint);
//        curl_setopt($ch, CURLOPT_POST, TRUE);
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
//        curl_setopt($ch, CURLOPT_USERPWD, "$secretId:$appSecret");
//
//        $r = curl_exec($ch);
//        curl_close($ch);

    }

}

//
//$data = ['client_id'=>$client_id,
//    'response_type'=>'code',
//    'state'=>$state,
//    'redirect_uri'=>$redirectUrl];