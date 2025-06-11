<?php
session_start();
require_once '../../classes/Auth.php';
require_once '../../classes/TicketService.php';
require_once '../../config/UserRoles.php';

if (!isset($_SESSION['user'])) {
    http_response_code(403);
    exit('Unauthorized');
}

$id = (int) ($_POST['id'] ?? 0);
if ($id <= 0) {
    http_response_code(400);
    exit('Invalid ticket ID');
}

$ticketService = new TicketService();
$ticket = $ticketService->getTicketById($id);

if (!$ticket) {
    http_response_code(404);
    exit('Ticket not found');
}

$user = Auth::user();
if (!$ticketService->userCanManage($ticket, $user, UserRoles::ADMIN)) {
    http_response_code(403);
    exit('Access denied');
}

$ticketService->deleteTicket($id);

header('Location: /project_PHP_SJ/project_PHP_SJ/my-tickets.php');
exit();
