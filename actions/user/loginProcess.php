<?php
require_once __DIR__ . '/../../classes/Validator.php';
require_once __DIR__ . '/../../classes/Auth.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? ''
    ];
  

    if (!Validator::checkRequired($data, ['email', 'password'])) {
        die('Vsetky polia su povinne');
    }

    $auth = new Auth();

    if (!$auth->authenticate($data['email'], $data['password'])) {
        die('Invalid email or password');
        header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
        exit();
    }

    header('Location: /project_PHP_SJ/project_PHP_SJ/my-tickets.php');
    exit();
}
