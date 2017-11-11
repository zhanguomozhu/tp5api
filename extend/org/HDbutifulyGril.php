<?php
namespace org;
class HDbutifulyGril
{
    private $url = '';
    private $savepath = '';
    private $imagessavepath = array();
     
    public function __construct($url,$savepath='')
    {
        $this->url = $url;
        if( !empty($savepath) && !is_dir($savepath)){
            mkdir($savepath,0777,true);
        }
        $this->savepath = $savepath;
    }
 
    /**
     * 得到所有大图的url地址
     * @param type $id
     * @return array();
     */
    private function getimagesurl($id = '')
    {
        $url = $this->url . $id;
        $str = file_get_contents($url);
        $arr = json_decode($str, true);
        $images = array ();
        $savepath = array();
        if ( is_array($arr) && !empty($arr) ) {
            foreach ( $arr['data'] as $v ) {
                $url = $v['image']['original'];
                $filename = $this->getFilenameBy($url);
                if(  !file_exists($filename)){ // 如果图片已经采集了就不要再采了
                    $images[] = $url;
                    $savepath[] = $filename;
                }
            }
        }
        $this->imagessavepath = $savepath;
        return $images;
    }


    /**
     * 通过url确定图片的保存地址
     * @param string $url
     * @return string 
     */
    private function getFilenameBy($url)
    {
        $tmp = explode('/', $url);
       
        return $this->savepath . str_replace(',', '_', array_pop($tmp));
    }
 
    /**
     * 开始下载
     * @param int $id pid
     */
    public function start($id = '')
    {
        ini_set('memory_limit','800M');
        $imgurl = $this->getimagesurl($id);
        $imgs = $this->MultiDownByUrls($imgurl);
        foreach ( $imgs as $k => $v ) {
            if ( !empty($v) ) {
                file_put_contents($this->imagessavepath[$k], $v);
            }
        }
        return $this->imagessavepath;
    }
 
    /**
     * 通过urls多线程下载图片
     * @param array $urls
     * @return array
     */
    private function MultiDownByUrls($urls)
    {
        $opts = array (
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_AUTOREFERER => 1,
            CURLOPT_HEADER => 0,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_USERAGENT => 'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/33.0.1750.154 Safari/537.36'
        );
        $mutil = new \org\Mulcurl($urls, $opts);
        $mutil->start();
        return $mutil->getRes();
    }
 
}