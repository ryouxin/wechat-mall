1、App/Common/Conf/db.php 数据库连接参数修改；

2、App/Api/Conf/config.php 微信小程序的appid、secret、mchid、key、notify_url，SELF_ROOT的参数修改；

3、ThinkPHP\Library\Vendor\wxpay\lib\WxPay.Config.php  微信小程序的appid、appsecret、mchid、key参数修改；

4、ThinkPHP\Library\Vendor\WeiXinpay\lib\WxPay.Config.php  微信小程序的appid、appsecret、mchid、key、notify_url参数修改；

5、App/Api/Controller/WxPayController.class.php 50行修改链接
