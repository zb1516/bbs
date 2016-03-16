<?php
namespace Admin\Controller;

use Common\Controller\AdminController;

class TopicController extends AdminController
{
    //文章列表
    public function index()
    {
        $condition=array();
        if(IS_POST)
        {
            $post=I('post.');
            $condition=array("topic_title"=>$post);
        }
        $join="__MEMBER__ b on a.member_id=b.member_id";
        //实例化文章模型
        $topicModel=D('Topic');
        $data=$topicModel::showPage($topicModel,$condition);
        $topicList=$topicModel::findJoinAll($topicModel,$condition,$join,$data['firstRow'],$data['listRows']);
        $this->assign('topic',$topicList);
        $this->assign('page',$data['show']);
        $this->display();
    }
}