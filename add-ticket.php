<!doctype html>
<html lang="sk">
<head>
    <?php require_once __DIR__ . '/parts/head.php' ?>
    <title>pridat</title>
</head>
<body>
    <?php require_once __DIR__ . '/parts/header.php' ?>
    <section class="main">
        <div class="container">
            <div class="row">
                <h2 class="display-6 mb-3">Pridat poziadavku</h2>
            </div>
            <div class="row">
                <form>
                    <div class="mb-3">
                        <label for="requestTitle" class="form-label">Tema</label>
                        <input type="text" class="form-control" id="requestTitle" placeholder="Введите тему заявки">
                    </div>
      
                    <div class="mb-3">
                        <label for="attachments" class="form-label">Pridat subory</label>
                        <input class="form-control" type="file" id="attachments" multiple>
                    </div>
      
                    <div class="mb-3">
                        <label for="description" class="form-label">Opis</label>
                        <textarea class="form-control" id="description" rows="3" placeholder="Опишите проблему..."></textarea>
                    </div>
      
                    <button type="submit" class="btn btn-outline-primary">Pridat</button>
                </form>
            </div>
        </div>
    </section>
      
    <?php require_once __DIR__ . '/parts/scripts.php' ?>
</body>
</html>