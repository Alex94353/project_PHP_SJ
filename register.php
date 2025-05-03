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
            <div class="card">
                <div class="card-header">
                    Register
                </div>
                <div class="card-body">
                    <form>
                        <div class="mb-3">
                            <label for="email" class="form-label">e-mail</label>
                            <input type="email" class="form-control" id="email">
                        </div>
              
                        <div class="mb-3">
                            <label for="fullname" class="form-label">meno a priezvisko</label>
                            <input type="text" class="form-control" id="fullname">
                        </div>
              
                        <div class="mb-3">
                            <label for="birthdate" class="form-label">datum narodenia</label>
                            <input type="datetime-local" class="form-control" id="birthdate" placeholder="dd.mm.rrrr --:--">
                        </div>
              
                        <div class="mb-3">
                            <label for="password" class="form-label">heslo</label>
                            <input type="password" class="form-control" id="password">
                        </div>
              
                        <div class="mb-3">
                            <label for="confirm-password" class="form-label">podtvrdenie hesla</label>
                            <input type="password" class="form-control" id="confirm-password">
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