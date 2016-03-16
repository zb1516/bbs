<?php
namespace Home\Model;

use Common\Model\BaseModel;

class MemberModel extends BaseModel
{
    protected $_validate=array(
        array('verify','require','验证码必填'),
        array('member_username','require','用户名必填'),                     //验证用户名是否填写
        array('member_username','','用户名已存在',0,'unique',1),              //用户名是否存在
        array('member_password','require','密码必填'),                      //验证密码是否填写
        array('member_repassword','member_password','确认密码不一致',0,'confirm'),     //验证确认密码是否一致，存在字段就验证
        array('member_email','email','邮箱格式不正确'),                                 //验证邮箱格式是否正确，存在字段就验证
        array('member_name','require','真实姓名必填'),
        array('member_mobile','require','手机必填'),
        array('member_qq','require','qq必填'),
        //array('member_qq','qq','qq格式不正确'),
    );
    
    protected $_auto=array(
        array('member_password','md5',1,'function'),        //密码自动填充
        array('member_register_time','time',1,'function'),  //注册时间自动填充
    );
    
    
}