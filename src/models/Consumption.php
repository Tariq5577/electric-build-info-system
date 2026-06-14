<?php
/**
 * Consumption Model
 */

namespace App\Models;

class Consumption {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    /**
     * Record consumption reading
     */
    public function recordReading($flatId, $currentReading, $month, $year) {
        $stmt = $this->pdo->prepare(
            'INSERT INTO consumption (flat_id, current_reading, month, year, created_at) 
             VALUES (?, ?, ?, ?, NOW())'
        );
        return $stmt->execute([$flatId, $currentReading, $month, $year]);
    }

    /**
     * Get consumption by flat
     */
    public function getByFlat($flatId) {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM consumption WHERE flat_id = ? ORDER BY year DESC, month DESC'
        );
        $stmt->execute([$flatId]);
        return $stmt->fetchAll();
    }

    /**
     * Get consumption for specific month
     */
    public function getByFlatAndMonth($flatId, $month, $year) {
        $stmt = $this->pdo->prepare(
            'SELECT * FROM consumption WHERE flat_id = ? AND month = ? AND year = ?'
        );
        $stmt->execute([$flatId, $month, $year]);
        return $stmt->fetch();
    }

    /**
     * Get previous month reading
     */
    public function getPreviousReading($flatId, $month, $year) {
        if ($month == 1) {
            $prevMonth = 12;
            $prevYear = $year - 1;
        } else {
            $prevMonth = $month - 1;
            $prevYear = $year;
        }

        $stmt = $this->pdo->prepare(
            'SELECT * FROM consumption WHERE flat_id = ? AND month = ? AND year = ?'
        );
        $stmt->execute([$flatId, $prevMonth, $prevYear]);
        return $stmt->fetch();
    }

    /**
     * Calculate consumption (current - previous)
     */
    public function calculateConsumption($flatId, $month, $year) {
        $current = $this->getByFlatAndMonth($flatId, $month, $year);
        $previous = $this->getPreviousReading($flatId, $month, $year);

        if (!$current) return null;

        $previousReading = $previous ? $previous['current_reading'] : 0;
        $consumption = $current['current_reading'] - $previousReading;

        return [
            'current_reading' => $current['current_reading'],
            'previous_reading' => $previousReading,
            'consumption_units' => $consumption,
            'month' => $month,
            'year' => $year
        ];
    }

    /**
     * Calculate bill for flat
     */
    public function calculateBill($flatId, $month, $year, $unitRate) {
        $consumption = $this->calculateConsumption($flatId, $month, $year);
        if (!$consumption) return null;

        $bill = $consumption['consumption_units'] * $unitRate;

        return [
            'consumption_units' => $consumption['consumption_units'],
            'unit_rate' => $unitRate,
            'total_amount' => $bill,
            'month' => $month,
            'year' => $year
        ];
    }

    /**
     * Get consumption for tower (all flats)
     */
    public function getTowerConsumption($towerId, $month, $year) {
        $stmt = $this->pdo->prepare(
            'SELECT f.id, f.flat_number, f.owner_name, c.current_reading
             FROM flats f
             LEFT JOIN consumption c ON f.id = c.flat_id AND c.month = ? AND c.year = ?
             WHERE f.tower_id = ?
             ORDER BY f.flat_number ASC'
        );
        $stmt->execute([$month, $year, $towerId]);
        return $stmt->fetchAll();
    }

    /**
     * Get consumption for building (all towers)
     */
    public function getBuildingConsumption($buildingId, $month, $year) {
        $stmt = $this->pdo->prepare(
            'SELECT t.id, t.name as tower_name, COUNT(f.id) as flat_count
             FROM towers t
             LEFT JOIN flats f ON t.id = f.tower_id
             WHERE t.building_id = ?
             GROUP BY t.id, t.name'
        );
        $stmt->execute([$buildingId]);
        return $stmt->fetchAll();
    }
}
