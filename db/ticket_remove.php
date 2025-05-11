<?php
session_start();
require_once __DIR__ . '/connect.php';
$access = require __DIR__ . '/access.php';


if (!isset($_SESSION['user'])) {
    die('Nepovoleny pristup');
}

$id = $_POST['id'];


$query = $conn->prepare("SELECT user_id FROM `tickets` WHERE `id` = :id");
$query->execute(['id' => $id]);
$ticket = $query->fetch();

if (!$ticket) {
    die('Žiadosť nebola nájdená.');
}


$query = $conn->prepare("SELECT * FROM `users` WHERE `id` = :id");
$query->execute(['id' => $_SESSION['user']]);
$user = $query->fetch();

$isAdmin = (int)$user['group_id'] === $access['admin_user_group'];
$isOwner = $ticket['user_id'] === $_SESSION['user'];

if (!$isAdmin && !$isOwner) {
    die('Nemate opravnenie na odstranenie tejto poziadavky');
}


$query = $conn->prepare("DELETE FROM `tickets` WHERE `id` = :id");
$query->execute(['id' => $id]);


if ($isAdmin) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/tickets-control.php');
} else {
    header("Location: /project_PHP_SJ/project_PHP_SJ/my-tickets.php");
}
exit;