<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>Moje poziadavky</title>
</head>
<body>
    <?php require_once __DIR__ . '/parts/header.php' ?>
    <?php require_once __DIR__ . '/db/connect.php' ?>
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
                        $tags = $conn->query("SELECT * FROM `ticket_tags`")->fetchAll(PDO::FETCH_ASSOC);

                        $query = $conn->prepare("SELECT * FROM tickets");
                        $query->execute();
                        $tickets = $query->fetchAll(PDO::FETCH_ASSOC);
                        ?>

                        <?php foreach ($tickets as $ticket): ?>
                            <?php
                            $tagId = $ticket['tag_id'];

                            $tag = array_filter($tags, function ($tag) use ($tagId) {
                                return (int)$tag['id'] === (int)$tagId;
                            });

                            $tag = array_shift($tag);
                            ?>
                            <th>
                                <td>
                                    <img src="/project_PHP_SJ/project_PHP_SJ/<?= htmlspecialchars($ticket['image']) ?>" width="200" alt="">
                                </td>
                                <td>opravit</td>
                                <td>
                                    <span class="badge bg-success" style="background: <?= $tag['background'] ?>; color: <?= $tag['color'] ?>;">
                                        <?= $tag['label'] ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            akcie
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">hotovo</a></li>
                                            <li><a class="dropdown-item" href="#">v praci</a></li>
                                            <li><a class="dropdown-item" href="#">odmietne</a></li>
                                            <li><a class="dropdown-item" href="#">odstranit</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </th>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <?php require_once __DIR__ . '/parts/scripts.php' ?>
</body>
</html>