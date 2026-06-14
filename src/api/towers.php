<?php
/**
 * Towers API Endpoint
 */

header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../controllers/TowerController.php';

use App\Controllers\TowerController;

$controller = new TowerController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($method === 'GET') {
        $buildingId = $_GET['building_id'] ?? null;
        if (isset($_GET['id'])) {
            $data = $controller->show($_GET['id']);
        } elseif ($buildingId) {
            $data = $controller->index($buildingId);
        } else {
            throw new Exception('Building ID is required');
        }
        echo json_encode(['success' => true, 'data' => $data]);
    } elseif ($method === 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $result = $controller->store($input);
        echo json_encode($result);
    } elseif ($method === 'PUT') {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        $result = $controller->update($id, $input);
        echo json_encode($result);
    } elseif ($method === 'DELETE') {
        $input = json_decode(file_get_contents('php://input'), true);
        $id = $input['id'] ?? null;
        $result = $controller->destroy($id);
        echo json_encode($result);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => $e->getMessage()]);
}
