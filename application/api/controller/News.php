<?php
namespace app\api\controller;
use think\Loader;
use app\base\controller\Base;
/**
 * @title 新闻接口
 */
class News extends Base
{
    /**
     * @title 新闻轮播
     * @description 接口说明 新闻轮播图
     * @author 战国墨竹
     * @url /api/news/banner
     * @method GET
     * @param name: type: require: default: other: desc:
     */
    public function banner()
    {
        $url = "http://c.m.163.com/nc/article/headline/list/0-10.html?from=toutiao&passport=&devId";
        $res = doCurl($url);
        $arr = json_decode($res, true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr['list'],
        ]);
    }


    /**
     * @title 新闻分类
     * @description 接口说明 新闻分类
     * @author 战国墨竹
     * @url /api/news/new_list
     * @method GET
     * @param name:type type:int require:1 default:0 other: desc:0:头条,1:军事,2:娱乐,3:体育,4:科技,5:艺术,6:教育,7:要闻,
     * @param name:page type:int require:1 default:10 other: desc:页码,
     */
    public function new_list()
    {

       $type = input('type') ? intval(input('type')) : 0;
       $page = input('page') ? intval(input('page')) : 10;
        $data = [
            'page' => $page,
            'type' => $type,
        ];

        $validate = Loader::validate('News');
        if(!$validate->check($data)){
            return json([
                'msg'=>$validate->getError(),
                'code' => 0,
            ]);
        }
        $news_type = \think\Config::get("news")['news_type'][$type];
        if (empty($news_type)) {
            return json([
                'msg' => '请填写正确的请求参数',
                'code' => 0
            ]);
        }
        $url="http://c.m.163.com/nc/article/headline/{$news_type}/{$page}-10.html";
        $res = doCurl($url);
        $arr = json_decode($res, true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr[$news_type]
        ]);
    }


    /**
     * @title 新闻详情
     * @description 接口说明 新闻详情
     * @author 战国墨竹
     * @url /api/news/new_detail
     * @method GET
     * @param name:postid type:int require:1 default:CLJMJRRL000181KT other: desc:新闻列表下新闻id,
     */
    public function new_detail($postid = "CLJMJRRL000181KT")
    {
        $id = input('postid') ? input('postid') : "CLJMJRRL000181KT";
        $url="http://c.m.163.com/nc/article/{$id}/full.html";
        $res = doCurl($url);
        $arr = json_decode($res, true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr[$id]
        ]);
    }


    /**
     * @title 本地新闻
     * @description 接口说明 本地新闻
     * @author 战国墨竹
     * @url /api/news/local_news
     * @method GET
     * @param name:name type:string require:1 default:CLJMJRRL000181KT other: desc:地名 ,
     * @param name:page type:int    require:1 default:1 other: desc:页码 ,
     */
    public function local_news()
    {
        $name = input('name') ? input('name') : $this->get_ip_address();
        $page = input('page') ? input('page') : 0;
        $address = urlencode($name);
        $url="http://3g.163.com/touch/jsonp/article/local/{$address}/{$page}-10.html";
        $res = doCurl($url);
        $arr = json_decode(substr($res, 9, -1), true);
        return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr[$name]
        ]);
    }

	/**
	*微信精选
	*
	*/
    /**
     * @title 微信精选
     * @description 接口说明 微信精选
     * @author 战国墨竹
     * @url /api/news/wx_select
     * @method GET
     * @param name:ps type:int require:1 default:1 other: desc:页码 ,
     */
	public function wx_select(){
		$ps = input('ps') ? input('ps') : 10;
		$jkAPikey="d046cd1f569ed13d951f0258902ef9b2";
		$url="http://v.juhe.cn/weixin/query?key=d046cd1f569ed13d951f0258902ef9b2&ps=".$ps;
		$res=doCurl($url);
        $arr = json_decode($res, true);
		return json([
            'msg' => 'success',
            'code' => 1,
            'data' => $arr['result']
        ]);
	}

    /**
     * 获取IP地址
     * @return string
     */
    public function get_ip_address(){
        $getIp = get_client_ip();
        $content = file_get_contents("http://api.map.baidu.com/location/ip?ak=enYCQ2yaIIjL8IZfYdA1gi6hK2eqqI2T&ip={$getIp}&coor=bd09ll");
        $json = json_decode($content, true);
        $place=$json['content']['address_detail']['province']."_".$json['content']['address_detail']['city'];
        return $place;
    }


}
