<?php
require_once __DIR__ . '/../../classes/Auth.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth();
    $auth->logout();
    header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
    exit();
} else {
    http_response_code(405);
    echo 'Invalid request method.';
    exit();
}

