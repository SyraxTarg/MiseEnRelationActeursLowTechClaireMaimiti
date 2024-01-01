<?php

if ($user['id'] == 5 && $user['username'] == "utilisateur introuvable") {
    echo "<h1>Cet utilisateur n'existe pas.</h1>";
} else {
    ?>
    <h1>Profil de
        <?= $user['username'] ?>
    </h1>

    <?php
    if (isset($msg))
        echo $msg;
    ?>

    <?php
    if ($currentUser) { ?>
        <a href='index.php?page=deconnexion'>Me déconnecter</a>
        <a href='index.php?page=modifierProfil'>Modifier mon profil</a>
        <?php
    } else {
        if ($_SESSION['privileges'] == "admin") {
            if ($userPrivileges != "admin") { ?>
                <a href="#"
                    onclick="confirmDelete(<?= $user['id'] ?>, 'Êtes-vous sûr de vouloir bannir cet utilisateur ? Il ne sera pas prévenu.', 'ban')">Ban</a>
            <?php }
            if ($userPrivileges == "particulier") { ?>
                <a href="index.php?page=profil&id=<?= $user['id'] ?>&action=grantModo">Nommer modérateur</a>
            <?php } elseif ($userPrivileges == "modo") { ?>
                <a href="#"
                    onclick="confirmDelete(<?= $user['id'] ?>, 'Êtes-vous sûr de vouloir nommer cet utilisateur administrateur ? Cette action est irréversible.', 'grantAdmin')">Nommer administrateur</a>
                <a href="index.php?page=profil&id=<?= $user['id'] ?>&action=removeModo">Supprimer les privilèges de modérateur</a>
            <?php }
        }
    }
    ?>

    <p>Contact :
        <?= $user['email'] ?>
    </p>

    <?php
    if ($user['activites']) {
        echo "<p>Activités : " . $user['activites'] . "</p>";
    }
    ?>

    <!-- afficher les annonces (sans les commentaires) -->
    <?php
    if ($annonces) {
        foreach ($annonces as $annonce) {
            ?>
            <div class="annonce">
                <a href="index.php?page=focusAnnonce&id=<?= $annonce['id'] ?>">
                    <h4>
                        <?= $annonce['titre'] ?>
                    </h4>
                </a>
                <p><?php 
                    $date = explode('.', $annonce['date']);
                    echo $date[0]; ?></p>
                <p>
                    <?= $annonce['description'] ?>
                </p>
            </div>
            <br>
            <?php
        }
    }
?>
<?php
}