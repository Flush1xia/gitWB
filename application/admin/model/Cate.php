<?php
namespace app\admin\model;
use think\Model;
class Cate extends Model
{
    protected static function init()
    {
      // Cate::event('before_insert',function($cate){
      //     dump($cate->pid); die;
      // });

      Cate::event('before_delete',function(){
          dump(111); die;
          return false;
      });
    }

    public function catetree(){
        $cateres=$this->order('sort desc')->select();
		
        if(session('id')=='1' or session('id')=='33' or session('id')=='35' or session('id')=='36' or session('id')=='37' or  session('id')=='38' or  session('id')=='39')
			{
			//echo(session('id'));
        return $this->sort($cateres);
		}
		if(session('id')=='34' ){
			//echo (session('id'));			
        return $this->sort1($cateres);
		}
		if(session('id')=='32'){
		//	echo(session('id'));
        return $this->sort2($cateres);
		}
    }

    public function sort($data,$pid=0,$level=0){
        static $arr=array();
        foreach ($data as $k => $v) {
            if($v['pid']==$pid){
                $v['level']=$level;
                $arr[]=$v;
                $this->sort($data,$v['id'],$level+1);
            }
        }
		
        return $arr;
    }

	  public function sort1($data,$pid=0,$level=0){
        static $arr1=array();
        foreach ($data as $k => $v) {
            if($v['pid']==$pid){
                $v['level']=$level;
                $arr1[]=$v;
                $this->sort1($data,$v['id'],$level+1);
            }
        }
		
         $arr=array();
		foreach ($arr1 as $k => $v) {
            if($v['upri']=='0'){
                $arr[]=$v;
             }
        }
       // dump ($arr);
        return $arr; 
    }

	  public function sort2($data,$pid=0,$level=0){
        static $arr2=array();
        foreach ($data as $k => $v) {
            if($v['pid']==$pid){ 
                $v['level']=$level;
                $arr2[]=$v;
                $this->sort2($data,$v['id'],$level+1);
            }
        }

		$arr=array();
		foreach ($arr2 as $k => $v) {
            if($v['upri']=='0' or $v['upri']=='1' ){
                $arr[]=$v;
             }
        }
		
        return $arr;
    }

    public function getchilrenid($cateid){
        $cateres=$this->select();
        return $this->_getchilrenid($cateres,$cateid);
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


}
