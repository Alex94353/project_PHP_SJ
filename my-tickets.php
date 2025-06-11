<?php
session_start();
require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/classes/TicketService.php';
$user = Auth::user();
if (!$user) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/login.php');
    die();
}

$ticketService = new TicketService();
$tickets = $ticketService->getUserTickets($user['id']);
$tags = $ticketService->getAllTags();

$tagMap = [];
foreach ($tags as $tag) {
    $tagMap[$tag['id']] = $tag;
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
                        <?php foreach ($tickets as $ticket): ?>
                            <?php $tag = $tagMap[$ticket['tag_id']] ?? null; ?>
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
                                                <form action="./actions/tickets/removeTicketProcess.php" method="post">
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