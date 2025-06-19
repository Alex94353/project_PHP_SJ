<?php
require_once __DIR__ . '/../../classes/UserManage.php';
require_once __DIR__ . '/../../classes/Validator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

    if (!Validator::validateId($id)) {
        die('Neplate ID');
    }


    $userService = new UserService();

    if ($userService->delete($id)) {
        header('Location: /project_PHP_SJ/project_PHP_SJ/users-control.php');
        exit;
    } else {
        die('Nepodarilo sa vymazat pouzivatela');
    }
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
