<?php


namespace alibaba\nacos\util;


/**
 * Class FileUtil
 * @author suxiaolin
 * @package alibaba\nacos\util
 */
class FileUtil
{
    public static function deleteAll($path)
    {
        $files = glob("${$path}/*"); // get all file names
        foreach ($files as $file) { // iterate files
            if (!is_file($file)) {
                continue;
            }
            unlink($file); // delete file
        }
    }
}