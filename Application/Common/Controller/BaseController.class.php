<?php
namespace Common\Controller;

use Think\Controller;
use Extension\CRedis;
use Think\Upload;
use Think\Verify;
use Think\Image;
class BaseController extends Controller
{
    const UPLOAD_ROOT_DIR="./Uploads/";
    const UPLOAD_FILE_DIR='images/';
    
    public function __construct()
    {
        parent::__construct();
    }
    
    
    /**
     * 单文件上传
     * @param unknown $file
     */
    protected  function uploadFile($file)
    {
        $config=array(
            'maxSize'=>3000000,
            'rootPath'=>self::UPLOAD_ROOT_DIR,
            'savePath'=>self::UPLOAD_FILE_DIR,
            'saveName'=>array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    true,
            'subName'    =>    array('date','Ymd'),
        );
        $upload=new Upload($config);
        $info=$upload->uploadOne($file);
        if (!$info)
        {
            $this->error($upload->getError());
        }else
        {
            $path['image']=$info['savepath'].$info['savename'];
            $path['thumb']=$info['savepath'].'s_'.$info['savename'];
            return $path;
        }
    }
    
    /**
     * 生成缩略图
     * @param unknown $path
     * @param unknown $thumb
     * @param number $width
     * @param number $height
     */
    public function thumb($path,$thumb,$width=60,$height=60)
    {
         $image=new Image();
         $image->open(self::UPLOAD_ROOT_DIR.$path);
         $image->thumb($width,$height,2)->save(self::UPLOAD_ROOT_DIR.$thumb);
         return $thumb;
    }
    
    
    /**
     * 生成验证码
     */
    public function createVerify()
    {
        $config=array(
            'fontSize'=>20,
            'length'=>4,
            'fontttf'=>'5.ttf',
        );
        $verify=new Verify($config);
        $verify->entry();
    }
    
    
    /**
     * 检测验证码是否正确
     * @param unknown $code
     * @param string $id
     * @return boolean
     */
    public function checkVerify($code, $id = ''){
        $verify = new Verify();
        return $verify->check($code,$id);
    }
    
    /**
     * 获取缓存数据
     * @param unknown $name
     * @return boolean
     */
    public static function getCache($name)
    {
        //如果缓存不存在
        if (($cache=S($name)) == null)
        {
            return false;
        }
        return unserialize($cache);
    }
    
    /**
     * 设置缓存数据
     * @param unknown $name
     * @param unknown $value
     * @param number $expire
     * @return boolean
     */
    public static function setCache($name,$value,$expire=60)
    {
        //设置缓存
        S($name,serialize($value),$expire);
        //获取缓存
        return self::getCache($name);
    }
    
}
