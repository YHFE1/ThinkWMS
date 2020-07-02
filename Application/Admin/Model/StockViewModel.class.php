<?php
namespace Admin\Model;
use Think\Model\ViewModel;

class StockViewModel extends ViewModel
{
	protected $viewFields = array(
	
		'Product' => array('id', 'name', 'cate_id', 'price', 'type', 'title', 'uid', 'addtime', 'kucun', 'ruku', 'chuku', 'remarks', '_type'=>'LEFT'),
		
		'Category' => array('name'=> 'category_name', '_on'=> 'Category.id=Product.cate_id'),
		
		'Member' => array('username', '_on'=> 'Member.id=Product.uid')
	
	);
}