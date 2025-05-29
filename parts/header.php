<?php

$user = false;
require_once __DIR__ . '/../classes/Database.php';
require_once __DIR__ . '/../classes/Auth.php';
require_once __DIR__ . '/../config/UserRoles.php';
$user = Auth::user();
        
?>
<header class="header">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="./">Uradny portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./">
                            Domov
                        </a>
                    </li>
                    <?php if ($user): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="./" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Poziadavky
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./add-ticket.php">Pridat</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="./my-tickets.php">moje poziadavky</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if ($user && (int)$user['group_id'] === UserRoles::ADMIN): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./tickets-control.php">Riadenie poziadaviek</a>
                    </li>
                    <?php endif; ?>
                </ul>
                <div class="right-side d-flex">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="accountDropdown" role="button"
                               data-bs-toggle="dropdown" aria-expanded="false">
                                <?= $user ? $user['first_name'] : 'ucet' ?>
                            </a>
                            <ul class="dropdown-menu">
                            <?php if (!$user): ?>
                                <li><a class="dropdown-item" href="./login.php">login</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="./register.php">sign up</a></li>
                            <?php else: ?>
                                <li>
                                    <form action="./db/logout.php" method="post">
                                        <button type="submit" class="dropdown-item">logout</button>
                                    </form>
                                </li>
                            <?php endif; ?>
                            </ul>
                        </li>
                    </ul>
                    <form class="d-flex" method="get" action="./" role="search">
                        <input class="form-control me-2" type="search" name="search" 
                               value="<?= $_GET['search'] ?? '' ?>" 
                               placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" type="submit">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</header>