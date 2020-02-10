<?php



class Auth
{

    function getAuthorization($client_id,$redirectUrl){;
        $state = $this->randomStringForState();
//        $data = ['client_id&'=> $client_id,
//                'response_type&'=>'code',
//                'state&'=>$state,
//                'redirect_uri&'=>$redirectUrl];
        $uri = "https://www.dropbox.com/oauth2/authorize?client_id={$client_id}&response_type=code&state={$state}&redirect_uri={$redirectUrl}";
////        echo $uri;
//        $uri = "https://www.dropbox.com/oauth2/authorize?client_id={$client_id}&response_type=code";

//        $headers = ['Content-Type: application/x-www-form-urlencoded'];
//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_POST, $uri);
//        curl_setopt($ch, CURLOPT_URL, true);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//        curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
//
//        $r = curl_exec($ch);
        return $uri;
//        return Header("Location: https://www.dropbox.com/oauth2/authorize?client_id={$client_id}&response_type=code&state={$state}&redirect_uri={$redirectUrl}");

    }

    private function randomStringForState(){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < 32; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        return $randomString;
    }

}