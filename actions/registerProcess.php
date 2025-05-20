<?php
require_once '../classes/Validator.php';
require_once '../classes/Register.php';
require_once '../config/UserRoles.php';


$data = [
    'email' => $_POST['email'] ?? '',
    'firstName' => $_POST['first_name'] ?? '',
    'lastName' => $_POST['last_name'] ?? '',
    'dateOfBirth' => $_POST['date_of_birth'] ?? '',
    'password' => $_POST['password'] ?? '',
    'passwordConfirmation' => $_POST['password_confirmation'] ?? ''
];


if (!Validator::checkRequired($data, ['email', 'firstName', 'lastName', 'dateOfBirth', 'password', 'passwordConfirmation'])) {
    die('Vsetky polia su povinne');
}

if (!Validator::checkPasswordConfirmation($data['password'], $data['passwordConfirmation'])) {
    die('Hesla sa nezhoduju');
}


$register = new Register();
$success = $register->registerUser(
    $data['email'],
    $data['firstName'],
    $data['lastName'],
    $data['dateOfBirth'],
    $data['password'],
    UserRoles::DEFAULT_ROLE
);

if ($success) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
    exit;
} else {
    die('Registracia chybala');
}


