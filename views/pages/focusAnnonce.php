<?php
?><a href="index.php?page=mur">Retour En arrière</a><?php
if (!$annonceId) {
    echo "Oups :/ une erreur est survenue.";
} else {
    
    echo "<h1>Focus de l'annonce $annonceId</h1>"; ?>

    <div class="annonce" style="overflow: hidden; word-wrap:break-word;">
    <?php $annoncesManager->getAnnonceType($annonceId, $avancees, $dispos, $recherches); ?>
        <h1><?php echo $annonce['titre']; ?></h1>
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
                <div class="commentaires" style="overflow: hidden; word-wrap:break-word;">
                    <p><?php echo $comm['description']; ?></p>
                    <p><?php echo $comm['username']; ?></p>
                    <!-- <?php if($comm['profile_picture']){
                        ?><img class="smallPfp" src="<?php echo $comm['profile_picture']; ?>" alt="profilePicture"><?php
                    }?> -->
                    <p><?php 
                    $date = explode('.', $comm['date']);
                    echo $date[0]; ?></p>
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
}
?>
