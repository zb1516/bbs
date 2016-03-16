<?php
namespace Home\Controller;

use Common\Controller\HomeController;

class NoticeController extends HomeController
{
    public function index()
    {}
    
    /**
     * 公告详情
     */
    public function detail()
    {
        //实例化公告模型
        $noticeModel=D('Notice');
        //接收公告id
        $notice_id=I('get.notice_id');
        //创建查询条件
        $condition=array('notice_id'=>$notice_id);
        $noticeInfo=$noticeModel::findOne($noticeModel,$condition);
        $this->assign('notice',$noticeInfo);
        $this->display();
    }
}