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

        <div class="user_form_select">
            <label for="activites">Quelles sont vos compétences ? </label>

            <?php
            foreach ($activitesPossibles as $act) { ?>
                <input type="checkbox" name="activites[]" id="<?= $act ?>" value="<?= $act ?>" hidden>
                <label class="unique_act" for="<?= $act ?>">
                    <?= $act ?>
                </label>
                <?php
            }
            ?>
        </div>
        <div class="user_form_group column_align" id="user_form_group_act">
            <div id="autresActivites" class="row_align"></div>
            <button type="button" id="buttonActivite">Ajouter une autre activité</button>
        </div>

        <input class="user_submit_button" type="submit" value="Continuer">
    </form>

    <br>
    <div class="row_align">
        <span>Vous avez déjà un compte ?</span>
        <a class="link_action" href="index.php?page=connexion">Connexion</a>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        var boutonAjouter = document.querySelector("#buttonActivite");
        var conteneurAutresActivites = document.querySelector("#autresActivites");

        boutonAjouter.addEventListener("click", function () {
            var nouvelInput = document.createElement("input");
            nouvelInput.type = "text";
            nouvelInput.name = "autresActivites[]";

            var croixSuppression = document.createElement("span");
            croixSuppression.textContent = "X";
            croixSuppression.style.cursor = "pointer";

            conteneurAutresActivites.appendChild(nouvelInput);
            conteneurAutresActivites.appendChild(croixSuppression);

            // Ajoutez un écouteur d'événement pour supprimer le champ texte lorsqu'on clique sur la croix
            croixSuppression.addEventListener("click", function () {
                conteneurAutresActivites.removeChild(nouvelInput);
                conteneurAutresActivites.removeChild(croixSuppression);
            });
        });
    });

</script>

<style>
    #user_form_group_act input {
        width: 15vw;
    }
</style>