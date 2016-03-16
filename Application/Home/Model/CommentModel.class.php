<?php
namespace Home\Model;

use Common\Model\BaseModel;

class CommentModel extends BaseModel
{
    protected $_validate=array(
        array('comment_content','require','评论内容必填'),
    );
    
    protected $_auto=array(
        array('comment_add_time','time',1,'function')
    );
}