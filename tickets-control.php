<?php 
session_start();
require_once __DIR__ . '/db/connect.php';
$access = require __DIR__ . '/db/access.php';


if (!isset($_SESSION['user'])) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/');
    exit;
}

$query = $conn->prepare("SELECT * FROM users WHERE id = :id");
$query->execute(['id' => $_SESSION['user']]);
$user = $query->fetch();

if ((int)$user['group_id'] !== $access['admin_user_group']) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/');
    exit;
}


$tags = $conn->query("SELECT * FROM ticket_tags")->fetchAll();
$tickets = $conn->query("SELECT * FROM tickets")->fetchAll();

?>
<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>riadenie poziadaviek</title>
</head>
<body>
    <?php require_once __DIR__ . '/parts/header.php' ?>
    <section class="main">
        <div class="container">
            <div class="row">
                <h2 class="display-6 mb-3">Riadenie poziadaviek</h2>
            </div>
            <div class="row">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">obrazky</th>
                            <th scope="col">tema</th>
                            <th scope="col">opis</th>
                            <th scope="col">akcie</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                    <?php foreach ($tickets as $ticket): ?>
                        <?php
                        $tagId = $ticket['tag_id'];

                        $tag = array_filter($tags, function ($tag) use ($tagId) {
                            return (int)$tag['id'] === (int)$tagId;
                        });
                        $tag = array_shift($tag) ?: [
                            'background' => '#000',
                            'color' => '#fff',
                            'label' => 'not found'
                        ];
                        ?>
                        <tr>
                            <td>
                                <img src="<?= $ticket['image'] ?>" width="200" alt="">
                            </td>
                            <td><?= $ticket['title'] ?></td>
                            <td><?= $ticket['description'] ?></td>
                            <td>
                                <span class="badge rounded-pill"
                                        style="background: <?= $tag['background'] ?>; color: <?= $tag['color'] ?>;">
                                    <?= $tag['label'] ?>
                                </span>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-warning dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        akcie
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <form action="/project_PHP_SJ/project_PHP_SJ/db/change_tag.php" method="post">
                                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                <input type="hidden" name="tag" value="<?= $access['success_tickets_tag'] ?>">
                                                <button type="submit" class="dropdown-item">hotovo</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="/project_PHP_SJ/project_PHP_SJ/db/change_tag.php" method="post">
                                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                <input type="hidden" name="tag" value="<?= $access['in_progress_tickets_tag'] ?>">
                                                <button type="submit" class="dropdown-item">v praci</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="/project_PHP_SJ/project_PHP_SJ/db/change_tag.php" method="post">
                                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                <input type="hidden" name="tag" value="<?= $access['reject_tickets_tag'] ?>">
                                                <button type="submit" class="dropdown-item">odmietne</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="/project_PHP_SJ/project_PHP_SJ/db/remove.php" method="post">
                                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                <button type="submit" class="dropdown-item">odstranit</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php require_once __DIR__ . '/parts/scripts.php' ?>
</body>
</html>