<?php

require "config.php";

class Request
{
    private $accessToken = '';


    public static function postRequest($endpoint, $headers, $data, $json = TRUE,$accessToken='') {
    echo $data;
        $ch = curl_init($endpoint);
        array_push($headers, "Authorization: Bearer " . $accessToken);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $r = curl_exec($ch);
        curl_close($ch);

        if ($json)
            return json_decode($r, true);
        else
            return $r;
    }

    public function getToken($callBackUrl,$secretId,$appSecret){
        if(isset($_GET['code']) && isset($_GET['state'])) {
            $authorizationCode = $_GET['code'];
            $uri = "https://api.dropboxapi.com/oauth2/token";
            $params = array('code' => $authorizationCode,
                'grant_type' => 'authorization_code',
                'redirect_uri' => $callBackUrl);
            $ch = curl_init($uri);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
            curl_setopt($ch, CURLOPT_USERPWD, "$secretId:$appSecret");
            $r = curl_exec($ch);


            $token = json_decode($r);

            if(!isset($token->access_token)){
                $myfile = fopen("myToken.txt", "r");
                // Output one line until end-of-file
                while(!feof($myfile)) {
                    $access_token =  fgets($myfile);
                }
                //    echo $access_token;

                fclose($myfile);
                return $access_token;
            }else{
                $content =  $token->access_token;
                $fp = fopen("myToken.txt","wb");
                fwrite($fp,$content);
                fclose($fp);
                return $token->access_token;
            }



        }
    }

}

//
//$data = ['client_id'=>$client_id,
//    'response_type'=>'code',
//    'state'=>$state,
//    'redirect_uri'=>$redirectUrl];