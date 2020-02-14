<?php


class Files
{
     private $headers= array("Content-Type: application/json");
     private $accessToken;

     function __construct($accessToken){
         $this->accessToken = $accessToken;
     }

    /**
     *  The from_path is the filename that we want to copy and
     *  the to_path is the destination folder with the name of the file
     *  If we want to copy the text.txt in the folder TestFolder we should write
     *  from_path = /text.txt (this if we are in the home page) and
     *  to_path = /TestFolder/text.txt
     *
     * @param string $fromPath
     * @param string $toPath
     * @param bool $allowShared_folder
     * @param bool $autorename
     * @param bool $allowOwnershipTransfer
     * @return mixed|string
     */

     public function copy($fromPath,$toPath,$allowShared_folder=false,$autorename=false,$allowOwnershipTransfer=false){
         $endPoint = "https://api.dropboxapi.com/2/files/copy_v2";
         $data = json_encode(array( "from_path" => $fromPath, "to_path" => $toPath,
             "allow_shared_folder" => $allowShared_folder, "autorename" => $autorename, "allow_ownership_transfer" => $allowOwnershipTransfer));
         return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
     }

    /** Created the entry class to call the different files
     *  that I want to copy from one dest to other
     * @param list $entries
     * @param bool $autorename
     * @return mixed|string
     */

     public function copyBatch($entries, $autorename=false){
         $endPoint = "https://api.dropboxapi.com/2/files/copy_batch_v2";
         $data = json_encode(array("entries" => $entries, "autorename" =>$autorename));
         return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
     }

    public function copyBatchCheck($asyncJobId){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_batch/check_v2";
        $data = json_encode(array("async_job_id" => $asyncJobId));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function copyReferenceGet($path){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_reference/get";
        $data = json_encode(array( "path" => $path));
        $copy_reference = $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));

        // depending what I want I have the choice to take only the reference or all the results

        // return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));

        //  I can call the "copyReferenceSave" function from here, I don't understand why it sends error
        // return $this->copyReferenceSave($copy_reference['copy_reference'],$path);
        return $copy_reference['copy_reference'];
    }

    public function copyReferenceSave($copyReference,$path){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_reference/save";
        $data = json_encode(array( "copy_reference" => $copyReference,"path" => $path));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function createFolder($path,$autorename=false){
        $endPoint = "https://api.dropboxapi.com/2/files/create_folder_v2";
        $data = json_encode(array( "path" => $path,"autorename" => $autorename));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function createFolderBatch($paths,$autorename=false,$forceAsync = false){
        $endPoint = "https://api.dropboxapi.com/2/files/create_folder_batch";
        $data = json_encode(array( "paths" =>$paths,"autorename" => $autorename,'force_async'=>$forceAsync));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function createFolderBatchCheck($asyncJobId){
         $endPoint = "https://api.dropboxapi.com/2/files/create_folder_batch/check";
         $data = $data = json_encode(array( "async_job_id" => $asyncJobId));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function deleteFiles($path){
        $endPoint = "https://api.dropboxapi.com/2/files/delete_v2";
        $data = json_encode(array( "path" => $path));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function deleteFilesBatch($paths){
        $endPoint = "https://api.dropboxapi.com/2/files/delete_batch";
        $data = json_encode(array( "entries" => $paths));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function deleteFilesBatchCheck($asyncJobId){
        $endPoint = "https://api.dropboxapi.com/2/files/delete_batch/check";
        $data = json_encode(array( "async_job_id" => $asyncJobId));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    /**
     *
     *
     * @param string $path
     * @return string
     */

    public function downloadFile($path){
         $filename = basename($path);
         $endPoint = "https://content.dropboxapi.com/2/files/download";
         $headers = array("Content-Type: application/octet-stream",
             "Dropbox-API-Arg: ".$path);
         $data = '';
         $thedata = $this->validateTheData(Request::postRequest($endPoint,$headers,$data,$this->accessToken,false));
         $fp = fopen($filename,"wb");
        return $this->validateTheDownloadingProcess($fp,$thedata);
    }

    public function downloadZip($path){
        $filename = basename($path);
        $endPoint = "https://content.dropboxapi.com/2/files/download_zip";
        $headers = array("Content-Type: application/octet-stream",
            "Dropbox-API-Arg: ".$path);
        $data = '';
        $thedata = $this->validateTheData(Request::postRequest($endPoint,$headers,$data,$this->accessToken,false));
        $fp = fopen($filename.".zip","wb");
        return $this->validateTheDownloadingProcess($fp,$thedata);
    }

    /**
     * @param string $path
     * @param bool $includeMediaInfo
     * @param bool $includeDeleted
     * @param bool $includeHasExplicitSharedMembers
     * @return mixed|string
     */

    public function getMetadata($path, $includeMediaInfo = false, $includeDeleted = false, $includeHasExplicitSharedMembers = false) {
        $endPoint = "https://api.dropboxapi.com/2/files/get_metadata";
        $data = json_encode(array( "path" => $path, "include_media_info" => $includeMediaInfo,
                    "include_deleted" => $includeDeleted, "include_has_explicit_shared_members" => $includeHasExplicitSharedMembers));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    public function getPrieview($path) {
        $endPoint = "https://content.dropboxapi.com/2/files/get_preview";
        $headers = array("Content-Type: application/octet-stream; charset=utf-8","Dropbox-API-Arg: {\"path\":\"$path\"}");
        $data ='';
        return $this->validateTheData(Request::postRequest($endPoint,$headers,$data,$this->accessToken,false));
    }

    public function getTemporaryLink($path) {
        $endPoint = "https://api.dropboxapi.com/2/files/get_temporary_link";
        $data = json_encode(array( "path" => $path));
        return $this->validateTheData(Request::postRequest($endPoint,$this->headers,$data,$this->accessToken));
    }

    public function getTemporaryUploadLink($commitInfo, $durationTime = 14400) {
        $endPoint = "https://api.dropboxapi.com/2/files/get_temporary_upload_link";
        $data = json_encode(array( "commit_info" => $commitInfo,
                                    "duration"=>$durationTime));
        return $this->validateTheData(Request::postRequest($endPoint,$this->headers,$data,$this->accessToken));
    }

    public function getThumbnail($parameters) {
        $parameters = json_encode($parameters[0]);
        $endPoint = "https://content.dropboxapi.com/2/files/get_thumbnail";
        $headers = array("Content-Type: application/octet-stream","Dropbox-API-Arg: ".$parameters);
        $data ='';
//        return $this->validateTheData(Request::postRequest($endPoint,$headers,$data,$this->accessToken,false));
       $theImage = $this->validateTheData(Request::postRequest($endPoint,$headers,$data,$this->accessToken,false));
        echo '<img src="data&colon;image/jpg;charset=utf8;base64,'.base64_encode($theImage).' "/>';
    }
    public function getThumbnailBatch($parameters) {
        $endPoint = "https://content.dropboxapi.com/2/files/get_thumbnail_batch";
        $data =json_encode(array("entries" => $parameters));
        return $this->validateTheData(Request::postRequest($endPoint,$this->headers,$data,$this->accessToken));

        //An example inside the function.
//        $theImage = $this->validateTheData(Request::postRequest($endPoint,$this->headers,$data,$this->accessToken,true));
//        for ($x=0; $x<count($parameters); $x++ ){
//            echo '<img src="data&colon;image/jpg;charset=utf8;base64,'.$theImage['entries'][$x]['thumbnail'].' "/>';
//            echo "<br>";
//        }
    }

    /**
     * @param string $path
     * @param bool $recursive
     * @param bool $includeMediaInfo
     * @param bool $includeDeleted
     * @param bool $includeHasExplicitSharedMembers
     * @param bool $includeMountedFolders
     * @param bool $includeNonDownloadableFiles
     * @return mixed|string
     */

    public function listFolder($path, $recursive = false, $includeMediaInfo = false, $includeDeleted =false,
                               $includeHasExplicitSharedMembers=false, $includeMountedFolders=true, $includeNonDownloadableFiles=true){
        $endPoint = "https://api.dropboxapi.com/2/files/list_folder";
        $data = json_encode(array("path" => $path, "recursive" => $recursive, "include_media_info" => $includeMediaInfo, "include_deleted" => $includeDeleted,
                    "include_has_explicit_shared_members" => $includeHasExplicitSharedMembers,"include_mounted_folders" => $includeMountedFolders,
                    "include_non_downloadable_files" => $includeNonDownloadableFiles));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data, $this->accessToken));
    }

    /**
     * @param $cursor
     * @return mixed|string
     */

    public function listFolderContinue($cursor){
        $endPoint = "https://api.dropboxapi.com/2/files/list_folder/continue";
        $data = json_encode(array("cursor" => $cursor));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data, $this->accessToken));
    }

    /**
     * @param string $path
     * @param bool $recursive
     * @param bool $includeMediaInfo
     * @param bool $includeDeleted
     * @param bool $includeHasExplicitSharedMembers
     * @param bool $includeMountedFolders
     * @param bool $includeNonDownloadableFiles
     * @return mixed|string
     */

    public function getLatestCursor($path, $recursive = false, $includeMediaInfo = false, $includeDeleted =false,
                                    $includeHasExplicitSharedMembers=false, $includeMountedFolders=true, $includeNonDownloadableFiles=true){
        $endPoint = "https://api.dropboxapi.com/2/files/list_folder/get_latest_cursor";
        $data = json_encode(array("path" => $path, "recursive" => $recursive, "include_media_info" => $includeMediaInfo, "include_deleted" => $includeDeleted,
            "include_has_explicit_shared_members" => $includeHasExplicitSharedMembers,"include_mounted_folders" => $includeMountedFolders,
            "include_non_downloadable_files" => $includeNonDownloadableFiles));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data, $this->accessToken));
    }

    public function move($fromPath,$toPath,$allowShared_folder=false,$autorename=false,$allowOwnershipTransfer=false){
        $endPoint = "https://api.dropboxapi.com/2/files/move_v2";
        $data = json_encode(array( "from_path" => $fromPath, "to_path" => $toPath,
            "allow_shared_folder" => $allowShared_folder, "autorename" => $autorename, "allow_ownership_transfer" => $allowOwnershipTransfer));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data, $this->accessToken));
    }

    public function moveBatch($entries, $autorename = false, $allowOwnershipTransfer = false){
        $endPoint = "https://api.dropboxapi.com/2/files/move_batch_v2";
        $data = json_encode(array("entries" => $entries, "autorename" =>$autorename,"allow_ownership_transfer"=>$allowOwnershipTransfer));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }

    /**
     * It doesn't work for simple account only in Business
     * @param $path
     * @return mixed|string
     */
    public function permanentlyDelete($path){
        $endPoint = "https://api.dropboxapi.com/2/files/permanently_delete";
        $data = json_encode(array("path"=>$path));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,$this->accessToken));
    }
    
    private function validateTheData($theData){

        if($theData == null || isset($theData['error'])){
            if(isset($theData['error'])){
                return $theData['error_summary'];
            }else{
                return "Something is wrong";
            }
        }else{
            return $theData;
        }
    }

    private function validateTheDownloadingProcess($fp,$thedata){
        if(fwrite($fp,$thedata)){
            fclose($fp);
            return "success";
        }else{
            fclose($fp);
            return "something";

        }
    }

}