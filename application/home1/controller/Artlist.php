<?php
namespace app\home1\controller;
use app\home1\model\Article;
class Artlist extends Common
{
    public function index()
    {
    	$article=new Article();
        $cateid=input('cateid');
        //echo  $cateid;
    	$artRes=$article->getAllArticles($cateid);
        $Page=$artRes->render();
    	$hotRes=$article->getHotRes($cateid);
       // $childCate=$article->getChildCate($cateid);
        $childL1=$article->getChildl1($cateid);
        $catelevel=$article->getTree($cateid);                   

        $cate=new \app\home1\model\Cate();     
        $cateInfo=$cate->getCateInfo($cateid);
        
    	$this->assign(array(
    		'artRes'=>$artRes,
            'Page'=>$Page,
    		'hotRes'=>$hotRes,
            'cateInfo'=>$cateInfo,       
           // 'childCate'=>$childCate,
            'childL1'=>$childL1,
            'catelevel'=>$catelevel,
    		));
        return view('artlist');
    }
}
