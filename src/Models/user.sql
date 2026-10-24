DROP DATABASE IF EXISTS `gestion_utilisateurs`;
CREATE DATABASE `gestion_utilisateurs` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `gestion_utilisateurs`;

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricule` varchar(255) DEFAULT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo` longblob DEFAULT NULL,
  `etat` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `date_modif` date DEFAULT NULL,
  `date_archive` date DEFAULT NULL,
  `role_etat` int(11) NOT NULL,
  `role` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `audit_logs`;
CREATE TABLE `audit_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL, -- L'administrateur ou le contrôleur concerné
  `action` varchar(255) NOT NULL, -- Ex: "VALIDATION_UTILISATEUR", "MODIFICATION_ROLE"
  `details` text DEFAULT NULL,
  `date_action` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`user_id`) REFERENCES `users`(`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

