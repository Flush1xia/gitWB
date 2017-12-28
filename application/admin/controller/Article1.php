<?php
namespace app\admin\controller;
use app\admin\model\Cate as CateModel;
//use app\admin\model\Article1 as ArticleModel;
use app\admin\controller\Common;
class Article1 extends Common
{

    

	 public function lst1(){
		if(session('id')=='33'){
        $artres=db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid=b.id')->order('a.id desc')->paginate(10);}
		if(session('id')=='32'){
        $artres=db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid=b.id and b.upri in  (0,1)')->order('a.id desc')->paginate(10);}
		if(session('id')=='34'){
        $artres=db('article')->field('a.*,b.catename')->alias('a')->join('bk_cate b','a.cateid=b.id and b.upri in  (0)')->order('a.id desc')->paginate(10);}

		if(session('id')=='35'){
        $artres=db('article')->field('a.*,b.catename')->where('b.id between 132 and 142') ->alias('a')->join('bk_cate b','a.cateid=b.id ')->order('a.id desc')->paginate(10);}

        $this->assign('artres',$artres);
        return view();
    }

    
	    public function add1(){
        if(request()->isPost()){
            $data=input('post.');
            $time=time();
            $time=date('Y-m-d',$time);

            $data['time']=$time;
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('add')->check($data)){
                $this->error($validate->getError());
            }
            // $article=new ArticleModel;
            // if($article->save($data)){
            //     $this->success('添加文章成功',url('lst1'));
            // }else{
            //     $this->error('添加文章失败！');
            // }


            if(db('article')->insert($data)){
                $this->success('添加文章成功',url('lst1'));
            }else{
                $this->error('添加文章失败！');
            }
            return;
        }
        $cate=new CateModel();
        $cateres=$cate->catetree();
        $this->assign('cateres',$cateres);
        return view();
    }
   
	   public function edit1(){
        if(request()->isPost()){
            $data=input('post.');
            $validate = \think\Loader::validate('Article');
            if(!$validate->scene('edit')->check($data)){
                $this->error($validate->getError());
            }
            // $article=new ArticleModel;
            // $save=$article->update($data);
            // if($save){
            //     $this->success('修改文章成功！',url('lst1'));
            // }else{
            //     $this->error('修改文章失败！');
            // }

           
            if(db('article')->update($data)){
                $this->success('修改文章成功！',url('lst1'));
            }else{
                $this->error('修改文章失败！');
            }
            return;
        }
        $cate=new CateModel();
        $cateres=$cate->catetree();
        $arts=db('article')->where(array('id'=>input('id')))->find();
        $this->assign(array(
            'cateres'=>$cateres,
            'arts'=>$arts,
            ));
        return view();
    }

  

	   public function del1(){
        if(ArticleModel::destroy(input('id'))){
            $this->success('删除文章成功！',url('lst1'));
        }else{
            $this->error('删除文章失败！');
        }
    }


 



   

	












}
