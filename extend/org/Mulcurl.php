<?php
namespace org;
/**
 * curl多线程下载类
 */
class Mulcurl
{
    public  $urls = array ();//url数组
    private $res = array ();
    private $curlopt_header = 0;
    private $method = "GET";
    private $curlopt = array ();
 
    /**
     * 初始化
     * @param boolean $urls    [description]
     * @param array   $curlopt [description]
     */
    public function __construct($urls = false, $curlopt = array ())
    {
        $this->urls = $urls;
        if ( !empty($curlopt) ) {
            $this->curlopt = $curlopt;
        }
    }
 
    /**
     * 设置urls
     * @param [type] $urls [description]
     */
    public function set_urls($urls)
    {
        $this->urls = $urls;
        return $this;
    }
 

    public function set_curlopt($name, $vale)
    {
        $this->curlopt[$name] = $vale;
    }
 
    public function is_return_header($b)
    {
        $this->curlopt_header = $b;
        return $this;
    }
 
    public function get_curlopt()
    {
        return $this->curlopt;
    }
 
    public function set_method($m)
    {
        $this->medthod = strtoupper($m);
        return $this;
    }
 
    public function set_curlopts($arr)
    {
        $this->curlopt = $arr;
    }
 

    public function start()
    {
        if ( !is_array($this->urls) || count($this->urls) == 0 ) {
            return false;
        }
 
        $handle = curl_multi_init();
        foreach ( $this->urls as $k => $v ) {
            $curl[$k] = $this->add_handle($handle, $v);
        }
 
        $this->exec_handle($handle);
        foreach ( $this->urls as $k => $v ) {
            $this->res[$k] = curl_multi_getcontent($curl[$k]);
            curl_multi_remove_handle($handle, $curl[$k]);
        }
        curl_multi_close($handle);
    }
 

    private function add_handle($handle, $url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        foreach ( $this->curlopt as $k => $v ) {
            curl_setopt($curl, $k, $v);
        }
        curl_multi_add_handle($handle, $curl);
        return $curl;
    }
 

    private function exec_handle($handle)
    {
        $flag = null;
        do {
            curl_multi_exec($handle, $flag);
        } while ( $flag > 0 );
    }
 

    public function getRes()
    {
        return $this->res;
    }
 
}
 
