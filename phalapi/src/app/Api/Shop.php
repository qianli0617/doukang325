<?php
namespace App\Api;

use PhalApi\Api;
use App\Domain\Shop as Domain_Shop;
/**
 * 商城
 */
class Shop extends Api {
	public function getRules() {
		return array(

			'getBond'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
			),

			'deductBond'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'require' => true, 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
                'time' => array('name' => 'time', 'type' => 'string', 'desc' => '当前时间戳'),
                'sign' => array('name' => 'sign', 'type' => 'string', 'desc' => '签名'),
			),

			'shopApply'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'username' => array('name' => 'username', 'type' => 'string', 'desc' => '姓名'),
                'cardno' => array('name' => 'cardno', 'type' => 'string', 'desc' => '身份证号'),
                'classid' => array('name' => 'classid', 'type' => 'string', 'desc' => '经营类目'),
                'contact' => array('name' => 'contact', 'type' => 'string', 'desc' => '经营联系人'),
                'country_code' => array('name' => 'country_code', 'type' => 'int', 'desc' => '国家代号','default'=>'86'),
                'phone' => array('name' => 'phone', 'type' => 'string', 'desc' => '手机号'),
                'province' => array('name' => 'province', 'type' => 'string', 'desc' => '省份'),
                'city' => array('name' => 'city', 'type' => 'string', 'desc' => '市'),
                'area' => array('name' => 'area', 'type' => 'string', 'desc' => '地区'),
                'address' => array('name' => 'address', 'type' => 'string', 'desc' => '详细地址'),
                'service_phone' => array('name' => 'service_phone', 'type' => 'string', 'desc' => '客服电话'),
                'receiver' => array('name' => 'receiver', 'type' => 'string', 'desc' => '收货人'),
                'receiver_phone' => array('name' => 'receiver_phone', 'type' => 'string', 'desc' => '收货人手机号'),
                'receiver_province' => array('name' => 'receiver_province', 'type' => 'string', 'desc' => '收货人省份'),
                'receiver_city' => array('name' => 'receiver_city', 'type' => 'string', 'desc' => '收货人市'),
                'receiver_area' => array('name' => 'receiver_area', 'type' => 'string', 'desc' => '收货人地区'),
                'receiver_address' => array('name' => 'receiver_address', 'type' => 'string', 'desc' => '收货人详细地址'),
                'certificate' => array('name' => 'certificate', 'type' => 'string', 'desc' => '营业执照'),
                'other' => array('name' => 'other', 'type' => 'string', 'desc' => '其他证件'),

			),
            
            'getShopApplyInfo'=>array(
                'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string',  'require' => true, 'desc' => '用户Token'),
                'time' => array('name' => 'time', 'type' => 'string', 'desc' => '时间戳'),
                'sign' => array('name' => 'sign', 'type' => 'string', 'desc' => '签名'),
            ),
            
            'setSale' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'desc' => '商品ID'),
                'issale' => array('name' => 'issale', 'type' => 'int', 'desc' => '在售状态，0否1是'),
			),
            
            'getShop' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
				'touid' => array('name' => 'touid', 'type' => 'int', 'desc' => '对方ID'),
                'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
			),
            
            'getSale' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'liveuid' => array('name' => 'liveuid', 'type' => 'int', 'desc' => '主播ID'),
                'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
			),
            
            
            'getShopInfo' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'touid' => array('name' => 'touid', 'type' => 'int', 'desc' => '对方ID'),
			),

			'getGoodsInfo'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'desc' => '商品ID'),
			),

			'getGoodsCommentList'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'desc' => '商品ID'),
                'type'=>array('name' => 'type', 'type' => 'string', 'desc' => '评论类型 all 全部 img 有图 video 有视频 append 追加'),
                'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
			),

			'searchShopGoods'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'keywords' => array('name' => 'keywords', 'type' => 'string', 'desc' => '关键词'),
                'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
			),
			'setCollect' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
				'goodsid' => array('name' => 'goodsid', 'type' => 'int','require' => true, 'desc' => '商品ID'),
			),
			'getGoodsCollect' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
				'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
				
			),
			'getBusinessCategory' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),

			),
			'getApplyBusinessCategory' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),

			),
			'applyBusinessCategory' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'require' => true, 'desc' => '用户token'),
				'classid' => array('name' => 'classid', 'type' => 'string', 'desc' => '经营类目'),

			),
			'getGoodExistence' => array(
				'uid' => array('name' => 'uid', 'type' => 'int',  'require' => true, 'desc' => '用户ID'),
				'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'min' => 1, 'require' => true, 'desc' => '商品ID'),
			),

			'setPlatformGoodsSale' => array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'goodsid' => array('name' => 'goodsid', 'type' => 'int', 'desc' => '商品ID'),
                'issale' => array('name' => 'issale', 'type' => 'int', 'desc' => '在售状态，0否1是'),
			),
			
			'searchOnsalePlatformGoods'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'keywords' => array('name' => 'keywords', 'type' => 'string', 'desc' => '关键词'),
                'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
			),

			'getOnsalePlatformGoods'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'touid' => array('name' => 'touid', 'type' => 'int', 'desc' => '对方ID'),
                'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
			),
			'delGoodsCollect'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
                'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
                'ids' => array('name' => 'ids', 'type' => 'string', 'desc' => '商品收藏记录id列表'),
			),
			'getShoppingCartList'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
			),
			'addShoppingCart'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int','require' => true, 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string','require' => true, 'desc' => '用户token'),
				'goodsid' => array('name' => 'goodsid', 'type' => 'int','require' => true, 'desc' => '商品ID'),
				'num' => array('name' => 'num', 'type' => 'int','require' => true, 'desc' => '商品数量'),
				'specid' => array('name' => 'specid', 'type' => 'int','require' => true, 'desc' => '商品规格id'),
			),
			'updateShoppingCart'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int','require' => true,'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string','require' => true,'desc' => '用户token'),
				'cartid' => array('name' => 'cartid', 'type' => 'int','require' => true,'desc' => '购物车商品记录id列表'),
				'num' => array('name' => 'num', 'type' => 'int','require' => true, 'desc' => '商品数量'),
			),
			'delShoppingCart'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
				'cartids' => array('name' => 'cartids', 'type' => 'string', 'desc' => '购物车商品记录id列表'),
			),
			'isApplyShop'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
			),
			'shopWindow'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
				'p' => array('name' => 'p', 'type' => 'int', 'default'=>'1', 'desc' => '页码'),
			),
			'shopApplyNew'=>array(
				'uid' => array('name' => 'uid', 'type' => 'int', 'desc' => '用户ID'),
				'token' => array('name' => 'token', 'type' => 'string', 'desc' => '用户token'),
				'username' => array('name' => 'username', 'type' => 'string', 'desc' => '姓名'),
				'cardno' => array('name' => 'cardno', 'type' => 'string', 'desc' => '身份证号'),
				'classid' => array('name' => 'classid', 'type' => 'string', 'desc' => '经营类目'),
				'name' => array('name' => 'name', 'type' => 'string', 'desc' => '店铺姓名'),
				'thumb' => array('name' => 'thumb', 'type' => 'string', 'desc' => '店铺图片'),
				'des' => array('name' => 'des', 'type' => 'string', 'desc' => '店铺简介'),
				'phone' => array('name' => 'phone', 'type' => 'string', 'desc' => '手机号'),
				'certificate' => array('name' => 'certificate', 'type' => 'string', 'desc' => '营业执照'),
			)
		);
	}
	
	/**
	 *获取保证金
	 *@desc 用于获取保证金设置数和用户是否缴纳保证金
	 *@return int code 状态码，0表示成功
	 *@return array info 状态码，0表示成功
	 *@return array info[0].shop_bond 后台设置的保证金金额
	 *@return array info[0].bond_status 用户是否缴纳保证金
	 *@return string msg 提示信息
	*/
	public function getBond(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());

		$uid=\App\checkNull($this->uid);
        $token=\App\checkNull($this->token);

        $checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		$configpri=\App\getConfigPri();
		$shop_bond=$configpri['shop_bond'];
		$rs['info'][0]['shop_bond']=$shop_bond;

		$domain=new Domain_Shop();
		$res=$domain->getBond($uid);

		if($res==-1){ //没有缴纳保证金
			$rs['info'][0]['bond_status']='0';
		}

		if($res==1){ //保证金已退回
			$rs['info'][0]['bond_status']='0';
		}

		if($res==2){ //保证金已缴纳/已处理
			$rs['info'][0]['bond_status']='1';
		}

		return $rs;
	}


	/**
	 *缴纳保证金
	 *@desc 用于用户缴纳保证金
	 *@return int code 状态码，0表示成功
	 *@return array info 状态码，0表示成功
	 *@return string msg 提示信息
	*/
	public function deductBond(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('保证金缴纳成功'), 'info' => array());

		$uid=\App\checkNull($this->uid);
        $token=\App\checkNull($this->token);
        $time=\App\checkNull($this->time);
        $sign=\App\checkNull($this->sign);

        $checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		if(!$time){
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('参数错误,请重试');
			return $rs;
		}

		$now=time();
		if($now-$time>300){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T('参数错误');
			return $rs;
		}

		if(!$sign){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T("参数错误,请重试");
			return $rs;
		}
        
        $checkdata=array(
            'uid'=>$uid,
            'token'=>$token,
            'time'=>$time,
        );
        
        $issign=\App\checkSign($checkdata,$sign);
        if(!$issign){
            $rs['code']=1001;
            $rs['msg']=\PhalApi\T('签名错误');
            return $rs;
        }

        $configpri=\App\getConfigPri();
		$shop_bond=isset($configpri['shop_bond'])? $configpri['shop_bond']:'';

		if(!$shop_bond){
			$rs['code']=1002;
            $rs['msg']=\PhalApi\T('保证金设置无法缴纳');
            return $rs;
		}

		$domain=new Domain_Shop();
		$result=$domain->deductBond($uid,$shop_bond);
		if($result==1001){
			$rs['code']=1003;
            $rs['msg']=\PhalApi\T('已缴纳保证金');
            return $rs;
		}

		if($result==1002){
			$rs['code']=1004;
            $rs['msg']=\PhalApi\T('您的余额不足');
            return $rs;
		}

		if($result==1003){
			$rs['code']=1005;
            $rs['msg']=\PhalApi\T('保证金缴纳失败');
            return $rs;
		}

		return $rs;
	}

	/**
	 * 获取一级商品分类
	 * @desc 用于获取一级商品分类
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return array info[].gc_id 商品分类id
	 * @return array info[].gc_name 商品分类名称
	 * @return string msg 提示信息
	 */
	public function getOneGoodsClass(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$domain=new Domain_Shop();

		$list=$domain->getOneGoodsClass();
		$rs['info']=$list;

		return $rs;
	}


	/**
	 * 申请店铺
	 * @desc 用于申请店铺
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string msg 提示信息
	 */
	public function shopApply(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('店铺申请成功'), 'info' => array());
		
		$uid=\App\checkNull($this->uid);
        $token=\App\checkNull($this->token);
        $username=\App\checkNull($this->username);
        $cardno=\App\checkNull($this->cardno);
        $classid=\App\checkNull($this->classid);
        $contact=\App\checkNull($this->contact);
        $country_code=\App\checkNull($this->country_code);
        $phone=\App\checkNull($this->phone);
        $province=\App\checkNull($this->province);
        $city=\App\checkNull($this->city);
        $area=\App\checkNull($this->area);
        $address=\App\checkNull($this->address);
        $service_phone=\App\checkNull($this->service_phone);
        $receiver=\App\checkNull($this->receiver);
        $receiver_phone=\App\checkNull($this->receiver_phone);
        $receiver_province=\App\checkNull($this->receiver_province);
        $receiver_city=\App\checkNull($this->receiver_city);
        $receiver_area=\App\checkNull($this->receiver_area);
        $receiver_address=\App\checkNull($this->receiver_address);
        $certificate=\App\checkNull($this->certificate);
        $other=\App\checkNull($this->other);

        $checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		//判断用户是否实名认证
		$isauth=\App\isAuth($uid);
		if(!$isauth){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请先进行实名认证");
        	return $rs;
		}

        if(!$username){
        	$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请填写姓名");
        	return $rs;
        }

        if(mb_strlen($username)>20){
        	$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("姓名长度不能超过{num}个字",['num'=>20]);
        	return $rs;
        }

        if(!$cardno){
        	$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请填写身份证号");
        	return $rs;
        }

        if(!\App\isCreditNo($cardno)){
        	$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("身份证号不合法");
        	return $rs;
        }

        if(!$classid){
        	$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请选择经营类目");
        	return $rs;
        }

        $classid_arr=explode(",",$classid);

   

        $domain=new Domain_Shop();
		$class_list=$domain->getOneGoodsClass();

		$is_exist=1;

		$gc_ids=array_column($class_list,"gc_id");
		foreach ($classid_arr as $k => $v) {
			if(!in_array($v, $gc_ids)){
				$is_exist=0;
				break;
			}
		}

		if(!$is_exist){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("主营类目有误");
        	return $rs;
		}

		if(!$contact){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请填写经营者联系人");
        	return $rs;
		}

		if(mb_strlen($contact)>20){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("经营者联系人不能超过{num}个字",['num'=>20]);
        	return $rs;
		}

		if(!$phone){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请填写经营者手机号");
        	return $rs;
		}

		if(!\App\checkMobile($phone)){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("手机号码错误");
        	return $rs;
		}

		if(!$province){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请选择所在省份");
        	return $rs;
		}

		if(!$city){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请选择所在市");
        	return $rs;
		}

		if(!$area){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请选择所在地区");
        	return $rs;
		}

		if(!$address){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请填写详细地址");
        	return $rs;
		}

		if(mb_strlen($address)>50){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("详细地址必须在{num}字以内",['num'=>50]);
        	return $rs;
		}

		if($service_phone){
			$checkmobile=\App\checkMobile($service_phone);
			if(!$checkmobile){
				$rs['code']=1001;
	        	$rs['msg']=\PhalApi\T("客服电话错误");
	        	return $rs;
			}
		}else{
			$service_phone=$phone;
		}

		if($receiver){
			if(mb_strlen($receiver)>20){
	        	$rs['code']=1001;
	        	$rs['msg']=\PhalApi\T("收货人姓名长度不能超过{num}个字",['num'=>20]);
	        	return $rs;
	        }
		}else{
			$receiver=$username;
		}

		if($receiver_phone){

			$checkmobile=\App\checkMobile($receiver_phone);
			if(!$checkmobile){
				$rs['code']=1001;
	        	$rs['msg']=\PhalApi\T("退货电话错误");
	        	return $rs;
			}

		}else{
			$receiver_phone=$phone;
		}

		if(!$receiver_province){
			$receiver_province=$province;
		}

		if(!$receiver_city){
			$receiver_city=$city;
		}

		if(!$receiver_area){
			$receiver_area=$area;
		}

		if(!$receiver_address){
			$receiver_address=$address;
		}

		if(!$certificate){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T("请上传营业执照");
			return $rs;
		}

		if(!$other){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T("请上传其他证件");
			return $rs;
		}

		//判断保证金是否缴纳
		$bond_res=$domain->getBond($uid);

//		if($bond_res==-1 ||$bond_res==1){ //没有缴纳保证金
//			$rs['code']=1001;
//			$rs['msg']=\PhalApi\T("请缴纳保证金");
//			return $rs;
//		}

		//判断店铺审核状态
		$apply_info=$domain->getShopApplyInfo($uid);
		$apply_status=$apply_info['apply_status']; //-1 无审核记录 0 审核中 1 审核通过 2 审核拒绝

		if($apply_status==0){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T("店铺审核中,请耐心等待");
			return $rs;
		}

		if($apply_status==1){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T("店铺已审核通过");
			return $rs;
		}


		$data=array(
			'username'=>$username,
	        'cardno'=>$cardno,
	        'contact'=>$contact,
	        'country_code'=>$country_code,
	        'phone'=>$phone,
	        'province'=>$province,
	        'city'=>$city,
	        'area'=>$area,
	        'address'=>$address,
	        'service_phone'=>$service_phone,
	        'receiver'=>$receiver,
	        'receiver_phone'=>$receiver_phone,
	        'receiver_province'=>$receiver_province,
	        'receiver_city'=>$receiver_city,
	        'receiver_area'=>$receiver_area,
	        'receiver_address'=>$receiver_address,
	        'certificate'=>$certificate,
	        'other'=>$other,
	        'status'=>1
		);

		if($apply_status==-1){ //无审核记录
			$data['uid']=$uid;
			$data['addtime']=time();
		}

		if($apply_status==2){ //被拒绝
			
			$data['uptime']=time();
		}

		$configpri=\App\getConfigPri();
		$shop_switch=$configpri['show_switch'];
		$shoporder_percent=$configpri['shoporder_percent'];

		$data['order_percent']=isset($shoporder_percent)?$shoporder_percent:0; //订单抽成比例

		if($shop_switch){
			$data['status']=0;
		}


		$res=$domain->shopApply($uid,$data,$apply_status,$classid_arr);

		if($res==1001){
			$rs['code']=1002;
			$rs['msg']=\PhalApi\T('店铺审核提交失败');
			return $rs;
		}

		return $rs;

	}

	/**
     * 用户获取店铺申请信息
     * @desc 用于 用户获取店铺申请信息[只有在店铺审核状态为通过或拒绝时才返回信息]
     * @return int code 操作码，0表示成功
     * @return array info
     * @return string msg 提示信息
     */
    public function getShopApplyInfo(){
    	$rs = array('code' => 0, 'msg' => '', 'info' => array());
		
		$uid=\App\checkNull($this->uid);
        $token=\App\checkNull($this->token);
        $time=\App\checkNull($this->time);
        $sign=\App\checkNull($this->sign);

        $checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		if(!$time){
            $rs['code'] = 1001;
            $rs['msg'] = \PhalApi\T('参数错误');
            return $rs;
        }

        $now=time();
		if($now-$time>300){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T('参数错误');
			return $rs;
		}

        if(!$sign){
            $rs['code'] = 1001;
            $rs['msg'] = \PhalApi\T('参数错误');
            return $rs;
        }
        
        $checkdata=array(
            'uid'=>$uid,
            'token'=>$token,
            'time'=>$time
        );

        $issign=\App\checkSign($checkdata,$sign);
        if(!$issign){
            $rs['code']=1001;
			$rs['msg']=\PhalApi\T('签名错误');
			return $rs;
        }

        $domain=new Domain_Shop();
        $res=$domain->getShopApplyInfo($uid);
        if($res['apply_status']==-1){
        	$rs['code']=1001;
			$rs['msg']=\PhalApi\T('未提交店铺审核');
			return $rs;
        }

        if($res['apply_status']==0){
        	$rs['code']=1001;
			$rs['msg']=\PhalApi\T('店铺正在审核中');
			return $rs;
        }

        $rs['info'][0]=$res['apply_info'];

        return $rs;

    }


	/**
	 * 店铺信息(带商品列表)
	 * @desc 用于获取店铺信息(带商品列表)
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return object info[0].shop_info 店铺信息
	 * @return string info[0].shop_info.uid 店铺用户ID
	 * @return string info[0].shop_info.user_nickname 店铺用户昵称
	 * @return string info[0].shop_info.sale_nums 店铺总销量
	 * @return string info[0].shop_info.quality_points 店铺商品质量评分
	 * @return string info[0].shop_info.service_points 店铺服务质量评分
	 * @return string info[0].shop_info.express_points 店铺物流速度评分
	 * @return string info[0].shop_info.certificate 店铺营业执照
	 * @return string info[0].shop_info.other 店铺其他证件
	 * @return string info[0].shop_info.service_phone 店铺客服热线
	 * @return string info[0].shop_infos.province 店铺省份
	 * @return string info[0].shop_info.city 店铺城市
	 * @return string info[0].shop_info.area 店铺所在地区
	 * @return string info[0].shop_info.name 店铺名称
	 * @return string info[0].shop_info.avatar 商品封面
	 * @return string info[0].shop_info.composite_points 店铺综合评分
	 * @return string info[0].shop_info.goods_nums 店铺在售商品数量
	 * @return string info[0].shop_info.address_format 店铺地址格式化
	 * @return string info[0].shop_info.isattention 用户是否关注了店铺主播 0 否 1 是
	 * @return string info[0].list[].id 商品ID
	 * @return string info[0].list[].name 商品名
	 * @return string info[0].list[].thumb 商品封面
	 * @return string info[0].list[].sale_nums 商品销量
	 * @return string info[0].list[].price 现价
	 * @return string msg 提示信息
	 */
	public function getShop() {
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$touid=\App\checkNull($this->touid);
        $p=\App\checkNull($this->p);
        if($uid>0){
        	$checkToken=\App\checkToken($uid,$token);
			if($checkToken==700){
				$rs['code'] = $checkToken;
				$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆1！');
				return $rs;
			}
        }
		$domain = new Domain_Shop();
		$info = $domain->getShop($touid);

		if(!$info){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T('店铺不存在');
			return $rs;
		}

		$list=[];
		$nums=0;
		if($touid>1){

			$where=[];
	        $where['uid']=$touid;
	        $where['status']=1;
	        
			$list = $domain->getGoodsList($where,$p);
	  
			$nums = $domain->countGoods($where);
			
			
		}
        
        $info['goods_nums']=$nums; //店铺在售商品重新赋值

		//获取代售的平台商品数量

		$where1=[];
		$where1['uid']=$touid;
		$where1['status']=1;
	
		$platform_nums = $domain->countPlatformSale($where1);
		$info['platform_goods_nums']=$platform_nums;
		
		//判断用户是否关注了店铺主播
        $isattention=\App\isAttention($uid,$touid);
        $info['isattention']=$isattention;
		
		$domain = new Domain_Shop();
		$OnsalePlatformGoodsList = $domain->getShopOnsalePlatformGoods($touid,$p);
		$list = array_merge($OnsalePlatformGoodsList,$list);
        $rs['info'][0]['shop_info']=$info;
        $rs['info'][0]['list']=$list;
        
		return $rs;
	}




	/**
	 * 在售商品
	 * @desc 用于用户获取直播间在售商品
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string info[0].nums 总数
	 * @return array info[0].list 商品列表
	 * @return string info[0].list[].id 商品id
	 * @return string info[0].list[].name 商品名
	 * @return string info[0].list[].thumb 商品封面
	 * @return string info[0].list[].hits 查看次数
	 * @return string info[0].list[].price 商品价格
	 * @return string msg 提示信息
	 */
	public function getSale(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		
		$uid=\App\checkNull($this->uid);
		$liveuid=\App\checkNull($this->liveuid);
        $p=\App\checkNull($this->p);
        
        
		$domain = new Domain_Shop();
		$nums = $domain->countSale($liveuid);

		$where1=[];
		$where1['uid']=$liveuid;
		$where1['status']=1;
		$where1['issale']=1;

		$platform_nums=$domain->countPlatformSale($where1);

		$total=$nums+$platform_nums;
        
        $where=[];
        $where['uid=?']=$liveuid;
        
        $where['status']=1;
        $where['issale']=1;
        
		$list = $domain->getGoodsListNew($where,$p);

		$where1=[];
		$where1['uid=?']=$liveuid;
		$where1['status']=1;

		$onsale_platform_list=$domain->onsalePlatformListNew($where1,$p); //加$p是为了适应小程序请求，其实是一次性返回数据

		$new_list=array_merge($onsale_platform_list,$list);

        $rs['info'][0]['nums']=(string)$total;

        $rs['info'][0]['list']=$new_list;
		
		$domain = new Domain_Shop();
		$score = $domain->liveScore($liveuid);
		$rs['info'][0]['score']=$score;
		
  
		return $rs;
	}

	/**
	 * 主播增删自己发布的在售商品
	 * @desc 用于主播增删自己发布的在售商品
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string msg 提示信息
	 */
	public function setSale() {
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$goodsid=\App\checkNull($this->goodsid);
		$issale=\App\checkNull($this->issale);
        
        if($uid<0 || $token=='' || $goodsid<0){
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
  
  
		$domain = new Domain_Shop();
  
		$res = $domain->setSale($uid,$goodsid,$issale);

		return $res;
	}
 
	
	/**
	 * 店铺信息(不带商品列表)
	 * @desc 用于获取店铺信息(不带商品列表)
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string info[0].uid 店铺用户ID
	 * @return string info[0].sale_nums 店铺总销量
	 * @return string info[0].quality_points 店铺商品质量评分
	 * @return string info[0].service_points 店铺服务质量评分
	 * @return string info[0].express_points 店铺物流速度评分
	 * @return string info[0].certificate 店铺营业执照
	 * @return string info[0].other 店铺其他证件
	 * @return string info[0].service_phone 店铺客服热线
	 * @return string info[0].province 店铺省份
	 * @return string info[0].city 店铺城市
	 * @return string info[0].area 店铺所在地区
	 * @return string info[0].name 店铺名称
	 * @return string info[0].name 店铺名称
	 * @return array info[0].avatar 商品封面
	 * @return array info[0].composite_points 店铺综合评分
	 * @return array info[0].goods_nums 店铺在售商品数量
	 * @return array info[0].address_format 店铺地址格式化
	 * @return string msg 提示信息
	 */
	public function getShopInfo() {
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		
		$uid=\App\checkNull($this->uid);
		$touid=\App\checkNull($this->touid);

  
		$domain = new Domain_Shop();
		$info = $domain->getShop($touid);

		if(!$info){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T('店铺不存在');
			return $rs;
		}

		//判断用户是否关注了店铺主播
        $isattention=\App\isAttention($uid,$touid);
        $info['isattention']=$isattention;
        

        $rs['info'][0]=$info;
        
		return $rs;
	}

	/**
	 * 获取商品详情
	 * @desc 用于获取商品详情
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return int info[0].id 商品id
	 * @return int info[0].uid 商品所属用户id
	 * @return string info[0].name 商品名称
	 * @return int info[0].one_classid 商品一级分类id
	 * @return int info[0].two_classid 商品二级分类id
	 * @return int info[0].three_classid 商品三级分类id
	 * @return string info[0].one_class_name 商品一级分类名称
	 * @return string info[0].two_class_name 商品二级分类名称
	 * @return string info[0].three_class_name 商品三级分类名称
	 * @return string info[0].video_url 商品视频地址
	 * @return string info[0].thumbs 商品封面图字符串
	 * @return string info[0].content 商品文字内容
	 * @return string info[0].pictures 商品内容图片字符串
	 * @return string info[0].specs 商品规格json字符串
	 * @return float info[0].postage 商品邮费
	 * @return string info[0].hits 商品访问量
	 * @return string info[0].status 商品状态 0审核中 1审核通过 -1商家下架 -2管理员下架
	 * @return string info[0].sale_nums 商品总销量
	 * @return string info[0].video_url_format 商品视频地址格式化
	 * @return array info[0].thumbs_format 商品封面格式化
	 * @return array info[0].pictures_format 商品内容图片格式化
	 * @return string info[0].comment_nums 商品评价数
	 * @return float info[0].original_price 站外商品原价
	 * @return float info[0].present_price 站外商品现价
	 * @return string info[0].goods_desc 站外商品简介
	 * @return float info[0].low_price 站外商品最低价
	 * @return array info[0].shop_info 商品所在店铺信息
	 * @return string info[0].shop_info.name 商品所在店铺名称
	 * @return string info[0].shop_info.avatar 商品所在店铺头像
	 * @return string info[0].shop_info.sale_nums 商品所在店铺总销量
	 * @return string info[0].shop_info.quality_points 商品所在店铺商品质量评分
	 * @return string info[0].shop_info.service_points 商品所在店铺服务评分
	 * @return string info[0].shop_info.express_points 商品所在店铺物流服务评分
	 * @return string info[0].shop_info.isattention 用户是否关注了店铺主播 0 否 1 是
	 * @return array info[0].comment_lists 商品评价信息
	 * @return array info[0].is_sale_platform 用户是否代售了该商品
	 * @return string msg 提示信息
	 */
	public function getGoodsInfo(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());

		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$goodsid=\App\checkNull($this->goodsid);
        
        if($goodsid<0){
            $rs['code'] = 1000;
			$rs['msg'] = \PhalApi\T('信息错误');
			return $rs;
        }

        if($uid>0){
        	$checkToken=\App\checkToken($uid,$token);
			if($checkToken==700){
				$rs['code'] = $checkToken;
				$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
				return $rs;
			}
        }
        
        
		$domain = new Domain_Shop();
  
		$res = $domain->getGoodsInfo($uid,$goodsid);

		return $res;
	}


	/**
	 * 根据不同类型获取商品评论列表
	 * @desc 用于根据不同类型获取商品评论列表
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 * @return array info[0]['comment_lists'] 评论列表
	 * @return object info[0]['comment_lists'][].append_comment 追加评论信息
	 * @return array info[0]['type_nums'] 不同类型下的评论总数
	 */
	public function getGoodsCommentList(){

		$rs = array('code' => 0, 'msg' => '', 'info' => array());

		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$goodsid=\App\checkNull($this->goodsid);
		$type=\App\checkNull($this->type);
		$p=\App\checkNull($this->p);

		//all 全部 img 有图 video 有视频 append 追加
		if($goodsid<1 ||!in_array($type, ['all','img','video','append'])){
            $rs['code'] = 1000;
			$rs['msg'] = \PhalApi\T('信息错误');
			return $rs;
        }

        if($uid>0){
        	$checkToken=\App\checkToken($uid,$token);
			if($checkToken==700){
				$rs['code'] = $checkToken;
				$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
				return $rs;
			}
        }

        

		$domain=new Domain_Shop();
		$res=$domain->getGoodsCommentList($uid,$goodsid,$type,$p);

		$rs['info'][0]=$res;

		return $rs;

	}


	/**
	 * 用户发布的商品搜索
	 * @desc 用于用户发布的商品搜索
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 * @return int info[0]['id'] 商品ID
	 * @return string info[0]['name'] 商品名称
	 * @return string info[0]['price'] 商品价格
	 * @return string info[0]['thumb'] 商品封面
	 */
	public function searchShopGoods(){

		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$keywords=\App\checkNull($this->keywords);
		$p=\App\checkNull($this->p);

		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		//判断用户是否开通了店铺
		$is_shop = \App\checkShopIsPass($uid);
		if(!$is_shop){
			$rs['info']=[];
			return $rs;
		}

		$where=[];
        $where['uid=?']=$uid;
        $where['status']=1;
        if($keywords!=''){
            $where['name like ?']='%'.$keywords.'%';
        }

		$domain=new Domain_Shop();
		$res=$domain->getGoodsList($where,$p);

		$rs['info']=$res;
		return $rs;
	}
	
	
	/**
	 * 收藏/取消收藏商品
	 * @desc 用于收藏/取消收藏商品
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string info[0].iscollect 收藏信息，0表示未收藏，1表示已收藏
	 * @return string msg 提示信息
	 */
	public function setCollect() {
		$rs = array('code' => 0, 'msg' => '', 'info' => array());

		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$goodsid=\App\checkNull($this->goodsid);


		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		$domain = new Domain_Shop();
		$info = $domain->setCollect($uid,$goodsid);
	 
		
		return $info;
	}
	
	
	/**
	 * 收藏商品列表
	 * @desc 用于获取已收藏的商品
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string msg 提示信息
	 */
	public function getGoodsCollect() {
		$rs = array('code' => 0, 'msg' => '', 'info' => array());

		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$p=\App\checkNull($this->p);


		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		$domain = new Domain_Shop();
		$info = $domain->getGoodsCollect($uid,$p);
	 
		$rs['info']=$info;
		return $rs;
	}
	
	/**
	 * 获取正在经营的一级商品分类
	 * @desc 用于获取一级商品分类
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return array info[].gc_id 商品分类id
	 * @return array info[].gc_name 商品分类名称
	 * @return string msg 提示信息
	 */
	public function getBusinessCategory(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		$domain=new Domain_Shop();
		$list=$domain->getBusinessCategory($uid);
		$rs['info']=$list;

		return $rs;
	}
	
	/**
	 * 获取正在申请的经营类目
	 * @desc 用于获取正在申请的经营类目
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return array info[].gc_id 商品分类id
	 * @return array info[].gc_name 商品分类名称
	 * @return string msg 提示信息
	 */
	public function getApplyBusinessCategory(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		$domain=new Domain_Shop();
		$apply=$domain->getApplyBusinessCategory($uid);
		if(!$apply){
			$apply['status']='1';
		}
		
		$rs['info'][0]=$apply;

		return $rs;
	}
	
	
	/**
	 * 经营类目提交申请提交
	 * @desc 用于获取一级商品分类
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return array info[].gc_id 商品分类id
	 * @return array info[].gc_name 商品分类名称
	 * @return string msg 提示信息
	 */
	public function applyBusinessCategory(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('管理员正在飞速审核中,请耐心等待'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$classid=\App\checkNull($this->classid);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		if(!$classid){
        	$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("请选择经营类目");
        	return $rs;
        }

		
		$domain=new Domain_Shop();
		$info=$domain->applyBusinessCategory($uid,$classid);
		if($info==1001){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("管理员正在飞速审核中,请勿重新提交");
        	return $rs;
		}else if(!$info){
			$rs['code']=1002;
        	$rs['msg']=\PhalApi\T("系统繁忙,请稍后操作");
        	return $rs;
		}
		
		//判断后台是否开启免审
		$configpri=\App\getConfigPri();
		$show_category_switch=$configpri['show_category_switch'];
		if(!$show_category_switch){
			$rs['msg']=\PhalApi\T("申请成功");
		}


		return $rs;
	}
	
	
	/**
	 * 判断商品是否删除及下架
	 * @desc 用于判断商品是否删除及下架
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string msg 提示信息
	 */
	public function getGoodExistence(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());

		$uid=\App\checkNull($this->uid);
		$goodsid=\App\checkNull($this->goodsid);
		$domain=new Domain_Shop();
		$info=$domain->getGoodExistence($uid,$goodsid);
		if(!$info){
			$rs['code']=1001;
        	$rs['msg']=\PhalApi\T("商品不存在");
        	return $rs;
		}

		return $rs;
	}

	/**
	 * 主播增删直播间代售的平台商品
	 * @desc 用于主播增删直播间代售的平台商品
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string msg 提示信息
	 */
	public function setPlatformGoodsSale() {
		$rs = array('code' => 0, 'msg' => \PhalApi\T('操作成功'), 'info' => array());
		
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$goodsid=\App\checkNull($this->goodsid);
		$issale=\App\checkNull($this->issale);
        
        if($uid<0 || $token=='' || $goodsid<0){
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

		if(!in_array($issale, ['0','1'])){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('参数错误');
			return $rs;
		}
  
  
		$domain = new Domain_Shop();
  
		$res = $domain->setPlatformGoodsSale($uid,$goodsid,$issale);

		if($res==1001){
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('未代卖该商品');
			return $rs;
		}

		if($res==1002){
			$rs['code'] = 1002;
			$rs['msg'] = \PhalApi\T('该商品已下架');
			return $rs;
		}

		if($res==1003){
			$rs['code'] = 1003;
			$rs['msg'] = \PhalApi\T('操作失败');
			return $rs;
		}

		if($res==1004){
			$rs['code'] = 1004;
			$rs['msg'] = \PhalApi\T('该商品已经添加到了直播间');
			return $rs;
		}

		if($res==1005){
			$rs['code'] = 1005;
			$rs['msg'] = \PhalApi\T('该商品已经移除了直播间');
			return $rs;
		}

		return $rs;
	}


	/**
	 * 用户代售平台的商品搜索
	 * @desc 用于用户代售平台的商品搜索
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 * @return int info[0]['id'] 商品ID
	 * @return string info[0]['name'] 商品名称
	 * @return string info[0]['price'] 商品价格
	 * @return string info[0]['thumb'] 商品封面
	 */
	public function searchOnsalePlatformGoods(){

		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$keywords=\App\checkNull($this->keywords);
		$p=\App\checkNull($this->p);

		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		//判断用户是否开通了店铺
		$is_shop = \App\checkShopIsPass($uid);
		if(!$is_shop){
			$rs['info']=[];
			return $rs;
		}

		$domain=new Domain_Shop();
		$res=$domain->searchOnsalePlatformGoods($uid,$keywords,$p);

		$rs['info']=$res;
		return $rs;
	}


	/**
	 * 获取店铺代售平台商品列表
	 * @desc 用于获取店铺代售平台商品列表
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 * @return int info[].id 返回商品ID
	 * @return int info[].name 返回商品名称
	 * @return int info[].sale_nums 返回商品销量
	 * @return int info[].hits 返回商品访问量
	 * @return int info[].type 返回商品类型 2代表平台自营商品
	 * @return int info[].thumb 返回商品封面
	 * @return int info[].price 返回商品价格
	 */
	public function getOnsalePlatformGoods(){
		$rs = array('code' => 0, 'msg' => '', 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$touid=\App\checkNull($this->touid);
		$p=\App\checkNull($this->p);

		if($touid<0 ){
            $rs['code'] = 1000;
			$rs['msg'] = \PhalApi\T('信息错误');
			return $rs;
        }

        if($uid>0){
        	$checkToken=\App\checkToken($uid,$token);
			if($checkToken==700){
				$rs['code'] = $checkToken;
				$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
				return $rs;
			}
        }
		

		$domain = new Domain_Shop();
		$shop_info = $domain->getShop($touid);

		if(!$shop_info){
			$rs['code']=1001;
			$rs['msg']=\PhalApi\T('店铺不存在');
			return $rs;
		}

		if($touid>1){

			$where1=[];
			$where1['uid']=$touid;
			$where1['status']=1;

			$platform_nums = $domain->countPlatformSale($where1);

		}else{ //平台自营

			$where=[];
	        $where['uid']=$touid;
	        $where['status']=1;
			$platform_nums = $domain->countGoods($where);

		}

		
		$shop_info['platform_goods_nums']=$platform_nums;

		if($touid>1){
			$list=$domain->getOnsalePlatformGoods($touid,$p);
		}else{
			$list = $domain->getGoodsList($where,$p);
		}

		

		$rs['info'][0]['shop_info']=$shop_info;
		$rs['info'][0]['list']=$list;
		return $rs;
	}

	/**
	 * 删除商品收藏记录
	 * @desc 删除商品收藏记录
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 */
	public function delGoodsCollect(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('清除成功'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$ids=\App\checkNull($this->ids);

		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}

		if(!$ids){
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('请选择收藏记录');
			return $rs;
		}

		$ids_arr=explode(',',$ids);
		$new_arr=array_filter($ids_arr);
		if(empty($new_arr)){
			$rs['code'] = 1002;
			$rs['msg'] = \PhalApi\T('请选择收藏记录');
			return $rs;
		}

		$domain=new Domain_Shop();
		$res=$domain->delGoodsCollect($uid,$new_arr);

		if(!$res){
			$rs['code'] = 1003;
			$rs['msg'] = \PhalApi\T('清除失败');
			return $rs;
		}

		return $rs;
	}
	
	/**
	 * 商品购物车列表
	 * @desc 用于获取商品购物车列表
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 */
	public function getShoppingCartList(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('获取成功'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		$domain=new Domain_Shop();
		$res=$domain->getShoppingCartList($uid);
		
		$rs['info']=$res;
		return $rs;
	}
	/**
	 * 商品添加购物车
	 * @desc 用于商品添加购物车
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 */
	public function addShoppingCart(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('添加成功'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$goodsid=\App\checkNull($this->goodsid);
		$num=\App\checkNull($this->num);
		$specid=\App\checkNull($this->specid);
		
		if(!$specid){
			$rs['code'] = 1002;
			$rs['msg'] = \PhalApi\T('请选择商品规格');
			return $rs;
		}
		
		if($uid<0||$token==''||$goodsid<0||$num<1){
			$rs['code']=1002;
			$rs['msg']=\PhalApi\T('参数错误');
			return $rs;
		}
		
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		if(!$num){
			$num = 1;
		}
		
		$domain=new Domain_Shop();
		$res=$domain->addShoppingCart($uid,$goodsid,$num,$specid);
		
		if($res === 1001){
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('商品不存在');
			return $rs;
		}
		
		if($res === 1003){
			$rs['code'] = 1003;
			$rs['msg'] = \PhalApi\T('添加购物车失败');
			return $rs;
		}
		
		return $rs;
	}
	
	/**
	 * 更新商品购物车
	 * @desc 用于更新商品购物车
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 */
	public function updateShoppingCart(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('更新购物车成功'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$cartid=\App\checkNull($this->cartid);
		$num=\App\checkNull($this->num);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		if(!$num){
			$num = 1;
		}
		
		$domain=new Domain_Shop();
		$res=$domain->updateShoppingCart($uid,$cartid,$num);
		
		if($res === 1001){
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('商品不存在');
			return $rs;
		}
		
		if($res === 1002){
			$rs['code']=1002;
			$rs['msg']=\PhalApi\T('购物车商品已删除');
			return $rs;
		}
		
		
		if($res === 1003){
			$rs['code'] = 1003;
			$rs['msg'] = \PhalApi\T('上传购物车商品失败');
			return $rs;
		}
		
		return $rs;
	}
	
	/**
	 * 删除商品购物车
	 * @desc 用于删除商品购物车
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 */
	public function delShoppingCart(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('删除购物车商品成功'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$cartids=\App\checkNull($this->cartids);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		if(empty($cartids)){
			$rs['code'] = 1002;
			$rs['msg'] = \PhalApi\T('请选择购物车');
			return $rs;
		}
		
		$domain=new Domain_Shop();
		$res=$domain->delShoppingCart($uid,$cartids);
		
		if(!$res){
			$rs['code'] = 1003;
			$rs['msg'] = \PhalApi\T('删除购物车失败');
			return $rs;
		}
		
		return $rs;
	}
	
	/**
	 * 判断是否可以开通店铺
	 * @desc 用于判断是否可以开通店铺
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 */
	public function isApplyShop(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('获取成功'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		$domain=new Domain_Shop();
		$res=$domain->isApplyShop($uid);
		
		$rs['info'] =  $res;
		
		return $rs;
	}
	
	/**
	 * 主页商品橱窗
	 * @desc 用于主页商品橱窗
	 * @return int code 状态码，0表示成功
	 * @return string msg 提示信息
	 * @return array info 返回信息
	 */
	public function shopWindow(){
		$rs = array('code' => 0, 'msg' => \PhalApi\T('获取成功'), 'info' => array());
		$uid=\App\checkNull($this->uid);
		$token=\App\checkNull($this->token);
		$p=\App\checkNull($this->p);
		
		$checkToken=\App\checkToken($uid,$token);
		if($checkToken==700){
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		$list=[];
		$nums=0;
		if($uid>1){
			
			$where=[];
			$where['uid']=$uid;
			$where['status']=1;
			
			$domain = new Domain_Shop();
			$list = $domain->getGoodsList($where,$p);
			$nums = $domain->countGoods($where);
			
			
		}
		
		$rs['info']['list'] =  $list;
		$rs['info']['nums'] =  $nums;
		
		
		return $rs;
	}
	
	/**
	 * 申请店铺新
	 * @desc 用于申请店铺
	 * @return int code 操作码，0表示成功
	 * @return array info
	 * @return string msg 提示信息
	 */
	public function shopApplyNew()
	{
		$rs = array('code' => 0, 'msg' => \PhalApi\T('店铺申请成功'), 'info' => array());
		
		$uid = \App\checkNull($this->uid);
		$token = \App\checkNull($this->token);
		$name = \App\checkNull($this->name);
		$thumb = \App\checkNull($this->thumb);
		$username = \App\checkNull($this->username);
		$cardno = \App\checkNull($this->cardno);
		$classid = \App\checkNull($this->classid);
		$des = \App\checkNull($this->des);
		$phone = \App\checkNull($this->phone);
		$certificate = \App\checkNull($this->certificate);
		
		$checkToken = \App\checkToken($uid, $token);
		if ($checkToken == 700) {
			$rs['code'] = $checkToken;
			$rs['msg'] = \PhalApi\T('您的登陆状态失效，请重新登陆！');
			return $rs;
		}
		
		//判断用户是否实名认证
		$isauth = \App\isAuth($uid);
		if (!$isauth) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('请先进行实名认证');
			return $rs;
		}

		if (!$username) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('请填写姓名');
			return $rs;
		}
		
		if (mb_strlen($username) > 20) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('姓名长度不能超过{num}个字', ['num' => 20]);
			return $rs;
		}
		
		if (!$cardno) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('请填写身份证号');
			return $rs;
		}
		
		if (!\App\isCreditNo($cardno)) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('身份证号不合法');
			return $rs;
		}
		
		if (!$phone) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('请填写经营者手机号');
			return $rs;
		}
		
		if (!\App\checkMobile($phone)) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('手机号码错误');
			return $rs;
		}
		
		
		if (!$classid) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('请选择经营类目');
			return $rs;
		}
		
		$classid_arr = explode(',', $classid);
		
		
		$domain = new Domain_Shop();
		$class_list = $domain->getOneGoodsClass();
		
		$is_exist = 1;
		
		$gc_ids = array_column($class_list, 'gc_id');
		foreach ($classid_arr as $k => $v) {
			if (!in_array($v, $gc_ids)) {
				$is_exist = 0;
				break;
			}
		}
		
		if (!$is_exist) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('主营类目有误');
			return $rs;
		}
		
		
		$domain = new Domain_Shop();
		//判断保证金是否缴纳
		$bond_res = $domain->getBond($uid);

//		if ($bond_res == -1 || $bond_res == 1) { //没有缴纳保证金
//			$rs['code'] = 1001;
//			$rs['msg'] = \PhalApi\T('请缴纳保证金');
//			return $rs;
//		}

		//判断店铺审核状态
		$apply_info = $domain->getShopApplyInfo($uid);
		$apply_status = $apply_info['apply_status']; //-1 无审核记录 0 审核中 1 审核通过 2 审核拒绝
		
		if ($apply_status == 0) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('店铺审核中,请耐心等待');
			return $rs;
		}
		
		if ($apply_status == 1) {
			$rs['code'] = 1001;
			$rs['msg'] = \PhalApi\T('店铺已审核通过');
			return $rs;
		}
		
		$data = array(
			'username' => $username,
			'cardno' => $cardno,
			'phone' => $phone,
			'name' => $name,
			'des' => $des,
			'thumb' => $thumb,
			'certificate' => $certificate,
			'status' => 1
		);
		
		if ($apply_status == -1) { //无审核记录
			$data['uid'] = $uid;
			$data['addtime'] = time();
		}
		
		if ($apply_status == 2) { //被拒绝
			
			$data['uptime'] = time();
		}
		
		$configpri = \App\getConfigPri();
		$shop_switch = $configpri['show_switch'];
		$shoporder_percent = $configpri['shoporder_percent'];
		
		$data['order_percent'] = isset($shoporder_percent) ? $shoporder_percent : 0; //订单抽成比例
		
		if ($shop_switch) {
			$data['status'] = 0;
		}
		
		
		$res = $domain->shopApplyNew($uid, $data, $apply_status,$classid_arr);
		
		if ($res == 1001) {
			$rs['code'] = 1002;
			$rs['msg'] = \PhalApi\T('店铺审核提交失败');
			return $rs;
		}
		
		return $rs;
		
	}
	
	
}
