-- Electric Build Information System Database Schema

CREATE DATABASE IF NOT EXISTS electric_build_info;
USE electric_build_info;

-- Buildings Table
CREATE TABLE IF NOT EXISTS buildings (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL UNIQUE,
    address VARCHAR(500),
    phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_name (name)
);

-- Towers Table
CREATE TABLE IF NOT EXISTS towers (
    id INT PRIMARY KEY AUTO_INCREMENT,
    building_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (building_id) REFERENCES buildings(id) ON DELETE CASCADE,
    UNIQUE KEY unique_tower_per_building (building_id, name),
    INDEX idx_building_id (building_id)
);

-- Flats Table
CREATE TABLE IF NOT EXISTS flats (
    id INT PRIMARY KEY AUTO_INCREMENT,
    tower_id INT NOT NULL,
    flat_number VARCHAR(50) NOT NULL,
    owner_name VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (tower_id) REFERENCES towers(id) ON DELETE CASCADE,
    UNIQUE KEY unique_flat_per_tower (tower_id, flat_number),
    INDEX idx_tower_id (tower_id),
    INDEX idx_flat_number (flat_number)
);

-- Consumption Table
CREATE TABLE IF NOT EXISTS consumption (
    id INT PRIMARY KEY AUTO_INCREMENT,
    flat_id INT NOT NULL,
    current_reading DECIMAL(10, 2) NOT NULL,
    month INT NOT NULL,
    year INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (flat_id) REFERENCES flats(id) ON DELETE CASCADE,
    UNIQUE KEY unique_reading_per_month (flat_id, month, year),
    INDEX idx_flat_id (flat_id),
    INDEX idx_month_year (month, year)
);

-- Audit Log Table
CREATE TABLE IF NOT EXISTS audit_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    action VARCHAR(50) NOT NULL,
    entity_type VARCHAR(50) NOT NULL,
    entity_id INT,
    old_values JSON,
    new_values JSON,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_created_at (created_at),
    INDEX idx_entity_type (entity_type)
);

-- Create Indexes for better performance
CREATE INDEX idx_consumption_flat_year_month ON consumption(flat_id, year, month);
CREATE INDEX idx_towers_building ON towers(building_id);
CREATE INDEX idx_flats_tower ON flats(tower_id);
