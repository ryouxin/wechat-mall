<?php
namespace Api\Controller;

use Think\Controller;

class WxpayController extends Controller
{
    //构造函数
    public function _initialize()
    {
        //php 判断http还是https
        $this->http_type = ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')) ? 'https://' : 'http://';
        vendor('WeiXinpay.wxpay');
    }

    //***************************
    //  微信支付 接口
    //***************************
    public function wxpay()
    {
        $pay_sn = trim($_REQUEST['order_sn']);
        if (!$pay_sn) {
            echo json_encode(array('status'=>0,'err'=>'支付信息错误！'));
            exit();
        }

        $order_info = M('order')->where('order_sn="'.$pay_sn.'"')->find();
        if (!$order_info) {
            echo json_encode(array('status'=>0,'err'=>'没有找到支付订单！'));
            exit();
        }

        if (intval($order_info['status'])!=10) {
            echo json_encode(array('status'=>0,'err'=>'订单状态异常！'));
            exit();
        }

        //①、获取用户openid
        $tools = new \JsApiPay();
        $openId = M('user')->where('id='.intval($order_info['uid']))->getField('openid');
        if (!$openId) {
            echo json_encode(array('status'=>0,'err'=>'用户状态异常！'));
            exit();
        }

        //②、统一下单
        $input = new \WxPayUnifiedOrder();
        $input->SetBody("蓝果小镇商城商品购买_".trim($order_info['order_sn']));
        $input->SetAttach("蓝果小镇商城商品购买_".trim($order_info['order_sn']));
        $input->SetOut_trade_no($pay_sn);
        $input->SetTotal_fee(floatval($order_info['amount'])*100);
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 3600));
        $input->SetGoods_tag("蓝果小镇商城商品购买_".trim($order_info['order_sn']));
        $input->SetNotify_url('https://wechat-shop.zytxgame.com/index.php/Api/Wxpay/notify');
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = \WxPayApi::unifiedOrder($input);
        //echo '<font color="#f00"><b>统一下单支付单信息</b></font><br/>';
        //printf_info($order);
        $arr = array();
        $arr['appId'] = $order['appid'];
        $arr['nonceStr'] = $order['nonce_str'];
        $arr['package'] = "prepay_id=".$order['prepay_id'];
        $arr['signType'] = "MD5";
        $arr['timeStamp'] = (string)time();
        $str = $this->ToUrlParams($arr);
        $jmstr = $str."&key=".\WxPayConfig::KEY;
        $arr['paySign'] = strtoupper(MD5($jmstr));

        //添加prepay_id
        $prepay_id = array();
        $order_info['prepay_id']=$order['prepay_id'];
        $respnsea = M()->execute('update lr_order set prepay_id = "'.$order['prepay_id'].'" where order_sn ="'.$pay_sn.'"');
        if (!$respnsea) {
            echo 'err';
            return;
        }
        echo json_encode(array('status'=>1,'arr'=>$arr));
        exit();
        //获取共享收货地址js函数参数
        //$editAddress = $tools->GetEditAddressParameters();
        //$this->assign('jsApiParameters',$jsApiParameters);
        //$this->assign('editAddress',$editAddress);
    }

    //***************************
    //  支付回调 接口
    //***************************
    public function notify()
    {
        $res_xml = file_get_contents("php://input");
        libxml_disable_entity_loader(true);
        $ret = json_decode(json_encode(simplexml_load_string($res_xml, 'simpleXMLElement', LIBXML_NOCDATA)), true);

        $path = "./Data/log/";
        if (!is_dir($path)) {
            mkdir($path, 0777);  // 创建文件夹test,并给777的权限（所有权限）
        }


        // $contents = 'error => '.date("Ymd").' '.json_encode($ret);  // 写入的内容
        // $files = $path."error_".date("Ymd").".log";    // 写入的文件
        // file_put_contents($files, $contents, FILE_APPEND);  // 最简单的快速的以追加的方式写入写入方法，


        $content = date("Y-m-d H:i:s").'=>'.json_encode($ret);  // 写入的内容
        $file = $path."weixin_".date("Ymd").".log";    // 写入的文件
        file_put_contents($file, $content, FILE_APPEND);  // 最简单的快速的以追加的方式写入写入方法，

        $data = array();
        $data['order_sn'] = $ret['out_trade_no'];
        $data['pay_type'] = 'weixin';
        $data['trade_no'] = $ret['transaction_id'];
        $data['total_fee'] = $ret['total_fee'];


        $result = $this->orderhandle($data);

        if (is_array($result)) {
            $prepay_id = $result['data']['prepay_id'];

            $p_id = $result['data']['p_id'];

            $openid = $ret['openid'];
            $time = $ret['time_end'];
            $product_name = '激活码';
            $order = $ret['out_trade_no'];
            $money = $ret['cash_fee']/100;
            $activation_code = $this->get_activation_code($p_id,$openid);
            if($activation_code!='err'){
                $activation_code = json_decode($activation_code);
                foreach ($activation_code as $one ) {
                    $key_val.='<br>'.$one->CDkey;
                }
                // $key_val = $product['pro_number'];
            }else{
                $contents = 'error => '.date("Ymd").' '.$activation_code;  // 写入的内容
                $files = $path."error_".date("Ymd").".log";    // 写入的文件
                file_put_contents($files, $contents, FILE_APPEND);  // 最简单的快速的以追加的方式写入写入方法，
                echo 'fail';
            }


            $tell_user = $this->tell_user($prepay_id, $openid, $time, $product_name, $order, $money, $key_val);
            if ($tell_user!='ok') {
                return;
            }


            $result_c = $this->check_max($data['order_sn']);
            $xml = "<xml><return_code><![CDATA[SUCCESS]]></return_code><return_msg><![CDATA[OK]]></return_msg>";
            $xml.="</xml>";
            echo $xml;
        } else {
            $contents = 'error => '.date("Ymd").' '.json_encode($result);  // 写入的内容
            $files = $path."error_".date("Ymd").".log";    // 写入的文件
            file_put_contents($files, $contents, FILE_APPEND);  // 最简单的快速的以追加的方式写入写入方法，
            echo 'fail';
        }
    }

    //获取激活码接口
    public function get_activation_code()
    {
        $pid=260;
        $user_openid=123;
        $order_product =M('order_product')->where('order_id='.'"'.$pid.'"')->select();
        $key = 'ahfuehfagdfjahsjasdhtec';
        $time = time();
        $key_var_data = array(
            'protocol'=> '20000821',
            'key'=>md5("uid=$user_openid&time=$time$key"),
            'OrderUserId'=> $user_openid,
            'time'=>$time,
            'Product'=>array(),
        );
        foreach ($order_product as $one) {
            $product = M('product')->where('id="'.$one['pid'].'"')->find();
            $product_data=array('ProductId'=>$product['pro_number'],'Num'=>$one['num']);
            array_push($key_var_data['Product'], $product_data);
        }
        // $key_var_data['Product'] = json_encode($key_var_data['Product']);
        $key_val_url = "http://test.wondergm.com/xinghe/api.php?Module=Shop&Action=Order";

        $activation_code =$this->curl_post($key_val_url,$key_var_data);
        if(json_decode($activation_code)->ErrorCode==0){
            return $activation_code;
        }else{
            $path = "./Data/log/";
            $contents = 'error => '.date("Ymd").' '.$activation_code.' data  '.json_encode($key_var_data);  // 写入的内容
            $files = $path."error_".date("Ymd").".log";    // 写入的文件
            file_put_contents($files, $contents, FILE_APPEND);  // 最简单的快速的以追加的方式写入写入方法，
            return 'err';
        }
        // $activation_code = json_decode($activation_code);
        // foreach ($activation_code->Return as $one ) {
        //     # code...
        //     echo $one->CDkey;
        // }
    }

    //***************************
    //  订单处理 接口
    //***************************
    public function orderhandle($data)
    {
        $order_sn = trim($data['order_sn']);
        $pay_type = trim($data['pay_type']);
        $trade_no = trim($data['trade_no']);
        $total_fee = floatval($data['total_fee']);
        $check_info = M('order')->where('order_sn="'.$order_sn.'"')->find();
        $data['prepay_id']=$check_info['prepay_id'];
        $data['p_id']=$check_info['id'];
        if (!$check_info) {
            return "订单信息错误...";
        }

        if ($check_info['status']<10 || $check_info['back']>'0') {
            return "订单异常...";
        }

        if ($check_info['status']>10) {
            return array('status'=>1,'data'=>$data);
        }

        $up = array();
        $up['type'] = $pay_type;
        $up['price_h'] = sprintf("%.2f", floatval($total_fee/100));
        $up['status'] = 50;
        $up['trade_no'] = $trade_no;
        $res = M('order')->where('order_sn="'.$order_sn.'"')->save($up);
        if ($res) {
            //处理优惠券
            // if (intval($check_info['vid'])) {
            //     $vou_info = M('user_voucher')->where('uid='.intval($check_info['uid']).' AND vid='.intval($check_info['vid']))->find();
            //     if (intval($vou_info['status'])==1) {
            //         M('user_voucher')->where('id='.intval($vou_info['id']))->save(array('status'=>2));
            //     }
            // }
            return array('status'=>1,'data'=>$data);
        } else {
            return '订单处理失败...';
        }
    }
    public function tell_user($form_id, $user_openid, $time, $product_name, $order, $money, $key_val)
    {
        $APPID = 'wxf26bf0e013e7e9f7';
        $APPSECRET = 'e53c852496502ddae82b11f00aaf59b5';
        $token_requery = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$APPID&secret=$APPSECRET";
        $response = $this->curl_get($token_requery);
        $a = json_decode($response);
        $a->access_token;
        $template_id = 'lrxw2ogRLqZ-Xg64bpqXCL5e7A_Lh68VWwWDGJ3quHw';
        $requery = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=$a->access_token";
        $data = array();
        $data['touser']=$user_openid;
        $data['template_id']=$template_id;
        $data['form_id']=$form_id;
        $data_obj=array();
        $keyword1 = array( "value"=>"$time");
        $data_obj['keyword1']=$keyword1;

        $keyword2 = array( "value"=>"$product_name");
        $data_obj['keyword2']=$keyword2;

        $keyword3 = array( "value"=>"$order");
        $data_obj['keyword3']=$keyword3;

        $keyword4 = array( "value"=>"$money");
        $data_obj['keyword4']=$keyword4;

        $keyword5 = array( "value"=>"$key_val");
        $data_obj['keyword5']=$keyword5;

        $data['data']=$data_obj;

        $response = $this->curl_post($requery, json_encode($data));
        $response = json_decode($response);
        if ($response['errcode']!=0) {
            $path = "./Data/log/";
            $contents = 'error => '.date("Ymd").' '.json_encode($response).' info '.json_encode($data);  // 写入的内容
            $files = $path."error_".date("Ymd").".log";    // 写入的文件
            file_put_contents($files, $contents, FILE_APPEND);  // 最简单的快速的以追加的方式写入写入方法，
            return 'err';
        } else {
            return 'ok';
        }
    }
    //处理限购
    public function check_max($order_sn)
    {
        $check_info = M('order')->where('order_sn="'.$order_sn.'"')->find();
        $max_info = M('order_product')->where('order_id='.$check_info['id'])->find();

        if (!$max_info) {
            return "订单信息错误...".__LINE__;
        } else {
            $product_info = M('product')->where('id='.$max_info['pid'])->find();
            if ($product_info['max']<999999) {
                $product_max = M('product_max')->where('product_id='.$max_info['pid'].' AND user_id='.$check_info['uid'])->find();
                if ($product_max) {
                    $product_max_up=array();
                    $product_max_up['buy_num']=$check_info['product_num']+$product_max['buy_num'];
                    $product_max_up['update_time']=time();
                    $check_res = M('product_max')->where('product_id='.$max_info['pid'].' AND user_id='.$check_info['uid'])->save($product_max_up);
                    if ($check_res) {
                        return array('status'=>1).__LINE__;
                    } else {
                        return '数据库修改信息失败'.__LINE__;
                    }
                } else {
                    $product_max_up=array(
                        'product_id'=>$max_info['pid'],
                        'user_id'=>$check_info['uid'],
                        'buy_num'=>$check_info['product_num'],
                        'create_time'=>time(),
                        'update_time'=>time(),
                    );
                    $check_res = M('product_max')->add($product_max_up);
                    if ($check_res) {
                        return array('status'=>1).__LINE__;
                    } else {
                        return '数据库添加信息失败'.__LINE__;
                    }
                }
            } else {
            }
        }
    }

    //构建字符串
    private function ToUrlParams($urlObj)
    {
        $buff = "";
        foreach ($urlObj as $k => $v) {
            if ($k != "sign") {
                $buff .= $k . "=" . $v . "&";
            }
        }

        $buff = trim($buff, "&");
        return $buff;
    }
    public function curl_get($url, $header = null)
    {
        $my_curl = curl_init();
        curl_setopt($my_curl, CURLOPT_URL, $url);
        curl_setopt($my_curl, CURLOPT_RETURNTRANSFER, 1);

        if ($header) {
            $header_list = array();
            foreach ($header as $key => $value) {
                $header_list[] = "$key: $value";
            }
            curl_setopt($my_curl, CURLOPT_HTTPHEADER, $header_list);
        }

        $str = curl_exec($my_curl);
        curl_close($my_curl);

        return $str;
    }

    public function curl_post($url, $data, $header = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        if (gettype($data) == 'array' || gettype($data) == 'object') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $this->to_params($data));
        } elseif (gettype($data) == 'string') {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        if ($header) {
            $header_list = array();
            foreach ($header as $key => $value) {
                $header_list[] = "$key: $value";
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $header_list);
        }

        $str = curl_exec($ch);
        curl_close($ch);

        return $str;
    }
    public function to_params($input)
    {
        $index = 0;
        $pair = '';
        foreach ($input as $key => $value) {
            if ($index != 0) {
                $pair .= '&';
            }
            $pair .= "$key=".$value;
            ++$index;
        }

        return $pair;
    }
    public function https_request($url, $data, $type)
    {
        if ($type=='json') {//json $_POST=json_decode(file_get_contents('php://input'), TRUE);
 $headers = array("Content-type: application/json;charset=UTF-8","Accept: application/json","Cache-Control: no-cache", "Pragma: no-cache");
            $data=json_encode($data);
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        if (!empty($data)) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
}
