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

        <label for="activites">Quelles sont vos compétences ? </label>
        <div class="user_form_select" id="activitesCheckboxDiv">
            <?php
            foreach ($activitesPossibles as $act) { ?>
                <div class="activitesCheckbox">
                    <input type="checkbox" name="activites[]" id="<?= $act ?>" value="<?= $act ?>" hidden>
                    <label class="unique_act" for="<?= $act ?>">
                        <?= $act ?>
                    </label>
                </div>
                <?php
            }
            ?>
        </div>

        <div class="user_form_group column_align" id="user_form_group_act">
            <button type="button" id="buttonActivite">Ajouter une autre activité</button>
            <div id="autresActivites" class="row_align"></div>
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
            let divNouvelInput = document.createElement("div");
            divNouvelInput.className = "autreActiviteInput";

            var nouvelInput = document.createElement("input");
            nouvelInput.type = "text";
            nouvelInput.name = "autresActivites[]";

            var croixSuppression = document.createElement("span");
            croixSuppression.textContent = "X";
            croixSuppression.style.cursor = "pointer";

            conteneurAutresActivites.appendChild(divNouvelInput);
            divNouvelInput.appendChild(nouvelInput);
            divNouvelInput.appendChild(croixSuppression);

            croixSuppression.addEventListener("click", function () {
                divNouvelInput.removeChild(nouvelInput);
                divNouvelInput.removeChild(croixSuppression);
                conteneurAutresActivites.appendChild(divNouvelInput);
            });
        });
    });

</script>

<style>
    #user_form_group_act input {
        width: 15vw;
    }

    .autreActiviteInput {
        display: flex;
        flex-direction: row;
        align-items: center;
        margin: 1vh 1vw;
    }

    #autresActivites {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
    }

    #activitesCheckboxDiv {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        width: 60vw;
    }

    .activitesCheckbox {
        margin: 1vh 0;
    }

    label[for="activites"] {
        margin: 1.5vh;
    }

    #buttonActivite {
        width: 15vw;
        height: 5vh;
        border: none;
        border-radius: 0.5vw;
        cursor: pointer;

        background-color: var(--bleu-marine);
        color: white;
        font-family: "Montserrat", sans-serif;
    }
</style>