<?php
namespace Home\Controller;

use Common\Controller\HomeController;
use Think\Exception;

class CommentController extends HomeController
{
    public function add()
    {
        //如果是post提交
        if (IS_POST)
        {
            //实例化评论模型
            $commentModel=D('Comment');
            //实例化用户模型
            $memberModel=D('Member');
            //实例化评论日志模型
            $commentLogModel=D('CommentLog');
            //创建数据
            $data=$commentModel->create();
            //如果数据没通过验证
            if (!$data)
            {
                $this->error($commentModel->getError()); 
            }
            $condition=array('member_id'=>$data['member_id']);
            //获取指定字段
            $memberinfo=$memberModel::findOne($memberModel,$condition,'member_name');
            $data['member_name']=$memberinfo['member_name'];
            //事务开启
            $commentModel->startTrans();
            try {
                //添加评论成功
                $commentid=$commentModel::insert($commentModel,$data);
                if ($commentid)
                {
                    //评论成功，修改对应文章的评论
                    $result=$this->commentCount($data['topic_id']);
                    if ($result)
                    {
                        //当都执行成功提交
                        $commentModel->commit();
                        $log_array=array('comment_id'=>$commentid,'log_content'=>'评论成功，评论id：'.$commentid);
                        $commentLogModel::insert($commentLogModel,$log_array);
                        $this->success('发表成功');
                    }else
                    {
                        //回滚操作
                        $commentModel->rollback();
                        $this->error('发表失败');
                    }
                }
                $commentModel->rollback();
                $this->error('发表失败');
            }catch (Exception $e){
                $commentModel->rollback();
                $this->error('发表失败');
            }
            

        }
    }
    
    /**
     * 更新评论数
     * @param unknown $article_id
     * @return boolean
     */
    private function commentCount($topic_id)
    {
        //实例化文章模型
        $topicModel=D('Topic');
        //创建条件
        $condition=array('topic_id'=>$topic_id);
        //查询文章数据
        $topicInfo=$topicModel::findOne($topicModel,$condition,'topic_comment');
        //创建更新条件
        $data=array('topic_id'=>$topic_id,'topic_comment'=>$topicInfo['topic_comment']+1);
        $result=$topicModel::update($topicModel,$data);
        if ($result)
        {
            return true;
        }
        return false;
    }
}