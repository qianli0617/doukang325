<?php

namespace App\Api;

use PhalApi\Api;
use App\Domain\Backpack as Domain_Backpack;

/**
 * 背包
 */
class Backpack extends Api {
	public function getRules() {
		return array(
            'getBackpack' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'live_type' => array('name' => 'live_type', 'type' => 'int', 'default' => 0, 'desc' => '直播间类型 0视频直播 1语音聊天室'),
			),
		);
	}
	

	/**
	 * 获取背包礼物
	 * @desc 用于获取背包礼物
	 * @return int code 操作码，0表示成功
	 * @return array info 
	 * @return string info[].nums 数量
	 * @return string msg 提示信息
	 */
	public function getBackpack() {
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		
		$uid=\App\checkNull($this->uid);
        $token=\App\checkNull($this->token);
        $live_type=\App\checkNull($this->live_type);
        
        if($uid<0 || $token=='' ){
            $rs['code'] = 1000;
			$rs['msg'] = \PhalApi\T('信息错误');
			return $rs;
        }
        
        $checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
        
		$domain = new Domain_Backpack();
		$info = $domain->getBackpack($uid,$live_type);

		
		$rs['info']=$info;
		return $rs;			
	}		
	

}
