<?php 
namespace Admin\Model;
use Think\Model\ViewModel;
class OutstoreViewModel extends ViewModel {
	
   public $viewFields = array(
   
     'outstore'=>array('id','applicat', 'outstore_count','outstore_time','outstore_remarks', 'pid', '_type'=>'LEFT'),
	 
	
	  'product'=>array('name'=> 'product_name', '_on'=>'product.id=outstore.pid'),	
     
   );
}

?>