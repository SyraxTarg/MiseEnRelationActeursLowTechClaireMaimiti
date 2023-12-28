<a href="index.php?page=home">Retour à l'accueil</a>

<h1>Inscription</h1>

<?php
if(isset($msg))
    echo $msg;
?>

<form method="POST">
    <label for="username">Username </label>
    <input type="text" name="username" id="username" required>

    <label for="email">Email </label>
    <input type="email" name="email" id="email" required>

    <label for="password">Mot de passe </label>
    <input type="password" name="password" id="password" required>
    <label for="reEnterPassword">Entrez à nouveau votre mot de passe </label>
    <input type="password" name="reEnterPassword" id="reEnterPassword" required>

    <label for="activites">Activités </label>
    <input type="text" name="activites" id="activites">

    <input type="submit" value="Continuer">
</form>

<br>
<span>Vous avez déjà un compte ? </span>
<a href="index.php?page=connexion">Connexion</a>