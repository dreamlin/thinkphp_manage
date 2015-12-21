<?php
return array(
    /* 数据库配置 */
    'DB_TYPE' => 'mysql', // 数据库类型
    'DB_HOST' => '127.0.0.1', // 服务器地址
    'DB_NAME' => 'db_manage', // 数据库名
    'DB_USER' => 'root', // 用户名
    'DB_PWD' => '123qwe', // 密码
    'DB_PORT' => '3306', // 端口
    'DB_PREFIX' => '', // 数据库表前缀
    'DB_PARAMS' => array(), // 数据库连接参数
    'DB_DEBUG' => TRUE, // 数据库调试模式 开启后可以记录SQL日志
    'DB_FIELDS_CACHE' => true, // 启用字段缓存
    'DB_CHARSET' => 'utf8', // 数据库编码默认采用utf8
    
    /* 路由 */
    'URL_ROUTER_ON' => true,
    // 静态路由
    'URL_MAP_RULES' => array(
        'list' => 'index/plist'
    ),
    'URL_ROUTE_RULES' => array(
        // 规则路由,这里:id表示参数，获取方式是$_GET['id']
        'item/:id\d' => 'index/item',
        // 正则路由
        '/^item-(\d+)$/' => 'index/item?id=:1'
    )
);