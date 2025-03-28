<?php
namespace App\Model;

use PhalApi\Model\NotORMModel as NotORM;

class Guard extends NotORM {
	/* 守护用户列表 */
	public function getGuardList($data) {
        
        $rs=array();
        
        $liveuid=$data['liveuid'];
        
        $nowtime=time();
        $w=date('w',$nowtime);
        //获取本周开始日期，如果$w是0，则表示周日，减去 6 天
        $first=1;
        //周一
        $week=date('Y-m-d H:i:s',strtotime( date("Ymd",$nowtime)."-".($w ? $w - $first : 6).' days'));
        $week_start=strtotime( date("Ymd",$nowtime)."-".($w ? $w - $first : 6).' days');

        //本周结束日期
        //周天
        $week_end=strtotime("{$week} +1 week");

		$order=array();
		$order2=array();
		$list=\PhalApi\DI()->notorm->guard_user
                    ->select('uid,type')
                    ->where('liveuid=? and endtime>?',$liveuid,$nowtime)
                    //->order("type desc")
                    ->fetchAll();
        foreach($list as $k=>$v){
            $userinfo=\App\getUserInfo($v['uid']);
            
            $userinfo['type']=$v['type'];
            $userinfo['contribute']=$this->getWeekContribute($v['uid'],$liveuid,$week_start,$week_end);
            
            $order[]=$userinfo['contribute'];
            $order2[]=$userinfo['type'];
            $rs[]=$userinfo;
        }
        
        
        array_multisort($order, SORT_DESC, $order2, SORT_DESC, $rs);


		return $rs;
	}
    
    public function getWeekContribute($uid,$liveuid,$starttime=0,$endtime=0){
        $contribute='0';
        if($uid>0){
            $where="action in ('1','10') and uid = {$uid} and touid={$liveuid}";
            if($starttime>0 ){
               $where.=" and addtime > {$starttime}";
            }
            if($endtime>0 ){
               $where.=" and addtime < {$endtime}";
            }
            
            $contribute=\PhalApi\DI()->notorm->user_coinrecord
                    ->where($where)
                    ->sum('totalcoin');
            if(!$contribute){
                $contribute=0;
            }
        }
        
        return (string)$contribute;
    }

    /* 守护信息列表 */
    public function getList(){

        //语言包
		$list=\PhalApi\DI()->notorm->guard
                    ->select('id,name,name_en,type,coin')
                    ->order("list_order asc")
                    ->fetchAll();

        return $list;
    }
    
    /* 购买守护 */
    public function buyGuard($data){
        $rs = array('code' => 0, 'msg' => \PhalApi\T('购买成功'), 'info' => array());
        $uid=$data['uid'];
        $liveuid=$data['liveuid'];
        $stream=$data['stream'];
        $guardid=$data['guardid'];
        
        $guardinfo=\PhalApi\DI()->notorm->guard
                    ->select('*')
                    ->where('id=?',$guardid)
                    ->fetchOne();
        if(!$guardinfo){
            $rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('守护信息不存在');
			return $rs;
        }
        
        $addtime=time();
        $isexist=\PhalApi\DI()->notorm->guard_user
					->select('*')
					->where('uid = ? and liveuid=?', $uid,$liveuid)
					->fetchOne();
        if($isexist && $isexist['endtime'] > $addtime && $isexist['type'] > $guardinfo['type'] ){
            $rs['code'] = 1004;
			$rs['msg'] = \PhalApi\T('已经是尊贵守护了，不能购买普通守护');
			return $rs;
        }
		
		$type='0';
		$action='10';
        $giftid= $guardinfo['id'];
        $total= $guardinfo['coin'];
        
        /* 更新用户余额 消费 */
		$isok=\PhalApi\DI()->notorm->user
				->where('id = ? and coin>=?', $uid,$total)
				->update(
                    array(
                        'coin' => new \NotORM_Literal("coin - {$total}"),
                        'consumption' => new \NotORM_Literal("consumption + {$total}")
                    )
                );

        if(!$isok){
            $rs['code'] = 1002;
			$rs['msg'] = \PhalApi\T('余额不足');
			return $rs;
        }
        
        
        \PhalApi\DI()->notorm->user
            ->where('id = ?', $liveuid)
            ->update(
                array(
                    'votes' => new \NotORM_Literal("votes + {$total}"),
                    'votestotal' => new \NotORM_Literal("votestotal + {$total}")
                )
            );
        
        $showid=0;
        if($stream){
            $stream2=explode('_',$stream);
            $showid=$stream2[1];
            if(!$showid){
                $showid=0;
            }
        }
        
        $insert_votes=[
            'type'=>'1',
            'action'=>$action,
            'uid'=>$liveuid,
            'fromid'=>$uid,
            'actionid'=>$giftid,
            'nums'=>1,
            'total'=>$total,
            'showid'=>$showid,
            'votes'=>$total,
            'addtime'=>$addtime,
        ];
        \PhalApi\DI()->notorm->user_voterecord->insert($insert_votes);
		
		
        $insert=array(
            "type"=>$type,
            "action"=>$action,
            "uid"=>$uid,
            "touid"=>$liveuid,
            "giftid"=>$giftid,
            "giftcount"=>'1',
            "totalcoin"=>$total,
            "showid"=>$showid,
            "addtime"=>$addtime
        );

		\PhalApi\DI()->notorm->user_coinrecord->insert($insert);
	    
	    $insert_all = array(
		    'type' => $type,
		    'action' => '3',
		    'uid' => $uid,
		    'totalcoin' => $total,
		    'showid' => $showid,
		    'addtime' => $addtime
	    );
	    
	    \PhalApi\DI()->notorm->user_coinrecord_all->insert($insert_all);
        
        $endtime=$addtime + $guardinfo['length_time'];
        if($isexist){
            
            if($isexist['type'] == $guardinfo['type'] && $isexist['endtime'] > $addtime){
                /* 同类型未到期 只更新到期时间 */
                \PhalApi\DI()->notorm->guard_user
					->where('id = ? ', $isexist['id'])
					->update(
                        array(
                            'endtime' => new \NotORM_Literal("endtime + {$guardinfo['length_time']}")
                        )
                    );
                    
                $rs['msg']=\PhalApi\T('续费成功');
            }else{
                $data=array(
                    'type'=>$guardinfo['type'],
                    'endtime'=>$endtime,
                    'addtime'=>$addtime,
                );
                \PhalApi\DI()->notorm->guard_user
					->where('id = ? ', $isexist['id'])
					->update( $data );
            }
        }else{
            $data=array(
                'uid'=>$uid,
                'liveuid'=>$liveuid,
                'type'=>$guardinfo['type'],
                'endtime'=>$endtime,
                'addtime'=>$addtime,
            );
            \PhalApi\DI()->notorm->guard_user
					->insert( $data );
        
        }
        
        /* 清除缓存 */
		\App\delcache("userinfo_".$uid);
		\App\delcache("userinfo_".$liveuid);
        
        $userinfo2 =\PhalApi\DI()->notorm->user
				->select('consumption,coin')
				->where('id = ?', $uid)
				->fetchOne();
    
		$level=\App\getLevel($userinfo2['consumption']);
        
        $guard=\PhalApi\DI()->notorm->guard_user
					->select('type,endtime')
					->where('uid = ? and liveuid=?', $uid,$liveuid)
					->fetchOne();
        $key='getUserGuard_'.$uid.'_'.$liveuid;
        \App\setcaches($key,$guard);
        
        $liveuidinfo =\PhalApi\DI()->notorm->user
				->select('votestotal')
				->where('id = ?', $liveuid)
				->fetchOne();
        
        $guard_nums=$this->getGuardNums($liveuid);
        
        $info=array(
            'coin'=>$userinfo2['coin'],
            'votestotal'=>$liveuidinfo['votestotal'],
            'guard_nums'=>$guard_nums,
            'level'=>(string)$level,
            'total'=>(string)$total,
            'type'=>$guard['type'],
            'endtime'=>date("Y.m.d",$guard['endtime']),
        );
        
        $rs['info'][0]=$info;
        return $rs;
        
    }
    
    /* 获取用户守护信息 */
    public function getUserGuard($uid,$liveuid){
        $rs=array(
            'type'=>'0',
            'endtime'=>'0',
        );

        if($uid<0 || $liveuid<0){
            return $rs;
        }

        $key='getUserGuard_'.$uid.'_'.$liveuid;
        $guardinfo=\App\getcaches($key);
        if(!$guardinfo){
            $guardinfo=\PhalApi\DI()->notorm->guard_user
					->select('type,endtime')
					->where('uid = ? and liveuid=?', $uid,$liveuid)
					->fetchOne();
            \App\setcaches($key,$guardinfo);
        }
        $nowtime=time();
        
        if($guardinfo && $guardinfo['endtime']>$nowtime){
            $rs=array(
                'type'=>$guardinfo['type'],
                'endtime'=>date("Y.m.d",$guardinfo['endtime']),
            );
        }
        return $rs;
    }
    
    /* 获取主播守护总数 */
    public function getGuardNums($liveuid){
        
        $nowtime=time();
        
        $nums=\PhalApi\DI()->notorm->guard_user
					->where('liveuid=? and endtime>?',$liveuid,$nowtime)
					->count();
        return (string)$nums;
    }
}
