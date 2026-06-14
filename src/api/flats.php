<?php
/**
 * Flats API Endpoint
 */

header('Content-Type: application/json');
require_once '../config/database.php';
require_once '../controllers/FlatController.php';

use App\Controllers\FlatController;

$controller = new FlatController($pdo);
$method = $_SERVER['REQUEST_METHOD'];

try {
    if ($method === 'GET') {
        $towerId = $_GET['tower_id'] ?? null;
        if (isset($_GET['id'])) {
            $data = $controller->show($_GET['id']);
        } elseif ($towerId) {
            $data = $controller->index($towerId);
        } else {
            throw new Exception('Tower ID is required');
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
