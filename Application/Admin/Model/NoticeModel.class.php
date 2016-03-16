<?php
namespace Admin\Model;

use Common\Model\BaseModel;

class NoticeModel extends BaseModel
{
    protected $_validate=array(
        array('notice_title','require','公告标题必填'),
        array('notice_content','require','公告内容必填'),
        array('notice_type','require','公告类型必选'),
        array('notice_state','require','公告状态必选')
    );
    
    protected $_auto=array(
        array('notice_add_time','time',1,'function')
    );
}