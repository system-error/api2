<?php


class Files
{
    private $headers= array("Content-Type: application/json");
    private $accessToken;

    function __construct($accessToken){
        $this->accessToken = $accessToken;
        echo "test";
    }

    /**
     *  The from_path is the filename that we want to copy and
     *  the to_path is the destination folder with the name of the file
     *  If we want to copy the text.txt in the folder TestFolder we should write
     *  from_path = /text.txt (this if we are in the home page) and
     *  to_path = /TestFolder/text.txt
     *
     * @param $from_path
     * @param $to_path
     * @param bool $allow_shared_folder
     * @param bool $autorename
     * @param bool $allow_ownership_transfer
     * @return mixed|string
     */
    public function copy($from_path,$to_path,$allow_shared_folder=false,$autorename=false,$allow_ownership_transfer=false){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_v2";
        $data = json_encode(array( "from_path" => $from_path, "to_path" => $to_path,
            "allow_shared_folder" => $allow_shared_folder, "autorename" => $autorename, "allow_ownership_transfer" => $allow_ownership_transfer));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }



    /** Created the entry class to call the different files
     *  that I want to copy from one dest to other
     * @param $entries
     * @param bool $autorename
     * @return mixed|string
     */
    public function copyBatch($entries, $autorename=false){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_batch_v2";
        $data = json_encode(array("entries" => $entries, "autorename" =>$autorename));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function copyBatchCheck($asyncJobId){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_batch/check_v2";
        $data = json_encode(array("async_job_id" => $asyncJobId));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function copyReferenceGet($path){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_reference/get";
        $data = json_encode(array( "path" => $path));
        $copy_reference = $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));

//        depending what I want I have the choice to take only the reference or all the results

//        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));

        //  I can call the "copyReferenceSave" function from here, I don't understand why it sends error
//        return $this->copyReferenceSave($copy_reference['copy_reference'],$path);
        return $copy_reference['copy_reference'];
    }

    public function copyReferenceSave($copyReference,$path){
        $endPoint = "https://api.dropboxapi.com/2/files/copy_reference/save";
        $data = json_encode(array( "copy_reference" => $copyReference,"path" => $path));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function createFolder($path,$autorename=false){
        $endPoint = "https://api.dropboxapi.com/2/files/create_folder_v2";
        $data = json_encode(array( "path" => $path,"autorename" => $autorename));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function createFolderBatch($paths,$autorename=false,$forceAsync = false){
        $endPoint = "https://api.dropboxapi.com/2/files/create_folder_batch";
        $data = json_encode(array( "paths" =>$paths,"autorename" => $autorename,'force_async'=>$forceAsync));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function createFolderBatchCheck($asyncJobId){
        $endPoint = "https://api.dropboxapi.com/2/files/create_folder_batch/check";
        $data = $data = json_encode(array( "async_job_id" => $asyncJobId));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function deleteFiles($path){
        $endPoint = "https://api.dropboxapi.com/2/files/delete_v2";
        $data = $data = json_encode(array( "path" => $path));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    public function deleteFilesBatch($paths){
        $endPoint = "https://api.dropboxapi.com/2/files/delete_batch";
        $data = json_encode(array( "entries" => $paths));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }


    /**
     * @param $path
     * @param bool $includeMediaInfo
     * @param bool $includeDeleted
     * @param bool $includeHasExplicitSharedMembers
     * @return mixed|string
     */

    public function getMetadata($path, $includeMediaInfo = false, $includeDeleted = false, $includeHasExplicitSharedMembers = false) {
        $endPoint = "https://api.dropboxapi.com/2/files/get_metadata";
        $data = json_encode(array( "path" => $path, "include_media_info" => $includeMediaInfo,
            "include_deleted" => $includeDeleted, "include_has_explicit_shared_members" => $includeHasExplicitSharedMembers));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }


    /**
     * @param $path
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
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    /**
     * @param $cursor
     * @return mixed|string
     */

    public function listFolderContinue($cursor){
        $endPoint = "https://api.dropboxapi.com/2/files/list_folder/continue";
        $data = json_encode(array("cursor" => $cursor));
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }

    /**
     * @param $path
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
        return $this->validateTheData(Request::postRequest($endPoint, $this->headers, $data,true,$this->accessToken));
    }


    private function validateTheData($theData){
        print_r($theData);
        die();
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

}