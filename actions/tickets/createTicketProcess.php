<?php
session_start();

require_once __DIR__ . '/../../classes/Validator.php';
require_once __DIR__ . '/../../classes/TicketService.php';
require_once __DIR__ . '/../../config/TicketStatus.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    exit('Method Not Allowed');
}

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    exit('Unauthorized');
}

$image = $_FILES['image'] ?? null;

$data = [
    'title' => $_POST['title'] ?? '',
    'description' => $_POST['description'] ?? '',
    'tag_id' => TicketStatus::CREATED ?? null,
    'user_id' => $_SESSION['user']
];

try {
    Validator::validateImage($image);
    Validator::checkRequired($data, ['title', 'description', 'tag_id', 'user_id']);

    $ticketService = new TicketService();
    $ticketService->create($data, $image);

    header('Location: /project_PHP_SJ/project_PHP_SJ/my-tickets.php');
    exit();
} catch (Exception $e) {
    http_response_code(500);
    echo 'Error creating ticket: ' . $e->getMessage();
    exit();
}
