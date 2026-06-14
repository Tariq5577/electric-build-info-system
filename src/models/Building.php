<?php
/**
 * Building Model
 */

namespace App\Models;

class Building {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Get all buildings
     */
    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM buildings ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    /**
     * Get building by ID
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM buildings WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Create building
     */
    public function create($name, $address = '', $phone = '') {
        $stmt = $this->pdo->prepare(
            'INSERT INTO buildings (name, address, phone, created_at) VALUES (?, ?, ?, NOW())'
        );
        return $stmt->execute([$name, $address, $phone]);
    }

    /**
     * Update building
     */
    public function update($id, $name, $address = '', $phone = '') {
        $stmt = $this->pdo->prepare(
            'UPDATE buildings SET name = ?, address = ?, phone = ?, updated_at = NOW() WHERE id = ?'
        );
        return $stmt->execute([$name, $address, $phone, $id]);
    }

    /**
     * Delete building
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM buildings WHERE id = ?');
        return $stmt->execute([$id]);
    }

    /**
     * Get building with towers and flats count
     */
    public function getBuildingStats($id) {
        $stmt = $this->pdo->prepare(
            'SELECT b.*, COUNT(DISTINCT t.id) as tower_count, COUNT(DISTINCT f.id) as flat_count
             FROM buildings b
             LEFT JOIN towers t ON b.id = t.building_id
             LEFT JOIN flats f ON t.id = f.tower_id
             WHERE b.id = ?
             GROUP BY b.id'
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
