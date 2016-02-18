<?php
namespace Home\Controller;

use Think\Controller;

class SysController extends Controller
{

    public function menuList()
    {
        $this->display("menu_list");
    }

    public function menuData()
    {
        $Model = M('SysMenu');
        $dataList = $Model->order('seq asc')->select();
        $this->ajaxReturn(genTree($dataList, 'menu_id'));
    }

    public function menuTree()
    {
        $Menu = M('SysMenu');
        $dataList = $Menu->order('seq asc')->select();
        $this->ajaxReturn(BuildMenuTree($dataList));
    }

    public function menuDataSort()
    {
        $Model = M('SysMenu');
        $dataList = $Model->where("is_sort=1")
            ->order('seq asc')
            ->select();
        $this->ajaxReturn(genTree($dataList, 'menu_id'));
    }

    public function menuDetail()
    {
        $menu_id = getFormGetPostValue("menu_id");
        if ($menu_id != null) {
            $Model = M('SysMenu');
            $data = $Model->where("menu_id=%u", $menu_id)->find();
            $this->assign("data", $data);
        }
        $this->display("menu_detail");
    }

    public function menuSave()
    {
        $menu_id = getFormGetPostValue("menu_id");
        $pid = getFormGetPostValue("pid");
        $text = getFormGetPostValue("text");
        $href = getFormGetPostValue("href");
        $icon_cls = getFormGetPostValue("icon_cls");
        $is_sort = getFormGetPostValue("is_sort");
        $seq = getFormGetPostValue("seq");
        $status = getFormGetPostValue("status");
        
        if ($pid == null)
            $data["pid"] = 0;
        else
            $data["pid"] = $pid;
        $data["text"] = $text;
        $data["href"] = $href;
        $data["icon_cls"] = $icon_cls;
        $data["is_sort"] = $is_sort;
        $data["seq"] = $seq;
        $data["status"] = $status;
        
        $Model = M("SysMenu");
        if ($menu_id != null) {
            $Model->where("menu_id=%u", $menu_id)->save($data);
        } else {
            $Model->data($data)->add();
        }
        $this->ajaxReturn(returnStatus());
    }

    public function menuDelete()
    {
        $menu_id = getFormGetPostValue("menu_id");
        $Model = M("SysMenu");
        $data = $Model->where("pid=%u", $menu_id)->select();
        $ids = $menu_id;
        while (count($data) > 0) {
            $tmp = "";
            foreach ($data as $item) {
                if (strlen($tmp) > 0) {
                    $tmp = $tmp . ",";
                }
                $tmp = $tmp . $item['menu_id'];
            }
            if (strlen($ids) > 0) {
                $ids = $ids . ",";
            }
            $ids = $ids . $tmp;
            $map['pid'] = array(
                'in',
                $tmp
            );
            $data = $Model->where($map)->select();
        }
        $Model->delete($ids);
        
        $SysFunction = M("SysFunction");
        $map = array();
        $map['menu_id'] = array(
            'in',
            $ids
        );
        $SysFunction->where($map)->delete();
        
        $this->ajaxReturn(returnStatus());
    }

    public function dictWindow()
    {
        $this->display('dict_window');
    }

    public function dictData()
    {
        $Model = M("SysDict");
        $dataList = $Model->select();
        $count = count($dataList);
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function validDictKey()
    {
        $id = getFormGetPostValue("id");
        $dict_key = getFormGetPostValue("dict_key");
        $map = array();
        if (! empty($id)) {
            $map['dict_id'] = array(
                'neq',
                $id
            );
        }
        if (! empty($dict_key)) {
            $map['dict_key'] = array(
                'eq',
                $dict_key
            );
        }
        $Model = M("SysDict");
        $count = $Model->where($map)->count();
        if ($count > 0)
            echo 'false';
        else
            echo 'true';
        exit();
    }

    public function dictSave()
    {
        $inserted = getFormGetPostValue('inserted');
        $updated = getFormGetPostValue('updated');
        $deleted = getFormGetPostValue('deleted');
        
        if (! empty($inserted)) {
            $inserted = stripcslashes($inserted);
            $listInserted = json_decode($inserted, TRUE);
        }
        if (! empty($updated)) {
            $updated = stripcslashes($updated);
            $listUpdated = json_decode($updated, TRUE);
        }
        if (! empty($deleted)) {
            $deleted = stripcslashes($deleted); // stripcslashes()删除由 addcslashes()函数添加的反斜杠。
            $listDeleted = json_decode($deleted, TRUE); // 当该参数为TRUE时，返回 array而非object
        }
        
        $Model = M('SysDict');
        if (! empty($listInserted)) {
            $Model->addAll($listInserted);
        }
        if (! empty($listUpdated)) {
            foreach ($listUpdated as $value) {
                $Model->save($value);
            }
        }
        if (! empty($listDeleted)) {
            foreach ($listDeleted as $value) {
                $Model->where("dict_id=%u", $value['dict_id'])->save(array(
                    'status' => 1
                ));
            }
        }
        $this->ajaxReturn(returnStatus());
    }

    public function functionList()
    {
        $this->display("function_list");
    }

    public function functionData()
    {
        $page = getFormGetPostValue("page");
        $rows = getFormGetPostValue("rows");
        if (empty($page)) {
            $page = 1;
        }
        if (empty($rows)) {
            $rows = 20;
        }
        
        $menu_id = getFormGetPostValue('menu_id');
        $Model = M("SysFunction");
        if ($menu_id != null) {
            $dataList = $Model->field('sys_function.*,sys_menu.text as relegation')
                ->join('sys_menu ON sys_menu.menu_id = sys_function.menu_id')
                ->where('sys_function.menu_id = %u', $menu_id)
                ->page($page, $rows)
                ->select();
            $count = $Model->where('menu_id = %u', $menu_id)->count();
        } else {
            $dataList = $Model->field('sys_function.*,sys_menu.text as relegation')
                ->join('sys_menu ON sys_menu.menu_id = sys_function.menu_id')
                ->page($page, $rows)
                ->select();
            $count = $Model->count();
        }
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function functionDetail()
    {
        $function_id = getFormGetPostValue("function_id");
        if (! empty($function_id)) {
            $Model = M('SysFunction');
            $data = $Model->where("function_id=%u", $function_id)->find();
            $this->assign("data", $data);
        }
        $this->display("function_detail");
    }

    public function functionSave()
    {
        $function_id = getFormGetPostValue("function_id");
        $text = getFormGetPostValue("text");
        $menu_id = getFormGetPostValue("menu_id");
        $resources = getFormGetPostValue("resources");
        
        $data["text"] = $text;
        $data["menu_id"] = $menu_id;
        $data["resources"] = $resources;
        
        $Model = M("SysFunction");
        if ($function_id != null) {
            $Model->where("function_id=%u", $function_id)->save($data);
        } else {
            $Model->data($data)->add();
        }
        $this->ajaxReturn(returnStatus());
    }

    public function functionDelete()
    {
        $ids = getFormGetPostValue("ids");
        $Model = M("SysFunction");
        $Model->delete($ids);
        $this->ajaxReturn(returnStatus());
    }

    public function userList()
    {
        $this->display("user_list");
    }

    public function userData()
    {
        $page = getFormGetPostValue("page");
        $rows = getFormGetPostValue("rows");
        if (empty($page)) {
            $page = 1;
        }
        if (empty($rows)) {
            $rows = 20;
        }
        
        $real_name = getFormGetPostValue('Q_real_name_like');
        $user_name = getFormGetPostValue('Q_user_name_like');
        $create_time_EGT = getFormGetPostValue('Q_create_time_EGT');
        $create_time_ELT = getFormGetPostValue('Q_create_time_ELT');
        
        $map = array();
        if (! empty($real_name))
            $map['real_name'] = array(
                'like',
                '%' . $real_name . '%'
            );
        
        if (! empty($user_name))
            $map['user_name'] = array(
                'like',
                '%' . $user_name . '%'
            );
        
        if (! empty($create_time_EGT))
            $map['create_time'] = array(
                'egt',
                $create_time_EGT
            );
        
        if (! empty($create_time_ELT))
            $map['create_time'] = array(
                'elt',
                $create_time_ELT
            );
        
        $Model = M("SysUser");
        $dataList = $Model->where($map)
            ->page($page, $rows)
            ->select();
        $count = $Model->where($map)->count();
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function userDetail()
    {
        $user_id = getFormGetPostValue("user_id");
        if (! empty($user_id)) {
            $Model = M('SysUser');
            $data = $Model->where("user_id=%u", $user_id)->find();
            
            if ($data) {
                $RoleUser = M("sysRoleUser");
                $roles = $RoleUser->where("user_id=%u", $user_id)
                    ->field('role_id')
                    ->select();
                $ids = array();
                foreach ($roles as $value) {
                    $ids[] = $value['role_id'];
                }
                $data['role_ids'] = join(',', $ids);
                $this->assign('data', $data);
                
                $RoleModel = M('SysRole');
                $rolesCombox = $RoleModel->field('role_id,text')
                    ->where('status=0')
                    ->select();
                $this->assign('roles', json_encode($rolesCombox));
            }
        }
        $this->display("user_detail");
    }

    public function userSave()
    {
        $user_id = getFormGetPostValue("user_id");
        $user_name = getFormGetPostValue("user_name");
        $real_name = getFormGetPostValue("real_name");
        $password = getFormGetPostValue("password");
        $mail = getFormGetPostValue("mail");
        $role_ids = getFormGetPostValue("role_ids");
        
        $data["user_name"] = $user_name;
        $data["real_name"] = $real_name;
        $data["mail"] = $mail;
        
        $Model = M("SysUser");
        $RoleUser = M("sysRoleUser");
        $Model->startTrans();
        $result = false;
        
        if (! empty($user_id)) {
            if (! empty($password))
                $data["password"] = md5($password);
            $data["update_time"] = getDateTime();
            $result = $Model->where("user_id=%u", $user_id)->save($data);
        } else {
            if (empty($password))
                $data["password"] = md5('123456');
            else
                $data["password"] = md5($password);
            $time = getDateTime();
            $data["create_time"] = $time;
            $data["update_time"] = $time;
            $result = $Model->data($data)->add();
        }
        
        if ($result !== false) {
            if (! empty($user_id)) {
                $RoleUser->where("user_id=%u", $user_id)->delete();
            }
            if (! empty($user_id) && ! empty($role_ids)) {
                $map = array();
                $rolesIds = explode(',', $role_ids);
                foreach ($rolesIds as $value) {
                    $map[] = array(
                        'id' => getGuid(),
                        'role_id' => $value,
                        'user_id' => $user_id
                    );
                }
                if ($RoleUser->addAll($map) === false) {
                    $Model->rollback();
                    $this->returnStatus(false, '设置权限失败');
                }
            }
        } else {
            $Model->rollback();
            $this->returnStatus(false, '修改用户信息失败');
        }
        $Model->commit();
        $this->ajaxReturn(returnStatus());
    }

    public function userDelete()
    {
        $ids = getFormGetPostValue("ids");
        $Model = M("SysUser");
        $Model->delete($ids);
        $RoleUser = M("SysRoleUser");
        $map = array();
        $map['user_id'] = array(
            'in',
            $ids
        );
        $RoleUser->where($map)->delete();
        $this->ajaxReturn(returnStatus());
    }

    public function roleList()
    {
        $this->display("role_list");
    }

    public function roleData()
    {
        $page = getFormGetPostValue("page");
        $rows = getFormGetPostValue("rows");
        if (empty($page)) {
            $page = 1;
        }
        if (empty($rows)) {
            $rows = 20;
        }
        
        $Model = M("SysRole");
        $dataList = $Model->page($page, $rows)->select();
        $count = $Model->count();
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function roleDetail()
    {
        $role_id = getFormGetPostValue("role_id");
        if (! empty($role_id)) {
            $Model = M('SysRole');
            $data = $Model->where("role_id=%u", $role_id)->find();
            $this->assign("data", $data);
        }
        $this->display("role_detail");
    }

    public function roleSave()
    {
        $role_id = getFormGetPostValue("role_id");
        $text = getFormGetPostValue("text");
        $remark = getFormGetPostValue("remark");
        $status = getFormGetPostValue("status");
        
        $data["text"] = $text;
        $data["remark"] = $remark;
        $data["status"] = $status;
        
        $Model = M("SysRole");
        if (! empty($role_id)) {
            $Model->where("role_id=%u", $role_id)->save($data);
        } else {
            $Model->data($data)->add();
        }
        $this->ajaxReturn(returnStatus());
    }

    public function roleDelete()
    {
        $ids = getFormGetPostValue("ids");
        $Model = M("SysRole");
        $Model->delete($ids);
        $map = array();
        $map['role_id'] = array(
            'in',
            $ids
        );
        $RoleUser = M("SysRoleUser");
        $RoleUser->where($map)->delete();
        $SysRoleFunction = M("SysRoleFunction");
        $SysRoleFunction->where($map)->delete();
        $this->ajaxReturn(returnStatus());
    }

    public function chooseUser()
    {
        $this->display('choose_user');
    }

    public function chooseUserData()
    {
        $page = getFormGetPostValue("page");
        $rows = getFormGetPostValue("rows");
        if (empty($page)) {
            $page = 1;
        }
        if (empty($rows)) {
            $rows = 20;
        }
        
        $role_id = getFormGetPostValue('role_id');
        $real_name = getFormGetPostValue('Q_real_name_like');
        $mail = getFormGetPostValue('Q_mail_like');
        
        if (! empty($real_name)) {
            $map['real_name'] = array(
                'like',
                '%' . $real_name . '%'
            );
        }
        
        if (! empty($mail)) {
            $map['mail'] = array(
                'like',
                '%' . $mail . '%'
            );
        }
        
        $SysRoleUser = M("SysRoleUser");
        $userIds = $SysRoleUser->field('user_id')
            ->where('role_id=%u', $role_id)
            ->select();
        
        if (count($userIds) > 0) {
            $userIdArray = array();
            foreach ($userIds as $item) {
                $userIdArray[] = $item['user_id'];
            }
            $map['user_id'] = array(
                'not in',
                $userIdArray
            );
        }
        
        $Model = M("SysUser");
        $dataList = $Model->where($map)
            ->page($page, $rows)
            ->select();
        $count = $Model->where($map)->count();
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function chooseUserSave()
    {
        $role_id = getFormGetPostValue('role_id');
        $uids = getFormGetPostValue('uids');
        
        $array = explode(',', $uids);
        if ($array && count($array) > 0) {
            $dataList = array();
            foreach ($array as $id) {
                $dataList[] = array(
                    'id' => getGuid(),
                    'role_id' => $role_id,
                    'user_id' => $id
                );
            }
            $Model = M("SysRoleUser");
            $Model->addAll($dataList);
        }
        $this->ajaxReturn(returnStatus());
    }

    public function roleUserData()
    {
        $page = getFormGetPostValue("page");
        $rows = getFormGetPostValue("rows");
        if (empty($page)) {
            $page = 1;
        }
        if (empty($rows)) {
            $rows = 20;
        }
        
        $role_id = getFormGetPostValue('role_id');
        $Model = M("SysRoleUser");
        $map = array();
        if (! empty($role_id)) {
            $map['role_id'] = array(
                'eq',
                $role_id
            );
        }
        $dataList = $Model->field('sys_user.*')
            ->join('sys_user ON sys_user.user_id = sys_role_user.user_id')
            ->where($map)
            ->page($page, $rows)
            ->select();
        $count = $Model->where($map)->count();
        
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function roleUserDelete()
    {
        $role_id = getFormGetPostValue("role_id");
        $ids = getFormGetPostValue("ids");
        $map = array();
        $map['role_id'] = array(
            'eq',
            $role_id
        );
        $map['user_id'] = array(
            'in',
            $ids
        );
        $Model = M("SysRoleUser");
        $Model->where($map)->delete();
        $this->ajaxReturn(returnStatus());
    }

    public function roleFunctionData()
    {
        $role_id = getFormGetPostValue('role_id');
        $Model = M();
        $data = $Model->query("SELECT rf.id,f.text,f.menu_id AS pid,f.function_id AS tid,1 TYPE 
            FROM ( SELECT * FROM sys_role_function rf WHERE rf.role_id = %u AND rf.type = 1 ) rf 
            JOIN sys_function f ON f.function_id = rf.mf_id 
            UNION 
            SELECT rf.id,m.text,m.pid,m.menu_id AS tid,0 
            FROM ( SELECT * FROM sys_role_function rf WHERE rf.role_id = %u AND rf.type = 0 ) rf 
            JOIN sys_menu m ON m.menu_id = rf.mf_id", $role_id, $role_id);
        $this->ajaxReturn(genTree($data, 'tid'));
    }

    public function roleGrantTree()
    {
        $role_id = getFormGetPostValue('role_id');
        $Model = M("SysRole");
        $functionData = $Model->query("SELECT rf.id,f.text,f.menu_id AS pid,f.function_id AS tid,1 TYPE 
            FROM ( SELECT * FROM sys_role_function rf WHERE rf.role_id = %u AND rf.type = 1 ) rf 
            JOIN sys_function f ON f.function_id = rf.mf_id 
            UNION 
            SELECT rf.id,m.text,m.pid,m.menu_id AS tid,0 
            FROM ( SELECT * FROM sys_role_function rf WHERE rf.role_id = %u AND rf.type = 0 ) rf 
            JOIN sys_menu m ON m.menu_id = rf.mf_id", $role_id, $role_id);
        
        $functionTids = array();
        foreach ($functionData as $item) {
            $prefix = 'm';
            if ($item['type'] == 1)
                $prefix = 'f';
            $functionTids[] = $prefix . $item['tid'];
        }
        
        $data = $Model->query("SELECT CONCAT('f',function_id) AS id, `text`, CONCAT('m',menu_id) AS pid,0 AS `type` FROM sys_function
            UNION 
            SELECT CONCAT('m',menu_id), `text`, CONCAT('m',pid),is_sort FROM sys_menu");
        $newData = array();
        foreach ($data as $Tright) {
            if (in_array($Tright['id'], $functionTids)) {
                $Tright['checked'] = true;
            }
            $newData[] = $Tright;
        }
        $this->assign('treeData', json_encode(genTree($newData)));
        $this->display('role_grant');
    }

    public function roleGrant()
    {
        $role_id = getFormGetPostValue('role_id');
        $gids = $_POST['gids'];
        
        $Model = M("SysRoleFunction");
        $Model->startTrans();
        $result = $Model->where('role_id=%u', $role_id)->delete();
        
        if ($result === false) {
            $Model->rollback();
            $this->returnStatus(false, "删除历史权限失败");
        }
        
        $array = explode(',', $gids);
        if ($array && count($array) > 0) {
            $datas = array();
            foreach ($array as $id) {
                if ($id) {
                    $type = substr($id, 0, 1) == 'f' ? 1 : 0;
                    $mf_id = substr($id, 1);
                    $datas[] = array(
                        'id' => getGuid(),
                        'role_id' => $role_id,
                        'type' => $type,
                        'mf_id' => $mf_id
                    );
                }
            }
            $result = $Model->addAll($datas);
            if (false === $result) {
                $Model->rollback();
                $this->returnStatus(false, "赋予新权限失败");
            }
        }
        $Model->commit();
        $this->ajaxReturn(returnStatus());
    }

    public function roleUnGrant()
    {
        $ids = getFormGetPostValue('tids');
        if (! empty($ids)) {
            $map['id'] = array(
                'in',
                $ids
            );
            $Model = M("SysRoleFunction");
            $Model->where($map)->delete();
        }
        $this->ajaxReturn(returnStatus());
    }

    public function orgList()
    {
        $this->display('org_list');
    }

    public function orgData()
    {
        $Model = M("SysOrg");
        $data = $Model->select();
        return $this->ajaxReturn(genTree($data, 'org_id', 'pid'));
    }

    public function orgComboData()
    {
        $org_id = getFormGetPostValue("org_id");
        if (empty($org_id))
            $org_id = 0;
        $Model = M("SysOrg");
        $data = $Model->where('org_id<>%u', $org_id)->select();
        return $this->ajaxReturn(genTree($data, 'org_id', 'pid', 'title'));
    }

    public function orgDetail()
    {
        $org_id = getFormGetPostValue("org_id");
        if (! empty($org_id)) {
            $Model = M('SysOrg');
            $data = $Model->where("org_id=%u", $org_id)->find();
            $this->assign("data", $data);
        }
        $this->display("org_detail");
    }

    public function orgSave()
    {
        $org_id = getFormGetPostValue("org_id");
        $pid = getFormGetPostValue("pid");
        $title = getFormGetPostValue("title");
        $org_manager = getFormGetPostValue("org_manager");
        $seq = getFormGetPostValue("seq");
        $description = getFormGetPostValue("description");
        
        $data["pid"] = $pid;
        $data["title"] = $title;
        if (! empty($org_manager)) {
            $data["org_manager"] = $org_manager;
        }else{
            $data["org_manager"] = 0;
        }
        $data["seq"] = $seq;
        $data["description"] = $description;
        
        $Model = M("SysOrg");
        if (! empty($org_id)) {
            $Model->where("org_id=%u", $org_id)->save($data);
        } else {
            $Model->data($data)->add();
        }
        $this->ajaxReturn(returnStatus());
    }

    public function orgDelete()
    {
        $org_id = getFormGetPostValue("org_id");
        $Model = M("SysOrg");
        $Model->delete($org_id);
        $RoleUser = M("SysOrgUser");
        $RoleUser->where('org_id=%u', $org_id)->delete();
        $this->ajaxReturn(returnStatus());
    }

    public function orgUserData()
    {
        $page = getFormGetPostValue("page");
        $rows = getFormGetPostValue("rows");
        if (empty($page)) {
            $page = 1;
        }
        if (empty($rows)) {
            $rows = 20;
        }
        
        $org_id = getFormGetPostValue("org_id");
        $Model = M("SysOrgUser");
        $map = array();
        if (! empty($org_id)) {
            $map['org_id'] = array(
                'eq',
                $org_id
            );
        }
        $dataList = $Model->field('sys_user.*')
            ->join('sys_user ON sys_user.user_id = sys_org_user.user_id')
            ->where($map)
            ->page($page, $rows)
            ->select();
        $count = $Model->where($map)->count();
        
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function orgUserDelete()
    {
        $org_id = getFormGetPostValue("org_id");
        $ids = getFormGetPostValue("ids");
        $map = array();
        $map['org_id'] = array(
            'eq',
            $org_id
        );
        $map['user_id'] = array(
            'in',
            $ids
        );
        $Model = M("SysOrgUser");
        $Model->where($map)->delete();
        $this->ajaxReturn(returnStatus());
    }

    public function chooseOrgUserData()
    {
        $page = getFormGetPostValue("page");
        $rows = getFormGetPostValue("rows");
        if (empty($page)) {
            $page = 1;
        }
        if (empty($rows)) {
            $rows = 20;
        }
        
        $org_id = getFormGetPostValue('org_id');
        $real_name = getFormGetPostValue('Q_real_name_like');
        $mail = getFormGetPostValue('Q_mail_like');
        
        if (! empty($real_name)) {
            $map['real_name'] = array(
                'like',
                '%' . $real_name . '%'
            );
        }
        
        if (! empty($mail)) {
            $map['mail'] = array(
                'like',
                '%' . $mail . '%'
            );
        }
        
        $SysRoleUser = M("SysOrgUser");
        $userIds = $SysRoleUser->field('user_id')
            ->where('org_id=%u', $org_id)
            ->select();
        
        if (count($userIds) > 0) {
            $userIdArray = array();
            foreach ($userIds as $item) {
                $userIdArray[] = $item['user_id'];
            }
            $map['user_id'] = array(
                'not in',
                $userIdArray
            );
        }
        
        $Model = M("SysUser");
        $dataList = $Model->where($map)
            ->page($page, $rows)
            ->select();
        $count = $Model->where($map)->count();
        $this->ajaxReturn(returnGridData($dataList, $count));
    }

    public function chooseOrgUserSave()
    {
        $org_id = getFormGetPostValue('org_id');
        $uids = getFormGetPostValue('uids');
        
        $array = explode(',', $uids);
        if ($array && count($array) > 0) {
            $dataList = array();
            foreach ($array as $id) {
                $dataList[] = array(
                    'id' => getGuid(),
                    'org_id' => $org_id,
                    'user_id' => $id
                );
            }
            $Model = M("SysOrgUser");
            $Model->addAll($dataList);
        }
        $this->ajaxReturn(returnStatus());
    }
}