<?php
header('Content-type:text/html;charset=utf-8');
//文件名称：PHP文件多服务器同步工具
//文件作用：本文件所在服务器为主服务器，其它文件所在服务器可作分流或者备份。本文件需要jQuery库。你也可以外链别人的
//最后修改时间：2016-06-30
//BY:strwei
 
if(!empty($_POST['files'])) sync();
 
function sync(){
    $aFiles      = explode("\n", $_POST['files']);
//var_dump($aFiles);exit;
    foreach($aFiles as $k => $v){
        if(strlen($v) <= 5) unset($aFiles[$k]);
    }
    array_filter($aFiles);
    if(empty($aFiles)) {
        echo '没有文件'; exit;
    }
    $aFTPServers = array(
                        'server1' => array('strwei.com','FTP用户名','FTP密码', '打开FTP进去时的默认目录'),//ftp地址、用户名，密码、FTP打开此站点时的默认目录
                        //'server2' => array('yy.9.je','FTP用户名','FTP密码','打开FTP进去时的默认目录'),
    );
    $aAbortFile  = array('robots.txt');
    $aErrors     = array();
    $iError      = count($aErrors);
    $aSuc        = array();
    foreach($aFTPServers as  $ftp) {
        $conn    = ftp_connect($ftp[0]);
        if(empty($conn)){
            $iError = $iError + 1;
            array_push($aErrors, $iError . "、服务器 $ftp 无法连接");
            continue;
        }
        $login = ftp_login($conn, $ftp[1], $ftp[2]);
        if(empty($login)){
            $iError = $iError + 1;
            array_push($aErrors, $iError . "、服务器 $ftp[0] 无法登录");
            continue;
        }
 
        $ftp_root = '';
        if(!empty($ftp[3])) $ftp_root = ftp_chdir($conn, $ftp[3]);
        $ftp_root = ftp_pwd($conn);
        if(substr($ftp_root, -1) == '/') $ftp_root = substr($ftp_root, 0, -1);
        foreach($aFiles as $k => $v){
            $s  = basename($v);
            if(in_array($s, $aAbortFile)) {
                $iError = $iError + 1;
                array_push($aErrors, $iError . "、文件 $v 不允许同步");
                continue;
            }
            if(!file_exists('.'.$v)) {
                $iError = $iError + 1;
                array_push($aErrors, $iError . "、文件 $v 不存在");
                continue;
            }
            $upload = ftp_put($conn, $ftp_root . $v, '.' . $v, FTP_BINARY);
            if(empty($upload)){
                $iError = $iError + 1;
                array_push($aErrors, $iError . "、文件 $v 上传失败");
                continue;
            }
            array_push($aSuc, $v);
        }
    }
    if(empty($aErrors)) {
        echo '上传成功： ' . implode('、', $aSuc);
        exit;
    }
    echo implode('<br>', $aErrors);
    exit;
}
 
$cc = '\r\n';
echo '<script src="//cdn.bootcss.com/jquery/3.0.0/jquery.js"></script>';
echo <<<EOF
请输入你要同步的文件名（包括它的路径），例如：inoutcome_final.zip、/default.php、/index.php、/inoutcome_final.sqlite等等，每行输入一个文件名，可回车输入多个<br><br>
<textarea style="width:450px; height:85px; border:1px #000 solid;" id="id_file" onkeyup="this.value=this.value.replace(/ /g,'');"></textarea><br>
<button id="btn_submit" onclick="return submit_sync();">同步以上文件</button> <br><span id="show_sync" style="color:#f00;"></span>
 
<script>
function submit_sync(){
    $("#btn_submit").hide();
    var sFiles  = $("#id_file").val();
    var aFiles  = sFiles.split(/$cc/);
    if(aFiles.length <= 0  || aFiles[0].length <= 5) {
        alert("请手工写入要同步的文件清单");
        $("#btn_submit").show("slow");
        return false;
    }
    $.post("?", {"files":sFiles}, function(v){
        $("#show_sync").text(v);
        if(v.indexOf("上传成功") != -1) $("#id_file").val('');
        $("#btn_submit").show(5000);
    })
    return true;
}
</script>
 
EOF;
?>