<?php
foreach ($annoncesPinned as $index => $annoncePinned) {
    $annonceId = $annoncePinned['id'];
    $etatBoutonKey = 'etat_bouton_' . $annonceId;
    
    $etatBouton = isset($_SESSION[$etatBoutonKey]) ? $_SESSION[$etatBoutonKey] : 0;

    if (isset($_POST['like'][$index])) {
        $etatBouton = ($etatBouton == 0) ? 1 : 0;


        $annoncesManager->leaveOrRemoveLike($annonceId, ($etatBouton == 1));

        $annoncePinned['nb_likes'] = $annoncesManager->getLikesCount($annonceId);
        
        $_SESSION[$etatBoutonKey] = $etatBouton;
    }
    
    $heartColor = ($etatBouton == 1) ? 'red' : 'black';
    ?>

    <div class="annonce">
        <?php getAnnonceType($annonceId, $avancees, $dispos, $recherches); ?>
        <i class="fas fa-thumbtack"></i>
        <h3><?php echo $annoncePinned['titre']; ?></h3>
        <?php 
        if($annoncePinned['image']){
            ?> <img class="imageAnnonce" src="<?php echo $annoncePinned['image'] ; ?>" alt="image"><?php
        }?>
        <p><?php echo $annoncePinned['description']; ?></p>
        <p><?php echo $annoncePinned['date']; ?></p>
        

        <form method="post" action="">
            <input type="hidden" name="annonce_id" value="<?php echo $annonceId; ?>">
            <p>
                <span id="likes-count-<?php echo $annonceId; ?>"><?php echo $annoncePinned['nb_likes']; ?></span>
                <?php
                if(isset($_SESSION['username'])){
                    ?>
                    <button type="submit" name="like[<?php echo $index; ?>]" class="like-btn" data-is-liked="<?php echo $etatBouton; ?>">
                    <i class="fas fa-heart" style="color: <?php echo $heartColor; ?>"></i>
                </button><?php
                } else{
                    ?>
                    <i class="fas fa-heart" style="color: red"></i><?php
                } ?>
                
            </p>
        </form>
        <?php 
        $comms = $annoncesManager->getCommentaires($annonceId);
        if(!empty($comms)){
            echo "<p>Derniers commentaires:</p>";
            foreach($comms as $comm){
                ?>
                <div class="commentaires">
                    <p><?php echo $comm['description'];?></p>
                    <p><?php echo $comm['username'];?></p>
                    <p><?php echo $comm['date'];?></p>

                </div>
                    <?php
            }
        }

    ?>
    </div>
    <br>
<?php
}
?>

<?php
foreach ($annoncesNonPinned as $index => $annonceNonPinned) {
    $annonceId = $annonceNonPinned['id'];
    $etatBoutonKey = 'etat_bouton_' . $annonceId;
    
    $etatBouton = isset($_SESSION[$etatBoutonKey]) ? $_SESSION[$etatBoutonKey] : 0;

    if (isset($_POST['like'][$index])) {
        $etatBouton = ($etatBouton == 0) ? 1 : 0;


        $annoncesManager->leaveOrRemoveLike($annonceId, ($etatBouton == 1));

        $annonceNonPinned['nb_likes'] = $annoncesManager->getLikesCount($annonceId);
        
        $_SESSION[$etatBoutonKey] = $etatBouton;
    }
    
    $heartColor = ($etatBouton == 1) ? 'red' : 'black';
    ?>

    <div class="annonce">
        <?php getAnnonceType($annonceId, $avancees, $dispos, $recherches); ?>
        <h3><?php echo $annonceNonPinned['titre']; ?></h3>
        <?php 
        if($annonceNonPinned['image']){
            ?> <img class="imageAnnonce" src="<?php echo $annonceNonPinned['image'] ; ?>" alt="image"><?php
        }?>
        <p><?php echo $annonceNonPinned['description']; ?></p>
        <p><?php echo $annonceNonPinned['date']; ?></p>

        <form method="post" action="">
            <input type="hidden" name="annonce_id" value="<?php echo $annonceId; ?>">
            <p>
                <span id="likes-count-<?php echo $annonceId; ?>"><?php echo $annonceNonPinned['nb_likes']; ?></span>
                <?php
                if(isset($_SESSION['username'])){
                    ?>
                    <button type="submit" name="like[<?php echo $index; ?>]" class="like-btn" data-is-liked="<?php echo $etatBouton; ?>">
                    <i class="fas fa-heart" style="color: <?php echo $heartColor; ?>"></i>
                </button><?php
                } else{
                    ?>
                    <i class="fas fa-heart" style="color: red"></i><?php
                }?>
                
            </p>
        </form>
        <?php 
        $comms = $annoncesManager->getCommentaires($annonceId);
        if(!empty($comms)){
            echo "<p>Derniers commentaires:</p>";
            foreach($comms as $comm){
                ?>
                <div class="commentaires">
                    <p><?php echo $comm['description'];?></p>
                    <p><?php echo $comm['username'];?></p>
                    <p><?php echo $comm['date'];?></p>

                </div>
                    <?php
            }
        }

    ?>

    </div>
    <br>
<?php
}
?>