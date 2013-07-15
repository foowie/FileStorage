CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_czech_ci NOT NULL,
  `directory` varchar(5) COLLATE utf8_czech_ci NOT NULL,
  `originalName` varchar(100) COLLATE utf8_czech_ci NOT NULL,
  `mime` varchar(30) COLLATE utf8_czech_ci NOT NULL,
  `size` int(11) NOT NULL COMMENT 'bytes',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;
