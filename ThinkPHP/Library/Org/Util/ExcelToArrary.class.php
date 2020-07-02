<?php
namespace Org\Util;
class ExcelToArrary extends Service{
	
	public function __construct() {
		/*导入phpExcel核心类  注意 ：你的路径跟我不一样就不能直接复制*/
		vendor('Classes.PHPExcel.php');
	}
	/**
	* 读取excel $filename 路径文件名 $encode 返回数据的编码 默认为utf8
	*以下基本都不要修改
	*/
	public function read($filename,$encode='utf-8'){
		$objReader = PHPExcel_IOFactory::createReader('Excel5'); 
		$objReader->setReadDataOnly(true); 
		$objPHPExcel = $objReader->load($filename);
		
		$objWorksheet = $objPHPExcel->getActiveSheet();
		
　　　  $highestColumn = $objWorksheet->getHighestColumn();
 
		$highestRow = $objWorksheet->getHighestRow();
		
　　    $highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn); 

 　　   $excelData = array(); 
	 　　　 for ($row = 1; $row <= $highestRow; $row++) { 
	  　　  	for ($col = 0; $col < $highestColumnIndex; $col++) { 
					$excelData[$row][] =(string)$objWorksheet->getCellByColumnAndRow($col, $row)->getValue();
				} 
			} 
		return $excelData; 
	}   
 	
	/* 导出excel函数*/
	public function push($data,$name='Excel'){
		 error_reporting(E_ALL);
		 date_default_timezone_set('Europe/London');
		 $objPHPExcel = new PHPExcel();
	 
		/*以下是一些设置 ，什么作者 标题啊之类的*/
		$objPHPExcel->getProperties()->setCreator("转弯的阳光")
			 ->setLastModifiedBy("转弯的阳光")
			 ->setTitle("数据EXCEL导出")
			 ->setSubject("数据EXCEL导出")
			 ->setDescription("备份数据")
			 ->setKeywords("excel")
			->setCategory("result file");
		/*以下就是对处理Excel里的数据， 横着取数据，主要是这一步，其他基本都不要改*/
		foreach($data as $k => $v){
			$num=$k+1;
			$objPHPExcel->setActiveSheetIndex(0)
			//Excel的第A列，uid是你查出数组的键值，下面以此类推
			->setCellValue('A'.$num, $v['uid'])  
			->setCellValue('B'.$num, $v['email'])
			->setCellValue('C'.$num, $v['password']);
		}
		$objPHPExcel->getActiveSheet()->setTitle('User');
		$objPHPExcel->setActiveSheetIndex(0);
		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="'.$name.'.xls"');
		header('Cache-Control: max-age=0');
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
		$objWriter->save('php://output');
		exit;
	}
	
}