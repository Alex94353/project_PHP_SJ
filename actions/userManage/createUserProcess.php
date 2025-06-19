<?php
require_once __DIR__ . '/../../classes/Validator.php';
require_once __DIR__ . '/../../classes/Register.php';
require_once __DIR__ . '/../../config/UserRoles.php';

$data = [
    'email' => $_POST['email'] ?? '',
    'first_name' => $_POST['first_name'] ?? '',
    'last_name' => $_POST['last_name'] ?? '',
    'date_of_birth' => $_POST['date_of_birth'] ?? '',
    'password' => $_POST['password'] ?? '',
    'group_id' => $_POST['group_id'] ?? UserRoles::DEFAULT_ROLE
];


if (!Validator::checkRequired($data, [
    'email',
    'first_name',
    'last_name',
    'date_of_birth',
    'password',
    'group_id'
])) {
    die('Všetky polia sú povinné.');
}

$register = new Register();
$success = $register->registerUser(
    $data['email'],
    $data['first_name'],
    $data['last_name'],
    $data['date_of_birth'],
    $data['password'],
    $data['group_id']
);


if ($success) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/users-control.php');
    exit;
} else {
    die('Vytvorenie používateľa zlyhalo');
}
