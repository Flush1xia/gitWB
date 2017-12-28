<?php
namespace app\home1\model;
use think\Model;
class Admin extends Model
{

 
    public function deladmin($id){
        if($this::destroy($id)){
            return 1;
        }else{
            return 2;
        }
    }

    public function login($data){
        $admin=Admin::getByName($data['name']);
        if($admin){
            if($admin['password']==$data['password']){
                session('id', $admin['id']);
                session('name', $admin['name']);
				session('desc', $admin['desc']);

                return 2; //登录密码正确的情况
            }else{
                return 3; //登录密码错误
            }
        }else{
            return 1; //用户不存在的情况
        }
    }






}
