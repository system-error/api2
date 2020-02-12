<?php


class Entry
{

    public function getEntries($fromPath,$toPath){
        return array('from_path'=> $fromPath,'to_path' => $toPath);
    }

    public function getMultiplePaths($paths){
        $path = array();
        for($x=0; $x<count($paths); $x++){
            $path[$x] = array('path'=>$paths[$x]);
        }
        return $path;


    }





}