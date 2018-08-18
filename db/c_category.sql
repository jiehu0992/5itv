
CREATE TABLE IF NOT EXISTS `c_category` (
  `catid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `catname` char(30) NOT NULL,
  PRIMARY KEY (`catid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk AUTO_INCREMENT=33 ;

--
-- 转存表中的数据 `c_category`
--

INSERT INTO `c_category` (`catid`,`parentid`, `catname`) VALUES
(1, 0, '关于我们'),
(2, 0, '新闻资讯'),
(3, 0, '产品展示'),
(4, 0, '招贤纳士'),
(5, 0, '营销网络'),
(6, 0, '在线留言'),
(7, 0, '联系方式'),
(8, 1, '公司简介'),
(9, 1, '企业文化'),
(10,2, '公司新闻'),
(11,2, '行业新闻'),
(12,3, '网站建设'),
(13,3, '软件开发'),
(14,3, '短信群发'),
(15,4, '招聘信息'),
(16,4, '人才理念'),
(17,4, '培训制度'),
(18,5, '网络地图'),
(19,5, '市场政策'),
(20,7, '联系方式'),
(21,7, '联系地图'),
(22,3, '网络推广'),
(23,3, '平面设计'),
(24,3, '虚拟主机'),
(28,0, '资料下载'),
(29,28, '产品资料'),
(30, 28, '其它资料'),
(31, 12, '777777777'),
(32, 31, '88888');
