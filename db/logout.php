<?php
require_once __DIR__ . '/connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    unset($_SESSION['user']);
    session_destroy();
    header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
} else {
    echo 'Error';
    die();
}
