<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:72:"D:\phpStudy\WWW\tp5api\public/../application/index\view\index\share.html";i:1510736498;}*/ ?>
<!doctype html>
	<html>
	<head>
	<meta http-equiv="Content-Type" Content="text/html; charset=utf-8;">
	<title>分享到微信微博空间等第三方平台的JS代码</title>
	<meta name="author" content="rainna" />
	<meta name="keywords" content="rainna's js lib" />
	<meta name="description" content="js" />
	<style>
	*{margin:0;padding:0;}
	img{border:0 none;}
	body{background:#eee;}
	.m-box{width:800px;margin:0 auto;padding:20px;background:#fff;}
	.m-box p{margin:0 0 10px;}
	.m-box .icn a{display:block;width:55px;height:35px;background:url('http://l.bst.126.net/rsc/img/weibo.png?035') no-repeat;}
	.m-box .icn .wb1{background-position:10px -216px;}
	.m-box .icn .wb2{background-position:-190px -216px;}
	.m-box .icn .wb3{background:url(http://l.bst.126.net/rsc/img/postshare/tieba24.png) 15px 0 no-repeat;}
	.m-box .icn .wb4{background-position:-88px -215px;}
	.m-box .icn .wb5{background-position:-138px -216px;}
	.m-box .icn .wb6{background-position:-245px -216px;}
	.m-box .icn .wb7{background-position:-300px -216px;}
	 .m-box .icn .wb8{background-position:-355px -216px;}
	.m-box .icn .wb9{background-position:-415px -215px;}
	</style>
 	</head>
 <body>
	 <div class="m-box">
	     <p>分享到微信,易信:</p>
	     <div class="icn"><img width="200" src="http://cli.clewm.net/qrcode/2015/01/21/2031452178.png" /></div>
	 </div>
	 <div class="m-box">
	     <p>分享到新浪微博:<a href="http://open.weibo.com/wiki/ShareCode" target="_blank">http://open.weibo.com/wiki/ShareCode</a></p>
	     <div class="icn"><a href="#" class="wb1" onclick="shareToSinaWB(event)"></a></div>
	 </div>
	 <div class="m-box">
	     <p>分享到QQ空间:<a href="http://connect.qq.com/intro/share/" target="_blank">http://connect.qq.com/intro/share/</a></p>
	     <div class="icn"><a href="#" class="wb2" onclick="shareToQzone(event)"></a></div>
	 </div>
	 <div class="m-box">
	     <p>分享到百度贴吧:<a href="http://share.baidu.com/code/advance" target="_blank">http://share.baidu.com/code/advance</a></p>
	     <div class="icn"><a href="#" class="wb3" onclick="shareToTieba(event)"></a></div>
	 </div>
	 <div class="m-box">
	     <p>分享到豆瓣:</p>
	     <div class="icn"><a href="#" class="wb4" onclick="shareToDouban(event)"></a></div>
	</div>
	 <div class="m-box">
	     <p>分享到腾迅微博:<a href="http://dev.t.qq.com/websites/share/" target="_blank">http://dev.t.qq.com/websites/share/</a></p>
	     <div class="icn"><a href="#" class="wb5"  onclick="shareToQQwb(event)"></a></div>
	</div>
	 <div class="m-box">
	     <p>分享到人人网:<a href="http://dev.renren.com/website/?widget=rrshare&content=use" target="_blank">http://dev.renren.com/website/?widget=rrshare&content=use</a></p>
	     <div class="icn"><a href="#" class="wb6" onclick="shareToRenren(event)"></a></div>
	 </div>
	 <div class="m-box">
	     <p>分享到开心网:<a href="http://open.kaixin001.com/document.php?type=records#code" target="_blank">http://open.kaixin001.com/document.php?type=records#code</a></p>
	     <div class="icn"><a href="#" class="wb7" onclick="shareToKaixin(event)"></a></div>
	 </div>
	 <div class="m-box">
	    <p>分享到facebook:</p>
	     <div class="icn"><a href="#" class="wb8" onclick="shareToFacebook(event)"></a></div>
	 </div>
	 <div class="m-box">
	     <p>分享到Twitter:</p>
	    <div class="icn"><a href="#" class="wb9" onclick="shareToTwitter(event)"></a></div>
	</div>





<script>
var _title,_source,_sourceUrl,_pic,_showcount,_desc,_summary,_site,
    _width = 600,
    _height = 600,
    _top = (screen.height-_height)/2,
    _left = (screen.width-_width)/2,
    _url = 'http://traveliceland.lofter.com/post/352b58_579d8e7',
    _pic = 'http://m3.img.srcdd.com/farm4/d/2015/0113/11/6AE3FEBE500857BF82CA97E8F03DD6A8_B500_900_500_411.jpeg';



//分享到新浪微博     
function shareToSinaWB(event){
	event.preventDefault();
	var _shareUrl = 'http://v.t.sina.com.cn/share/share.php?&appkey=895033136';//真实的appkey，必选参数 
	    _shareUrl += '&url='+ encodeURIComponent(_url||document.location);     //参数url设置分享的内容链接|默认当前页location，可选参数 96     
	    _shareUrl += '&title=' + encodeURIComponent(_title||document.title);    //参数title设置分享的标题|默认当前页标题，可选参数 97     
	    _shareUrl += '&source=' + encodeURIComponent(_source||'');
	    _shareUrl += '&sourceUrl=' + encodeURIComponent(_sourceUrl||'');
	    _shareUrl += '&content=' + 'utf-8';   //参数content设置页面编码gb2312|utf-8，可选参数100     
	    _shareUrl += '&pic=' + encodeURIComponent(_pic||'');  //参数pic设置图片链接|默认为空，可选参数101     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',top='+_top+',left='+_left+',toolbar=no,menubar=no,scrollbars=no, resizable=1,location=no,status=0');
 }




//分享到QQ空间
function shareToQzone(event){
	event.preventDefault();
	var _shareUrl = 'http://sns.qzone.qq.com/cgi-bin/qzshare/cgi_qzshare_onekey?';
	    _shareUrl += 'url=' + encodeURIComponent(_url||document.location);   //参数url设置分享的内容链接|默认当前页location110     
	    _shareUrl += '&showcount=' + _showcount||0;      //参数showcount是否显示分享总数,显示：'1'，不显示：'0'，默认不显示111     
	    _shareUrl += '&desc=' + encodeURIComponent(_desc||'分享的描述');    //参数desc设置分享的描述，可选参数112     
	    _shareUrl += '&summary=' + encodeURIComponent(_summary||'分享摘要');    //参数summary设置分享摘要，可选参数113    
	    _shareUrl += '&title=' + encodeURIComponent(_title||document.title);    //参数title设置分享标题，可选参数114     
	    _shareUrl += '&site=' + encodeURIComponent(_site||'');   //参数site设置分享来源，可选参数115     
	    _shareUrl += '&pics=' + encodeURIComponent(_pic||'');   //参数pics设置分享图片的路径，多张图片以＂|＂隔开，可选参数116    
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',top='+_top+',left='+_left+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
}




//分享到百度贴吧
function shareToTieba(event){
	event.preventDefault();
	var _shareUrl = 'http://tieba.baidu.com/f/commit/share/openShareApi?';
	    _shareUrl += 'title=' + encodeURIComponent(_title||document.title);  //分享的标题125     
	    _shareUrl += '&url=' + encodeURIComponent(_url||document.location);  //分享的链接126     
	    _shareUrl += '&pic=' + encodeURIComponent(_pic||'');    //分享的图片127     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
 }




//分享到豆瓣
function shareToDouban(event){
	event.preventDefault();
	var _shareUrl = 'http://shuo.douban.com/!service/share?';
	    _shareUrl += 'href=' + encodeURIComponent(_url||location.href);    //分享的链接136     
	    _shareUrl += '&name=' + encodeURIComponent(_title||document.title);    //分享的标题137     
	    _shareUrl += '&image=' + encodeURIComponent(_pic||'');    //分享的图片138     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
 }




//分享到腾迅微博
function shareToQQwb(event){
    event.preventDefault();
	var _shareUrl = 'http://v.t.qq.com/share/share.php?';
	    _shareUrl += 'title=' + encodeURIComponent(_title||document.title);    //分享的标题147     
	    _shareUrl += '&url=' + encodeURIComponent(_url||location.href);    //分享的链接148     
	    _shareUrl += '&appkey=5bd32d6f1dff4725ba40338b233ff155';    //在腾迅微博平台创建应用获取微博AppKey149    
	    _shareUrl += '&site=' + encodeURIComponent(_site||'');   //分享来源150     
	    _shareUrl += '&pic=' + encodeURIComponent(_pic||'');//分享的图片，如果是多张图片，则定义var _pic='图片url1|图片url2|图片url3....';
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
 }




//分享到人人网
function shareToRenren(event){
	event.preventDefault();
	var _shareUrl = 'http://share.renren.com/share/buttonshare.do?';
	    _shareUrl += 'link=' + encodeURIComponent(_url||location.href);   //分享的链接160     
	    _shareUrl += '&title=' + encodeURIComponent(_title||document.title);     //分享的标题161     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
 }



//分享到开心网
function shareToKaixin(event){
    event.preventDefault();
	var _shareUrl = 'http://www.kaixin001.com/rest/records.php?';
	    _shareUrl += 'url=' + encodeURIComponent(_url||location.href);    //分享的链接170     
	    _shareUrl += '&content=' + encodeURIComponent('分享的文字');    //需要分享的文字，当文字为空时，自动抓取分享网址的title171     
	    _shareUrl += '&pic=' + encodeURIComponent(_pic||'');     //分享的图片,多个使用半角逗号分隔172     
	    _shareUrl += '&showcount=0';    //是否显示分享数，显示：'1'，不显示：'0'173     
	    _shareUrl += '&style=11';      //显示的样式，必选参数174     
	    _shareUrl += '&aid=' + encodeURIComponent(_site||'');    //显示分享来源175     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
}

function shareToKaixin2(event){
	event.preventDefault();
	var _shareUrl = 'http://www.kaixin001.com/repaste/share.php?';
	    _shareUrl += 'rtitle=' + encodeURIComponent(_title||document.title);   //分享的标题183     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
 }


//分享到facebook
function shareToFacebook(event){
	event.preventDefault();
	var _shareUrl = 'http://www.facebook.com/sharer/sharer.php?';
	    _shareUrl += 'u=' + encodeURIComponent(_url||location.href);    //分享的链接192     
	    _shareUrl += '&t=' + encodeURIComponent(_title||document.title);    //分享的标题193     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
 }


//分享到Twitter
function shareToTwitter(event){
	event.preventDefault();
	var _shareUrl = 'http://twitter.com/intent/tweet?';
	    _shareUrl += 'url=' + encodeURIComponent(_url||location.href);    //分享的链接203     
	    _shareUrl += '&text=' + encodeURIComponent(_title||document.title);    //分享的标题204     
	window.open(_shareUrl,'_blank','width='+_width+',height='+_height+',left='+_left+',top='+_top+',toolbar=no,menubar=no,scrollbars=no,resizable=1,location=no,status=0');
}
</script>
</body>
</html>