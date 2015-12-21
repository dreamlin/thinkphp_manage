<?php

/**
 * 树形数据生成
 * @param type $items 原始数据
 * @param type $id  主键字段（默认：id）
 * @param type $pid 父节点标识（默认：pid）
 * @param type $son 子节点标识（默认：children）
 * @param type $attributes 是否添加attributes属性
 * @return array 树形数据
 */
function genTree($items, $id = 'id', $pid = 'pid', $textFiled = 'text', $iconCls = 'icon_cls', $son = 'children')
{
    $tree = array(); // 格式化的树
    $tmpMap = array(); // 临时扁平数据
    
    foreach ($items as $item) {
        if (! isset($item['id'])) {
            $item['id'] = $item[$id];
        }
        if (! isset($item['text'])) {
            $item['text'] = $item[$textFiled];
        }
        if (! isset($item['iconCls'])) {
            $item['iconCls'] = $item[$iconCls];
        }
        $tmpMap[$item[$id]] = $item;
    }
    
    foreach ($items as $item) {
        if (isset($tmpMap[$item[$pid]])) {
            $tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
        } else {
            $tree[] = &$tmpMap[$item[$id]];
        }
    }
    return $tree;
}

/**
 * 树形数据生成
 *
 * @param type $items
 *            原始数
 * @return array 树形数据
 */
function BuildMenuTree($items)
{
    $id = 'menu_id';
    $pid = 'pid';
    $son = 'children';
    
    $tree = array(); // 格式化的树
    $tmpMap = array(); // 临时扁平数据
    
    foreach ($items as $item) {
        $tmpMap[$item[$id]] = array(
            'id' => $item[$id],
            'text' => $item['text'],
            'iconCls' => $item['icon_cls'],
            'attributes' => array(
                'issort' => $item['is_sort'],
                'href' => $item['href']
            )
        );
    }
    foreach ($items as $item) {
        if (isset($tmpMap[$item[$pid]])) {
            $tmpMap[$item[$pid]][$son][] = &$tmpMap[$item[$id]];
        } else {
            $tree[] = &$tmpMap[$item[$id]];
        }
    }
    return $tree;
}

/**
 * 返回执行结果
 *
 * @param type $status            
 * @param type $msg            
 * @param type $data            
 */
function returnStatus($status = TRUE, $msg = null, $data = null)
{
    return array(
        'status' => $status,
        'data' => $data,
        'msg' => $msg
    );
}

/**
 * 返回grid数据
 *
 * @param type $data            
 * @param type $total            
 */
function returnGridData($data, $total)
{
    return array(
        'rows' => (empty($data) ? array() : $data),
        'total' => $total
    );
}

function getFormGetPostValue($key)
{
    if (isset($_GET[$key])) {
        return trim(urldecode($_GET[$key]));
    }
    if (isset($_POST[$key])) {
        return trim(urldecode($_POST[$key]));
    }
    return null;
}

function getFormGetValue($key)
{
    if (isset($_GET[$key])) {
        return trim(urldecode($_GET[$key]));
    }
    return null;
}

function getFormPostValue($key)
{
    if (isset($_POST[$key])) {
        return trim(urldecode($_POST[$key]));
    }
    return null;
}

function getFormPostArrayValue($key)
{
    $_POST = $this->GET_SUBMIT();
    if (isset($_POST[$key])) {
        return urldecode($_POST[$key]);
    }
    return null;
}

function GET_SUBMIT()
{
    if (empty($_POST)) {
        return $_POST;
    }
    // 获取POST原始值
    $data = file_get_contents("php://input");
    if (empty($data)) {
        return $_POST;
    }
    // 开始处理
    $POST = array();
    $list = explode('&', $data);
    foreach ($list as $key => $value) {
        // 获取POST的KEY和Value值
        $postname = urldecode(substr($value, 0, stripos($value, "=")));
        $postvalue = urldecode(substr($value, (stripos($value, "=") + 1)));
        // 对KEY值和Value值进行处理
        // 去空格和[]
        $postname = trim($postname, ' ,[,]');
        $postvalue = trim($postvalue);
        if (array_key_exists($postname, $POST)) {
            $POST[$postname] = $POST[$postname] . "," . $postvalue;
        } else {
            $POST[$postname] = $postvalue;
        }
    }
    return $POST;
}

function getDateTime()
{
    return date('Y-m-d H:i:s');
}

function getGuid()
{
    return md5(uniqid(rand(), true));
}