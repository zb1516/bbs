<?php
namespace Home\Controller;

use Common\Controller\HomeController;

class MemberController extends HomeController
{
    //设置登陆次数
    const LOGIN_NUM=4;
    
    /**
     * 登陆
     */
    public function login()
    {
        //如果是pos提交执行
        if (IS_POST)
        {
            //实例化用户模型
            $memberModel=D('Member');
            //创建数据
            $data=$memberModel->create($_POST,4);
            //验证数据是否通过验证
            if (!$data)
            {
                $this->error($memberModel->getError());
            }
            //根据用户名查询用户数据
            $condition=array('username'=>$data['member_username']);
            $memberInfo=$memberModel::findOne($memberModel,$condition);
            if ($memberInfo)
            {
                //验证密码是否错误，如果错误登陆次数-1
                if ($memberInfo['member_password'] != $this->_pwdMd5(md5($data['member_password']),$memberInfo['salt']))
                {
                    $num=$memberInfo['member_error_num']+1;
                    if($last_num=$this->_checkNum($num))
                    {
                        //更新用户当前错误次数
                        $login_num_data=array('member_id'=>$memberInfo['member_id'],'member_error_num'=>$num);
                        $memberModel::update($memberModel,$login_num_data);
                        $this->error("登陆失败，您还可以尝试".$last_num."次");
                    }
                    $this->error("您的登陆次数已用完");
                }
                //更新数据
                $updata_data=array(
                    'member_id'=>$memberInfo['member_id'],
                    'member_error_num'=>0,
                    'member_old_login_time'=>$memberInfo['member_login_time'],
                    'member_login_time'=>time(),
                    'member_old_login_ip'=>$memberInfo['member_login_ip'],
                    'member_login_ip'=>get_client_ip()
                );
                $result=$memberModel::update($memberModel,$updata_data);
                if ($result !== false)
                {
                    //把用户信息存入session
                    $memberInfo['member_old_login_time']=$updata_data['member_old_login_time'];
                    $memberInfo['member_old_login_ip']=$updata_data['member_old_login_ip'];
                    session('member_info',$memberInfo);
                    $this->redirect('Index/index');
                }
            }
            
            $this->error("用户不存在");
        }
        
        $this->display();
    }
    
    /**
     * 注册
     */
    public function register()
    {
        //如果是post提交执行
        if (IS_POST)
        {
            //实例化用户模型
            $memberModel=D('Member');
            //创建数据
            $data=$memberModel->create();
            //验证数据是否通过验证
            if (!$data)
            {
                $this->error($memberModel->getError());
            }
            //验证是否正确
            if(!$this->checkVerify(I('post.verify')))
            {
                $this->error("验证码错误");
            }
            $data['salt']=rand(1000, 9999);
            $data['member_password']=$this->_pwdMd5($data['member_password'],$data['salt']);
            $result=$memberModel->insert($memberModel,$data);
            if ($result !== false)
            {
                $this->success('注册成功',U('Member/login'));
            }
            $this->error('注册失败');
        }
        $this->display();
    }
    
    /**
     * 退出
     */
    public function logout()
    {
        session(null);
        session_destroy();
        $this->redirect('Member/login');
    }
    
    /**
     * 获取验证码
     */
    public function vertify()
    {
        $this->createVerify();
    }
    
    /**
     * 更新个人资料
     */
    public function edit()
    {
        //如果是post提交
        if (IS_POST)
        {
            $memberModel=D('Member');
            $data=$memberModel->create();
            if (!$data)
            {
                $this->error($memberModel->getError());
            }
            //更新个人资料
            $result=$memberModel::update($memberModel,$data);
            if($result !== false)
            {
                //查询信息
                $condition=array('member_id'=>$data['member_id']);
                $memberInfo=$memberModel::findOne($memberModel,$condition);
                session('member_info',$memberInfo);
                $this->error('保存成功');
            }
            $this->error('保存失败');
        }
        
        $this->display();
    }
    
    /**
     * 上传头像
     */
    public function upload()
    {
        C("TOKEN_ON",false);
        if (IS_POST)
        {
            if (empty($_FILES['member_image']))
            {
                $this->error('必须选择上传文件');
            }
            //调用上传
            $path=$this->uploadFile($_FILES['member_image']);
            //处理缩略图
            $thumb=$this->thumb($path['image'],$path['thumb']);
            $memberModel=D('Member');
            $update_data=array('member_id'=>I('post.member_id'),'member_images'=>$thumb);
            $result=$memberModel::update($memberModel,$update_data);
            if ($result !== false)
            {
                //查询信息
                $condition=array('member_id'=>I('post.member_id'));
                //查询用户信息
                $memberInfo=$memberModel::findOne($memberModel,$condition);
                //处理用户头像路径
                $memberInfo['member_images']=thumbPath($memberInfo['member_images']);
                session('member_info',$memberInfo);
                $this->success('保存成功',U('Index/index'));
            }
            
            $this->error('保存失败');
        }
        
        $this->display();
    }
    
    
    /**
     * 密码加密
     * @param unknown $password
     * @param unknown $salt
     * @return string
     */
    private function _pwdMd5($password,$salt)
    {
        return md5($password.$salt);
    }
    
    /**
     * 验证错误次数
     * @param unknown $num
     * @return boolean|number
     */
    private function _checkNum($num)
    {
        //判断当前错误次数是否超过3次
        while ($num == 4)
        {
            return false;
        }
        
        return self::LOGIN_NUM-$num;
    }
}