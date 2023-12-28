<a href="index.php?page=home">Retour à l'accueil</a>

<h1>Connexion</h1>

<?php
if(isset($msg))
    echo $msg;
?>

<form method="POST">
    <label for="email">Email </label>
    <input type="email" name="email" id="email" required>
    <label for="password">Mot de passe </label>
    <input type="password" name="password" id="password" required>
    <input type="submit" value="Me connecter">
</form>

<br>
<span>Pas encore de compte ? </span>
<a href="index.php?page=inscription">Inscription</a>