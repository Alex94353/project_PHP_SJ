<?php 
session_start();

require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/config/TicketStatus.php';
require_once __DIR__ . '/config/UserRoles.php';
require_once __DIR__ . '/classes/TagService.php';

$user = Auth::user();

if (!Auth::isRole(UserRoles::ADMIN)) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/');
    die();
}

$tagService = new TagService();
$tags = $tagService->getAll();

$editId = isset($_POST['edit_id']) ? (int)$_POST['edit_id'] : null;
$editTag = null;

if ($editId) {
    $editTag = $tagService->getById($editId);
}
?>
<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>Riadenie tagov</title>
</head>
<body>
<?php require_once __DIR__ . '/parts/header.php' ?>
<section class="main">
    <div class="container mt-4">
        <?php require_once __DIR__ . '/parts/menu.php' ?>
        <div class="row">
            <div class="col">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h2 class="display-6">Riadenie tagov</h2>
                </div>
                <table class="table table-success table-striped table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Názov (label)</th>
                            <th>Pozadie</th>
                            <th>Farba textu</th>
                            <th>Vytvorené</th>
                            <th>Upravené</th>
                            <th>Akcie</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tags as $tag): ?>
                            <?php if ($editTag && $editTag['id'] === $tag['id']): ?>
                                <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/tags/updateTagProcess.php">
                                    <input type="hidden" name="old_id" value="<?= $tag['id'] ?>">
                                    <tr>
                                        <td><input type="number" name="id" value="<?= $tag['id'] ?>" class="form-control" required></td>
                                        <td><input type="text" name="label" value="<?= htmlspecialchars($tag['label']) ?>" class="form-control" required></td>
                                        <td><input type="color" name="background" value="<?= $tag['background'] ?>" class="form-control form-control-color" required></td>
                                        <td><input type="color" name="color" value="<?= $tag['color'] ?>" class="form-control form-control-color" required></td>
                                        <td><?= $tag['created_at'] ?></td>
                                        <td><?= $tag['updated_at'] ?></td>
                                        <td>
                                            <button type="submit" class="btn btn-sm btn-success">Uložiť</button>
                                            <a href="tags-control.php" class="btn btn-sm btn-secondary">Zrušiť</a>
                                        </td>
                                    </tr>
                                </form>
                            <?php else: ?>
                                <tr>
                                    <td><?= $tag['id'] ?></td>
                                    <td><?= $tag['label'] ?></td>
                                    <td><span class="badge" style="background-color: <?= $tag['background'] ?>;"><?= $tag['background'] ?></span></td>
                                    <td><span class="badge" style="color: <?= $tag['color'] ?>;"><?= $tag['color'] ?></span></td>
                                    <td><?= $tag['created_at'] ?></td>
                                    <td><?= $tag['updated_at'] ?></td>
                                    <td>
                                        <form method="POST">
                                            <input type="hidden" name="edit_id" value="<?= $tag['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-primary">✏</button>
                                        </form>
                                        <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/tags/deleteTagProcess.php">
                                            <input type="hidden" name="id" value="<?= $tag['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-outline-danger">🗑</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; ?>

                        <form method="POST" action="/project_PHP_SJ/project_PHP_SJ/actions/tags/createTagProcess.php">
                            <tr>
                                <td><input type="number" name="id" class="form-control" required></td>
                                <td><input type="text" name="label" class="form-control" required></td>
                                <td><input type="color" name="background" class="form-control form-control-color" required></td>
                                <td><input type="color" name="color" class="form-control form-control-color" required></td>
                                <td colspan="2"></td>
                                <td><button class="btn btn-sm btn-primary">Vytvoriť</button></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<?php require_once __DIR__ . '/parts/scripts.php' ?>
</body>
</html>
