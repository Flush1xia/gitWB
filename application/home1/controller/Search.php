<?php
namespace app\home1\controller;
use app\home1\model\Article;
class Search extends Common
{
    public function index()
    {

    	$article=new Article();
        $serHot=$article->getSerHot();
        $keywords=input('keywords');
        $serRes=db('article')->order('id desc')->where('title','like','%'.$keywords.'%')->paginate(2,false,$config = ['query'=>array('keywords'=>$keywords)]);
        $this->assign(array(
            'serRes'=>$serRes,
            'keywords'=>$keywords,
            'serHot'=>$serHot,
            ));
        return view('search');
    }
}
