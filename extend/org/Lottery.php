<?php 
namespace org;
/**
 * 抽奖工具概率
 * 
 * 
 */
class Lottery{
 
    protected static $awardsArr;
    protected static $proField = 'probability';
    protected static $proSum = 0;
    protected static $checkAward = false;
 
    const SUCCESS_CODE = 0;
    const FAIL_CODE = -1;
 
    //检查抽奖数据
    protected static function checkAwards(){
 
        if (!is_array(self::$awardsArr) || empty(self::$awardsArr)) {
            return self::$checkAward = false;
        }
         
        self::$proSum = 0;
 
        foreach (self::$awardsArr as $_key => $award) {
            self::$proSum += $award[self::$proField];
        }
 
        if (empty(self::$proSum)) {
            return self::$checkAward = false;
        }
 
        return self::$checkAward = true;
    }
  

    protected static function successRoll($rollKey){
        return array('code' => self::SUCCESS_CODE, 'roll_key' => $rollKey, 'msg' => 'roll success');
    }
 

    protected static function failRoll($msg = 'roll fail'){
        return array('code' => self::FAIL_CODE, 'msg' => $msg );
    }
 

    //抽奖
    public static function roll () {
 
        if (false == self::$checkAward) {
            return self::failRoll('awards data is not the right format!');
        }
 
        $result = mt_rand(0, self::$proSum);
        $proValue = 0;
 
        foreach (self::$awardsArr as $_key => $value) {
            $proValue += $value[self::$proField]; 
            if ($result <= $proValue) {
                return self::successRoll($_key);
            }
        }
        return self::failRoll('wrong');
    } 
 

    //改变概率字段名
    public static function setProField($field = null) {
        if (!empty($field)) {
            self::$proField = $field;
        }
    }
 

    //设置奖品
    public static function setAwards($awards){
        self::$awardsArr = $awards;
        self::checkAwards();
    }


}