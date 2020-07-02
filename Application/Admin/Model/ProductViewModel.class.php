<?php 
namespace Admin\Model;
use Think\Model\ViewModel;
class ProductViewModel extends ViewModel {
	
   public $viewFields = array(  
     'Product' => array('id', 'name', 'cate_id', 'price', 'type', 'title', 'uid', 'addtime', 'status', 'remarks', 'kucun', 'ruku', 'chuku', '_type'=> 'LEFT'),
	 
     'member'=>array('username', '_on'=>'member.id=Product.uid'),
	 
     'category'=>array('name'=>'category_name','title'=>'category_title', '_on'=>'Product.cate_id=category.id'),
	 
	 
   );
}

