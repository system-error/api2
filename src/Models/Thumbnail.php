<?php


class Thumbnail
{
    public $path;
    public $format;
    public $size;
    public $mode;

    /**
     *
     * @param $path
     * @param string $format
     * "jpeg" , "png"
     * @param string $size
     * "thumb" , "small(default)" , "medium" , "large", "huge"
     * @param string $mode
     * "strict" (default) => Scale down the image to fit within the given size,
     * "bestfit" => Scale down the image to fit within the given size or its transpose,
     * "fitone_bestfit" => Scale down the image to completely cover the given size or its transpose
     */

    function __construct($path, $format="jpeg", $size = "small", $mode= "strict")
    {
        $this->path = $path;
        $this->format = $format;
        $this->size = $this->getThumbnailSize($size);
        $this->mode = $mode;
    }

    /**
     * Takes the size for the picture and put the specific parameter
     * else returns the default value which is the small in the code that dropbox wants
     * @param $size
     * @return mixed
     */
    private function getThumbnailSize($size)
    {
        $thumbnailSizes = array(
            "thumb" => "w32h32",
            "small" => "w64h64",
            "medium" => "w128h128",
            "large" => "w640h480",
            "huge" => "w1024h768"
        );
        return isset($thumbnailSizes[$size]) ? $thumbnailSizes[$size] : $thumbnailSizes["small"];
    }

}


