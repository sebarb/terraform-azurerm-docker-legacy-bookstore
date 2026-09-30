-- Schema MySQL reconstruita din codul PHP al proiectului "librarie"
-- 2026-09-24
-- NOTA: datele originale nu pot fi recuperate din fisierele disponibile.
-- Schema de mai jos foloseste coloanele demonstrate de interogarile existente.

CREATE DATABASE IF NOT EXISTS `librarie`
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_romanian_ci;
USE `librarie`;

SET FOREIGN_KEY_CHECKS=0;
DROP TABLE IF EXISTS `comentarii`;
DROP TABLE IF EXISTS `vanzari`;
DROP TABLE IF EXISTS `carti`;
DROP TABLE IF EXISTS `autori`;
DROP TABLE IF EXISTS `domenii`;
DROP TABLE IF EXISTS `admin`;
SET FOREIGN_KEY_CHECKS=1;

CREATE TABLE `autori` (
  `id_autor` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nume_autor` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_autor`),
  KEY `idx_autori_nume` (`nume_autor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;

CREATE TABLE `domenii` (
  `id_domeniu` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nume_domeniu` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id_domeniu`),
  KEY `idx_domenii_nume` (`nume_domeniu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;

CREATE TABLE `carti` (
  `id_carte` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_autor` INT UNSIGNED NOT NULL,
  `id_domeniu` INT UNSIGNED NOT NULL,
  `titlu` VARCHAR(255) NOT NULL,
  `descriere` TEXT NOT NULL,
  `pret` DECIMAL(10,2) NOT NULL DEFAULT 0.00,
  `data` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_carte`),
  KEY `idx_carti_autor` (`id_autor`),
  KEY `idx_carti_domeniu` (`id_domeniu`),
  KEY `idx_carti_data` (`data`),
  CONSTRAINT `fk_carti_autori` FOREIGN KEY (`id_autor`) REFERENCES `autori` (`id_autor`),
  CONSTRAINT `fk_carti_domenii` FOREIGN KEY (`id_domeniu`) REFERENCES `domenii` (`id_domeniu`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;

CREATE TABLE `comentarii` (
  `id_comentariu` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_carte` INT UNSIGNED NOT NULL,
  `nume_utilizator` VARCHAR(255) NOT NULL,
  `adresa_email` VARCHAR(255) NOT NULL,
  `comentariu` TEXT NOT NULL,
  PRIMARY KEY (`id_comentariu`),
  KEY `idx_comentarii_carte` (`id_carte`),
  CONSTRAINT `fk_comentarii_carti` FOREIGN KEY (`id_carte`) REFERENCES `carti` (`id_carte`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;

CREATE TABLE `vanzari` (
  `id_vanzare` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `id_carte` INT UNSIGNED NOT NULL,
  `nr_buc` INT UNSIGNED NOT NULL DEFAULT 1,
  PRIMARY KEY (`id_vanzare`),
  KEY `idx_vanzari_carte` (`id_carte`),
  CONSTRAINT `fk_vanzari_carti` FOREIGN KEY (`id_carte`) REFERENCES `carti` (`id_carte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;

CREATE TABLE `admin` (
  `id_admin` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_nume` VARCHAR(100) NOT NULL,
  `admin_parola` VARCHAR(255) NOT NULL COMMENT 'password_hash; login-ul accepta temporar si MD5 vechi si il migreaza',
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `uq_admin_nume` (`admin_nume`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_romanian_ci;



