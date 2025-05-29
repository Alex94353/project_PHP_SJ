<?php 
session_start();
require_once __DIR__ . '/classes/Database.php';
$db = new Database();
$conn = $db->getConnection();
?>
<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>Uradny portal</title>
</head>
<body>
    <?php require_once __DIR__ . '/parts/header.php' ?>
    <section class="main">
        <div class="container">
            <div class="row">
                <h2 class="display-6 mb-3">Poziadavky</h2>
            </div>
            <div class="row">
            <?php
            if (isset($_GET['search'])) {
                $stmt = $conn->prepare("SELECT * FROM `tickets` WHERE `title` LIKE :search ORDER BY `id` DESC");
                $stmt->execute(['search' => "%{$_GET['search']}%"]);
                $tickets = $stmt->fetchAll();
            } else {
                $tickets = $conn->query("SELECT * FROM `tickets` ORDER BY `id` DESC")->fetchAll();
            }

            if (empty($tickets)) {
                echo '<div class="alert alert-warning" role="alert">
                        not found.
                    </div>';
            }

            $tags = $conn->query("SELECT * FROM `ticket_tags`")->fetchAll();

            foreach ($tickets as $ticket):
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
                <div class="card mb-3">
                    <img src="<?= $ticket['image'] ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $ticket['title'] ?>
                            <span class="badge rounded-pill"
                                style="background: <?= $tag['background'] ?>; color: <?= $tag['color'] ?>;">
                                <?= $tag['label'] ?>
                            </span>
                        </h5>
                        <p class="card-text"><?= $ticket['description'] ?></p>
                        <p class="card-text">
                            <small class="text-muted">vytvorene: <?= $ticket['created_at'] ?></small>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php require_once __DIR__ . '/parts/scripts.php' ?>
</body>
</html>