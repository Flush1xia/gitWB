<?php
namespace app\home\controller;
use app\home\model\Article;
class Artlist extends Common
{
    public function index()
    {
    	$article=new Article();
        $cateid=input('cateid');
        //echo  $cateid;
    	$artRes=$article->getAllArticles($cateid);
    	$hotRes=$article->getHotRes($cateid);
       // $childCate=$article->getChildCate($cateid);
        $childL1=$article->getChildl1($cateid);
        $catelevel=$article->getTree($cateid);                   

        $cate=new \app\index\model\Cate();     
        $cateInfo=$cate->getCateInfo($cateid);
        
    	$this->assign(array(
    		'artRes'=>$artRes,
    		'hotRes'=>$hotRes,
            'cateInfo'=>$cateInfo,       
           // 'childCate'=>$childCate,
            'childL1'=>$childL1,
            'catelevel'=>$catelevel,
    		));
        return view('artlist');
    }
}
