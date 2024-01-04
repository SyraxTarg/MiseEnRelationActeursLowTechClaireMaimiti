<div class="user">

    <h1>Connexion</h1>

    <?php
    if (isset($msg))
        echo $msg;
    ?>

    <form method="POST" class="user_form">
        <div class="user_form_group">
            <label for="email">Email </label>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="user_form_group">
            <label for="password">Mot de passe </label>
            <input type="password" name="password" id="password" required>
        </div>
        <input class="user_submit_button" type="submit" value="Me connecter">
    </form>

    <br>
    <div class="row_align">
        <span>Pas encore de compte ? </span>
        <a class="link_action" href="index.php?page=inscription">Inscription</a>
    </div>

</div>