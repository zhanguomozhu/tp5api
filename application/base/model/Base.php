<?php  
namespace app\base\model;
use think\Model;


/**
* 基类模型
*/
class Base extends Model
{
	
	/**
     * 查找数据
     * @param [type] $data [description]
     */
    protected  function findData($data=[]){
        if(isset($data) && !empty($data)){
            $res = $this->where($data)->find();
            if($res){
                return $res;
            }else{
                return false;
            }
        }else{
            $res = $this->paginate('',false,['query' => request()->param()]);
            if($res){
                return $res;
            }else{
                return false;
            }
        }
    }




    /**
     * 添加数据
     * @param [type] $data [description]
     */
    protected  function addData($data){
        if(isset($data) && !empty($data)){
            if($this->save($data)){
                return $this->id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    /**
     * 编辑数据
     * @param [type] $data [description]
     */
    protected  function saveData($data){
        if(isset($data) && !empty($data)){
            if($this->save($data,['id'=>$data['id']])){
                return $this->id;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }



    /**
     * 删除数据
     * @param [type] $data [description]
     */
    protected  function delData($data){
        if(isset($data) && !empty($data)){
            if($this::destroy($data)){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    /**
     * 获取无限分类树
     * @return [type] [默认0，带前缀；1，不带前缀；2，子排序]
     * @return [type] [description]
     */
    public function getTree($data=[],$type=0)
    {
        $models = $this->where($data)->order('sort asc')->select();
        switch ($type) {
            case 0:
                return $this->qsort($models);
                break;
            case 1:
                return $this->nsort($models);
                break;
            case 2:
                return $this->ssort($models);
                break;
        }
    }

    /**
     * 排序带前缀
     * @param  [type]  $data [数据源]
     * @param  integer $pid  [父id]
     * @return [type]        []
     */
    public function qsort($data,$pid=0)
    {
        static $arr = array();
        $depth_html = '';
        foreach ($data as $k => $v) {
            if($v['pid'] == $pid){  
                for ($i=1; $i <=$v['level']; $i++) { 
                    if($i == 1){
                        $depth_html = '|';
                    }
                    $depth_html .= '———';
                }           
                $v['title'] = $depth_html.$v['title'];
                $arr[] = $v;
                $this->qsort($data,$v['id']);
                
            }
        }
        return $arr;
    }


     /**
     * 排序不带前缀
     * @param  [type]  $data [数据源]
     * @param  integer $pid  [父id]
     * @return [type]        []
     */
    public function nsort($data,$pid=0)
    {
        static $arr = array();
        foreach ($data as $k => $v) {
            if($v['pid'] == $pid){  
                $arr[] = $v;
                $this->nsort($data,$v['id']);
                
            }
        }
        return $arr;
    }



     /**
     * 排序不带前缀
     * @param  [type]  $data [数据源]
     * @param  integer $pid  [父id]
     * @return [type]        []
     */
    public function ssort($data)
    {
        $trees = array();
        //把数组主键ID重写到外层下标
        foreach($data as $k => $item){
            $trees[$item['id']]=$item->visible(['id','name','title','pid','icon'])->toArray();
        }
        //组件子类树
        $arr = array();
        foreach ($trees as $k => $v) {
            if(isset($trees[$v['pid']])){
                $trees[$v['pid']]['son'][] = &$trees[$v['id']];
            }else{
                $arr[] = &$trees[$v['id']];
            }
        }
        return $arr;
    }





    /**
     * 获取子级树
     * @param  [type] $rule_id [description]
     * @return [type]          [description]
     */
    public  function get_son($id)
    {
        $data = $this->select();
        return $this->_get_son($data,$id);
    }

    /**
     * 子级树排序
     * @param  [type] $data [description]
     * @param  [type] $id   [description]
     * @return [type]       [description]
     */
    public function _get_son($data,$id)
    {   
        static $arr = array();
        foreach ($data as $key => $value) {
            if($value['pid'] == $id){
                $arr[] = $value['id'];
                $this->_get_son($data,$value['id']);
            }
        }
        return $arr;
    }


    /**
     * 获取父级树
     * @param  [type] $rule_id [description]
     * @return [type]          [description]
     */
    public  function get_parent($id)
    {
        $data = $this->select();
        return $this->_get_parent($data,$id);
    }

    /**
     * 父级树排序
     * @param  [type] $data    [description]
     * @param  [type] $rule_id [description]
     * @return [type]          [description]
     */
    public function _get_parent($data,$id)
    {   
        static $arr = array();
        foreach ($data as $key => $value) {
            if($value['id'] == $id){
                $arr[] = $value['id'];
                $this->_get_parent($data,$value['pid']);
            }
        }
        return $arr;
    }
    
}

?>