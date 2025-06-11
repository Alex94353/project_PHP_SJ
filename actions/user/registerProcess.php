<?php
require_once '../../classes/Validator.php';
require_once '../../classes/Register.php';
require_once '../../config/UserRoles.php';


$data = [
    'email' => $_POST['email'] ?? '',
    'first_name' => $_POST['first_name'] ?? '',
    'last_name' => $_POST['last_name'] ?? '',
    'date_of_birth' => $_POST['date_of_birth'] ?? '',
    'password' => $_POST['password'] ?? '',
    'password_confirmation' => $_POST['password_confirmation'] ?? ''
];


if (!Validator::checkRequired($data, [
    'email',
    'first_name',
    'last_name',
    'date_of_birth',
    'password',
    'password_confirmation'
])) {
    die('Vsetky polia su povinne');
}

if (!Validator::checkPasswordConfirmation($data['password'], $data['password_confirmation'])) {
    die('Hesla sa nezhoduju');
}


$register = new Register();
$success = $register->registerUser(
    $data['email'],
    $data['first_name'],
    $data['last_name'],
    $data['date_of_birth'],
    $data['password'],
    UserRoles::DEFAULT_ROLE
);


if ($success) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
    exit;
} else {
    die('Registracia chybala');
}


