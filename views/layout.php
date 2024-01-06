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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

</head>

<body>

    <?php $activitesPossibles = ["Soudure", "Electricité", "Charpenterie", "Plomberie", "Chauffage", "Maçonnerie", "Isolation"]; ?>

    <?php require('./views/partials/__header.php'); ?>
    <main>
        <?php require($template); ?>
    </main>
    <?php require('./views/partials/__footer.php'); ?>
</body>

</html>