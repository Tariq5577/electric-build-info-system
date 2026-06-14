<?php
/**
 * Flat Model
 */

namespace App\Models;

class Flat {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Get all flats
     */
    public function getAll() {
        $stmt = $this->pdo->query('SELECT * FROM flats ORDER BY flat_number ASC');
        return $stmt->fetchAll();
    }

    /**
     * Get flats by tower
     */
    public function getByTower($towerId) {
        $stmt = $this->pdo->prepare('SELECT * FROM flats WHERE tower_id = ? ORDER BY flat_number ASC');
        $stmt->execute([$towerId]);
        return $stmt->fetchAll();
    }

    /**
     * Get flat by ID
     */
    public function getById($id) {
        $stmt = $this->pdo->prepare('SELECT * FROM flats WHERE id = ?');
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    /**
     * Create flat
     */
    public function create($towerId, $flatNumber, $ownerName = '') {
        $stmt = $this->pdo->prepare(
            'INSERT INTO flats (tower_id, flat_number, owner_name, created_at) VALUES (?, ?, ?, NOW())'
        );
        return $stmt->execute([$towerId, $flatNumber, $ownerName]);
    }

    /**
     * Update flat
     */
    public function update($id, $flatNumber, $ownerName = '') {
        $stmt = $this->pdo->prepare(
            'UPDATE flats SET flat_number = ?, owner_name = ?, updated_at = NOW() WHERE id = ?'
        );
        return $stmt->execute([$flatNumber, $ownerName, $id]);
    }

    /**
     * Delete flat
     */
    public function delete($id) {
        $stmt = $this->pdo->prepare('DELETE FROM flats WHERE id = ?');
        return $stmt->execute([$id]);
    }

    /**
     * Get flat with building and tower info
     */
    public function getFlatDetails($id) {
        $stmt = $this->pdo->prepare(
            'SELECT f.*, t.name as tower_name, b.name as building_name
             FROM flats f
             JOIN towers t ON f.tower_id = t.id
             JOIN buildings b ON t.building_id = b.id
             WHERE f.id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}
