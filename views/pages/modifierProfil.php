<a href="index.php?page=profil&id=<?= $_SESSION['idUser'] ?>" class="retourArriere"><i
        class="fas fa-arrow-left"></i></a>

<div class="user">
    <h1>Modifier le profil de
        <?= $user['username'] ?>
    </h1>

    <p>Les informations que vous entrez seront visibles publiquement sur la plateforme.</p>
    <p>* Champ obligatoire</p>
    <br>

    <?php
    if (isset($msg))
        echo $msg;
    ?>

    <form method="POST" enctype="multipart/form-data" class="user_form">
        <div class="user_form_group">
            <label for="username">Username * </label>
            <input type="text" name="username" id="username" value="<?= $user['username'] ?>" required>
        </div>

        <div class="user_form_group">
            <label for="email">Email * </label>
            <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required>
        </div>

        <div class="user_form_group">
            <label for="password">Mot de passe * </label>
            <input type="password" name="password" id="password" required>
        </div>
        <div class="user_form_group">
            <label for="reEnterPassword">Entrez à nouveau votre mot de passe * </label>
            <input type="password" name="reEnterPassword" id="reEnterPassword" required>
        </div>

        <div class="user_form_group">
            <label for="file">Modifier la photo de profil</label>
            <input id="user_add_pfp" type="file" name="photoProfil" id="photoProfil">
        </div>

        <div class="user_form_group">
            <label for="bio">Bio </label>
            <textarea name="bio" id="bio" cols="30" rows="10"><?= $user['bio'] ?></textarea>
        </div>


        <label for="activites">Quelles sont vos compétences ? </label>
        <div class="user_form_select" id="activitesCheckboxDiv">
            <?php
            foreach ($activitesPossibles as $act) { ?>
                <div class="activitesCheckbox">
                    <input type="checkbox" name="activites[]" id="<?= $act ?>" value="<?= $act ?>"
                        <?= estActiviteSelectionnee($act, $activitesUser) ? 'checked' : '' ?> hidden>
                    <label class="unique_act" for="<?= $act ?>">
                        <?= $act ?>
                    </label>
                </div>
                <?php
            }

            $activitesUserText = [];
            foreach ($activitesUser as $act) {
                if (!in_array($act, $activitesPossibles)) {
                    array_push($activitesUserText, $act);
                }
            } ?>
        </div>

        <div class="user_form_group column_align" id="user_form_group_act">
            <button type="button" id="buttonActivite">Ajouter une autre activité</button>
            <div id="autresActivites" class="row_align">
                <?php
                foreach ($activitesUserText as $act) { ?>
                    <div class="autreActiviteInput row_align">
                        <input type="text" name="autresActivites[]" value="<?= $act ?>">
                        <span class="croixSuppression">X</span>
                    </div>

                    <?php
                }
                ?>
            </div>
        </div>

        <input class="user_submit_button" type="submit" value="Enregistrer">
    </form>


    <br>
    <a class="user_dangerous_button" href='#' onclick='confirmDelete()'>Supprimer mon profil</a>
</div>

<script>
    var boutonAjouter = document.querySelector("#buttonActivite");
    var conteneurAutresActivites = document.querySelector("#autresActivites");

    boutonAjouter.addEventListener("click", function () {
        var nouvelleActiviteDiv = document.createElement("div");
        nouvelleActiviteDiv.className = "autreActiviteInput";

        var nouvelInput = document.createElement("input");
        nouvelInput.type = "text";
        nouvelInput.name = "autresActivites[]";

        var croixSuppression = document.createElement("span");
        croixSuppression.textContent = "X";
        croixSuppression.style.cursor = "pointer";

        nouvelleActiviteDiv.appendChild(nouvelInput);
        nouvelleActiviteDiv.appendChild(croixSuppression);

        conteneurAutresActivites.appendChild(nouvelleActiviteDiv);

        croixSuppression.addEventListener("click", function () {
            conteneurAutresActivites.removeChild(nouvelleActiviteDiv);
        });
    });

    conteneurAutresActivites.addEventListener("click", function (event) {
        if (event.target && event.target.className == "croixSuppression") {
            var parentDiv = event.target.parentNode;
            conteneurAutresActivites.removeChild(parentDiv);
        }
    });

    function confirmDelete() {
        var confirmation = confirm("Êtes-vous sûr de vouloir supprimer votre profil ? Cette action est irréversible.");

        if (confirmation) {
            window.location.href = "index.php?page=modifierProfil&action=delete";
        }
    }
</script>

<style>
    .retourArriere {
        color: #0F3F6C;
        margin: 1vw;
        font-size: 2vw;
    }

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

    .croixSuppression {
        cursor: pointer;
    }
</style>