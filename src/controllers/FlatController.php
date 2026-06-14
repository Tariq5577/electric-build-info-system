<?php
/**
 * Flat Controller
 */

namespace App\Controllers;

use App\Models\Flat;

class FlatController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Flat($pdo);
    }

    /**
     * Get flats by tower
     */
    public function index($towerId) {
        return $this->model->getByTower($towerId);
    }

    /**
     * Get flat details
     */
    public function show($id) {
        return $this->model->getFlatDetails($id);
    }

    /**
     * Create flat
     */
    public function store($data) {
        $towerId = $data['tower_id'] ?? null;
        $flatNumber = $data['flat_number'] ?? null;
        $ownerName = $data['owner_name'] ?? '';

        if (!$towerId || !$flatNumber) {
            return ['success' => false, 'message' => 'Tower ID and flat number are required'];
        }

        $result = $this->model->create($towerId, $flatNumber, $ownerName);
        return ['success' => $result, 'message' => $result ? 'Flat created successfully' : 'Failed to create flat'];
    }

    /**
     * Update flat
     */
    public function update($id, $data) {
        $flatNumber = $data['flat_number'] ?? null;
        $ownerName = $data['owner_name'] ?? '';

        if (!$flatNumber) {
            return ['success' => false, 'message' => 'Flat number is required'];
        }

        $result = $this->model->update($id, $flatNumber, $ownerName);
        return ['success' => $result, 'message' => $result ? 'Flat updated successfully' : 'Failed to update flat'];
    }

    /**
     * Delete flat
     */
    public function destroy($id) {
        $result = $this->model->delete($id);
        return ['success' => $result, 'message' => $result ? 'Flat deleted successfully' : 'Failed to delete flat'];
    }
}
