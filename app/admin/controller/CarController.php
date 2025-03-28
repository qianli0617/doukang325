<?php

/**
 * 坐骑管理
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\facade\Db;

class CarController extends AdminbaseController {

    function index(){

    	$lists = Db::name("car")
			->order("list_order asc")
			->paginate(20);
        
        $lists->each(function($v,$k){
			$v['thumb']=get_upload_path($v['thumb']);
            return $v;           
        });
        
        $page = $lists->render();

    	$this->assign('lists', $lists);

    	$this->assign("page", $page);
    	
    	return $this->fetch();
    }
		
	function del(){
        
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = DB::name('car')->where("id={$id}")->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        
        $action="删除坐骑：{$id}";
        setAdminLog($action);
                    
        $this->resetcache();
        $this->success("删除成功！");
            
	}
    //排序
    public function listOrder() { 
		
        $model = DB::name('car');
        parent::listOrders($model);
        
        $action="更新坐骑排序";
        setAdminLog($action);
        
        $this->resetcache();
        $this->success("排序更新成功！");
        
    }

	function add(){
		return $this->fetch();
	}

	function addPost(){
		if ($this->request->isPost()) {
            
            $configpub=getConfigPub();
            
            $data = $this->request->param();
            
			$name=$data['name'];
			$name_en=$data['name_en'];

			if($name==""){
				$this->error("请填写坐骑中文名称");
			}

			if($name_en==""){
				$this->error("请填写坐骑英文名称");
			}

			$needcoin=$data['needcoin'];
			if($needcoin==""){
				$this->error("请填写坐骑所需".$configpub['name_coin']);
			}

			if(!is_numeric($needcoin)){
				$this->error("请确认坐骑所需".$configpub['name_coin']);
			}

			if($needcoin<1||$needcoin>99999999){
				$this->error("坐骑所需".$configpub['name_coin']."必须在1-99999999之间");
			}

			if(floor($needcoin)!=$needcoin){
				$this->error("坐骑所需".$configpub['name_coin']."必须为整数");
			}
            
            $score=$data['score'];
			if($score==""){
				$this->error("请填写坐骑所需".$configpub['name_score']);
			}

			if(!is_numeric($score)){
				$this->error("请确认坐骑所需".$configpub['name_score']);
			}

			if($score<1||$score>99999999){
				$this->error("请确认坐骑所需".$configpub['name_score']."必须在1-99999999之间");
			}

			if(floor($score)!=$score){
				$this->error("坐骑所需".$configpub['name_score']."必须为整数");
			}

			$thumb=$data['thumb'];
			if(!$thumb){
				$this->error("请上传图片");
			}

			$data['thumb']=set_upload_path($thumb);

			$swf=$data['swf'];
			if(!$swf){
				$this->error("请上传动画");
			}

			$data['swf']=set_upload_path($swf);

			$swftime=$data['swftime'];
			if($swftime==""){
				$this->error("请填写动画时长");
			}

			if(!is_numeric($swftime)){
				$this->error("请确认动画时长");
			}

			if($swftime<0){
				$this->error("动画时长不能小于0");
			}

			$words=$data['words'];
			if($words==""){
				$this->error("请填写进场话术");
			}
            $data['addtime']=time();
            
			$id = DB::name('car')->insertGetId($data);
            if(!$id){
                $this->error("添加失败！");
            }
            
            $action="添加坐骑：{$id}";
            setAdminLog($action);
            
            $this->resetcache();
            $this->success("添加成功！");
            
		}
	}

	function edit(){
        
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::name('car')
            ->where("id={$id}")
            ->find();
        if(!$data){
            $this->error("信息错误");
        }
        
        $this->assign('data', $data);
        return $this->fetch();
	}
	
	function editPost(){
		if ($this->request->isPost()) {
            
            $configpub=getConfigPub();
            $data = $this->request->param();
            
			$name=$data['name'];

			if($name==""){
				$this->error("请填写坐骑名称");
			}
			$needcoin=$data['needcoin'];
			if($needcoin==""){
				$this->error("请填写坐骑所需".$configpub['name_coin']);
			}

			if(!is_numeric($needcoin)){
				$this->error("请确认坐骑所需".$configpub['name_coin']);
			}

			if($needcoin<1||$needcoin>99999999){
				$this->error("坐骑所需".$configpub['name_coin']."必须在1-99999999之间");
			}

			if(floor($needcoin)!=$needcoin){
				$this->error("坐骑所需".$configpub['name_coin']."必须为整数");
			}
            
            $score=$data['score'];
			if($score==""){
				$this->error("请填写坐骑所需".$configpub['name_score']);
			}

			if(!is_numeric($score)){
				$this->error("请确认坐骑所需".$configpub['name_score']);
			}

			if($score<1||$score>99999999){
				$this->error("请确认坐骑所需".$configpub['name_score']."必须在1-99999999之间");
			}

			if(floor($score)!=$score){
				$this->error("坐骑所需".$configpub['name_score']."必须为整数");
			}

			$thumb=$data['thumb'];
			if(!$thumb){
				$this->error("请上传图片");
			}

			$thumb_old=$data['thumb_old'];
			if($thumb!=$thumb_old){
				$data['thumb']=set_upload_path($thumb);
			}

			$swf=$data['swf'];
			if(!$swf){
				$this->error("请上传动画");
			}

			$swf_old=$data['swf_old'];
			if($swf!=$swf_old){
				$data['swf']=set_upload_path($swf);
			}

			$swftime=$data['swftime'];
			if($swftime==""){
				$this->error("请填写动画时长");
			}

			if(!is_numeric($swftime)){
				$this->error("请确认动画时长");
			}

			if($swftime<0){
				$this->error("动画时长不能小于0");
			}

			$words=$data['words'];
			if($words==""){
				$this->error("请填写进场话术");
			}

			unset($data['thumb_old']);
			unset($data['swf_old']);
            
			$rs = DB::name('car')->update($data);
            if($rs===false){
                $this->error("修改失败！");
            }
            
            $action="修改坐骑：{$data['id']}";
            setAdminLog($action);
            
            $this->resetcache();
            $this->success("修改成功！");
		}
	}
    
    function resetcache(){
        $key='carinfo';

        $car_list=DB::name("car")->order("list_order asc")->select();
        if($car_list){
            setcaches($key,$car_list);
        }else{
			delcache($key);
		}
        return 1;
    }
}
