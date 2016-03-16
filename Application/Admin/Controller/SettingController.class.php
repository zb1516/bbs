<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class SettingController extends AdminController
{
    /**
     * 设置配置信息
     */
    public function setBase()
    {
        //实例化配置模型
        $settingModel=D('Setting');
        if (IS_POST)
        {
            $param=I('post.');
            //执行更新配置信息
            $result=$settingModel->setSave(I('post.'));
            if ($result)
            {
                $this->success('保存成功');
            }else
            {
                $this->error('保存失败');
            }
        }
        $setList=$settingModel::findAll($settingModel);
        $this->assign('setting',$setList);
        $this->display();
    }
}