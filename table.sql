CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL auto_increment,
  `postid` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `name` varchar(100) collate utf8_unicode_ci NOT NULL,
  `email` varchar(150) collate utf8_unicode_ci NOT NULL,
  `website` varchar(150) collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci NOT NULL,
  `dateline` int(11) NOT NULL,
  `approved` enum('approved','unapproved') collate utf8_unicode_ci NOT NULL default 'unapproved',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `title` varchar(250) collate utf8_unicode_ci default NULL,
  `slug` varchar(300) collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `body` text collate utf8_unicode_ci,
  `preview` text collate utf8_unicode_ci NOT NULL,
  `dateline` datetime default NULL,
  `modified` datetime default NULL,
  `commentcount` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=43 ;

CREATE TABLE IF NOT EXISTS `relations` (
  `id` int(11) NOT NULL auto_increment,
  `postid` int(11) NOT NULL,
  `tag` varchar(50) collate utf8_unicode_ci NOT NULL,
  `tagslug` varchar(50) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=91 ;

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) collate utf8_unicode_ci NOT NULL,
  `email` varchar(100) collate utf8_unicode_ci NOT NULL,
  `password` varchar(32) collate utf8_unicode_ci NOT NULL,
  `joindate` int(11) NOT NULL,
  `group` enum('admin','user') collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

