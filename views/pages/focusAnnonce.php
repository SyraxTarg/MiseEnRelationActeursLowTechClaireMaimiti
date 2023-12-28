<?php
$annonceId = isset($_GET['id']) ? $_GET['id'] : null;
$annonce = $annoncesManager->getSingleAnnonce($annonceId);

$etatBoutonKey = 'etat_bouton_' . $annonceId;
$etatBouton = isset($_SESSION[$etatBoutonKey]) ? $_SESSION[$etatBoutonKey] : 0;

if (!$annonceId) {
    echo "Oups :/ une erreur est survenue.";
} else {
    echo "<h1>Focus de l'annonce $annonceId</h1>"; ?>
    <div class="annonce">
        <h3><?php echo $annonce['titre']; ?></h3>
        <?php
        if ($annonce['image']) {
            ?><img class="imageAnnonce" src="<?php echo $annonce['image']; ?>" alt="image"><?php
        } ?>
        <p><?php echo $annonce['description']; ?></p>
        <p><?php echo $annonce['date']; ?></p>
        <form method="post" action="">
            <input type="hidden" name="annonce_id" value="<?php echo $annonceId; ?>">
            <p>
                <span id="likes-count-<?php echo $annonceId; ?>"><?php echo $annonce['nb_likes']; ?></span>
                <?php
                if (isset($_SESSION['username'])) {
                    ?>
                    <button type="submit" name="like" class="like-btn">
                        <i class="fas fa-heart" style="color: <?php echo ($etatBouton == 1) ? 'red' : 'black'; ?>"></i>
                    </button><?php
                } else {
                    ?>
                    <i class="fas fa-heart" style="color: red"></i><?php
                } ?>

            </p>
        </form><?php
        $comms = $annoncesManager->getCommentaires($annonceId);
        if (!empty($comms)) {
            echo "<p>Derniers commentaires:</p>";
            foreach ($comms as $comm) {
                ?>
                <div class="commentaires">
                    <p><?php echo $comm['description']; ?></p>
                    <p><?php echo $comm['username']; ?></p>
                    <p><?php echo $comm['date']; ?></p>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php 

        if(isset($_SESSION['username'])){
            ?>
            <form method="post">
                <label for="description">Ajouter un commentaire:</label>
                <input type="textarea" placeholder="votre commentaire ici" name="description" id="description">
                <!-- <input type="file" name="image" id="image"> -->
                <input type="submit" value="Envoyer" name="posterComm" id="posterComm">
            </form>
            <?php
        }
        else{
            echo "<h3>Connectez-vous pour laisser un commentaire</h3>";
        }
    ?>
    
    <?php
    if (isset($_POST['posterComm'])) {
        $annoncesManager->postCommentaire($annonceId);
        header("Refresh:0");
    }

    if (isset($_POST['like'])) {
        $etatBouton = ($etatBouton == 0) ? 1 : 0;

        $annoncesManager->leaveOrRemoveLike($annonceId, ($etatBouton == 1));

        $annonce['nb_likes'] = $annoncesManager->getLikesCount($annonceId);

        $_SESSION[$etatBoutonKey] = $etatBouton;
    }
}
?>
