CREATE TABLE `student` (
       `id` int(11) NOT NULL AUTO_INCREMENT,
       `name` varchar(100) NOT NULL,
       `identifier` char(10) NOT NULL,
       `email` varchar(50) NOT NULL,
       `phone` char(14) NOT NULL,
       `major` varchar(50) NOT NULL,
       `image` varchar(50) NOT NULL,
       `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
       PRIMARY KEY (`id`),
       UNIQUE KEY `identifier` (`identifier`),
       UNIQUE KEY `email` (`email`),
       UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1