<?php
namespace Admin\Model;
use Think\Model;
class ProductModel extends Model
{
    protected $_validate = array(
        array('name','require','请填写货物名！'), //默认情况下用正则进行验证
              
    );
	
    protected $_auto = array ( 
		array('addtime', 'time', 1, 'function'), //新增时      
        array('uid', 'getuserid', 1, 'callback'),
		array('status', 1, 1),// 对status字段在新增的时候赋值0
		
	
    );
	
  	
	function getuserid() {
		return session("Uid");
	}

	function gettruename(){
		return session("truename");
	}

	function gettime(){
		return date('Y-m-d H:i:s',time());
	}
}