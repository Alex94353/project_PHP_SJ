<?php
require_once __DIR__ . '/../../classes/Validator.php';
require_once __DIR__ . '/../../classes/UserGroupManage.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldId = (int) ($_POST['old_id'] ?? 0);
    $id = (int) ($_POST['id'] ?? 0);
    $label = $_POST['label'] ?? '';

    if (!Validator::checkRequired(['label' => $label], ['label'])) {
        die('Názov skupiny je povinný.');
    }

    if (!Validator::validateId($id) || !Validator::validateId($oldId)) {
        die('Neplatne ID');
    }

    $service = new UserGroupManage();

    if ($oldId !== $id) {
        
        $service->delete($oldId);
        $service->create([
            'id' => $id,
            'label' => $label
        ]);
    } else {
       
        $service->update($id, ['label' => $label]);
    }

    header('Location: /project_PHP_SJ/project_PHP_SJ/roles-control.php');
    exit;
} else {
    http_response_code(405);
    echo 'Method Not Allowed';
}
