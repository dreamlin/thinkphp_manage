<?php
namespace Home\Controller;

use Think\Controller;

class IndexController extends Controller
{

    public function index()
    {
        $userInfo = session('userInfo');
        $this->assign('realName', $userInfo['real_name']);
        $this->assign('isLock', session('isLock'));
        $this->assign("menuData", json_encode(BuildMenuTree(session('menus'))));
        $this->display("index");
    }

    public function welcome()
    {
        $this->display("welcome");
    }

    public function lock()
    {
        session('isLock', true);
        $this->display("lock");
    }

    public function unlock()
    {
        $userInfo = session('userInfo');
        $pwd = getFormGetPostValue('pwd');
        if ($userInfo['password'] == md5($pwd)) {
            session('isLock', false);
            $this->ajaxReturn(returnStatus());
        } else {
            $this->ajaxReturn(returnStatus(false, '密码错误'));
        }
    }

    public function login()
    {
        $this->display("login");
    }

    public function loginPost()
    {
        $status = true;
        $msg = '';
        
        $user_name = getFormGetPostValue('user_name');
        $password = getFormGetPostValue('password');
        if (empty($user_name) || empty($password)) {
            $status = false;
            $msg = '帐号或密码不能为空。';
        } else {
            $Modle = M('SysUser');
            $userInfo = $Modle->where("user_name='%s' and password='%s'", $user_name, md5($password))->find();
            if (empty($userInfo)) {
                $status = false;
                $msg = '帐号或密码有误，请重试。';
            } else {
                $SysRoleUser = M('SysRoleUser');
                $roles = $SysRoleUser->where('user_id=%u', $userInfo['user_id'])->select();
                if (count($roles) == 0) {
                    $status = false;
                    $msg = '帐号未授权。';
                } else {
                    $roleids = array();
                    foreach ($roles as $value) {
                        $roleids[] = $value['role_id'];
                    }
                    // 加载菜单、请求
                    // role_id为0时是超级用户
                    if (in_array(0, $roleids)) {
                        session('isSuperUser', true);
                        $SysMenu = M('SysMenu');
                        $menus = $SysMenu->order('seq asc')->select();
                    } else {
                        session('isSuperUser', false);
                        $Model = M();
                        $menus = $Model->query("SELECT m.*
            FROM ( SELECT * FROM sys_role_function rf WHERE rf.role_id in (%s) AND rf.type = 0 ) rf
            JOIN sys_menu m ON m.menu_id = rf.mf_id order by m.seq asc", join(',', $roleids));
                        
                        $map['role_id'] = array(
                            'in',
                            $roleids
                        );
                        $map['type'] = array(
                            'eq',
                            1
                        );
                        $SysRoleFunction = M('SysRoleFunction');
                        $functionData = $SysRoleFunction->field('sys_function.text')
                            ->join('sys_function ON sys_function.function_id = sys_role_function.mf_id')
                            ->where($map)
                            ->select();
                        $functionList = array();
                        foreach ($functionData as $value) {
                            $functionList[] = $value['text'];
                        }
                    }
                    
                    session('menus', $menus);
                    session('functions', $functionList);
                    session('userInfo', $userInfo);
                    session('isLock', false);
                }
            }
        }
        $this->ajaxReturn(returnStatus($status, $msg));
    }

    public function logout()
    {
        session('menus', null);
        session('functions', null);
        session('userInfo', null);
        session('isLock', null);
        session('isAdmin', null);
        header("Location:/index/login");
    }
}