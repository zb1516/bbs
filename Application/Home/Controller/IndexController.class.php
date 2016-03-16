<?php
namespace Home\Controller;
use Common\Controller\HomeController;
use Org\Util\Date;
class IndexController extends HomeController {
    
    public function index()
    {
       //实例化主题模型
       $topicModel=D('Topic');
       $join="left join __MEMBER__ b on a.member_id=b.member_id";
       //获取分页
       $page=$topicModel::showPage($topicModel);
       $field="b.member_images,b.member_name,a.topic_id,a.topic_title,a.topic_click,a.topic_comment,a.topic_add_time";
       //查询所有推荐
       $topicList=$topicModel::findJoinAll($topicModel,array(),$join,'topic_id desc',$page['firstRow'],$page['listRows'],$field);
       $date=new Date();
       foreach ($topicList as $k => $v)
       {
           $topicList[$k]['topic_add_time']=$date->timeDiff(date('Y-m-d H:i:s',$v['topic_add_time']));
           $topicList[$k]['member_images']=thumbPath($v['member_images']);
       }
       $this->assign('page',$page['show']);
       $this->assign('topic',$topicList);
       $this->display();
    }    
}