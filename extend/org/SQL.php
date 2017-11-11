<?php
 
/**
 * SQL 简单查询工具类
 * <code>
 *      $tools = new SQLTools("表名", "数据库操作对象实例");
 *      $tools->query("字段默认为*")                          //（如无后续操作此处返回查询结果集）
 *            ->where( '条件', PDO参数化查询参数 )                //（如无后续操作此处返回查询结果集）
 *            ->group( 'id' )                                    //（如无后续操作此处返回查询结果集）
 *            ->order( 'id', 'desc' )                            //（如无后续操作此处返回查询结果集）
 *            ->limit( 0, 100 )                              //（如无后续操作此处返回查询结果集）
 *            ->toSQL();                                         // 返回拼接出来的SQL
 *
 * </code>
 */
 
defined( 'SQL_TAG_QUERY' ) OR define( 'SQL_TAG_QUERY', 'query' );
defined( 'SQL_TAG_LIMIG' ) OR define( 'SQL_TAG_LIMIT', 'limit' );
defined( 'SQL_TAG_WHERE' ) OR define( 'SQL_TAG_WHERE', 'where' );
defined( 'SQL_TAG_ORDER' ) OR define( 'SQL_TAG_ORDER', 'order' );
defined( 'SQL_TAG_GROUP' ) OR define( 'SQL_TAG_GROUP', 'group' );
 
// to xx 自己加吧
defined( 'TO_SQL' ) OR define( 'TO_SQL', 'toSQL' );
 
class SQL{
 
    public $id          = null;
    public $db          = null;
    public $tableName   = null;
 
    private $__code     = null;
    private $__query    = null;
    private $__where    = null;
    private $__param    = null;
    private $__limit    = null;
    private $__order    = null;
    private $__group    = null;
     
    /**
     * 实例化
     * @param $tableName stirng 表名
     * @param $db 一个数据库操作对象，且必须有个叫query的方法，接受两个参数  sql 及 params
     * @param $id 主键字段名
     */
    public function __construct( $tableName, $db, $id=null ){
        $this->db = $db;
        $this->id = $id;
        $this->tableName = $tableName;
    }
     
    public function query( $fields='*', $tableName=null ){
        $tableName === null && ( $tableName = $this->tableName );
        $this->__query = "SELECT $fields FROM $tableName ";
        return $this->__setResultByCallCode( SQL_TAG_QUERY );
    }
 
    public function where( $where, $params ){
        $this->__where = "WHERE $where ";
        $this->__param = $params;
        return $this->__setResultByCallCode( SQL_TAG_WHERE );
    }
 
    public function order( $fields, $sort ){
        $this->__order = "ORDER BY $fields $sort ";
        return $this->__setResultByCallCode( SQL_TAG_ORDER );
    }
 
    public function group( $fields ){
        $this->__group = "GROUP BY $fields";
        return $this->__setResultByCallCode( SQL_TAG_GROUP );
    }
 
    public function limit( $m, $n ){
        $this->__limit = sprintf( 'LIMIT %d,%s ', $m, $n );
        return $this->__setResultByCallCode( SQL_TAG_LIMIT );
    }
 
    public function toSQL(){ return $this->__setResultByCallCode( TO_SQL ); }
 
    public function clear(){
        $this->__code    = null;
        $this->__query   = null;
        $this->__where   = null;
        $this->__param   = null;
        $this->__limit   = null;
        $this->__order   = null;
        $this->__group   = null;
    }
 
    // 真正查询的地方
    private function __query( $tag ){
        $__sql = $this->__query;
 
        $this->__where !== null && ( $__sql .= $this->__where );
        $this->__group !== null && ( $__sql .= $this->__group );
        $this->__order !== null && ( $__sql .= $this->__order );
        $this->__limit !== null && ( $__sql .= $this->__limit );
         
        $result = $tag === TO_SQL ? $__sql : $this->db->query( $__sql, $this->__param );
        $this->clear();
 
        return $result;
    }
 
    /**
     * 通过堆栈信息获取调用脚本后面调用方法，
     * 根据方法生成相关返回对象
     * @param $tag sql标签
     * @return object
     **/
    private function __setResultByCallCode( $tag ){
        if( $this->__code !== null ){
            return $this->__createResult( $this->__code, $tag );
        }
 
        $info = debug_backtrace();
        if( !is_array($info) ){
            return null;
        }
         
        // 找到调用文件索引 ( 这里是通过文件名匹配的，如果改了文件名请自行修改这段代码 )
        $index = -1;
        foreach( $info as $counter => $item ){
            if( isset($item['file']) ){
                if( stripos($item['file'], 'SQLTools.class.php') > 0 ){
                    $index = $counter + 1;  // 下一个item即调用文件
                    break;
                }
            }
        }
 
        // 没有找到调用信息
        if( $index === -1 ){
            return null;
        }
 
        // 堆栈中没有找到相关信息
        $caller = $info[$index];
        if( !isset($caller['file']) || !file_exists($caller['file']) || !isset($caller['line']) ){
            return null;
        }
 
        $line = $caller['line'];
        $file = @fopen( $caller['file'], "r" );
        $counter = 1;
 
        $code = '';
        while( ($buffer = fgets($file)) !== false ){
            if( $counter >= $line ){
                $code .= $buffer;
                if( substr( $buffer, -2, 1 ) == ';' ){
                    goto end;
                }
            }
            $counter++;
        }
 
        end: isset( $file ) && @fclose( $file );
 
        $code = str_replace( ' ',  '', $code );
        $code = str_replace( "\t", '', $code );
        $code = str_replace( "\n", '', $code );
        $code = explode( '->', $code );
         
        return $this->__createResult( $code, $tag );
    }
 
    // 返回$this起到链接作用，又判断当前调用tag是否已经结束
    private function __createResult( $code, $tag ){
        $this->__code = $code;
 
        foreach( $this->__code as $code){
            if( stripos($code, $tag) === 0 && substr( $code, -1 ) === ';' ){  // 判断查询结束
                return $this->__query( $tag );
            }
        }
 
        return $this;
    }
}