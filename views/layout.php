<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise en relation d'acteurs</title>
    <link rel="stylesheet" href="public/style/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link rel="icon" type="image/x-icon" href="public/images/favicon.ico">
    <script src="public/script/script.js" defer></script>
    
</head>
<body>

    <?php require('./views/partials/__header.php'); ?>
    <main>
        <?php require($template); ?>
    </main>
    <?php require('./views/partials/__footer.php'); ?>
</body>
</html>