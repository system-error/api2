<?php

require "config.php";

class Request
{

    public static function postRequest($endPoint, $headers, $data, $json = TRUE,$accessToken='') {
        $ch = curl_init($endPoint);
        array_push($headers, "Authorization: Bearer " . $accessToken);
        print_r($headers);
        die();
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        if ($json)
            return json_decode($response, true);
        else
           return $response;
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
            $response = curl_exec($ch);


            $token = json_decode($response);

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