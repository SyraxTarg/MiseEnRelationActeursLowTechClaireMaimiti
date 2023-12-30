<?php

if($user['id'] == 5 && $user['username'] == "utilisateur introuvable"){
    echo "<h1>Cet utilisateur a supprimé son profil</h1>";
}
else{
    ?>
    <h1>Profil de <?= $user['username'] ?></h1>

    <?php
        if($currentUser){
            echo "<a href='index.php?page=deconnexion'>Me déconnecter</a>";
            echo "<a href='index.php?page=modifierProfil'>Modifier mon profil</a>";
        }
        else{
            if($_SESSION['privileges'] == "admin"){
                echo "<a href='#' onclick='confirmDelete(" . $user['id'] . ")'>Ban</a>";
                
                if($userPrivileges == "particulier")
                    echo "<a href='index.php?page=profil&id=" . $user['id'] . "&action=grant'>Nommer modérateur</a>";
                else
                    echo "<a href='index.php?page=profil&id=" . $user['id'] . "&action=remove'>Supprimer les privilèges de modérateur</a>";
            }
        }
    ?>

    <p>Contact : <?= $user['email'] ?></p>

    <?php
        if($user['activites']){
            echo "<p>Activités : " . $user['activites'] . "</p>" ;
        }
    ?>

    <!-- afficher les annonces (sans les commentaires) -->
    <?php
    if($annonces){
        foreach($annonces as $annonce){
            ?>
            <div class="annonce">
                <a href="index.php?page=focusAnnonce&id=<?=$annonce['id']?>">
                    <h4><?=$annonce['titre']?></h4>
                </a>
                <p><?=$annonce['date']?></p>
                <p><?=$annonce['description']?></p>
            </div>
            <br>
            <?php
        }
    }
    ?>
    <?php
}