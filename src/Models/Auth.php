<?php



class Auth
{

    function getAuthorization($client_id,$redirectUrl){
        $state = $this->randomStringForState();
//        $data = ['client_id'=> $client_id,
//                'response_type'=>'code',
//                'state'=>$state,
//                'redirect_uri'=>$redirectUrl];
        $uri = "https://www.dropbox.com/oauth2/authorize?client_id={$client_id}&response_type=code&state={$state}&redirect_uri={$redirectUrl}";
        $ch = curl_init($uri);

        $r = curl_exec($ch);
        echo $r;
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