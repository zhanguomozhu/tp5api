<?php 
namespace org;
/**
* 微信红包生成类
*/
class Redmoney 
{
	//总金额
    private $total=0;
    //红包数量
    private $num=0;
    //最小红包金额
    private $min=0.01;


    public function __construct($total,$num,$min)
    {
        $this->total = $total;
        $this->num = $num;
        $this->min = $min;
    }

	/**生成红包的函数*/
	public function getRandMoney(){
        $randRemainMoney = $this->total - $this->num * $this->min;//剩余需要随机的钱数
        return $this->_getRandMoney($randRemainMoney, $this->num, $this->min);
    }
	 
	/**红包生成的逻辑代码*/
	private function _getRandMoney(){
	 
	        $returnMessage = array('status'=>1, 'data'=>NULL);
	        if($this->total > 0){
	            $returnMessage['data'] = $this->_randMoney($this->total, $this->num, $this->min);
	        }elseif($this->total == 0){
	            $returnMessage['data'] = array_fill(0, $this->num, 1);
	        }else{
	            $returnMessage['status'] = -1;
	            $returnMessage['data'] = '参数传递有误，生成红包失败';
	        }
	        return $returnMessage;
	    }
	 
	/*参数无误，开始生成对应的红包金额*/
	private function _randMoney(){
        $data = array_fill(0, $this->num, $this->min);
        if($this->num > 1){
            foreach($data as $k => $v){
                if($k == $this->num -1){
                    $data[$k] = $this->total + $v;
                    break;
                }else {
                    if($this->total == 0) break;
                    $randMoney = rand(0, $this->total);
                    $this->total -= $randMoney;
                    $data[$k] = $randMoney + $v;
                }                
            }
        }
        return $data;
    }


    //红包结果
    public function getPack()
    {
        $total = $this->total;
        $num = $this->num;
        $min = $this->min;
        for ($i=1;$i<$num;$i++)   
        {   
            $safe_total=($total-($num-$i)*$min)/($num-$i);//随机安全上限   
            $money=mt_rand($min*100,$safe_total*100)/100;   
            $total=$total-$money;  
            //红包数据
            $readPack[]= [
                'money'=>$money,
                'balance'=>$total,
            ];
        }
        //最后一个红包，不用随机       
        $readPack[] = [
            'money'=>$money,
            'balance'=>0,
        ];
        //返回结果
        return $readPack;
    }
}


 ?>