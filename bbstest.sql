-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2016-03-16 07:10:22
-- 服务器版本： 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bbstest`
--

-- --------------------------------------------------------

--
-- 表的结构 `bbs_comment`
--

CREATE TABLE `bbs_comment` (
  `comment_id` int(10) NOT NULL COMMENT '评论id',
  `article_id` int(10) NOT NULL COMMENT '文章id',
  `member_id` int(10) NOT NULL COMMENT '用户id',
  `member_name` varchar(30) NOT NULL DEFAULT '0' COMMENT '用户昵称',
  `comment_content` text COMMENT '评论内容',
  `comment_add_time` int(10) NOT NULL DEFAULT '0' COMMENT '评论时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论表';

-- --------------------------------------------------------

--
-- 表的结构 `bbs_comment_log`
--

CREATE TABLE `bbs_comment_log` (
  `log_id` int(10) NOT NULL COMMENT '日志id',
  `comment_id` int(10) DEFAULT NULL COMMENT '评论id',
  `log_content` text NOT NULL COMMENT '日志内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='评论日志表';

-- --------------------------------------------------------

--
-- 表的结构 `bbs_member`
--

CREATE TABLE `bbs_member` (
  `member_id` int(10) NOT NULL COMMENT '用户id',
  `member_username` varchar(30) NOT NULL DEFAULT '' COMMENT '用户名',
  `member_password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `member_name` varchar(30) NOT NULL DEFAULT '' COMMENT '昵称',
  `member_images` varchar(200) NOT NULL DEFAULT '' COMMENT '头像',
  `member_sex` tinyint(3) NOT NULL DEFAULT '0' COMMENT '性别:0保密1男2女',
  `member_email` varchar(30) NOT NULL DEFAULT '' COMMENT '邮箱',
  `member_email_bind` tinyint(2) NOT NULL DEFAULT '0' COMMENT '邮箱绑定:0未绑定1已绑定',
  `member_qq` int(12) DEFAULT NULL COMMENT 'qq号',
  `member_mobile` int(12) NOT NULL DEFAULT '0' COMMENT '手机号',
  `member_mobile_bind` tinyint(2) NOT NULL DEFAULT '0' COMMENT '手机号绑定:0未绑定1已绑定',
  `member_status` tinyint(2) NOT NULL DEFAULT '0' COMMENT '用户状态:0未冻结1已冻结',
  `member_point` int(10) NOT NULL DEFAULT '20' COMMENT '用户积分',
  `member_exppoints` int(10) NOT NULL DEFAULT '0' COMMENT '用户经验',
  `member_offer` int(10) NOT NULL DEFAULT '0' COMMENT '贡献',
  `member_register_time` int(10) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `member_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `member_old_login_time` int(10) NOT NULL DEFAULT '0' COMMENT '上次登陆时间',
  `member_login_ip` varchar(25) NOT NULL DEFAULT '' COMMENT '登陆ip',
  `member_old_login_ip` varchar(25) NOT NULL DEFAULT '' COMMENT '上次登陆ip',
  `member_error_num` tinyint(4) NOT NULL DEFAULT '0' COMMENT '用户失败次数',
  `member_provinceid` int(10) DEFAULT NULL COMMENT '省id',
  `member_cityid` int(10) DEFAULT NULL COMMENT '市id',
  `member_areaid` int(10) DEFAULT NULL COMMENT '地区id',
  `salt` char(4) NOT NULL DEFAULT '' COMMENT '随机码'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户表';

--
-- 转存表中的数据 `bbs_member`
--

INSERT INTO `bbs_member` (`member_id`, `member_username`, `member_password`, `member_name`, `member_images`, `member_sex`, `member_email`, `member_email_bind`, `member_qq`, `member_mobile`, `member_mobile_bind`, `member_status`, `member_point`, `member_exppoints`, `member_offer`, `member_register_time`, `member_login_time`, `member_old_login_time`, `member_login_ip`, `member_old_login_ip`, `member_error_num`, `member_provinceid`, `member_cityid`, `member_areaid`, `salt`) VALUES
(2, 'zhangsan', 'b574d1e4fc48db2647c35d3586e411b4', '战三', 'images/20160305/s_56dad8e031999.png', 0, '98455@qq.com', 0, 98843553, 1500987787, 0, 0, 0, 0, 0, 1457097792, 1458106199, 1457508520, '127.0.0.1', '127.0.0.1', 0, NULL, NULL, NULL, '9020');

-- --------------------------------------------------------

--
-- 表的结构 `bbs_section`
--

CREATE TABLE `bbs_section` (
  `section_id` int(10) NOT NULL COMMENT '版块id',
  `section_name` varchar(20) NOT NULL DEFAULT '' COMMENT '版块名',
  `section_sort` tinyint(10) NOT NULL DEFAULT '0' COMMENT '排序',
  `section_desc` text NOT NULL COMMENT '备注',
  `section_click` int(10) NOT NULL COMMENT '点击数'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='版块表';

--
-- 转存表中的数据 `bbs_section`
--

INSERT INTO `bbs_section` (`section_id`, `section_name`, `section_sort`, `section_desc`, `section_click`) VALUES
(1, '模块一', 0, '', 0);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_setting`
--

CREATE TABLE `bbs_setting` (
  `id` int(11) NOT NULL,
  `title` varchar(20) NOT NULL COMMENT '名称',
  `name` varchar(20) NOT NULL COMMENT '键，唯一的',
  `value` text NOT NULL COMMENT '值',
  `desc` text NOT NULL COMMENT '备注说明信息'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `bbs_setting`
--

INSERT INTO `bbs_setting` (`id`, `title`, `name`, `value`, `desc`) VALUES
(1, '网站名称', 'web_name', '我的网站', ''),
(2, '网站logo', 'web_logo', 'f', ''),
(3, '版权信息', 'copyright', '版权所有', '');

-- --------------------------------------------------------

--
-- 表的结构 `bbs_topic`
--

CREATE TABLE `bbs_topic` (
  `topic_id` int(10) NOT NULL COMMENT '主题id',
  `member_id` int(10) NOT NULL DEFAULT '0' COMMENT '用户id',
  `section_id` int(10) NOT NULL DEFAULT '0' COMMENT '模块id',
  `topic_title` varchar(100) NOT NULL DEFAULT '' COMMENT '主题标题',
  `topic_content` text COMMENT '主题内容',
  `topic_type` tinyint(6) NOT NULL DEFAULT '0' COMMENT '是否推荐0不推荐1推荐',
  `topic_state` tinyint(3) DEFAULT '1' COMMENT '审核状态：1未审核2审核通过3审核拒绝',
  `topic_click` int(10) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `topic_comment` int(10) NOT NULL DEFAULT '0' COMMENT '评论数',
  `topic_add_time` int(10) NOT NULL DEFAULT '0' COMMENT '发表时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帖子表';

--
-- 转存表中的数据 `bbs_topic`
--

INSERT INTO `bbs_topic` (`topic_id`, `member_id`, `section_id`, `topic_title`, `topic_content`, `topic_type`, `topic_state`, `topic_click`, `topic_comment`, `topic_add_time`) VALUES
(10, 2, 1, '测试', '&lt;p&gt;测试&lt;/p&gt;&lt;p&gt;&lt;img alt=&quot;u=3227955476,1491622682&amp;amp;fm=21&amp;amp;gp=0.jpg&quot; src=&quot;/Uploads/ueditor/image/20160309/1457508717784899.jpg&quot; title=&quot;1457508717784899.jpg&quot;/&gt;&lt;/p&gt;', 0, 1, 0, 0, 1457508718);

-- --------------------------------------------------------

--
-- 表的结构 `bbs_topic_log`
--

CREATE TABLE `bbs_topic_log` (
  `log_id` int(10) NOT NULL COMMENT '文章日志id',
  `member_id` int(10) DEFAULT NULL COMMENT '用户id',
  `log_content` text COMMENT '文章日志内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='帖子日志';

--
-- 转存表中的数据 `bbs_topic_log`
--

INSERT INTO `bbs_topic_log` (`log_id`, `member_id`, `log_content`) VALUES
(3, 2, '发表主题成功，主题id：10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bbs_comment`
--
ALTER TABLE `bbs_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `bbs_comment_log`
--
ALTER TABLE `bbs_comment_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `bbs_member`
--
ALTER TABLE `bbs_member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `bbs_section`
--
ALTER TABLE `bbs_section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `bbs_setting`
--
ALTER TABLE `bbs_setting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `bbs_topic`
--
ALTER TABLE `bbs_topic`
  ADD PRIMARY KEY (`topic_id`);

--
-- Indexes for table `bbs_topic_log`
--
ALTER TABLE `bbs_topic_log`
  ADD PRIMARY KEY (`log_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `bbs_comment`
--
ALTER TABLE `bbs_comment`
  MODIFY `comment_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '评论id';
--
-- 使用表AUTO_INCREMENT `bbs_comment_log`
--
ALTER TABLE `bbs_comment_log`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '日志id';
--
-- 使用表AUTO_INCREMENT `bbs_member`
--
ALTER TABLE `bbs_member`
  MODIFY `member_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户id', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `bbs_section`
--
ALTER TABLE `bbs_section`
  MODIFY `section_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '版块id', AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `bbs_setting`
--
ALTER TABLE `bbs_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- 使用表AUTO_INCREMENT `bbs_topic`
--
ALTER TABLE `bbs_topic`
  MODIFY `topic_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '主题id', AUTO_INCREMENT=11;
--
-- 使用表AUTO_INCREMENT `bbs_topic_log`
--
ALTER TABLE `bbs_topic_log`
  MODIFY `log_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '文章日志id', AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
