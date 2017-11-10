<?php
namespace org;
/**
 * 2016-3-27
 * @author ankang
 */
class Pages {
    private $ShowPage;
    private $CountPage;
    private $Floorp;
    private $PageUrl;
    private $PageClass;
    private $CurClass;
     
    /**
     * @author ankang
     * @param number $CountNum          数据总数
     * @param string $PageUrl           跳转链接
     * @param string $PageClass         <a>标签 总体样式    
     * @param string $PageUrl           当前页样式
     * @param number $PageSize          每页显示的数据条数
     * @param number $ShowPage          每次显示的页数 
     */
    public function __construct($CountNum, $PageUrl = NULL, $PageClass = NULL,$CurClass = NULL, $PageSize = 20, $ShowPage = 5) {
        $this->ShowPage      = $ShowPage;
        $this->CountPage     = ceil ( $CountNum / $PageSize );
        $this->Floorp        = floor ( $ShowPage / 2 ); // 偏移量       
        $this->PageClass     = is_null ( $PageClass ) ? '' : $PageClass;
        $this->CurClass      = is_null ( $CurClass ) ? '' : $CurClass;
         
        // $ServerURL               = ( preg_match('/\?/i', $_SERVER['REQUEST_URI']))?preg_replace('/\&p\=[0-9]+/i', "", $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI']."?";
        // if( substr($ButURL,0,2)=='//' ){
            // $ServerURL          = substr($ServerURL,1);
        // }
        // $url                 = preg_replace('/p=[\d]*/i', '', $ServerURL);
           $url                 = '';
        //推荐自己传url,不传也可以打开上面的代码自动获取
        $this->PageUrl           = is_null ( $PageUrl ) ? $url : $PageUrl;
    }
     
    /**
     *
     * @param number $Page          
     * @param string $ShowToPage
     *          首页，上下页，尾页
     * @param string $Html  标签元素,li,p      
     * @return string
     */
    public function getPage($Page = 1, $ShowToPage = true, $Html = null) {
        $StartPage          = ($Page - $this->Floorp); // 开始页码
        $EndPage            = ($Page + $this->Floorp); // 结束页码
         
        if ($this->CountPage < $this->ShowPage) {
            $StartPage      = 1;
            $EndPage        = $this->CountPage;
        }
         
        if ($StartPage < 1) {
            $StartPage      = 1;
            $EndPage        = $this->ShowPage;
        }
         
        if ($EndPage > $this->CountPage) {
            $StartPage      = $this->CountPage - $this->ShowPage + 1;
            $EndPage        = $this->CountPage;
        }
         
        $PageHtml = '';
         
        if (! is_null ( $Html )) {
            if ($Html == 'li') {
                $Shtml = '<li>';
                $Ehtml = '</li>';
            } else {
                $Shtml = '<p>';
                $Ehtml = '</p>';
            }
        }
         
        if (true == $ShowToPage) {
            $PageHtml               .= "$Shtml<a href='{$this->PageUrl}p=1'>&laquo; 首页</a>$Ehtml";
            $PrveUrl                 = $this->getPrve($Page);
            $PageHtml               .= "$Shtml<a href='{$PrveUrl}'>&laquo; 上一页</a>$Ehtml";
        }
         
        for($i = $StartPage; $i <= $EndPage; $i ++) {
            if ($Page == $i) {
                $PageHtml           .= "$Shtml<a href='{$this->PageUrl}p={$i}' class='{$this->CurClass}'>{$i}</a>$Ehtml";
            } else {
                $PageHtml           .= "$Shtml<a href='{$this->PageUrl}p={$i}' class='{$this->PageClass}'>{$i}</a>$Ehtml";
            }
        }
         
        if (true == $ShowToPage) {
            $NextUrl                 = $this->getNext($Page);
            $PageHtml               .= "$Shtml<a href='{$NextUrl}'>下一页 &raquo;</a>$Ehtml";
            $PageHtml               .= "$Shtml<a href='{$this->PageUrl}p={$this->CountPage}' >尾页 &raquo;</a>$Ehtml";
        }
         
        return $PageHtml;
    }
    


    /**
     * 上一页
     * @param  [type] $Page [description]
     * @return [type]       [description]
     */
    public function getPrve($Page){
        if ($Page != 1) {
            $Prve                = $Page - 1;
            $PrveUrl             = "{$this->PageUrl}p={$Prve}";
        } else {
            $PrveUrl             = "{$this->PageUrl}p=1";
        }
         
        return $PrveUrl;
    }
    
    /**
     * 下一页
     * @param  [type] $Page [description]
     * @return [type]       [description]
     */
    public function getNext($Page){
        if ($Page != $this->CountPage) {
            $Next                = $Page + 1;
            $NextUrl             = "{$this->PageUrl}p={$Next}";
        } else {
            $NextUrl             = "{$this->PageUrl}p={$this->CountPage}";
        }
         
        return $NextUrl;
    }
     
     
     
}