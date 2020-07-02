<?php
namespace Admin\Controller;
use Think\Controller;

class ProductController extends BaseController	
{
	public function index($key="")
	{
		if($key == "") {
			$model = D('ProductView');
		} else {
			$where['Product.name'] = array('like', "%$key%");
			$where['member.username'] = array('like', "%$key%");
			$where['category.name'] = array('like', "%$key%");
			$where['_logic'] = 'or';
			$model = D('ProductView')-> where($where);
		}		
		$count = $model-> where($where)-> count();
		$page = new \Extend\Page($count, 15);
		$show = $page-> show();
		$product = $model -> limit($Page->firstRow. ',' .$Page->listRows)-> where($where)->order('addtime DESC') ->select();		
		$this->assign('model', $product);
		$this->assign('page', $show);
		$this-> display();
	}
	
	
	public function add()
	{
		if(!IS_POST) {
			$this->assign('category', M('category')->select());
			$this->display();
		}
		
		if(IS_POST) {
			$model = D('Product');
			$model-> addtime = time();			
			if (!$model-> create()) {
				$this-> error($model->getError());
				exit;
			} else {
				if ($model-> add()) {
					$this-> success('add successfully！', U('Product/index'));
				} else {
					$this-> error('fail！');
				}
			}
		}				
	}
	
	
	 public function update($id)
    {
    	$id = intval($id);
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('Product')->where("id= %d",$id)->find();
            $this->assign("category",M('category')->select());
            $this->assign('product',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("Product");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                if ($model->where("id= %d",$id)->save()) {
                    $this->success("succssfully", U('Product/index'));
                } else {
                    $this->error("fail");
                }        
            }
        }
    }
		      

	/* 批量导出 */
	function expUser(){
		$xlsName  = "product";
		$xlsCell  = array(
			array('id','序列'),
			array('name','产品名称'),
			array('price','市场单价'),
			array('type','计量单位'),
			array('title','型号规格'),
			array('status','经办人')
		);
		$xlsModel = D('ProductView');
		$xlsData  = $xlsModel->select();
		$this->exportExcel($xlsName,$xlsCell,$xlsData);
	}
	
	/* 批量导入Excel文件 */    
    public function importExcel() {
        if (!empty($_FILES)) {
            $upload = new \Think\Upload();// 实例化上传类
            $filepath='./Public/Excel/'; 
            $upload->exts = array('xlsx','xls');// 设置附件上传类型
            $upload->rootPath  =  $filepath; // 设置附件上传根目录
            $upload->saveName  =     'time';
            $upload->autoSub   =     false;
			$info = $upload->upload();
            if (!$info) {
                $this->error($upload->getError());
            }			
            foreach ($info as $key => $value) {
                unset($info);
                $info[0]=$value;				
                $info[0]['savepath']=$filepath;				
            }		
		
			vendor("PHPExcel.PHPExcel");
            $file_name=$info[0]['savepath'].$info[0]['savename'];//获得上传保存路径和excel新的文件名			
            $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
            $sheet = $objPHPExcel->getSheet(0);			
            $highestRow = $sheet->getHighestRow(); // 取得总行数			
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数			
            $j=0;
            for($i=2;$i<=$highestRow;$i++)
            {
                $data['name']= $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();//获取excel表格中B3的值
				
                $data['cate_id']= $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();				                
				
                $data['price']= $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
				
                $data['type']= $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
				
				$data['title']= $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();				                
				
                $data['uid']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
				
                $data['addtime']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
				
				$data['status']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();				                
				
                $data['remarks']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
				
                //$data['type']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
				
				$data['ruku']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();				                
				
                //$data['price']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();				               
				                               
                M('product')->add($data);
                    $j++;                
            }
            unlink($file_name);            
            $this->success('successfully!amount：'.$j);
        }else
        {
            $this->error("Select file");
        }
    
	}
	
}