<?php
namespace Common\Controller;

use Common\Controller\BaseController;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function _initialize()
    {
        //读取配置信息
        $this->_config();
    }
    
    /**
     * 判断是否登录
     */
    protected function isLogin()
    {
        //判断session是否设置，用户是否登陆
        if(session('?member_info') === false)
        {
            $this->redirect('Member/login');
        }
    }
    
    /**
     * 读取配置信息
     */
    private function _config()
    {
        //读取配置信息
        $settingModel=D('Setting');
        $settingList=$settingModel->select();
        $name=array();
        $value=array();
        foreach ($settingList as $k=>$v)
        {
            $name[]=$v['name'];
            $value[]=$v['value'];
        }
        $setting=array_combine($name,$value);
        $this->assign('setting',$setting);
    }
}