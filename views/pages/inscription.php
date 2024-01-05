<div class="user">

    <h1>Inscription</h1>

    <p>Les informations que vous entrez seront visibles publiquement sur la plateforme.</p>
    <p>* Champ obligatoire</p>
    <br>

    <?php
    if (isset($msg))
        echo $msg;
    ?>

    <form method="POST" class="user_form">
        <div class="user_form_group">
            <label for="username">Username * </label>
            <input type="text" name="username" id="username" required>
        </div>

        <div class="user_form_group">
            <label for="email">Email * </label>
            <input type="email" name="email" id="email" required>
        </div>

        <div class="user_form_group">
            <label for="password">Mot de passe * </label>
            <input type="password" name="password" id="password" required>
        </div>

        <div class="user_form_group">
            <label for="reEnterPassword">Entrez à nouveau votre mot de passe * </label>
            <input type="password" name="reEnterPassword" id="reEnterPassword" required>
        </div>

        <div>
            <label for="activites">Quelles sont vos compétences ? </label>

            <input type="checkbox" name="activites[]" id="Soudure" value="Soudure" hidden>
            <label for="Soudure">Soudure</label>

            <input type="checkbox" name="activites[]" id="Electricité" value="Electricité" hidden>
            <label for="Electricité">Electricité</label>

            <input type="checkbox" name="activites[]" id="Charpenterie" value="Charpenterie" hidden>
            <label for="Charpenterie">Charpenterie</label>

            <input type="checkbox" name="activites[]" id="Plomberie" value="Plomberie" hidden>
            <label for="Plomberie">Plomberie</label>

            <input type="checkbox" name="activites[]" id="Chauffage" value="Chauffage" hidden>
            <label for="Chauffage">Chauffage</label>

            <input type="checkbox" name="activites[]" id="Maçonnerie" value="Maçonnerie" hidden>
            <label for="Maçonnerie">Maçonnerie</label>

        </div>

        <input class="user_submit_button" type="submit" value="Continuer">
    </form>

    <br>
    <div class="row_align">
        <span>Vous avez déjà un compte ?</span>
        <a class="link_action" href="index.php?page=connexion">Connexion</a>
    </div>
</div>

<style>
    input[type="checkbox"]:checked + label {
        color: green;
    }
</style>