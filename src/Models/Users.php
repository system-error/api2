<?php



class Users
{
    public function getCurrentAccount(){
        $endPoint = "https://api.dropboxapi.com/2/users/get_current_account";

        $headers = array(
            "Content-Type: application/json"
        );
        $data = "null";
        return Request::postRequest($endPoint,$headers,$data);
    }

}