
<?php
if (!isset($_SESSION['idUser'])) {
    $userId = null;
    $isLoggedIn = false;
    echo "Connectez-vous";
} else {
    $userId = $_SESSION['idUser'];
    $isLoggedIn = true;
}

foreach ($annoncesPinned as $index => $annoncePinned) {
    $annonceId = $annoncePinned['id'];
    $etatBoutonKey = 'etat_bouton_' . $annonceId . '_' . $userId;


    $etatBouton = isset($_SESSION[$etatBoutonKey]) ? $_SESSION[$etatBoutonKey] : 0;

    if ($isLoggedIn && isset($_POST['like'][$index])) {
        $etatBouton = ($etatBouton == 0) ? 1 : 0;

        $annoncesManager->leaveOrRemoveLike($annonceId, ($etatBouton == 1));

        $annoncePinned['nb_likes'] = $annoncesManager->getLikesCount($annonceId);

        $_SESSION[$etatBoutonKey] = $etatBouton;
    }

    $heartColor = ($etatBouton == 1) ? 'red' : 'black';
    ?>

    <div class="annonce" style="overflow: hidden; word-wrap:break-word;">
        <?php $annoncesManager->getAnnonceType($annonceId, $avancees, $dispos, $recherches); ?>
        <i class="fas fa-thumbtack"></i>
        <h3><?php echo $annoncePinned['titre']; ?></h3>
        <?php
        if ($annoncePinned['image'] && $annoncePinned['image'] != "null") {
            ?> <img class="imageAnnonce" src="<?php echo $annoncePinned['image']; ?>" alt="image"><?php
        } ?>
        <p><?php echo $annoncePinned['description']; ?></p>
        <p>
            <?php echo $annoncePinned['username']; ?>
        </p>
        <p><?php
            $date = explode('.', $annoncePinned['date']);
            echo $date[0]; ?>
        </p>

        <form method="post" action="">
            <input type="hidden" name="annonce_id" value="<?php echo $annonceId; ?>">
            <p>
                <span id="likes-count-<?php echo $annonceId; ?>"><?php echo $annoncePinned['nb_likes']; ?></span>
                <?php
                if ($isLoggedIn) {
                    ?>
                    <button type="submit" name="like[<?php echo $index; ?>]" class="like-btn" data-is-liked="<?php echo $etatBouton; ?>">
                        <i class="fas fa-heart" style="color: <?php echo $heartColor; ?>"></i>
                    </button><?php
                } else {
                    ?>
                    <i class="fas fa-heart" style="color: red"></i><?php
                } ?>
            </p>
        </form>
        <?php
        if(isset($_SESSION['username'])){
            if($_SESSION['username'] == $annoncePinned['username']){
            $i=0;
            $comms = $annoncesManager->getCommentaires($annonceId);
            foreach ($comms as $comm) {
                $i+=1;
                ?>
                <div class="commentaires" style="overflow: hidden; word-wrap:break-word;">
                    <p><?php echo $comm['description']; ?></p>
                    <p><?php echo $comm['username']; ?></p>
                    <p><?php
                        $date = explode('.', $comm['date']);
                        echo $date[0]; ?>
                    </p>

                </div>
            <?php
            // if($i == 3){
            //     return;
            // }
            }
        }

        ?>
    </div>
    
<?php
echo "<a href='index.php?page=mur&id=$annonceId'>Voir plus</a>";
echo "</br>";
echo "</br>";
}

foreach ($annoncesNonPinned as $index => $annonceNonPinned) {
    $annonceId = $annonceNonPinned['id'];
    $etatBoutonKey = 'etat_bouton_' . $annonceId . '_' . $userId;


    $etatBouton = isset($_SESSION[$etatBoutonKey]) ? $_SESSION[$etatBoutonKey] : 0;

    if ($isLoggedIn && isset($_POST['like'][$index])) {
        $etatBouton = ($etatBouton == 0) ? 1 : 0;

        $annoncesManager->leaveOrRemoveLike($annonceId, ($etatBouton == 1));

        $annonceNonPinned['nb_likes'] = $annoncesManager->getLikesCount($annonceId);

        $_SESSION[$etatBoutonKey] = $etatBouton;
    }

    $heartColor = ($etatBouton == 1) ? 'red' : 'black';
    ?>

    <div class="annonce" style="overflow: hidden; word-wrap:break-word;">
        <?php $annoncesManager->getAnnonceType($annonceId, $avancees, $dispos, $recherches); ?>
        <h3><?php echo $annonceNonPinned['titre']; ?></h3>
        <?php
        if ($annonceNonPinned['image'] && $annonceNonPinned['image'] != "null") {
            ?> <img class="imageAnnonce" src="<?php echo $annonceNonPinned['image']; ?>" alt="image"><?php
        } ?>
        <p><?php echo $annonceNonPinned['description']; ?></p>
        <p>
            <?php echo $annonceNonPinned['username']; ?>
        </p>
        <p><?php
            $date = explode('.', $annonceNonPinned['date']);
            echo $date[0]; ?>
        </p>

        <form method="post" action="">
            <input type="hidden" name="annonce_id" value="<?php echo $annonceId; ?>">
            <p>
                <span id="likes-count-<?php echo $annonceId; ?>"><?php echo $annonceNonPinned['nb_likes']; ?></span>
                <?php
                if ($isLoggedIn) {
                    ?>
                    <button type="submit" name="like[<?php echo $index; ?>]" class="like-btn" data-is-liked="<?php echo $etatBouton; ?>">
                        <i class="fas fa-heart" style="color: <?php echo $heartColor; ?>"></i>
                    </button><?php
                } else {
                    ?>
                    <i class="fas fa-heart" style="color: red"></i><?php
                } ?>

            </p>
        </form>
        <?php
        $comms = $annoncesManager->getLastCommentaires($annonceId);
        if (!empty($comms)) {
            echo "<p>Derniers commentaires:</p>";
            foreach ($comms as $comm) {
                ?>
                <div class="commentaires" style="overflow: hidden; word-wrap:break-word;">
                    <p><?php echo $comm['description']; ?></p>
                    <p><?php echo $comm['username']; ?></p>
                    <p><?php
                        $date = explode('.', $comm['date']);
                        echo $date[0]; ?>
                    </p>

                </div>
            <?php
            }
        }

        ?>
    </div>
<?php
echo "<a href='index.php?page=mur&id=$annonceId'>Voir plus</a>";
echo "</br>";
echo "</br>";
}

}