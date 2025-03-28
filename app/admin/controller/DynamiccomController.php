<?php

/* 动态评论 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\facade\Db;

class DynamiccomController extends AdminBaseController
{

    
    public function index(){
        $data = $this->request->param();
        $map=[];
        
        $status= $data['status'] ?? '';
        $dynamicid= $data['dynamicid'] ?? '0';
        if($dynamicid!=0){
            $map[]=['dynamicid','=',$dynamicid];
        }
        $start_time= $data['start_time'] ?? '';
        $end_time= $data['end_time'] ?? '';
        
        if($start_time!=""){
           $map[]=['addtime','>=',strtotime($start_time)];
        }

        if($end_time!=""){
           $map[]=['addtime','<=',strtotime($end_time) + 60*60*24];
        }

        $uid= $data['uid'] ?? '';
        if($uid!=''){
            $lianguid=getLianguser($uid);
            if($lianguid){
                
                array_push($lianguid,$uid);
                $map[]=['uid','in',$lianguid];
            }else{
                $map[]=['uid','=',$uid];
            }
        }

        $list = Db::name('dynamic_comments')
            ->where($map)
            ->order("id desc")
            ->paginate(20);
        
        $list->each(function($v,$k){
           $v['userinfo']= getUserInfo($v['uid']);
           return $v; 
        });
        
        $list->appends($data);
        
        $page = $list->render();
        $this->assign("page", $page);
        $this->assign("dynamicid", $dynamicid);
        $this->assign('list', $list);
        return $this->fetch();
    }

    public function del()
    {
        $data = $this->request->param();
        
        if (isset($data['id'])) {
            $id = $data['id']; //获取删除id
            
            $info=DB::name('dynamic_comments')->where("id={$id}")->find();
            $rs = DB::name('dynamic_comments')->where("id={$id}")->delete();
            if(!$rs){
                $this->error("删除失败！");
            }
            
            DB::name('dynamic')
                ->where("id={$info['dynamicid']} and comments>=1")
                ->dec('comments','1')
                ->update();

			$action='动态ID: '.$info['dynamicid'].' 删除评论ID: '.$id;
			setAdminLog($action);

        } elseif (isset($data['ids'])) {
            $ids = $data['ids'];

            $infos=DB::name('dynamic_comments')
                ->field('dynamicid')
                ->where('id', 'in', $ids)
                ->select()
                ->toArray();

            $rs = DB::name('dynamic_comments')->where('id', 'in', $ids)->delete();
            if(!$rs){
                $this->error("删除失败！");
            }
            foreach($infos as $k=>$v){
                DB::name('dynamic')
                    ->where("id={$v['dynamicid']} and comments>=1")
                    ->dec('comments','1')
                    ->update();

            }
			
			$action=' 删除评论IDS: '.json_encode($ids);
			setAdminLog($action);
        }

        $this->success("删除成功！");	
        
    }


}