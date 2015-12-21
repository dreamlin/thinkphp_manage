<?php
return array(
    /* 模板引擎配置 */
    'TMPL_ENGINE_TYPE' => 'Smarty', // 默认模板引擎 以下设置仅对使用Think模板引擎有效
    'TMPL_ENGINE_CONFIG' => array(
        'plugins_dir' => './Application/Smarty/Plugins/',
        'left_delimiter' => '${',
        'right_delimiter' => '}',
        'cache_lifetime' => 30 * 24 * 3600,
        'caching' => false
    ), // 是否使用缓存，项目在调试期间，不建议启用缓存
    
    /* URL访问模式 */
    // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
    // 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE 模式); 3 (兼容模式) 默认为PATHINFO 模式
    'URL_MODEL' => 2
);