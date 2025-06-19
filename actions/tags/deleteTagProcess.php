<?php
require_once __DIR__ . '/../../classes/TagService.php';
require_once __DIR__ . '/../../classes/Validator.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)$_POST['id'];

    if (!Validator::validateId($id)) {
        die('Neplatne ID');
    }

    $tagService = new TagService();
    $tagService->delete($id);

    header('Location: /project_PHP_SJ/project_PHP_SJ/tags-control.php');
    exit;
} else {
    http_response_code(405);
    echo "Method Not Allowed";
}