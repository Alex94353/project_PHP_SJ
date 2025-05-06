<?php
require_once __DIR__ . '/connect.php';

$id = $_POST['id'];


$query = $conn->prepare("SELECT user_id FROM `tickets` WHERE `id` = :id");
$query->execute(['id' => $id]);
$ticket = $query->fetch(PDO::FETCH_ASSOC);

if (!$ticket) {
    die('Žiadosť nebola nájdená.');
}


$query = $conn->prepare("DELETE FROM `tickets` WHERE `id` = :id");
$query->execute(['id' => $id]);


header("Location: /project_PHP_SJ/project_PHP_SJ/my-tickets.php");
exit;