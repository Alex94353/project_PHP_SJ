<?php 
session_start();

require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/classes/TicketService.php';
$user = Auth::user();

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
                <h2 class="display-6 mb-3 mt-4">Poziadavky <?= $user['first_name'] ?? 'Host' ?></h2>
            </div>
            <div class="row">
            <?php
            $ticketService = new TicketService();
            $query = $_GET['search'] ?? '';
            
            $tickets = $ticketService->search($query);
            $tags = $ticketService->getAllTags();
            
            if (empty($tickets)) {
                echo '<div class="alert alert-warning" role="alert">
                        not found.
                    </div>';
            }

            $tagMap = [];
            foreach ($tags as $tag) {
                $tagMap[$tag['id']] = $tag;
            }

            ?>
            <?php foreach ($tickets as $ticket): ?>
                <?php $tag = $tagMap[$ticket['tag_id']] ?? null; ?>
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