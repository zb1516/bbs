<?php
namespace Common\Model;

use Think\Model;
use Extension\Page;
class BaseModel extends Model
{
    const PAGESIZE=1;
    
    public function __construct()
    {
        parent::__construct();
    }
    
    /**
     * 查询所有列表数据
     * @param unknown $model
     * @param unknown $condition
     * @param unknown $order
     * @param string $page
     * @param number $limit
     */
    public static function findAll($model,$condition=array(),$order="",$firstRow=null,$listRows=null,$field='*')
    {
        return $model->field($field)->where($condition)->order($order)->limit($firstRow,$listRows)->select();
    }
    
    /**
     * 关联查询数据
     * @param unknown $model
     * @param unknown $condition
     * @param unknown $join
     * @param string $order
     * @param string $page
     * @param number $limit
     * @param string $field
     */
    public static function findJoinAll($model,$condition=array(),$join,$order="",$firstRow=null,$listRows=null,$field="*")
    {
        return $model->alias('a')->join($join)->field($field)->where($condition)->order($order)->limit($firstRow,$listRows)->select();
    }
    
    /**
     * 获取条数
     * @param unknown $model
     * @param unknown $condition
     */
    public static function getCount($model,$condition)
    {
        return $model->alias('a')->where($condition)->count();
    }
    
    /**
     * 返回分页
     * @param unknown $model
     * @param unknown $condition
     * @return string
     */
    public static function showPage($model,$condition=array())
    {
        $page=new Page(self::getCount($model, $condition),self::PAGESIZE);
        $data['show']=$page->show();
        $data['firstRow']=$page->firstRow;
        $data['listRows']=$page->listRows;
        return $data;
    }
    
    /**
     * 根绝条件查询一条记录
     * @param unknown $model
     * @param unknown $condition
     */
    public static function findOne($model,$condition=array(),$field='*')
    {
        return $model->alias('a')->field($field)->where($condition)->find();
    }
    
    /**
     * 关联查询一条数据
     * @param unknown $model
     * @param unknown $condition
     * @param unknown $join
     * @param string $field
     */
    public static function findJoinOne($model,$condition=array(),$join,$field="*")
    {
        return $model->alias('a')->field($field)->join($join)->where($condition)->find();
    }
    
    /**
     * 增加数据
     * @param unknown $model
     * @param unknown $data
     */
    public static function insert($model,$data=array())
    {
        return $model->add($data);
    }
    
    /**
     * 添加多条数据
     * @param unknown $model
     * @param unknown $dataList
     */
    public static function insertAll($model,$dataList=array())
    {
        return $model->addAll($dataList);
    }
    
    /**
     * 修改数据
     * @param unknown $model
     * @param unknown $data
     */
    public static function update($model,$data=array())
    {
        return $model->save($data);
    }
    
    /**
     * 删除数据
     * @param unknown $model
     * @param unknown $condition
     */
    public static function del($model,$condition=array())
    {
        return $model->where($condition)->delete();
    }
}