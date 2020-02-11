<?php


class Entry
{

    public function getEntries($fromPath,$toPath){
        return array('from_path'=> $fromPath,'to_path' => $toPath);
    }

    public function getMultiplePaths(array $paths){
        return array($paths);
    }



}