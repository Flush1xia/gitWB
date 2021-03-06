<?php
namespace app\home\controller;

class Index extends Common
{
    public function index()
    {
    	//首页最新文章调用
        $cateid=input('cateid');
    	$articleM=new \app\home\model\Article();
    	$newArtiecleRes=$articleM->getNewArticle();
        $siteHotArt=$articleM->getSiteHot();
        $recArt=$articleM->getRecArt();
        //$artRes=$articleM->getAllArticles($cateid);
        $bgartRes=$articleM->bggetAllArticles($cateid=45);
        $zdartRes=$articleM->zdgetAllArticles($cateid=32);
        $childCate=$articleM->getChildCate($cateid=45);
        $childL1=$articleM->getChildl1($cateid); 

        //获取推荐栏目
        $cateM=new \app\home\model\Cate();
        
        $recIndex=$cateM->getRecIndex();
        //友情链接数据
        $linkRes=db('link')->order('sort desc')->select();
      

    	$this->assign(array(
    		'newArtiecleRes'=>$newArtiecleRes,
            'siteHotArt'=>$siteHotArt,
            'linkRes'=>$linkRes,
            'recArt'=>$recArt,
            'recIndex'=>$recIndex,
           // 'artRes'=>$artRes,
            'bgartRes'=>$bgartRes,
            'zdartRes'=>$zdartRes,
            'childCate'=>$childCate,
             'childL1'=>$childL1,
    		)); 
        return view();
    }
}
