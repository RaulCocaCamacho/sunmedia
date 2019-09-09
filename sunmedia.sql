-- Adminer 4.7.1 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `x` int(11) NOT NULL,
  `y` int(11) NOT NULL,
  `z` int(11) NOT NULL,
  `ad_status_id` int(11) NOT NULL DEFAULT '2',
  `component_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_status_id` (`ad_status_id`),
  KEY `component_id` (`component_id`),
  CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`ad_status_id`) REFERENCES `ad_statuses` (`id`),
  CONSTRAINT `ads_ibfk_6` FOREIGN KEY (`component_id`) REFERENCES `components` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `ad_statuses`;
CREATE TABLE `ad_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `ad_statuses` (`id`, `name`) VALUES
(1,	'published'),
(2,	'stopped'),
(3,	'publishing');

DROP TABLE IF EXISTS `components`;
CREATE TABLE `components` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_type_id` int(11) NOT NULL,
  `link` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `format` varchar(10) CHARACTER SET latin1 DEFAULT NULL,
  `weight` int(11) DEFAULT NULL,
  `text` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `component_type_id` (`component_type_id`),
  CONSTRAINT `components_ibfk_1` FOREIGN KEY (`component_type_id`) REFERENCES `component_types` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `component_types`;
CREATE TABLE `component_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `component_types` (`id`, `name`) VALUES
(1,	'imagen'),
(2,	'video'),
(3,	'texto');

-- 2019-09-09 17:19:32
