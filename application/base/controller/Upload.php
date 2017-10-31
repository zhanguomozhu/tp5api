<?php
/**
 * Created by PhpStorm.
 * Power By Mikkle
 * Email：776329498@qq.com
 * Date: 2017/7/27
 * Time: 11:05
 */

namespace app\base\controller;


use think\Config;
use think\Db;
use think\File;

class Upload
{

    /**
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param File $file
     * @param string $save_path
     * @param bool|true $is_record
     * @param array $rule
     * @return array
     */
    static public function uploadPicture(File $file,$save_path="",$is_record=true ,$rule=[]) {
        $return=[
            "code"=>1001,
            "data"=>"",
            "msg"=>"图片上传成功",
        ];

        $file_hash_md5 = $file->hash("md5");
        $file_hash_sha1 = $file->hash("sha1");
        //判断数据库中是否存在
        if ($is_record){
            $images_table = Config::get("upload.upload_images_table");
            $map = [
                "md5"=>$file_hash_md5,
                "sha1"=>$file_hash_sha1,
            ];
            $search_image=Db::table($images_table)->where($map)->find();
            if ($search_image){
                $return["path"] =  $search_image["path"];
                $return["msg"] =  "获取已存在图像成功";

                $return['data']['id'] = $search_image["id"];
                $return['data']['path'] = $search_image["path"];
                $return['data']['type'] = "images" ;
                return $return;
            }
        }

        $save_path = self::getSavePath("images");
        $validate_rule = $rule ? $rule : Config::get("upload.upload_images_validate");
        $info = $file->validate($validate_rule)->move($save_path);

        if ( $info ) {

            $oinfo = $info->getInfo();

            $data['name'] = $oinfo['name'];
            $data['path'] = self::getSavePath("images",false).DS.$info->getSaveName();
            $data['path'] = str_replace('\\', '/', $data['path']);
            $data['md5'] = $file_hash_md5;
            $data['sha1'] = $file_hash_sha1;
            $data['size'] = $oinfo['size'];
            $data['type'] = 'local';
            $data['create_time'] = time();
            $data['width'] = 0;
            $data['height'] = 0;


            if($is_record){
                $images_table = Config::get("upload.upload_images_table");
                if ( $id = Db::table($images_table)->insertGetId($data) ) {
                    $return['data']['id'] = $id;
                    $return['data']['path'] = $data['path'];
                    $return['data']['type'] = "images" ;
                } else {
                    $return['code'] = 1041;
                    $return['msg'] = '记录到数据库失败！';
                }
            }else{
                $return['data']['path'] = $data['path'];
                $return['data']['type'] = "images" ;
            }

        } else {
            $return['code'] = 1040;
            $return['msg'] = $file->getError();
        }
        return $return;
    }

    /**
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param File $file
     * @param string $save_path
     * @param bool|true $is_record
     * @param array $rule
     * @return array
     */
    static public function uploadFile(File $file,$save_path="",$is_record=true,$rule=[] ) {
        $return=[
            "code"=>1001,
            "data"=>"",
            "msg"=>"文件上传成功",
        ];

        $file_hash_md5 = $file->hash("md5");
        $file_hash_sha1 = $file->hash("sha1");
        //判断数据库中是否存在
        if ($is_record){
            $images_table = Config::get("upload.upload_files_table");
            $map = [
                "md5"=>$file_hash_md5,
                "sha1"=>$file_hash_sha1,
            ];
            $search_image=Db::table($images_table)->where($map)->find();
            if ($search_image){
                $return["path"] =  $search_image["path"];
                $return["msg"] =  "获取已存在图像成功";

                $return['data']['id'] = $search_image["id"];
                $return['data']['path'] = $search_image["path"];
                $return['data']['type'] = "files" ;
                return $return;
            }
        }

        $save_path = self::getSavePath("files");
        $validate_rule = $validate_rule = $rule ? $rule : Config::get("upload.upload_files_validate");
        $info = $file->validate($validate_rule)->move($save_path);

        if ( $info ) {

            $oinfo = $info->getInfo();

            $data['name'] = $oinfo['name'];
            $data['path'] = self::getSavePath("files",false).DS.$info->getSaveName();
            $data['path'] = str_replace('\\', '/', $data['path']);
            $data['md5'] = $file_hash_md5;
            $data['sha1'] = $file_hash_sha1;
            $data['size'] = $oinfo['size'];
            $data['type'] = 'local';
            $data['create_time'] = time();



            if($is_record){
                $images_table = Config::get("upload.upload_files_table");
                if ( $id = Db::table($images_table)->insertGetId($data) ) {
                    $return['data']['id'] = $id;
                    $return['data']['path'] = $data['path'];
                    $return['data']['type'] = "images" ;
                } else {
                    $return['code'] = 1041;
                    $return['msg'] = '记录到数据库失败！';
                }
            }else{
                $return['data']['path'] = $data['path'];
                $return['data']['type'] = "files" ;
            }

        } else {
            $return['code'] = 1040;
            $return['msg'] = $file->getError();
        }
        return $return;
    }


    /**
     * 获取保存路径
     * Power: Mikkle
     * Email：776329498@qq.com
     * @param $type
     * @param bool|true $absolute_path 服务器绝对路径
     * @return string
     */
    static public function getSavePath($type,$absolute_path=true){
        $root_path =$absolute_path? $_SERVER['CONTEXT_DOCUMENT_ROOT']:"";
        switch($type){
            case "images":
                $config_save_path = Config::get("upload.upload_images_path");
                if (!isset($save_path) && $config_save_path) {
                    $save_path = "{$root_path}{$config_save_path}";
                } elseif (!isset($save_path) && !$config_save_path) {
                    $save_path = "{$root_path}/upload/images";
                } else {
                    $save_path = "{$root_path}{$save_path}";
                }
            break;

            case "files":
                $config_save_path = Config::get("upload.upload_files_path");
                if (!isset($save_path) && $config_save_path) {
                    $save_path = "{$root_path}{$config_save_path}";
                } elseif (!isset($save_path) && !$config_save_path) {
                    $save_path = "{$root_path}/upload/files";
                } else {
                    $save_path = "{$root_path}{$save_path}";
                }
                break;
            default :
                $save_path = "{$root_path}/upload/others";
        }
        return $save_path;
    }


}