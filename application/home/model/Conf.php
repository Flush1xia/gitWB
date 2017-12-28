<?php
namespace app\home\model;
use think\Model;
class Conf  extends Model
{
    public function getAllConf(){
    	$confres=$this::field('enname,cnname')->select();
    	return $confres;
    }
}
