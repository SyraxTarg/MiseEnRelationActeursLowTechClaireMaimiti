<?php
?><a href="index.php?page=mur" class="retourArriere"><i class="fas fa-arrow-left"></i></a><br><?php
if (!$annonceId) {
    echo "Oups :/ une erreur est survenue.";
} else {
     ?>

    <div class="annonce" style="overflow: hidden; word-wrap:break-word;">
    <?php $annoncesManager->getAnnonceType($annonce['id'], $avancees, $dispos, $recherches); ?>
    <div class="mainAnnonce">
        <div class="userPicture">
            <h2>
                <?php echo $annonce['username']; ?>
            </h2>
            <br>
            <?php
                if (!isset($annonce['profile_picture']) || $annonce['profile_picture'] == 'null'){
                    $pfp = "./public/images/defaultPfp.png";
                } else{
                    $pfp = $annonce['profile_picture'];
                }
            ?>
            <img src="<?php echo $pfp; ?>" alt="profile picture" class="pfp">
        </div>
        <div class="titleContent">
            <h1><?php echo $annonce['titre']; ?></h1>
            <hr>
            <div class="content">
                <?php
                    if ($annonce['image'] && $annonce['image'] != "null") {
                        ?><img class="imageAnnonce" src="<?php echo $annonce['image']; ?>" alt="image"><?php
                    } ?>
                <p><?php echo $annonce['description']; ?></p>
                <br>
                <hr>
                <p class="date"><?php 
                        $date = explode('.', $annonce['date']);
                        echo $date[0]; ?>
                </p>
            </div>
        
        </div>
</div>
    
        <div class="forms">
            <form method="post" action="" class="formLike">
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
            </form>
            <?php
            if(isset($_SESSION['username'])){
                if($_SESSION['username'] == $annonce['username']){
                    ?>
                    <form method="post" name="supprimer">
                        <button type="submit" class="supprimerAnnonce">Supprimer mon annonce</button>
                    </form>
                    <?php
                }
            }
            ?>
        </div>
        </div>
        <br>
        <?php
        $comms = $annoncesManager->getCommentaires($annonceId);
        if (!empty($comms)) {
            echo "<h2 id='titreCommentaires'>Commentaires:</h2>";
            echo "</br>";
            foreach ($comms as $comm) {
                ?>
                <div class="commentaires" style="overflow: hidden; word-wrap:break-word;">
                    
                    <div class="commentUser">
                        <h3><?php echo $comm['username']; ?></h3>
                        <?php
                        if (!isset($comm['profile_picture']) || $comm['profile_picture'] == 'null'){
                            $pfp = "./public/images/defaultPfp.png";
                        } else{
                            $pfp = $comm['profile_picture'];
                        }
                        ?>
                        <img src="<?php echo $pfp; ?>" alt="profile picture" class="pfp">
                    <p class="date"><?php 
                    $date = explode('.', $comm['date']);
                    echo $date[0]; ?></p>
                    </div>
                    <div class="commentContent">
                        <p><?php echo $comm['description']; ?></p>
                    </div>
                    
                </div>
                <hr class="commentSeparator">
                <?php
            }
        }
        ?>
    
    <?php 

        if(isset($_SESSION['username'])){
            ?>
            <form method="post" class="postComment">
                <h3>Ajouter un commentaire</h3>
                <textarea placeholder="votre commentaire ici" name="description" id="description" required></textarea>

                <input type="submit" value="Envoyer" name="posterComm" id="posterComm">
            </form>
            <?php
        }
        else{
            echo "<h3><a href='index?page=connexion'>Connectez-vous</a> pour laisser un commentaire</h3>";
        }
    ?>
    
    <?php
}
?>


<style>

    .imageAnnonce{
        max-height: 20vw;
    }

    .mainAnnonce{
        display: flex;
        gap: 8vw;
        margin-left: 5vw;
    }

    .annonce {
    margin-left: 1vw;
    margin-right: 1vw;
}


    .titleContent{
        width: 90%;
        margin-right: 3vw;
        
    }

    .titleContent h1{
        margin: 1vw;
    }

    .titleContent .content{
        padding: 1vw;
    }

    .titleContent .date{
        color: #9B91C3;
    }

    hr{
        color: #0F3F6C;
    }

    .forms{
        display: flex;
        gap: 80%;
        margin:1vw;
        margin-left: 6vw;
        text-decoration: none;
        font-size: 2vh;
    }

    .forms button{
        border: none;
    }

    .annonce h1{
        font-size: 3vw;
    }

    .userPicture{
        display: flex;
        flex-direction: column;
        gap: 0px 2vw;
        justify-content: center;
        width:fit-content;
    }

    .userPicture .pfp{
        max-width: 5vw;
        max-height: 5vw;
    }

    .like-btn{
        background-color: white;
        cursor: pointer;
        size: 3vh;
    }

    .supprimerAnnonce{
        background-color: #0F3F6C;
        color: white;
        padding: 2vh;
        cursor: pointer;
    }

    .formLike{
        font-size: 2vh;
    }

    .retourArriere{
        color: #0F3F6C;
        margin: 1vw;
        font-size: 2vw;
    }

    .annonce .annonceType{
        margin-top: 1vw;
        margin-right: 1vw;
        float: right;
        background-color: #FEDF26;
        padding:2vh;
        width: fit-content;
        font-size: 3vh;
        border-radius: 1vh;
    }

    .commentaires{
        margin-left: 5vw;
        margin-right: 3vw;
        border: none;
        display: flex;
        gap: 8%;
    }

    .commentSeparator{
        width: 40vw;
        margin: auto;
        margin-top: 2vw;
        margin-bottom: 2vw;
        
    }

    .commentaires .date{
        color: #9B91C3;
    }
    

    .commentaires .commentContent p{
        max-width: 70vw;
        max-height: fit-content;
    }

    #titreCommentaires{
        margin-left: 2vw;
        color: #0F3F6C;
    }

    .commentaires .commentUser{
        border-right: #0F3F6C solid 1px;
        padding-right: 4vw;
    }

    .commentaires .commentUser h3{
        color: #0F3F6C;
    }

    .commentaires .commentUser .pfp{
        max-width: 3vw;
        max-height: 3vw;
    }

    .postComment{
        border-top: #0F3F6C 1px solid;
        padding-top: 2vw;
        padding-left: 5vw;
        display: flex;
        flex-direction: column;
    }

    .postComment #description{
        width:30vw;
        height: 10vw;
        margin: auto;
        resize: vertical;
        border-radius: 3px;
        box-shadow: #0F3F6C 5px 5px 5px;
        font-size: large;
        color: #9B91C3;
    }

    .postComment #posterComm{
        width:fit-content;
        background-color: #0F3F6C;
        color: white;
        padding: 1vh;
        cursor: pointer;

    }

    .postComment #posterComm :hover{
        color: #FEDF26;
    }




</style>