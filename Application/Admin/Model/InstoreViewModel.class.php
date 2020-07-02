<?php 
namespace Admin\Model;
use Think\Model\ViewModel;
class InstoreViewModel extends ViewModel {	
   public $viewFields = array(
     'Instore'=>array('id','cate_id', 'instore_count','goods_price','instore_time','instore_remarks','uid', 'pid', '_type'=>'LEFT'),
	 
	 'product'=>array('name'=> 'product_name', '_on'=> 'product.id=instore.pid'),
	 
     'Category'=>array('name'=>'category_name','title'=>'category_title', '_on'=>'category.id=instore.cate_id'),
	 
     'Member'=>array('username', '_on'=>'member.id=instore.uid'),
   );
}

?>