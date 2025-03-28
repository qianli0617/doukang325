<?php

/**
 * 主播等级
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\facade\Db;

class LevelanchorController extends AdminbaseController {
	
    function index(){
        
    	$lists = Db::name("level_anchor")
			->order("levelid asc")
			->paginate(20);
        
        $lists->each(function($v,$k){
			$v['thumb']=get_upload_path($v['thumb']);
			$v['thumb_mark']=get_upload_path($v['thumb_mark']);
			$v['bg']=get_upload_path($v['bg']);
            return $v;           
        });
        
        $page = $lists->render();

    	$this->assign('lists', $lists);
    	$this->assign("page", $page);
    	
    	return $this->fetch();
    }
    
    function del(){
        
        $id = $this->request->param('id', 0, 'intval');
        
        $rs = DB::name('level_anchor')->where("id={$id}")->delete();
        if(!$rs){
            $this->error("删除失败！");
        }
        
        $action="删除主播等级：{$id}";
        setAdminLog($action);
                    
        $this->resetcache();
        $this->success("删除成功！",url("levelanchor/index"));
            
	}		

	function add(){
		return $this->fetch();
	}
    
	function addPost(){
		if ($this->request->isPost()) {
            
            $data = $this->request->param();
            
			$levelid=$data['levelid'];
            $levelname=$data['levelname'];
            $levelname_en=$data['levelname_en'];

			if($levelid==""){
				$this->error("等级不能为空");
			}

            if(!is_numeric($levelid)){
                $this->error("等级必须为数字");
            }

            if($levelid<1){
                $this->error("等级必须大于1");
            }

            if($levelid>99999999){
                $this->error("等级必须在1-99999999之间");
            }

            if(floor($levelid)!=$levelid){
                $this->error("等级必须为整数");
            }
            
            $check = Db::name('level_anchor')->where(["levelid"=>$levelid])->find();
            if($check){
                $this->error('等级不能重复');
            }

            if($levelname==''){
                $this->error('请填写等级中文名称');
            }

            if($levelname_en==''){
                $this->error('请填写等级英文名称');
            }
                
			$level_up=$data['level_up'];
			if($level_up==""){
				$this->error("请填写等级经验上限");
			}

            if(!is_numeric($level_up)){
                $this->error("等级经验上限必须为数字");
            }

            if($level_up<1||$level_up>9999999999){
                $this->error("等级经验上限必须为1-9999999999数字");
            }

            if(floor($level_up)!=$level_up){
                $this->error("等级经验上限必须为整数");
            }
            
            $thumb=$data['thumb'];
			if($thumb==""){
				$this->error("请上传图标");
			}

            $data['thumb']=set_upload_path($thumb);
            
            $thumb_mark=$data['thumb_mark'];
			if($thumb_mark==""){
				$this->error("请上传头像角标");
			}

            $data['thumb_mark']=set_upload_path($thumb_mark);

            $bg=$data['bg'];
            if($bg==""){
                $this->error("请上传背景图片");
            }

            $data['bg']=set_upload_path($bg);
            
            $data['addtime']=time();
            
			$id = DB::name('level_anchor')->insertGetId($data);
            if(!$id){
                $this->error("添加失败！");
            }
            
            $action="添加主播等级：{$id}";
            setAdminLog($action);
            
            $this->resetcache();
            $this->success("添加成功！");
            
		}			
	}
        
	function edit(){
        
        $id   = $this->request->param('id', 0, 'intval');
        
        $data=Db::name('level_anchor')
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
            
            $data = $this->request->param();
            
			$id=$data['id'];
			$levelid=$data['levelid'];
            $levelname=$data['levelname'];
            $levelname_en=$data['levelname_en'];

			if($levelid==""){
				$this->error("等级不能为空");
			}
            
            if($levelid==""){
                $this->error("等级不能为空");
            }

            if(!is_numeric($levelid)){
                $this->error("等级必须为数字");
            }

            if($levelid<1){
                $this->error("等级必须大于1");
            }

            if($levelid>99999999){
                $this->error("等级必须在1-99999999之间");
            }

            if(floor($levelid)!=$levelid){
                $this->error("等级必须为整数");
            }

            $check = Db::name('level_anchor')->where([['levelid','=',$levelid],['id','<>',$id]])->find();
            if($check){
                $this->error('等级不能重复');
            }

            if($levelname==''){
                $this->error('请填写等级中文名称');
            }

            if($levelname_en==''){
                $this->error('请填写等级英文名称');
            }
                
			$level_up=$data['level_up'];
			if($level_up==""){
				$this->error("请填写等级经验上限");
			}

            if(!is_numeric($level_up)){
                $this->error("等级经验上限必须为数字");
            }

            if($level_up<1||$level_up>9999999999){
                $this->error("等级经验上限必须为1-9999999999数字");
            }

            if(floor($level_up)!=$level_up){
                $this->error("等级经验上限必须为整数");
            }
            
            $thumb=$data['thumb'];
			if($thumb==""){
				$this->error("请上传图标");
			}

            $thumb_old=$data['thumb_old'];
            if($thumb!=$thumb_old){
                $data['thumb']=set_upload_path($thumb);
            }
            
            $thumb_mark=$data['thumb_mark'];
			if($thumb_mark==""){
				$this->error("请上传头像角标");
			}

            $thumb_mark_old=$data['thumb_mark_old'];
            if($thumb_mark!=$thumb_mark_old){
                $data['thumb_mark']=set_upload_path($thumb_mark);
            }

            $bg=$data['bg'];
            if($bg==""){
                $this->error("请上传背景图片");
            }

            $bg_old=$data['bg_old'];
            if($bg_old!=$bg){
                $data['bg']=set_upload_path($bg);
            }

            unset($data['thumb_old']);
            unset($data['thumb_mark_old']);
            unset($data['bg_old']);
            
			$rs = DB::name('level_anchor')->update($data);
            if($rs===false){
                $this->error("修改失败！");
            }
            
            $action="编辑主播等级：{$data['id']}";
            setAdminLog($action);
            
            $this->resetcache();
            $this->success("修改成功！");
		}
	}
    
    function resetcache(){
		$key='levelanchor';
        
        $level= Db::name("level_anchor")->order("level_up asc")->select();
        if($level){
            setcaches($key,$level);
        }else{
			delcache($key);
		}
        
        return 1;
    }
		
}