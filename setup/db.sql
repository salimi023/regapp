/* 
DB creation
*/
DROP DATABASE IF EXISTS vj_landing;

CREATE DATABASE IF NOT EXISTS vj_landing
DEFAULT CHARACTER SET utf8mb4
DEFAULT COLLATE utf8mb4_general_ci;

USE vj_landing;

/*
Tables
*/
DROP TABLE IF EXISTS `applicant`;

CREATE TABLE `applicant` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `selected_date` date NOT NULL,
  `consent` int NOT NULL DEFAULT '1',
  `status` int NOT NULL DEFAULT '1',
  `reg_date` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci