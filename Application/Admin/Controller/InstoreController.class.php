<?php

namespace Admin\Controller;
use Think\Controller;
/**
 * 入库管理
 */
class InstoreController extends BaseController
{
    /**
     * 入库列表
     * @return [type] [description]
     */
    public function index($key="")
    {
        if($key === ""){
            $model = D('InstoreView'); 
        }else{
            $where['instore.goods_name'] = array('like',"%$key%");
            $where['member.username'] = array('like',"%$key%");
            $where['category.title'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = D('InstoreView')->where($where);			
        }        
        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $instore = $model-> limit($Page->firstRow.','.$Page->listRows)->where($where)->order('instore.instore_time DESC')->select(); 			
		$this->assign('model', $instore);
        $this->assign('page',$show);
        $this->display();     
    }
    /**
     * 添加文章
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
        	$this->assign("category",M('category')->select());
			$this->assign('product', (M('product')->select()));
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
			$id = intval($jpid);
            $model = D("Instore");
            $model->instore_time = time(); 		
$id = I('pid');		
$pro = M('product')->where('id = %d',$id)-> field('ruku')->setInc('ruku', I(instore_count));
$pro = M('product')->where('id = %d',$id)-> field('kucun')->setInc('kucun', I(instore_count));

            if (!$model->create()) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($model->getError());
                exit();
            } else {
                if ($model->add()) {
                    $this->success("添加成功", U('Instore/index'));
                } else {
                    $this->error("添加失败");
                }
            }
        }
    }
    /**
     * 更新文章信息
     * @param  [type] $id [文章ID]
     * @return [type]     [description]
     */
    public function update($id)
    {
    	$id = intval($id);
        //默认显示添加表单
        if (!IS_POST) {
            $model = D('Instore')->where("id= %d",$id)->find();
            $this->assign("category",M('category')->select());
            $this->assign('instore',$model);
            $this->display();
        }
        if (IS_POST) {
            $model = D("Instore");
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                if ($model->save()) {
                    $this->success("更新成功", U('Instore/index'));
                } else {
                    $this->error("更新失败");
                }        
            }
        }
    }
    /**
     * 删除入库
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
    	$id = intval($id);
        $model = M('Instore');
        $result = $model->where("id= %d",$id)->delete();
        if($result){
            $this->success("删除成功", U('Instore/index'));
        }else{
            $this->error("删除失败");
        }
    }
	
}
