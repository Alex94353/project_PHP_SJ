<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
    die();
}
?>
<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>Moje poziadavky</title>
</head>
<body>
    <?php require_once __DIR__ . '/parts/header.php' ?>
    <section class="main">
        <div class="container">
            <div class="row">
                <h2 class="display-6 mb-3">Moje poziadavky</h2>
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
                        <?php
                        $tags = $conn->query("SELECT * FROM `ticket_tags`")->fetchAll();

                        $query = $conn->prepare("SELECT * FROM tickets WHERE user_id = :user_id");
                        $query->execute(['user_id' => $_SESSION['user']]);
                        $tickets = $query->fetchAll();
                        ?>

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
                                    <img src="/project_PHP_SJ/project_PHP_SJ/<?= $ticket['image'] ?>" width="200" alt="">
                                </td>
                                <td><?= $ticket['title'] ?></td>
                                <td><?= $ticket['description'] ?></td>
                                <td>
                                    <span class="badge rounded-pill" style="background: <?= $tag['background'] ?>; color: <?= $tag['color'] ?>;">
                                        <?= $tag['label'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            akcie
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <form action="./db/ticket_remove.php" method="post">
                                                    <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                    <button type="submit" class="dropdown-item">Odstrániť</button>
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