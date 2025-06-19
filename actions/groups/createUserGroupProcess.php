<?php
require_once __DIR__ . '/../../classes/UserGroupManage.php';
require_once __DIR__ . '/../../classes/Validator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'id' => (int) ($_POST['id'] ?? 0),
        'label' => trim($_POST['label'] ?? '')
    ];

    
    if (!Validator::checkRequired($data, ['id', 'label']) || !Validator::validateId($data['id'])) {
        die('ID a nazov skupiny su povinne a musia byt platne');
    }

    $service = new UserGroupManage();
    $service->create($data);

    header('Location: /project_PHP_SJ/project_PHP_SJ/roles-control.php');
    exit;
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
