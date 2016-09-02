CREATE DATABASE IF NOT EXISTS dhcp_admin;
USE dhcp_admin;

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS `tbl_user_info` (
  `user_info_id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `endereco` varchar(60) NOT NULL DEFAULT '6th and Jarbas',
  `cep` varchar(10) NOT NULL DEFAULT '58000-000',
  `empresa` varchar(60) NOT NULL DEFAULT 'DHCP-Admin',
  `codigo` varchar(42) NOT NULL DEFAULT 'FH498AJ',
  PRIMARY KEY (`user_info_id`),
  FOREIGN KEY (`u_id`) REFERENCES `tbl_users` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1;
