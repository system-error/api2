<?php


class Request
{

    public $accessToken = '';

    public static function postRequest($endpoint, $headers, $data, $json = TRUE,$accessToken=null) {
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
            return $r;

        }
    }

}

//
//$data = ['client_id'=>$client_id,
//    'response_type'=>'code',
//    'state'=>$state,
//    'redirect_uri'=>$redirectUrl];