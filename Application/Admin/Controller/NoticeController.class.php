<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class NoticeController extends AdminController
{
    /**
     * 公告列表
     */
    public function index()
    {
        //实例化公告模型
        $noticeModel=D('Notice');
        //获取分页
        $data=$noticeModel::showPage($noticeModel);
        //查询所有公告
        $noticeList=$noticeModel::findAll($noticeModel,array(),'notice_id desc',$data['firstRow'],$data['listRows']);
        $this->assign('notice',$noticeList);
        $this->display();
    }
    
    /**
     * 发布公告
     */
    public function add()
    {
        if (IS_POST){
        //实例化公告模型
        $noticeModel=D('Notice');
        $data=$noticeModel->create();
        if (!$data)
        {
            $this->error($noticeModel->getError());
        }
        
        $result=$noticeModel::insert($noticeModel,$data);
        if ($result !== false)
        {
            $this->success('发布公告成功');
        }else
        {
            $this->error('发布失败');
        }
        
        }
        $this->display();
    }
}