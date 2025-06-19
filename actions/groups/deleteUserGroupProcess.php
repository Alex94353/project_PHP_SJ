<?php
require_once __DIR__ . '/../../classes/Validator.php';
require_once __DIR__ . '/../../classes/UserGroupManage.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int) ($_POST['id'] ?? 0);

    if (!Validator::validateId($id)) {
        die('Neplatne ID');
    }

    $service = new UserGroupManage();
    $service->delete($id);

    header('Location: /project_PHP_SJ/project_PHP_SJ/roles-control.php');
    exit;
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
