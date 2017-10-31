<?php 
namespace app\system\controller;
use think\Controller;


/**
* 文件操作
*/
class File extends Controller
{
    /**
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param string $md5
     * @param string $size
     */
    public function showPicture($md5="",$size="480_600")
    {
        $size_array = explode("_",$size);
        $width = is_numeric($size_array[0])?$size_array[0]:480;
        $height = is_numeric($size_array[1])?$size_array[1]:600;
        //根据图片MD5值获取路径
        $path = Upload::getPicturePathByMd5($md5);
        if($path){
            Image::open($path)->showImage($width,$height);
        }
        return;
    }


    /**
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param string $md5
     * @param string $size
     */
    public function downloadPicture($md5="",$size="0_0")
    {
        if($size!="0_0"){
            $size_array = explode("_",$size);
            $width = is_numeric($size_array[0])?$size_array[0]:480;
            $height = is_numeric($size_array[1])?$size_array[1]:600;
                    //根据图片MD5值获取路径
            $path = Upload::getPicturePathByMd5($md5);
            Image::open($path)->downloadImage($width,$height);
            return;
        }else{
            Upload::downloadPictureByMd5($md5);
        }
    }

    
}



 ?>