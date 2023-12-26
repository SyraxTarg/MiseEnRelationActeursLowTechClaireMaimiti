<h1>Mur d'annonces</h1>

<div class="annonces">
    <?php
        foreach ($annoncesPinned as $annoncePinned) {?>
            <div class="annonce"><?php
            echo "<h3>".$annoncePinned['titre']."</h3>";
            echo "<p>".$annoncePinned['description']."</p>";
            echo "<p>".$annoncePinned['date']."</p>";
            echo "<p>".$annoncePinned['nb_likes']."<a href='http://' target='_blank' '><i class='fas fa-heart'></i></a></p>";
            $comms=$annoncesManager->getCommentaires($annoncePinned['id']);
            if(!empty($comms)) {
                ?><div class="commentaires"><?php
            echo "<p>Derniers Commentaires:</p>";
                foreach ($comms as $comm ) {
                    echo "<p><b>".$comm['description']."</b>".$comm['username']."</p></br>";
                }?>
            </div><?php
            }
            ?>
            </div>
            <br><?php
        }?>
    <?php
        foreach ($annoncesNonPinned as $annonceNonPinned) {?>
            <div class="annonce"><?php
            echo "<h3>".$annonceNonPinned['titre']."</h3>";
            echo "<p>".$annonceNonPinned['description']."</p>";
            echo "<p>".$annonceNonPinned['date']."</p>";
            echo "<p>".$annonceNonPinned['nb_likes']."<a href='http://' target='_blank' '><i class='fas fa-heart'></i></a></p>";
            $comms=$annoncesManager->getCommentaires($annonceNonPinned['id']);
            if(!empty($comms)) {
                ?><div class="commentaires"><?php
            echo "<p>Derniers Commentaires:</p>";
                foreach ($comms as $comm ) {
                    echo "<p><b>".$comm['description']."</b>".$comm['username']."</p></br>";
                }?>
            </div><?php
            }
            ?>
            </div>
            <br><?php
        }?>
</div>
