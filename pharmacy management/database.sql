-- ================================================================
-- Pharmacy Management System - Database
-- ================================================================

CREATE DATABASE IF NOT EXISTS library_db
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE library_db;

CREATE TABLE IF NOT EXISTS admins (

    id INT AUTO_INCREMENT PRIMARY KEY,

    username VARCHAR(50) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS pharmacist (

    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100) NOT NULL,

    contact VARCHAR(20) NOT NULL,

    username VARCHAR(50) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL

) ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS medicine (

    id INT AUTO_INCREMENT PRIMARY KEY,

    medicine_name VARCHAR(200) NOT NULL,

    company VARCHAR(100) NOT NULL,

    quantity INT NOT NULL DEFAULT 0,

    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,

    pharmacist_id INT NULL,

    FOREIGN KEY (pharmacist_id)
    REFERENCES pharmacist(id)
    ON DELETE SET NULL

) ENGINE=InnoDB;