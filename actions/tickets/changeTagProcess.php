<?php
session_start();

require_once '../../classes/Auth.php';
require_once '../../classes/TicketService.php';
require_once '../../config/UserRoles.php';
require_once '../../classes/Validator.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    exit('Unauthorized');
}

$id = (int) ($_POST['id'] ?? 0);
$tagId = (int) ($_POST['tag'] ?? 0);

$data = ['id' => $id, 'tag_id' => $tagId];

try {
    Validator::checkRequired($data, ['id', 'tag_id']);

    $user = Auth::user();
    if (!Auth::isRole(UserRoles::ADMIN)) {
        http_response_code(403);
        exit('Access denied');
    }

    $ticketService = new TicketService();

    if (!$ticketService->tagExists($tagId)) {
        http_response_code(404);
        exit('Tag not found');
    }

    $ticketService->updateTag($id, $tagId);

    header('Location: /project_PHP_SJ/project_PHP_SJ/tickets-control.php');
    exit();
} catch (Exception $e) {
    http_response_code(500);
    echo 'Error: ' . $e->getMessage();
    exit();
}
