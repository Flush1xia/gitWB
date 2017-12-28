<?php
namespace app\home1\controller;
use think\Controller;
use app\home1\model\Admin;
class Login extends Controller
{
    public function index()
    {
        if(request()->isPost()){
            //$this->check(input('code'));
        	$admin=new Admin();
        	$num=$admin->login(input('post.'));
        	if($num==1){
        		$this->error('用户不存在！');
        	}  
        	if($num==2){
				if(session('id')==null)
        		{$this->success('登录成功！',url('index/index'));}
				else
        		{$this->success('登录成功！',url('index/index'));}
        	}
        	if($num==3){
        		$this->error('密码错误！');
        	}
        	return;
        }
        return view();
    }


    
}
