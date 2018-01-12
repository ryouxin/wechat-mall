<?php
namespace Api\Controller;
use Think\Controller;
class TriggerController extends PublicController{
	//构造函数
    // public $all_server_ips = array(
    //
    //     );
    //
    // public function __construct()
    // {
    //     parent::__construct();
    // }

    // trigger project to update through git,
    // make sure update.sh is added to crontab which does the update actually
    public function index()
    {
        system('echo 1 > ./tools/git_update && chmod 777 ./tools/git_update ');
        echo 'SUCCESS 等待10秒后 项目部署成功';
    }

    // public function all()
    // {
    //     foreach ($this->all_server_ips as $ip) {
    //         $url = "http://$ip/index.php/trigger";
    //         $content = $this->Curl_model->curl_get($url);
    //         if ($content && strpos($content, 'SUCCESS') !== false) {
    //             echo "SUCCESS: server $ip update trigger success , wait for 10s to confirm<br/>";
    //         }
    //     }
    // }

    // public function game_flush()
    // {
    //     $this->Game_model->flush_cache();
    //     echo 'ok';
    // }
    //
    // public function game_flush_all()
    // {
    //     foreach ($this->all_server_ips as $ip) {
    //         $url = "http://$ip/index.php/trigger/game_flush";
    //         $content = $this->Curl_model->curl_get($url);
    //         // if ($content && strpos($content, 'ok') !== false) {
    //             echo "SUCCESS: server $ip game flush success<br/>";
    //         // }
    //     }
    // }

}
?>
