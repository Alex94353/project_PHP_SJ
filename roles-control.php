<?php
session_start();

require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/config/UserRoles.php';
require_once __DIR__ . '/classes/UserGroupManage.php';

$user = Auth::user();
if (!Auth::isRole(UserRoles::ADMIN)) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/');
    exit;
}

$groupService = new UserGroupManage();
$groups = $groupService->getAll();

$editId = $_POST['edit_id'] ?? null;
$editGroup = $editId ? $groupService->getById((int)$editId) : null;
?>

<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php'; ?>
    <title>Riadenie skupín používateľov</title>
</head>
<body>
<?php require_once __DIR__ . '/parts/header.php'; ?>
<section class="main">
    <div class="container mt-4">
        <?php require_once __DIR__ . '/parts/menu.php'; ?>
        <div class="row">
            <div class="col">
                <h2 class="display-6 mb-3">Riadenie skupín používateľov</h2>

                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Názov skupiny</th>
                            <th>Vytvorená</th>
                            <th>Upravená</th>
                            <th>Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($groups as $group): ?>
                        <?php if ($editGroup && $editGroup['id'] == $group['id']): ?>
                            <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/groups/updateUserGroupProcess.php">
                                <tr>
                                    <td>
                                        <input type="number" name="id" value="<?= $group['id'] ?>" class="form-control" required min="1">
                                        <input type="hidden" name="old_id" value="<?= $group['id'] ?>">
                                    </td>
                                    <td><input type="text" name="label" value="<?= $group['label'] ?>" class="form-control" required></td>
                                    <td><?= $group['created_at'] ?></td>
                                    <td><?= $group['updated_at'] ?></td>
                                    <td>
                                        <button type="submit" class="btn btn-sm btn-success">Uložiť</button>
                                        <a href="roles-control.php" class="btn btn-sm btn-secondary">Zrušiť</a>
                                    </td>
                                </tr>
                            </form>
                        <?php else: ?>
                            <tr>
                                <td><?= $group['id'] ?></td>
                                <td><?= $group['label'] ?></td>
                                <td><?= $group['created_at'] ?></td>
                                <td><?= $group['updated_at'] ?></td>
                                <td>
                                    <form method="POST" class="d-inline">
                                        <input type="hidden" name="edit_id" value="<?= $group['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-primary">✏</button>
                                    </form>
                                    <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/groups/deleteUserGroupProcess.php" class="d-inline">
                                        <input type="hidden" name="id" value="<?= $group['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-outline-danger">🗑</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    
                    <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/groups/createUserGroupProcess.php">
                        <tr>
                            <td><input type="number" name="id" class="form-control" required></td>
                            <td><input type="text" name="label" class="form-control" placeholder="Názov skupiny" required></td>
                            <td colspan="2"></td>
                            <td><button type="submit" class="btn btn-sm btn-primary">Pridať</button></td>
                        </tr>
                    </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/parts/scripts.php'; ?>
</body>
</html>
