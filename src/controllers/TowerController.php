<?php
/**
 * Tower Controller
 */

namespace App\Controllers;

use App\Models\Tower;

class TowerController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Tower($pdo);
    }

    /**
     * Get towers by building
     */
    public function index($buildingId) {
        return $this->model->getByBuilding($buildingId);
    }

    /**
     * Get tower details
     */
    public function show($id) {
        return $this->model->getTowerStats($id);
    }

    /**
     * Create tower
     */
    public function store($data) {
        $buildingId = $data['building_id'] ?? null;
        $name = $data['name'] ?? null;

        if (!$buildingId || !$name) {
            return ['success' => false, 'message' => 'Building ID and tower name are required'];
        }

        $result = $this->model->create($buildingId, $name);
        return ['success' => $result, 'message' => $result ? 'Tower created successfully' : 'Failed to create tower'];
    }

    /**
     * Update tower
     */
    public function update($id, $data) {
        $name = $data['name'] ?? null;

        if (!$name) {
            return ['success' => false, 'message' => 'Tower name is required'];
        }

        $result = $this->model->update($id, $name);
        return ['success' => $result, 'message' => $result ? 'Tower updated successfully' : 'Failed to update tower'];
    }

    /**
     * Delete tower
     */
    public function destroy($id) {
        $result = $this->model->delete($id);
        return ['success' => $result, 'message' => $result ? 'Tower deleted successfully' : 'Failed to delete tower'];
    }
}
