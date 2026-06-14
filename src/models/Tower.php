<?php
/**
 * Tower Model
 */

namespace App\Models;

class Tower {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Get all towers
     */
    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM towers ORDER BY name ASC');
        return $stmt->fetchAll();
    }

    /**
     * Get towers by building
     */
    public function getByBuilding($buildingId) {
        $stmt = $this->pdo->prepare('SELECT * FROM towers WHERE building_id = ? ORDER BY name ASC');
        $stmt->execute([$buildingId]);
        return $stmt->fetchAll();
    }

    /**
     * Get tower by ID
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM towers WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Create tower
     */
    public function create($buildingId, $name) {
        $stmt = $this->pdo->prepare(
            'INSERT INTO towers (building_id, name, created_at) VALUES (?, ?, NOW())'
        );
        return $stmt->execute([$buildingId, $name]);
    }

    /**
     * Update tower
     */
    public function update($id, $name) {
        $stmt = $this->pdo->prepare(
            'UPDATE towers SET name = ?, updated_at = NOW() WHERE id = ?'
        );
        return $stmt->execute([$name, $id]);
    }

    /**
     * Delete tower
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM towers WHERE id = ?');
        return $stmt->execute([$id]);
    }

    /**
     * Get tower with flats count
     */
    public function getTowerStats($id) {
        $stmt = $this->pdo->prepare(
            'SELECT t.*, COUNT(f.id) as flat_count
             FROM towers t
             LEFT JOIN flats f ON t.id = f.tower_id
             WHERE t.id = ?
             GROUP BY t.id'
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
