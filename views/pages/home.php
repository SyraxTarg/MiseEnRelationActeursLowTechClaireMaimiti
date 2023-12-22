<?php
if(!$connecte)
    echo "<a href='index.php?page=connexion'>Me connecter</a>";
else{
    echo "<h2>Bienvenue " . $currentUser['username'] . "</h2>";
    echo "<h4>" . $_SESSION['privileges'] . "</h4>";
    echo "<a href='index.php?page=deconnexion'>Me déconnecter</a>";
}
    
?>

<h1>HOME</h1>

<ul class="homeArticles">
    <?php foreach($annonces as $annonce) { ?>
        <li>
            <h3><?php echo $annonce["titre"] ?></h3>
            <div class=divArt>
                <div class="content"><p><?php echo $annonce["description"]?></p></div>
            </div>
        </li>
    <?php } ?>
</ul>
