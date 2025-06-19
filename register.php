<?php 
session_start();
?>
<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>sing in</title>
</head>
<body>
    <?php require_once __DIR__ . '/parts/header.php' ?>
    <section class="main">
        <div class="container">
            <div class="card mt-4">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <form method="post" action="./actions/user/registerProcess.php">
                        <div class="mb-3">
                            <label for="email" class="form-label">e-mail</label>
                            <input type="email" name="email" class="form-control" id="email">
                        </div>

                        <div class="mb-3">
                            <label for="first-name" class="form-label">meno</label>
                            <input type="text" name="first_name" class="form-control" id="first-name">
                        </div>

                        <div class="mb-3">
                            <label for="last-name" class="form-label">priezvisko</label>
                            <input type="text" name="last_name" class="form-control" id="last-name">
                        </div>

                        <div class="mb-3">
                            <label for="birthdate" class="form-label">datum narodenia</label>
                            <input type="date" name="date_of_birth" class="form-control" id="birthdate">
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">heslo</label>
                            <input type="password" name="password" class="form-control" id="password">
                        </div>

                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">potvrdenie hesla</label>
                            <input type="password" name="password_confirmation" class="form-control" id="confirm-password">
                        </div>

                        <button type="submit" class="btn btn-outline-primary">vytvorit ucet</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <?php require_once __DIR__ . '/parts/scripts.php' ?>
</body>
</html>