CREATE TABLE `pages` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `title` varchar(255) NOT NULL,

  `slug` varchar(255) NOT NULL,

  `content` text NOT NULL,

  PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `users` (

  `id` int(11) NOT NULL AUTO_INCREMENT,

  `username` varchar(255) NOT NULL,

  `password` varchar(255) NOT NULL,

  PRIMARY KEY (`id`)

) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4;

