<?php
namespace app\home\model;
use think\Model;
class Cate  extends Model
{
    public function getchilrenid($cateid){
        $cateres=$this->select();
         //echo ($cateid);
        $arr=$this->_getchilrenid($cateres,$cateid);
        $arr[]=$cateid;
        $strId=implode(',', $arr);
        return rtrim($strId,',');
    }

  

    public function _getchilrenid($cateres,$cateid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['pid'] == $cateid){
                $arr[]=$v['id'];
                $this->_getchilrenid($cateres,$v['id']);
            }
        }

        return $arr;
    }

     public function getchilrenid1($cateid){
        $cateres=$this->select();
        // echo ($cateid);
        $arr=$this->_getchilrenid1($cateres,$cateid);
        $arr[]=$cateid;
        $strId=implode(',', $arr);
        return rtrim($strId,',');
    }

    public function _getchilrenid1($cateres,$cateid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['pid'] == $cateid){
                $arr[]=$v['id'];
                $this->_getchilrenid1($cateres,$v['id']);
            }
        }

        return $arr;
    }
   

      public function getchildid($cateid){
        $cateres=$this->select();
         //echo ($cateid);
        $arr=$this->_getchildid($cateres,$cateid);
        //dump($arr);
       // $arr[]=$cateid;
        $strId=implode(',', $arr);
         //echo ($strId);
        return rtrim($strId,',');
    }

        public function _getchildid($cateres,$cateid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['pid'] == $cateid){
                $arr[]=$v['id'];
                $this->_getchildid($cateres,$v['id']);
            }
        }

        return $arr;
    }



    public function getparents($cateid){
        $cateres=$this->field('id,pid,catename')->select();
        $cates=db('cate')->field('id,pid,catename')->find($cateid);
        $pid=$cates['pid'];
        if($pid){
            $arr=$this->_getparentsid($cateres,$pid);
        }
        $arr[]=$cates;
         
        return $arr;
    }

    public function _getparentsid($cateres,$pid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['id'] == $pid){
                $arr[]=$v;
                $this->_getparentsid($cateres,$v['pid']);
            }
        }

        return $arr;
    }

    public function getRecIndex(){
        $recIndex=$this->order('id desc')->where('rec_index','=',1)->select();
        return $recIndex;
    }

    public function getRecBottom(){
        $RecBottom=$this->order('id desc')->where('rec_bottom','=',1)->select();
        return $RecBottom;
    }

    public function getCateInfo($cateid){
        $cateInfo=$this->field('catename,keywords,desc')->find($cateid);
        return $cateInfo;
    }


      public function tree($cateid){
        $cateres=$this->select();
         //echo ($cateid);
        $arr=$this->_tree1($cateres,$cateid);
        $arr[]=$cateid;
        $strId=implode(',', $arr);
        return rtrim($strId,',');
    }

  

    public function _tree1($cateres,$cateid){
        static $arr=array();
        foreach ($cateres as $k => $v) {
            if($v['pid'] == $cateid){
                $arr[]=$v['id'];
                $this->_tree1($cateres,$v['id']);
            }
        }

        return $arr;
    }
    

}
