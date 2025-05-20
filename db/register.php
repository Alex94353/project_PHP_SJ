<?php
// require_once __DIR__ . '/connect.php';


// $email = $_POST['email'] ?? '';
// $firstName = $_POST['first_name'] ?? '';
// $lastName = $_POST['last_name'] ?? '';
// $dateOfBirth = $_POST['date_of_birth'] ?? '';
// $password = $_POST['password'] ?? '';
// $passwordConfirmation = $_POST['password_confirmation'] ?? '';



// if (
//     empty($email) || empty($firstName) || empty($lastName) ||
//     empty($dateOfBirth) || empty($password) || empty($passwordConfirmation)
// ) {
//     die('Vsetky polia su povinne');
// }


// if ($password !== $passwordConfirmation) {
//     die('Hesla sa nezhoduju');
// }

// $query = $conn->prepare("INSERT INTO users (email, first_name, last_name, date_of_birth, password) 
//                          VALUES (:email, :first_name, :last_name, :date_of_birth, :password)");

// try {
//     $query->execute([
//         'email' => $email,
//         'first_name' => $firstName,
//         'last_name' => $lastName,
//         'date_of_birth' => $dateOfBirth,
//         'password' => password_hash($password, PASSWORD_BCRYPT)
//     ]);
//     header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
//     exit;
// } catch (\PDOException $exception) {
//     die("Chyba pri registrácii: " . $exception->getMessage());
// }
