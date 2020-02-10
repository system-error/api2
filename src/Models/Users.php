<?php



class Users
{
    public function getCurrentAccount($token){
        $endPoint = "https://api.dropboxapi.com/2/users/get_current_account";

        $headers = array(
            "Content-Type: application/json"
        );
        $data = "null";
        $theData =  Request::postRequest($endPoint,$headers,$data,true, $token);

        return $theData;
    }

}