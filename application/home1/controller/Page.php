<?php
namespace app\home1\controller;

class Page extends Common
{
    public function index()
    {
    	$cates=db('cate')->find(input('cateid'));
    	$cate=new \app\home\model\Cate();
        $cateInfo=$cate->getCateInfo(input('cateid'));
    	$this->assign(array(
    		'cates'=>$cates,
    		'cateInfo'=>$cateInfo,
    		));
        return view('page');
    }
}
