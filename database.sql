
CREATE TABLE IF NOT EXISTS `tiny_url_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `long_url` varchar(256) NOT NULL,
  `tiny_url` varchar(200) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
