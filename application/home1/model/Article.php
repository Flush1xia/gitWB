<?php
namespace app\home1\model;
use think\Model;
use app\home1\model\Cate;
class Article  extends Model
{
    public function getAllArticles($cateid){
        $cate=new Cate();
        $allCateID=$cate->getchilrenid($cateid);
	    if(session('id')==null){
        $artRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,a.cateid,c.catename')->alias('a')->where("a.cateid IN($allCateID) and c.upri in ('0') ")->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->paginate(10);

	   }

	   if(session('id')== '41'){
        $artRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,a.cateid,c.catename')->alias('a')->where("a.cateid IN($allCateID) and c.upri in ('0','1') ")->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->paginate(10);
	   }
	    if(session('id')== '40' or session('id')== '42'){
        $artRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,a.cateid,c.catename')->alias('a')->where("a.cateid IN($allCateID) and c.upri in ('0','1','2') ")->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->paginate(10);
	   }

        //dump($artRes);
        return $artRes;  

    }  

    
    public function bggetAllArticles($catid){
         $cate=new Cate();
      
        $allCateID1=$cate->getchilrenid1($catid);
         //echo ($allCateID1);
        if(session('id')== null){
        $bgartRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,a.cateid,c.catename')->alias('a')->where("a.cateid IN($allCateID1) and c.upri ='0' ")->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->limit(10)->select();
	     }  

		 if(session('id')=='41'){
        $bgartRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,a.cateid,c.catename')->alias('a')->where("a.cateid IN($allCateID1) and c.upri in ('0','1')")->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->limit(10)->select();
	     }

		if(session('id')=='40' or session('id')== '42'){
        $bgartRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,a.cateid,c.catename')->alias('a')->where("a.cateid IN($allCateID1) and c.upri in ('0','1','2')")->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->limit(10)->select();
	     }
        return $bgartRes;
    }


        public function zdgetAllArticles($catid){
        $cate=new Cate();

        $allCateID2=$cate->getchilrenid1($catid);

        $zdartRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,a.cateid,c.catename')->alias('a')->where("a.cateid IN($allCateID2)")->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->paginate(10);
        return $zdartRes;
    }

        public function getChildCate($cateid){
        $cate=new Cate();
        $allCateID=$cate->getchildid($cateid);
        //echo $allCateID;
        $artRes=db('cate')->where(" id IN($allCateID)")->select();
        //dump($artRes); 
        return $artRes;
    }

     public function getTree($cateid){
        $cate=new Cate();
        $allCateID=$cate->tree($cateid);
        //echo $allCateID;
        $artRes=db('cate')->where(" id IN($allCateID)")->select();
        //dump($artRes); 
       // echo JSON_ENCODE($artRes);
        return $artRes;
    }

     public function getChildl1($cateid){
        $cate=new Cate();
        
        $artRes=db('cate')
			->where('pid','=',$cateid)
			->where ('upri','=','0')
			->select();

       // dump($artRes); 
        return $artRes;
    }

    public function getHotRes($cateid){
        $cate=new Cate();
        $allCateID=$cate->getchilrenid($cateid);
        $artRes=db('article')->where("cateid IN($allCateID)")->order('click desc')->limit(5)->select();
        return $artRes;
    }

    public function getSerHot(){
       $artRes=db('article')->order('click desc')->limit(5)->select();
        return $artRes; 
    }

    public function getSiteHot(){
        $siteHotArt=$this->field('id,title,thumb')->order('click desc')->limit(5)->select();
        return $siteHotArt;
    }

    public function getNewArticle(){
        $newArtiecleRes=db('article')->field('a.id,a.title,a.desc,a.thumb,a.click,a.zan,a.time,c.catename')->alias('a')->join('bk_cate c','a.cateid=c.id')->order('a.id desc')->limit(10)->select();
        return $newArtiecleRes;
    }

    public function getRecArt(){
        $recArt=$this->where('rec','=',1)->field('id,title,thumb')->order('id desc')->limit(5)->select();
        return $recArt;
    }

    public function getRecPic(){
        $recPicArt=$this->where('cateid','=',148)->field('id,title,thumb')->order('id desc')->limit(10)->select();
        return $recPicArt;
    }
}
