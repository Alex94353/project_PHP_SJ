<?php
require_once __DIR__ . '/../../classes/TagService.php';
require_once __DIR__ . '/../../classes/Validator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];
    $label = $_POST['label'];
    $background = $_POST['background'];
    $color = $_POST['color'];

    if (!Validator::validateId($id)) {
        die('Neplatne ID');
    }


    $tagService = new TagService();
    if (!$tagService->exists($id)) {
        $tagService->create([
            'id' => $id,
            'label' => $label,
            'background' => $background,
            'color' => $color
        ]);
    }

    header('Location: /project_PHP_SJ/project_PHP_SJ/tags-control.php');
    exit;
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}