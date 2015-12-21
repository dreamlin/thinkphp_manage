<?php
namespace Home\Behaviors;

class authBehavior extends \Think\Behavior
{
    // 行为执行入口
    public function run(&$param)
    {
        // $url = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        // echo $url . "<br />";
        $url = strtolower(__ACTION__);
        $noLoginAllowUrl = array(
            "/index/login",
            "/index/loginpost"
        );
        if (in_array($url, $noLoginAllowUrl)) {
            return;
        }
        
        // 判断是否登录
        $userInfo = session('userInfo');
        if (empty($userInfo)) {
            echo "<script>top.location='/index/login'</script>";
            exit();
        }
        
        // 允许访问的Url
        $allowUrl = array(
            "/index/index",
            "/index/welcome",
            "/index/lock",
            "/index/unlock",
            "/index/logout"
        );
        if (in_array($url, $allowUrl)) {
            return;
        }
        
        // 判断是否有权限
        if (! session('isSuperUser')) {
            $functions = session('functions');
            if (! in_array($url, $functions)) {
                header("HTTP/1.1 902 Not Right");
                echo $url;
                exit();
            }
        }
    }
}
?>