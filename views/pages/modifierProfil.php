<h1>Modifier le profil de
    <?= $user['username'] ?>
</h1>

<?php
if (isset($msg))
    echo $msg;
?>

<form method="POST">
    <label for="username">Username </label>
    <input type="text" name="username" id="username" value="<?= $user['username'] ?>" required>

    <label for="email">Email </label>
    <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required>

    <label for="password">Mot de passe </label>
    <input type="password" name="password" id="password" required>
    <label for="reEnterPassword">Entrez à nouveau votre mot de passe </label>
    <input type="password" name="reEnterPassword" id="reEnterPassword" required>

    <label for="activites">Activités </label>
    <input type="text" name="activites" id="activites" value="<?= $user['activites'] ?>">

    <input type="submit" value="Enregistrer">
</form>








<a href="#">Supprimer mon profil</a>
<!-- afficher en rouge, tout en bas -->
<!-- demander confirmation avant d'appeler la méthode -->
<!-- utiliser la même méthode que le ban -->
<!-- déconnecter l'utilisateur -->