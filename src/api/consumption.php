<?php
/**
 * Consumption API Endpoint
 */

header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../controllers/ConsumptionController.php';

use App\Controllers\ConsumptionController;

$controller = new ConsumptionController($pdo, ELECTRICITY_RATE);
$method = $_SERVER['REQUEST_METHOD'];
$action = $_GET['action'] ?? null;

try {
    if ($method === 'GET') {
        $flatId = $_GET['flat_id'] ?? null;
        $month = $_GET['month'] ?? null;
        $year = $_GET['year'] ?? null;
        $towerId = $_GET['tower_id'] ?? null;
        $buildingId = $_GET['building_id'] ?? null;

        if ($action === 'consumption' && $flatId && $month && $year) {
            $result = $controller->getConsumption($flatId, $month, $year);
            echo json_encode($result);
        } elseif ($action === 'bill' && $flatId && $month && $year) {
            $result = $controller->getBill($flatId, $month, $year);
            echo json_encode($result);
        } elseif ($action === 'tower' && $towerId && $month && $year) {
            $result = $controller->getTowerConsumption($towerId, $month, $year);
            echo json_encode($result);
        } elseif ($action === 'building' && $buildingId && $month && $year) {
            $result = $controller->getBuildingConsumption($buildingId, $month, $year);
            echo json_encode($result);
        } else {
            throw new Exception('Invalid parameters');
        }
    } elseif ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        if ($action === 'record') {
            $result = $controller->recordReading($input);
            echo json_encode($result);
        } else {
            throw new Exception('Invalid action');
        }
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
