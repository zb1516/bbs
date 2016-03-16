<?php
return array(
	//'配置项'=>'配置值'
    "TMPL_L_DELIM"=>"{#",                                           //左定界符
    "TMPL_R_DELIM"=>"#}",                                           //右定界符
    "DEFAULT_MODULE"=>"Home",                                       //默认模块
    "URL_MODEL"=>2,                                                 //url重写
    "MODULE_ALLOW_LIST"=>array("Home","Admin"),                     //允许访问模块
    "DB_BIND_PARAM"=>true,                                          //开启参数绑定
	"SHOW_PAGE_TRACE"=>true,                                        //显示页面trace信息
    "LAYOUT_ON"=>true,                                              //启用布局
    "LAYOUT_NAME"=>"Layout/layout",                                 //布局文件路径
    "LANG_SWITCH_ON"=>true,                                         //开启多语言包
    'SESSION_AUTO_START'=>true,                                     //开启session
    "LOAD_EXT_CONFIG"=>"db,csrf,redis",                             //加载扩展配置
    "TMPL_PARSE_STRING"=>array(
        "__STATIC__"=>"/Static",
    ),
);