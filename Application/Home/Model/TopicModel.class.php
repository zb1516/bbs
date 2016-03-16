<?php
namespace Home\Model;

use Common\Model\BaseModel;

class TopicModel extends BaseModel
{
    protected $_validate=array(
        array('topic_title','require','标题必填'),
        array('topic_title','','标题已存在',0,'unique',1),
        array('topic_content','require','内容必填')
    );
    
    protected $_auto=array(
        array('topic_add_time','time',1,'function')                           //自动填充发表时间        
    );
}