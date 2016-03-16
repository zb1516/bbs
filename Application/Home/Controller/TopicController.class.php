<?php
namespace Home\Controller;

use Common\Controller\HomeController;
use Think\Model;
use Org\Util\Date;

class TopicController extends HomeController
{
    /**
     * 添加
     */
    public function add()
    {
        //验证用户是否登录
        $this->isLogin();
        //如果是post提交
        if (IS_POST)
        {
            //文章模型
            $topicModel=D('Topic');
            //文章日志模型
            $topicLogModel=D('TopicLog');
            //创建数据
            $data=$topicModel->create();
            //检查数据是否通过验证
            if (!$data)
            {
                $this->error($topicModel->getError());
            }
            //如果数据验证通过，添加数据
            $result=$topicModel::insert($topicModel,$data);
            if ($result !== false)
            {
                $log_array=array("member_id"=>$data['member_id'],'log_content'=>"发表主题成功，主题id：".$result);
                //记录日志
                $topicLogModel::insert($topicLogModel,$log_array);
                $this->success('发表成功',U('Index/index'));
            }
            
            $this->error('发表失败');
        }
        $this->display();
    }
    
    /**
     * 文章详情
     */
    public function detail()
    {
        //接收文章id
        $id=I('get.topic_id');
        //实例化文章模型
        $topicModel=D('Topic');
        //实例化评论模型
        $commentModel=D('Comment');
        //创建查询条件
        $condition=array('topic_id'=>$id);
        //创建查询条件
        $join="__SECTION__ b on a.section_id=b.section_id";
        //根据文章id查询一条信息
        $topicInfo=$topicModel::findJoinOne($topicModel,$condition,$join);
        if (!$topicInfo)
        {
            $this->error('参数错误');
        }
        $condition=array('topic_id'=>$id);
        $commentList=$commentModel::findAll($commentModel,$condition);
        $this->assign('topic',$topicInfo);
        $this->assign('comment',$commentList);
        $this->display();
    }
}