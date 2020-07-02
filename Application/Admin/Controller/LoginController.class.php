<?php
namespace Admin\Controller;
use Think\Controller;

class LoginController extends Controller {
    //登陆主页
    public function index(){
        $this->display();
    }
    //登陆验证
    public function login(){
        if(!IS_POST)$this->error("请输入账号密码");
        $member = D('member');
        $username =I('post.username');
        $password =md5(I('post.password'));
        $code = I('verify','','strtolower');
        //验证验证码是否正确
        if(!($this->check_verify($code))){
            $this->error('验证码错误');
        }
        //验证账号密码是否正确
       
        $user = $member->where("username = '%s' and password= '%s'",array($username,$password))->find();
       //$user = $member->where("username = ".$username. "and password=".$password)->find();
        if(!$user) {
            $this->error('账号或密码错误 :(') ;
        }else{
        $data =array(
            'id' => $user['id'],
            'update_at' => time(),
            'login_ip' => get_client_ip(),
        );
        $member->where("username = '%s' and password= '%s'",array($username,$password))->save($data);
        session('Uid',$user['id']);
        session('username',$user['username']);
        $this->success("登陆成功",U('Index/index'));
        
        }               
        

    }
    //验证码
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->codeSet = '0123456789';
		$Verify->useCurve = false;   // 是否画混淆曲线
        $Verify->useNoise = false;   // 是否添加杂点	
        $Verify->fontSize = 13;
        $Verify->length = 4;
        $Verify->entry();
    }
    
    protected function check_verify($code){
        $verify = new \Think\Verify();
        return $verify->check($code);
    }

    public function logout(){
        session('adminId',null);
        session('username',null);
        redirect(U('Login/index'));
    }
}