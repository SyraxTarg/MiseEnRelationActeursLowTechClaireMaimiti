<h1>Mur d'annonces</h1>

<div class="annonces">
    <?php
        foreach ($annonces as $annonce) {?>
            <div class="annonce"><?php
            echo "<h3>".$annonce['titre']."</h3>";
            echo "<p>".$annonce['description']."</p>";
            $comms=$annoncesManager->getCommentaires($annonce['id']);
            ?><div class="commentaires"><?php
            echo "<p>Derniers Commentaires:</p>";
                foreach ($comms as $comm ) {
                    echo "<b>".$comm['description']."</b>";
                }?>
            </div>
            
            </div>
            <br><?php
        }?>
</div>
