<?php


class Entry
{

    public static function getEntries($fromPath,$toPath){
        return array('from_path'=> $fromPath,'to_path' => $toPath);
    }

    public static function getMultiplePaths($paths){
        for($x=0; $x < count($paths); $x++){
            $path[] = array('path'=>$paths[$x]);
        }
        return $path;
    }

    public static function getCommitInfo($path, $mode="add", $autorename = true, $mute = false, $strictConflicet = false){
        return array('path'=>$path,
                    'mode'=>$mode,
                    'autorename'=>$autorename,
                    'mute'=>$mute,
                    'strict_conflict'=>$strictConflicet);
    }

    public static function getThumbnailParameters($thumbnail){
        for($x=0; $x < count($thumbnail); $x++){
            $parameters[] = array('path'=> $thumbnail[$x]->path,
                                'format'=>$thumbnail[$x]->format,
                                'size'=>$thumbnail[$x]->size,
                                'mode'=>$thumbnail[$x]->mode);
        }
        return $parameters;
    }









}