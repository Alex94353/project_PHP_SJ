<?php

require_once __DIR__ . '/connect.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    die('Nesprávna metóda požiadavky');
}

$title = $_POST['title'];
$description = $_POST['description'];
$image = $_FILES['image'];

$user_id = 1;
$tag_id = 3;

$path = __DIR__ . '/../uploads';
$filename = uniqid() . '-' . $image['name'];

if (!is_dir($path)) {
    mkdir($path);
}

move_uploaded_file($image['tmp_name'], "$path/$filename");

$query = $conn->prepare("INSERT INTO `tickets` (`title`, `description`, `image`, `tag_id`, `user_id`) 
                      VALUES (:title, :description, :image, :tag_id, :user_id)");

try {
    $query->execute([
        'title' => $title,
        'description' => $description,
        'image' => "uploads/$filename",
        'tag_id' => $tag_id,
        'user_id' => $user_id
    ]);
    header('Location: /project_PHP_SJ/project_PHP_SJ/my-tickets.php');
} catch (\PDOException $exception) {
    die("Chyba uloženia: " .  $e->getMessage());
}
