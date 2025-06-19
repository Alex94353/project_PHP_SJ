<?php
require_once __DIR__ . '/../../classes/Validator.php';
require_once __DIR__ . '/../../classes/UserManage.php';


$data = [
    'id' => $_POST['id'] ?? '',
    'email' => $_POST['email'] ?? '',
    'first_name' => $_POST['first_name'] ?? '',
    'last_name' => $_POST['last_name'] ?? '',
    'date_of_birth' => $_POST['date_of_birth'] ?? '',
    'group_id' => $_POST['group_id'] ?? ''
];


if (!Validator::checkRequired($data, ['id', 'email', 'first_name', 'last_name', 'date_of_birth', 'group_id'])) {
    die('Vsetky polia su povinne');
}

$id = (int)$data['id'];
if (!Validator::validateId($id)) {
    die('Neplatne ID.');
}

$userService = new UserService();
$success = $userService->update($id, [
    'email' => $data['email'],
    'first_name' => $data['first_name'],
    'last_name' => $data['last_name'],
    'date_of_birth' => $data['date_of_birth'],
    'group_id' => $data['group_id']
]);

if ($success) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/users-control.php');
    exit;
} else {
    die('Aktualizacia zlyhala');
}
