<div class="user">

    <h1>Connexion</h1>

    <?php
    if (isset($msg))
        echo $msg;
    ?>

    <section class="section_with_icon">
        <div class="icon_left">
            <img class="home_icon" id="connexion_icon_check" src=".\public\images\elements\elements1_check.png"
                alt="Icone carte">
            <div class="home_text">
                <form method="POST" class="user_form" id="connexion_form">
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
            </div>
        </div>
    </section>

    <div class="row_align">
        <span>Pas encore de compte ? </span>
        <a class="link_action" href="index.php?page=inscription">Inscription</a>
    </div>

</div>


<style>
    #connexion_icon_check{
        height: 45vh;
        margin-top: -20vh;
        margin-left: 12.5vw;
        transform: rotate(10deg);
    }
</style>