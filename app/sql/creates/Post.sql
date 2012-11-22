CREATE TABLE `post` (`id` int  auto_increment,
`created_at` datetime ,
`updated_at` datetime ,
`title` varchar(255) ,
`content` text ,
`owner_id` int ,
 PRIMARY KEY (id) );