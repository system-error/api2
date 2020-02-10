<?php


class Files
{
    public function get_metadata($path, $include_media_info = FALSE, $include_deleted = FALSE, $include_has_explicit_shared_members = FALSE,$accessToken) {
//        echo $accessToken;
        $endpoint = "https://api.dropboxapi.com/2/files/get_metadata";
        $headers = array(
            "Content-Type: application/json"
        );
        $postdata = json_encode(array( "path" => $path, "include_media_info" => $include_media_info, "include_deleted" => $include_deleted, "include_has_explicit_shared_members" => $include_has_explicit_shared_members));
        echo $postdata;
        $returnData = Request::postRequest($endpoint, $headers, $postdata,true,$accessToken);

        return $returnData;

    }

}