<?php

/**
 * 管理员手动充值余额记录
 */
namespace app\admin\controller;

use cmf\controller\AdminBaseController;
use think\facade\Db;

class BalanceController extends AdminbaseController {

    function index(){
        $data = $this->request->param();
        $map=[];
        
        $start_time= $data['start_time'] ?? '';
        $end_time= $data['end_time'] ?? '';
        
        if($start_time!=""){
           $map[]=['addtime','>=',strtotime($start_time)];
        }

        if($end_time!=""){
           $map[]=['addtime','<=',strtotime($end_time) + 60*60*24];
        }

        $uid=$data['uid'] ?? '';
        if($uid!=''){
            $lianguid=getLianguser($uid);
            if($lianguid){
                
                array_push($lianguid,$uid);
                $map[]=['touid','in',$lianguid];
            }else{
                $map[]=['touid','=',$uid];
            }
        }

        $lists = Db::name("balance_charge_admin")
            ->where($map)
			->order("id desc")
			->paginate(20);
        
        $lists->each(function($v,$k){
			$v['userinfo']=getUserInfo($v['touid']);
			$v['ip']=long2ip($v['ip']);
            return $v;           
        });
        
        $lists->appends($data);
        $page = $lists->render();

    	$this->assign('lists', $lists);

    	$this->assign("page", $page);
    	
        $balance = Db::name("balance_charge_admin")
            ->where($map)
			->sum('balance');
        if(!$balance){
            $balance=0;
        }

    	$this->assign('balance', $balance);
        
    	return $this->fetch();
    }
		
	function add(){
		return $this->fetch();
	}

	function addPost(){
		if ($this->request->isPost()) {
            
            $data = $this->request->param();
            
			$touid=$data['touid'];

			if($touid==""){
				$this->error("请填写用户ID");
			}
            
            $uid=Db::name("user")->where(["id"=>$touid])->value("id");
            if(!$uid){
                $this->error("会员不存在，请更正");
                
            }
            
			$balance=$data['balance'];
			if($balance==""){
				$this->error("请填写充值金额");
			}

            if(!is_numeric($balance)){
                $this->error("充值金额必须为数字");
            }

            $balance=round($balance,2);

            $user_balance=Db::name("user")->where(["id"=>$touid])->value("balance");

            $total=$user_balance+$balance;

            if($total<0){
              $total=0;  
            }
            
            $adminid=cmf_get_current_admin_id();
            $admininfo=Db::name("user")->where(["id"=>$adminid])->value("user_login");
            
            $data['admin']=$admininfo;
            $ip=get_client_ip(0,true);
            
            $data['ip']=ip2long($ip);
            
            $data['addtime']=time();
            
			$id = DB::name('balance_charge_admin')->insertGetId($data);
            if(!$id){
                $this->error("充值失败！");
            }
            
			$action="手动充值店铺余额ID：".$id;
			setAdminLog($action);
			
            Db::name("user")->where(["id"=>$touid])->update(['balance'=>$total]);
            $this->success("充值成功！");
            
		}
	}
    
    function export(){
        $data = $this->request->param();
        $map=[];
        
        $start_time= $data['start_time'] ?? '';
        $end_time= $data['end_time'] ?? '';
        
        if($start_time!=""){
           $map[]=['addtime','>=',strtotime($start_time)];
        }

        if($end_time!=""){
           $map[]=['addtime','<=',strtotime($end_time) + 60*60*24];
        }
        
        $status= $data['status'] ?? '';
        if($status!=''){
            $map[]=['status','=',$status];
        }
        
        $uid= $data['uid'] ?? '';
        if($uid!=''){
            $lianguid=getLianguser($uid);
            if($lianguid){
                
                array_push($lianguid,$uid);
                $map[]=['touid','in',$lianguid];
            }else{
                $map[]=['touid','=',$uid];
            }
        }
        
        $xlsName  = "手动充值余额记录";
        $xlsData = Db::name("balance_charge_admin")
            ->where($map)
			->order("id desc")
			->select()
            ->toArray();

        if(empty($xlsData)){
            $this->error('数据为空');
        }

        foreach ($xlsData as $k => $v){

            $userinfo=getUserInfo($v['touid']);
            
            $xlsData[$k]['user_nickname']= $userinfo['user_nickname'].'('.$v['touid'].')';
            $xlsData[$k]['addtime']=date("Y-m-d H:i:s",$v['addtime']); 
            $xlsData[$k]['ip']=long2ip($v['ip']); 
        }
        
        $action="导出手动充值余额记录：".Db::name("balance_charge_admin")->getLastSql();
        setAdminLog($action);
        $cellName = array('A','B','C','D','E','F');
        $xlsCell  = array(
            array('id','序号'),
            array('admin','管理员'),
            array('user_nickname','会员 (账号)(ID)'),
            array('balance','充值金额'),
            array('ip','IP'),
            array('addtime','时间'),
        );
        exportExcel($xlsName,$xlsCell,$xlsData,$cellName);
    }
    

}
