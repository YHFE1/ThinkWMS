<?php

namespace Admin\Controller;
use Think\Controller;

class StockController extends Controller
{
	public function index($key="")
	{
		if($key==="") {
			$model = D('StockView');
			
		} else {
			$where['Product.name'] = array('like', "%$key%");
			$where['category.name'] = array('like', "%$key%");
			$where['member.username'] =array('like', "%$key%");
			$where['_logic'] = 'or';
			$model = D('StockView')->where($where);
		}
		
		$count = $model-> where($where)-> count();		
		$page = new \Extend\Page($count, 15);
		$show = $page->show();		
		$product = $model-> limit($page->firstRow. ',' .$page->listRows)-> where($where)-> order('addtime DESC')-> select(); 		
		$this->assign('page', $show);
		$this->assign('model', $product);
		$this->display();
	}
}