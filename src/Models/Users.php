<?php



class Users
{
    public function getCurrentAccount($accessToken){
        $endPoint = "https://api.dropboxapi.com/2/users/get_current_account";
        $headers = array(
            "Content-Type: application/json"
        );
        $data = "null";
        $theData =  Request::postRequest($endPoint,$headers,$data,true,$accessToken);

        return $theData;
    }

    public function getAccount($accountId,$accessToken){
//        echo $accountId;
        $endPoint = "https://api.dropboxapi.com/2/users/get_account";
        $headers = array(
            "Content-Type: application/json"
        );
        $data = json_encode(array('account_id'=>$accountId));
//        echo $data;
        $theData =  Request::postRequest($endPoint,$headers,$data,true,$accessToken);
//        echo $theData;
        return $theData;
    }

}