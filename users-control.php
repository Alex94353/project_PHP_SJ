<?php 
session_start();

require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/config/UserRoles.php';
require_once __DIR__ . '/classes/UserManage.php';

$user = Auth::user();

if (!Auth::isRole(UserRoles::ADMIN)) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/');
    die();
}

$userService = new UserService();
$users = $userService->getAll();

$editId = isset($_POST['edit_id']) ? (int)$_POST['edit_id'] : null;
$editUser = null;

if ($editId) {
    $editUser = $userService->getById($editId);
}
?>
<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>Riadenie pouzivatelov</title>
</head>
<body>
<?php require_once __DIR__ . '/parts/header.php' ?>
<section class="main">
    <div class="container mt-4">
        <?php require_once __DIR__ . '/parts/menu.php' ?>
        <div class="row">
            <div class="col">
                <h2 class="display-6 mb-3">Riadenie pouzivatelov</h2>

                <table class="table table-striped table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Meno</th>
                            <th>Priezvisko</th>
                            <th>Dátum narodenia</th>
                            <th>Skupina</th>
                            <th>Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($users as $u): ?>
                            <?php if ($editUser && $editUser['id'] === $u['id']): ?>
                                <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/userManage/updateUserProcess.php">
                                    <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                    <tr>
                                        <td><?= $u['id'] ?></td>
                                        <td><input type="email" name="email" value="<?= $u['email'] ?>" class="form-control" required></td>
                                        <td><input type="text" name="first_name" value="<?= $u['first_name'] ?>" class="form-control" required></td>
                                        <td><input type="text" name="last_name" value="<?= $u['last_name'] ?>" class="form-control" required></td>
                                        <td><input type="date" name="date_of_birth" value="<?= $u['date_of_birth'] ?>" class="form-control" required></td>
                                        <td><input type="number" name="group_id" value="<?= $u['group_id'] ?>" class="form-control" required></td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-success">Uložiť</button>
                                            <a href="users-control.php" class="btn btn-sm btn-secondary">Zrušiť</a>
                                        </td>
                                    </tr>
                                </form>
                            <?php else: ?>
                                <tr>
                                    <td><?= $u['id'] ?></td>
                                    <td><?= $u['email'] ?></td>
                                    <td><?= $u['first_name'] ?></td>
                                    <td><?= $u['last_name'] ?></td>
                                    <td><?= $u['date_of_birth'] ?></td>
                                    <td><?= $u['group_id'] ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="edit_id" value="<?= $u['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">upravit</button>
                                        </form>
                                        <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/userManage/deleteUserProcess.php">
                                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">odstranit</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </tbody>
                    <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/userManage/createUserProcess.php">
                        <tr>
                            <td>Auto</td>
                            <td><input type="email" name="email" class="form-control" required></td>
                            <td><input type="text" name="first_name" class="form-control" required></td>
                            <td><input type="text" name="last_name" class="form-control" required></td>
                            <td><input type="date" name="date_of_birth" class="form-control" required></td>
                            <td><input type="number" name="group_id" class="form-control" required></td>
                            <td>
                                <input type="password" name="password" class="form-control mb-1" placeholder="Heslo" required>
                                <button type="submit" class="btn btn-sm btn-primary">Vytvorit</button>
                            </td>
                        </tr>
                    </form>
                </table>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/parts/scripts.php' ?>
</body>
</html>
