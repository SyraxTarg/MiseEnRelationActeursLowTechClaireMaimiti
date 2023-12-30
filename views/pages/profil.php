<h1>Profil de <?= $user['username'] ?></h1>

<?php
    if($currentUser){
        echo "<a href='index.php?page=deconnexion'>Me déconnecter</a>";
        echo "<a href='index.php?page=modifierProfil'>Modifier mon profil</a>";
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
            <h4><?=$annonce['titre']?></h4>
            <p><?=$annonce['date']?></p>
            <p><?=$annonce['description']?></p>
        </div>
        <br>
        <?php
    }
}

?>

