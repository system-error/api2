<?php

class Users
{
    private $headers= array("Content-Type: application/json");
    private $accessToken;


    function __construct($accessToken){
        $this->accessToken = $accessToken;
    }

    public function getCurrentAccount(){
        $endPoint = "https://api.dropboxapi.com/2/users/get_current_account";
        $data = "null";
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function getAccount($accountId){

        $endPoint = "https://api.dropboxapi.com/2/users/get_account";
        $data = json_encode(array('account_id'=>$accountId));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    private function validateTheData($theData){
        if($theData == null){
            return "Something is wrong";
        }else{
            return $theData;
        }
    }

}