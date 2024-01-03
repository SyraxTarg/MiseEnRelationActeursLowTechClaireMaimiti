<h1>Modifier le profil de
    <?= $user['username'] ?>
</h1>

<p>Les informations que vous entrez seront visibles publiquement sur la plateforme.</p>

<?php
if (isset($msg))
    echo $msg;
?>

<form method="POST" enctype="multipart/form-data">
    <label for="username">Username </label>
    <input type="text" name="username" id="username" value="<?= $user['username'] ?>" required>

    <label for="email">Email </label>
    <input type="email" name="email" id="email" value="<?= $user['email'] ?>" required>

    <label for="password">Mot de passe </label>
    <input type="password" name="password" id="password" required>
    <label for="reEnterPassword">Entrez à nouveau votre mot de passe </label>
    <input type="password" name="reEnterPassword" id="reEnterPassword" required>

    <label for="bio">Bio </label>
    <!-- <input type="text" name="bio" id="bio" value="<?= $user['bio'] ?>"> -->
    <textarea name="bio" id="bio" cols="30" rows="10"><?= $user['bio'] ?></textarea>

    <label for="activites">Activités </label>
    <input type="text" name="activites" id="activites" value="<?= $user['activites'] ?>">
    <label for="file">Modifier la photo de profil</label>
    <input type="file" name ="photoProfil" id = "photoProfil">

    <input type="submit" value="Enregistrer">
</form>


<a href='#' onclick='confirmDelete()'>Supprimer mon profil</a>
<!-- afficher en rouge, tout en bas -->