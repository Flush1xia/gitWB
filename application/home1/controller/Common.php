<?php
namespace app\home1\controller;
use think\Controller;
class Common extends Controller
{

    public function _initialize(){
		

    	//当前位置
        if(input('cateid')){
            $this->getPos(input('cateid'));
        }
        if(input('artid')){
            $articles=db('article')->field('cateid')->find(input('artid'));
            $cateid=$articles['cateid'];
            $this->getPos($cateid);
        }
        //网站公告栏
         $this->gggetCates();
        //网站配置项
    	$this->getConf();
        //网站栏目导航
        $this->getNavCates();
        //底部导航信息
        $cateM=new \app\home1\model\Cate();
        $recBottom=$cateM->getRecBottom();
        $this->assign('recBottom',$recBottom);
    }



    public function getNavCates(){
        $cateres=db('cate')->where(array('pid'=>0))->where('id','not in','44,147,148')->select();
        foreach ($cateres as $k => $v) {
            $children=db('cate')->where(array('pid'=>$v['id']))->select();
            if($children){
                $cateres[$k]['children']=$children;
            }else{
                $cateres[$k]['children']=0;  
            }
        }
        //dump($cateres);
        $this->assign('cateres',$cateres);
    }

     public function gggetCates(){
        $cateres1=db('cate')->where('id','=','44')->select();
       
        $this->assign('cateres1',$cateres1);
    }

    public function getConf(){
        $conf=new \app\home\model\Conf();
        $_confres=$conf->getAllConf();
        $confres=array();
        foreach ($_confres as $k => $v) {
            $confres[$v['enname']]=$v['cnname'];
        }
        $this->assign('confres',$confres);
    }

    public function getPos($cateid){
        $cate= new \app\home\model\Cate();
        $posArr=$cate->getparents($cateid);
         //dump($posArr); //die;
        $this->assign('posArr',$posArr);
    }


}
