<?php
namespace app\home1\controller;

class Index extends Common
{
    public function index()
    {
    	//首页最新文章调用
        $cateid=input('cateid');
    	$articleM=new \app\home1\model\Article();
    	$newArtiecleRes=$articleM->getNewArticle();
        $siteHotArt=$articleM->getSiteHot();
        $recArt=$articleM->getRecArt();
        $recPicArt=$articleM->getRecPic();
        $artRes=$articleM->getAllArticles($cateid);
        $ggartRes=$articleM->bggetAllArticles($cateid=44);
        $bgartRes=$articleM->bggetAllArticles($cateid=45);
        $ycartRes=$articleM->bggetAllArticles($cateid=46);
        $zdartRes=$articleM->bggetAllArticles($cateid=47);
        $zxartRes=$articleM->bggetAllArticles($cateid=48);
        $jyartRes=$articleM->bggetAllArticles($cateid=119);
        $zlartRes=$articleM->bggetAllArticles($cateid=120);
        $grartRes=$articleM->bggetAllArticles($cateid=149);
        $fcartRes=$articleM->bggetAllArticles($cateid=150);
   
        $childCate=$articleM->getChildCate($cateid=45);
        $childL1=$articleM->getChildl1($cateid); 

       
        $cateM=new \app\home1\model\Cate();
         //获取推荐栏目
        $recIndex=$cateM->getRecIndex();
        //友情链接数据
        $linkRes=db('link')->order('sort desc')->select();
      

    	$this->assign(array(
    		'newArtiecleRes'=>$newArtiecleRes,
            'siteHotArt'=>$siteHotArt,
            'linkRes'=>$linkRes,
            'recArt'=>$recArt,
            'recIndex'=>$recIndex,
            'recPicArt'=>$recPicArt,
            'artRes'=>$artRes,
            'ggartRes'=>$ggartRes,
            'bgartRes'=>$bgartRes,
            'ycartRes'=>$ycartRes,
			'zxartRes'=>$zxartRes,
            'zdartRes'=>$zdartRes,
            'jyartRes'=>$jyartRes,
            'zlartRes'=>$zlartRes,
            'grartRes'=>$grartRes,
            'fcartRes'=>$fcartRes,
            'childCate'=>$childCate,
             'childL1'=>$childL1,
    		)); 
        return view();
    }
}
