<?php
session_start();
require_once __DIR__ . '/connect.php';

$email = $_POST['email'];
$password = $_POST['password'];

$query = $conn->prepare("SELECT * FROM `users` WHERE `email` = :email");
$query->execute(['email' => $email]);
$user = $query->fetch();


if (!$user) {
    echo 'not user';
    die();
}

if (!password_verify($password, $user['password'])) {
    echo 'not confirm';
    die();
}

$_SESSION['user'] = $user['id'];

header('Location: /project_PHP_SJ/project_PHP_SJ');