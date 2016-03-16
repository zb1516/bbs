<?php
namespace Admin\Model;

use Common\Model\BaseModel;

class SettingModel extends BaseModel
{
    //保存配置
    public function setSave($param)
    {
        //判断传参是否为空
        if(empty($param))
        {
            return false;
        }
        //如果参数是数组
        if (is_array($param))
        {
            $data=array();
            //循环更新配置
            foreach ($param as $k => $v)
            {
                $condition=array("name"=>$k);
                $data=array("value"=>$v);
                $result=$this->where($condition)->save($data);
            }
            return true;
        }else
        {
            return false;
        }
    }
}