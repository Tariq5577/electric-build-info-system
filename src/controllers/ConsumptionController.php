<?php
/**
 * Consumption Controller
 */

namespace App\Controllers;

use App\Models\Consumption;

class ConsumptionController {
    private $model;
    private $unitRate;

    public function __construct($pdo, $unitRate = 0.12) {
        $this->model = new Consumption($pdo);
        $this->unitRate = $unitRate;
    }

    /**
     * Record reading
     */
    public function recordReading($data) {
        $flatId = $data['flat_id'] ?? null;
        $currentReading = $data['current_reading'] ?? null;
        $month = $data['month'] ?? null;
        $year = $data['year'] ?? null;

        if (!$flatId || !$currentReading || !$month || !$year) {
            return ['success' => false, 'message' => 'All fields are required'];
        }

        $result = $this->model->recordReading($flatId, $currentReading, $month, $year);
        return ['success' => $result, 'message' => $result ? 'Reading recorded successfully' : 'Failed to record reading'];
    }

    /**
     * Get consumption for flat
     */
    public function getConsumption($flatId, $month, $year) {
        $consumption = $this->model->calculateConsumption($flatId, $month, $year);
        return $consumption ? ['success' => true, 'data' => $consumption] : ['success' => false, 'message' => 'No consumption data found'];
    }

    /**
     * Get bill for flat
     */
    public function getBill($flatId, $month, $year) {
        $bill = $this->model->calculateBill($flatId, $month, $year, $this->unitRate);
        return $bill ? ['success' => true, 'data' => $bill] : ['success' => false, 'message' => 'No bill data found'];
    }

    /**
     * Get tower consumption
     */
    public function getTowerConsumption($towerId, $month, $year) {
        $data = $this->model->getTowerConsumption($towerId, $month, $year);
        return ['success' => true, 'data' => $data];
    }

    /**
     * Get building consumption
     */
    public function getBuildingConsumption($buildingId, $month, $year) {
        $data = $this->model->getBuildingConsumption($buildingId, $month, $year);
        return ['success' => true, 'data' => $data];
    }
}
