<?php
namespace app\home\controller;
use think\Request;
class Article extends Common
{
    public function index()
    {
    	$artid=input('artid');
    	db('article')->where(array('id'=>$artid))->setInc('click');
    	$articles=db('article')->find($artid);
    	$article= new \app\home\model\Article();
    	$hotRes=$article->getHotRes($articles['cateid']);
    	$this->assign(array(
    		'articles'=>$articles,
    		'hotRes'=>$hotRes,
            'artid'=>$artid,
    		));
        return view('article');
    }

}
