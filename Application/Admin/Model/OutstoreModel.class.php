<?php
namespace Admin\Model;
use Think\Model;
class OutstoreModel extends Model{
    protected $_validate = array(       
        array('applicat','require','请填写申请人姓名！'), //默认情况下用正则进行验证
        array('outstore_count','require','请填写出库数量！'), //默认情况下用正则进行验证        
    );
    protected $_auto = array ( 
        array('outstore_time','time',1,'function'), // 对outstore_time字段在更新的时候写入当前时间戳       
    );    
}