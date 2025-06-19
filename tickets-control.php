<?php 
session_start();

require_once __DIR__ . '/classes/Auth.php';
require_once __DIR__ . '/classes/TicketService.php';
require_once __DIR__ . '/config/TicketStatus.php';
require_once __DIR__ . '/config/UserRoles.php';

$user = Auth::user();

if (!Auth::isRole(UserRoles::ADMIN)) {
    header('Location: /project_PHP_SJ/project_PHP_SJ/');
    die();
}

$ticketService = new TicketService();
$tickets = $ticketService->getAllTickets();
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
    <title>riadenie poziadaviek</title>
</head>
<body>
    <?php require_once __DIR__ . '/parts/header.php' ?>
    <section class="main">
        <div class="container">
            <?php require_once __DIR__ . '/parts/menu.php' ?>
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
                        <?php $tag = $tagMap[$ticket['tag_id']] ?? null; ?>
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
                                            <form action="/project_PHP_SJ/project_PHP_SJ/actions/tickets/changeTagProcess.php" method="post">
                                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                <input type="hidden" name="tag" value="<?= TicketStatus::READY ?>">
                                                <button type="submit" class="dropdown-item">hotovo</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="/project_PHP_SJ/project_PHP_SJ/actions/tickets/changeTagProcess.php" method="post">
                                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                <input type="hidden" name="tag" value="<?= TicketStatus::IN_PROGRESS ?>">
                                                <button type="submit" class="dropdown-item">v praci</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="/project_PHP_SJ/project_PHP_SJ/actions/tickets/changeTagProcess.php" method="post">
                                                <input type="hidden" name="id" value="<?= $ticket['id'] ?>">
                                                <input type="hidden" name="tag" value="<?= TicketStatus::REJECTED ?>">
                                                <button type="submit" class="dropdown-item">odmietne</button>
                                            </form>
                                        </li>
                                        <li>
                                            <form action="/project_PHP_SJ/project_PHP_SJ/actions/tickets/removeTicketProcess.php" method="post">
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