/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.6.19 : Database - db_manage
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_manage` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_manage`;

/*Table structure for table `sys_dict` */

DROP TABLE IF EXISTS `sys_dict`;

CREATE TABLE `sys_dict` (
  `dict_id` int(11) NOT NULL AUTO_INCREMENT,
  `dict_key` varchar(20) NOT NULL,
  `dict_value` varchar(20) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dict_id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

/*Data for the table `sys_dict` */

insert  into `sys_dict`(`dict_id`,`dict_key`,`dict_value`,`status`) values (41,'sex','性别',0),(42,'sexa','abcabc',0),(56,'sexab','sexabbb',0),(57,'order_id','oid',0);

/*Table structure for table `sys_function` */

DROP TABLE IF EXISTS `sys_function`;

CREATE TABLE `sys_function` (
  `function_id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(20) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `resources` varchar(500) NOT NULL,
  PRIMARY KEY (`function_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;

/*Data for the table `sys_function` */

insert  into `sys_function`(`function_id`,`text`,`menu_id`,`resources`) values (4,'列表',94,'/menu/getdata;'),(5,'新增',94,'/menu/combodata;/menu/toadd;/menu/addmenu;'),(6,'更新',94,'/menu/combodata;/menu/toupdate;/menu/addmenu;'),(7,'删除',94,'/menu/delete;'),(8,'功能列表',95,'/function/getdata;/function/menutree;'),(9,'菜单树',95,'/function/menutree;'),(10,'新增',95,'/function/toadd;/function/dosave;'),(11,'更新',95,'/function/toupdate;/function/dosave;'),(12,'删除',95,'/function/dodelete;'),(13,'列表',96,'/role/getdata;'),(14,'新增',96,'/role/toadd;/role/dosave;'),(15,'删除',96,'/role/dodelete;'),(16,'更新',96,'/role/toupdate;/role/dosave;'),(17,'获取权限',96,'/role/getrightdata;'),(18,'获取用户',96,'/role/getuserdata;'),(19,'授权',96,'/role/togrant;/role/dogrant;'),(20,'解除授权',96,'/role/doungrant;'),(21,'列表',97,'/user/getdata;'),(22,'新增',97,'/user/toadd;/user/dosave;'),(23,'更新',97,'/user/toupdate;/user/dosave;'),(24,'删除',97,'/user/dodelete;'),(25,'新增角色用户',96,'/common/chooseuser;/role/getadduserdata;/role/doaddroleuser;'),(26,'删除角色用户',96,'/role/dodeleteroleuser;'),(27,'列表',98,'/org/getdata;'),(28,'新增',98,'/org/toadd;/org/combodata;/org/combogriddata;/org/dosave;'),(29,'更新',98,'/org/toupdate;/org/combodata;/org/combogriddata;/org/dosave;'),(30,'删除',98,'/org/dodelete;'),(31,'查看成员',98,'/org/getuserdata;'),(32,'增加成员',98,'/common/chooseuser;/org/getadduserdata;/org/doaddorguser;'),(33,'删除成员',98,'/org/dodeleteorguser;');

/*Table structure for table `sys_menu` */

DROP TABLE IF EXISTS `sys_menu`;

CREATE TABLE `sys_menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL,
  `text` varchar(20) NOT NULL,
  `href` varchar(100) DEFAULT NULL,
  `icon_cls` varchar(20) DEFAULT NULL COMMENT '图标',
  `is_sort` int(1) NOT NULL DEFAULT '0' COMMENT '是否是分类',
  `seq` int(11) NOT NULL DEFAULT '1' COMMENT '排序',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT '状态',
  PRIMARY KEY (`menu_id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

/*Data for the table `sys_menu` */

insert  into `sys_menu`(`menu_id`,`pid`,`text`,`href`,`icon_cls`,`is_sort`,`seq`,`status`) values (96,91,'角色管理','/sys/roleList','icon-role',0,3,0),(95,91,'功能管理','/sys/functionList','icon-function',0,1,0),(90,0,'管理系统','','icon-application',1,0,0),(91,90,'系统管理','','icon-system',1,0,0),(94,91,'菜单管理','/sys/menuList','icon-menu',0,0,0),(97,91,'用户管理','/sys/userList','icon-user',0,2,0),(98,91,'组织管理','/sys/orgList','icon-department',0,4,0);

/*Table structure for table `sys_org` */

DROP TABLE IF EXISTS `sys_org`;

CREATE TABLE `sys_org` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `pid` int(11) NOT NULL DEFAULT '0',
  `org_manager` varchar(50) NOT NULL,
  `seq` int(11) NOT NULL DEFAULT '0',
  `description` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`org_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `sys_org` */

insert  into `sys_org`(`org_id`,`title`,`pid`,`org_manager`,`seq`,`description`) values (1,'测试部',0,'',0,'测试'),(2,'测试',1,'',0,'萨达斯的'),(4,'aa11',1,'23',0,'aabb'),(5,'test',1,'22',0,'asdfad');

/*Table structure for table `sys_org_user` */

DROP TABLE IF EXISTS `sys_org_user`;

CREATE TABLE `sys_org_user` (
  `id` varchar(50) NOT NULL,
  `org_id` int(10) NOT NULL,
  `user_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

/*Data for the table `sys_org_user` */

insert  into `sys_org_user`(`id`,`org_id`,`user_id`) values ('7',2,21),('9',1,22),('10',1,23),('11',4,22),('12',4,23);

/*Table structure for table `sys_role` */

DROP TABLE IF EXISTS `sys_role`;

CREATE TABLE `sys_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `text` varchar(20) NOT NULL,
  `remark` varchar(200) DEFAULT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `sys_role` */

insert  into `sys_role`(`role_id`,`text`,`remark`,`status`) values (3,'测试','测试2',0),(4,'123','123',0);

/*Table structure for table `sys_role_function` */

DROP TABLE IF EXISTS `sys_role_function`;

CREATE TABLE `sys_role_function` (
  `id` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `mf_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=232 DEFAULT CHARSET=utf8;

/*Data for the table `sys_role_function` */

insert  into `sys_role_function`(`id`,`role_id`,`type`,`mf_id`) values ('cd41c6a195acc43524b65ca73b59a780',4,1,14),('70',2,0,97),('231',3,1,35),('230',3,1,34),('229',3,0,99),('228',3,1,31),('227',3,1,27),('226',3,0,98),('225',3,1,21),('224',3,0,97),('223',3,1,4),('222',3,0,94),('221',3,1,8),('220',3,0,95),('219',3,0,91),('218',3,0,90),('bcf374db047529660c186a3f0a2f2bad',4,1,13),('276a003de9e46c39e81ed884afdbcdd1',4,0,96),('c23223572223553bdb221b15b68dcb7d',4,0,91),('db3d0f5d72806eabf792e5b422dd1f5c',4,0,90);

/*Table structure for table `sys_role_user` */

DROP TABLE IF EXISTS `sys_role_user`;

CREATE TABLE `sys_role_user` (
  `id` varchar(50) NOT NULL,
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

/*Data for the table `sys_role_user` */

insert  into `sys_role_user`(`id`,`role_id`,`user_id`) values ('73e37eec2eacdb04bc21705c8fe6709f',4,23),('0',0,1);

/*Table structure for table `sys_user` */

DROP TABLE IF EXISTS `sys_user`;

CREATE TABLE `sys_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(100) NOT NULL,
  `real_name` varchar(100) NOT NULL,
  `password` varchar(64) NOT NULL,
  `mail` varchar(50) NOT NULL,
  `create_time` datetime NOT NULL,
  `update_time` datetime NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

/*Data for the table `sys_user` */

insert  into `sys_user`(`user_id`,`user_name`,`real_name`,`password`,`mail`,`create_time`,`update_time`) values (22,'张三','member','e10adc3949ba59abbe56e057f20f883e','zs123@126.com','2015-06-08 23:23:43','2015-06-18 09:09:21'),(23,'李四','dsc0948','e10adc3949ba59abbe56e057f20f883e','ls@126.com','2015-06-09 23:23:43','2015-06-16 10:44:16'),(1,'admin','Lin','e10adc3949ba59abbe56e057f20f883e','lin@qq.com','2015-06-18 15:56:07','2015-06-18 16:03:04');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
