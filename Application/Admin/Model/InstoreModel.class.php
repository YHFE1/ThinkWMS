<?php
namespace Admin\Model;
use Think\Model;
class InstoreModel extends Model{
    protected $_validate = array(
        array('goods_name','require','请填写货物名！'), //默认情况下用正则进行验证
        array('instore_count','require','请填写入库数量！'), //默认情况下用正则进行验证        
    );
    protected $_auto = array ( 
        array('instore_time','time',1,'function'), // 对instore_time字段在更新的时候写入当前时间戳
        array('uid','getuserid',1,'callback'), // 对update_time字段在更新的时候写入当前时间戳
    );
    protected function getuserid(){
    	return session('Uid');
    }
}