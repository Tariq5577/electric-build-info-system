<?php
/**
 * Building Controller
 */

namespace App\Controllers;

use App\Models\Building;

class BuildingController {
    private $model;

    public function __construct($pdo) {
        $this->model = new Building($pdo);
    }

    /**
     * Get all buildings
     */
    public function index() {
        return $this->model->getAll();
    }

    /**
     * Get building details
     */
    public function show($id) {
        return $this->model->getBuildingStats($id);
    }

    /**
     * Create building
     */
    public function store($data) {
        $name = $data['name'] ?? null;
        $address = $data['address'] ?? '';
        $phone = $data['phone'] ?? '';

        if (!$name) {
            return ['success' => false, 'message' => 'Building name is required'];
        }

        $result = $this->model->create($name, $address, $phone);
        return ['success' => $result, 'message' => $result ? 'Building created successfully' : 'Failed to create building'];
    }

    /**
     * Update building
     */
    public function update($id, $data) {
        $name = $data['name'] ?? null;
        $address = $data['address'] ?? '';
        $phone = $data['phone'] ?? '';

        if (!$name) {
            return ['success' => false, 'message' => 'Building name is required'];
        }

        $result = $this->model->update($id, $name, $address, $phone);
        return ['success' => $result, 'message' => $result ? 'Building updated successfully' : 'Failed to update building'];
    }

    /**
     * Delete building
     */
    public function destroy($id) {
        $result = $this->model->delete($id);
        return ['success' => $result, 'message' => $result ? 'Building deleted successfully' : 'Failed to delete building'];
    }
}
