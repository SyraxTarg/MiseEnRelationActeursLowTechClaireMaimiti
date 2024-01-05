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

        <div>
            <label for="activites">Quelles sont vos compétences ? </label>

            <?php
            foreach($activitesPossibles as $act){ ?>
                <input type="checkbox" name="activites[]" id="<?=$act?>" value="<?=$act?>" <?= estActiviteSelectionnee($act, $activitesUser) ? 'checked' : '' ?> hidden>
                <label for="<?=$act?>"><?=$act?></label>
                <?php
            }
            ?>

        </div>

        <input class="user_submit_button" type="submit" value="Enregistrer">
    </form>


    <br>
    <a class="user_dangerous_button" href='#' onclick='confirmDelete()'>Supprimer mon profil</a>
</div>

<style>
    input[type="checkbox"]:checked + label {
        color: green;
    }
</style>