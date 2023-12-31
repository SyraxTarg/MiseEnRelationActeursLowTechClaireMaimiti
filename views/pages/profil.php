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
    if ($currentUser) {
        echo "<a href='index.php?page=deconnexion'>Me déconnecter</a>";
        echo "<a href='index.php?page=modifierProfil&id=" . $user['id'] . "'>Modifier mon profil</a>";
    } else {
        if ($_SESSION['privileges'] == "admin") {
            if ($userPrivileges != "admin")
                echo "<a href='#' onclick='confirmDelete(" . $user['id'] . ")'>Ban</a>";

            if ($userPrivileges == "particulier")
                echo "<a href='index.php?page=profil&id=" . $user['id'] . "&action=grantModo'>Nommer modérateur</a>";
            elseif ($userPrivileges == "modo") {
                echo "<a href='index.php?page=profil&id=" . $user['id'] . "&action=grantAdmin'>Nommer administrateur</a>";
                echo "<a href='index.php?page=profil&id=" . $user['id'] . "&action=removeModo'>Supprimer les privilèges de modérateur</a>";
            }
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
                <p>
                    <?= $annonce['date'] ?>
                </p>
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