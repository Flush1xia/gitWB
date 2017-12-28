<?php
namespace app\home1\controller;
use think\Request;
class Article extends Common
{
    public function index()
    {
    	$artid=input('artid');
    	db('article')->where(array('id'=>$artid))->setInc('click');
    	$articles=db('article')->find($artid);
    	$article= new \app\home1\model\Article();
	
    	$hotRes=$article->getHotRes($articles['cateid']);
        $cate=new \app\home1\model\Cate();     
        $cateInfo=$cate->getCateInfo($articles['cateid']); 


    	$this->assign(array(
    		'articles'=>$articles,
    		'hotRes'=>$hotRes,
            'artid'=>$artid,
			'cateInfo'=>$cateInfo,    
    		));
        return view('article');
    }

}
