<?php
session_start();
require_once __DIR__ . '/connect.php';
$access = require __DIR__ . '/access.php';

if (!isset($_SESSION['user'])) {
    echo 'Error';
    die();
}

$id = $_POST['id'];
$tag = $_POST['tag'];


$query = $conn->prepare("SELECT * FROM `ticket_tags` WHERE `id` = :id");
$query->execute(['id' => $tag]);
$tagExists = $query->fetch();

if (!$tagExists) {
    echo 'Error';
    die();
}


$query = $conn->prepare("SELECT * FROM `users` WHERE `id` = :id");
$query->execute(['id' => $_SESSION['user']]);
$user = $query->fetch();


if ((int)$user['group_id'] === $access['admin_user_group']) {
    $query = $conn->prepare("UPDATE `tickets` SET `tag_id` = :tag WHERE `id` = :id");
    $query->execute([
        'tag' => $tag,
        'id' => $id
    ]);
}

header('Location: /project_PHP_SJ/project_PHP_SJ/tickets-control.php');
exit;
