<h1 id="annoncesTitre">Annonces</h1>

<?php
if (!isset($_SESSION['idUser'])) {
    $userId = null;
    $isLoggedIn = false;
    echo "Connectez-vous";
} else {
    $userId = $_SESSION['idUser'];
    $isLoggedIn = true;
}


$annoncesParPage = 20;

$numPage = isset($_GET['p']) ? (int) $_GET['p'] : 1;


$offset = ($numPage - 1) * $annoncesParPage;


$annonces = array_merge($annoncesPinned, $annoncesNonPinned);


$annoncesPaginees = array_slice($annonces, $offset, $annoncesParPage);


foreach ($annoncesPaginees as $index => $annonce) {
    $annonceId = $annonce['id'];
    $etatBoutonKey = 'etat_bouton_' . $annonceId . '_' . $userId;

    $etatBouton = isset($_SESSION[$etatBoutonKey]) ? $_SESSION[$etatBoutonKey] : 0;

    if ($isLoggedIn && isset($_POST['like'][$index])) {
        $etatBouton = ($etatBouton == 0) ? 1 : 0;

        $annoncesManager->leaveOrRemoveLike($annonceId, ($etatBouton == 1));

        $annonce['nb_likes'] = $annoncesManager->getLikesCount($annonceId);

        $_SESSION[$etatBoutonKey] = $etatBouton;
    }

    $heartColor = ($etatBouton == 1) ? 'red' : 'black';
    ?>

    <div class="annonceMur" style="overflow: hidden; word-wrap:break-word;">
        <?php $annoncesManager->getAnnonceType($annonceId, $avancees, $dispos, $recherches); ?>
        <?php if (in_array($annonce, $annoncesPinned, true)): ?>
            <i class="fas fa-thumbtack"></i>
        <?php endif; ?>
        <div class="mainAnnonce">
            <div class="userPicture">
                <?php
                if ($annonce['id_user'] == 5) { ?>
                    <p>
                        <?php echo $annonce['username']; ?>
                    </p>
                    <?php
                } else { ?>
                    <a href="index.php?page=profil&id=<?= $annonce['id_user'] ?>">
                        <p>
                            <?php echo $annonce['username']; ?>
                        </p>
                    </a>
                    <?php
                }
                ?>

                <?php
                if (!isset($annonce['profile_picture']) || $annonce['profile_picture'] == 'null') {
                    $pfp = "./public/images/defaultPfp.png";
                } else {
                    $pfp = $annonce['profile_picture'];
                }
                ?>
                <img src="<?php echo $pfp; ?>" alt="profilePicture" class="pfp">
            </div>
            <div class="titleContent">
                <h3>
                    <?php echo $annonce['titre']; ?>
                </h3>
                <hr>
                <?php if ($annonce['image'] && $annonce['image'] != "null"): ?>
                    <img class="imageAnnonce" src="<?php echo $annonce['image']; ?>" alt="image">
                <?php endif; ?>
                <p class="description">
                    <?php echo $annonce['description']; ?>
                </p>
                <hr>
                <p class="dateMur">
                    <?php
                    $date = explode('.', $annonce['date']);
                    echo $date[0]; ?>
                </p>
            </div>
        </div>



        <form method="post" action="" class="formLike">
            <input type="hidden" name="annonce_id" value="<?php echo $annonceId; ?>">
            <p>
                <span id="likes-count-<?php echo $annonceId; ?>" class="nbLikesMur">
                    <?php echo $annonce['nb_likes']; ?>
                </span>
                <?php if ($isLoggedIn): ?>
                    <button type="submit" name="like[<?php echo $index; ?>]" class="like-btn-mur"
                        data-is-liked="<?php echo $etatBouton; ?>">
                        <i class="fas fa-heart" style="color: <?php echo $heartColor; ?>"></i>
                    </button>
                <?php else: ?>
                    <i class="fas fa-heart" style="color: red"></i>
                <?php endif; ?>

            </p>
        </form>
        <hr class="annonceCommentSeparator">
        <?php
        $comms = $annoncesManager->getLastCommentaires($annonceId);
        if (!empty($comms)): ?>
            <?php foreach ($comms as $comm): ?>
                <div class="commentairesMur" style="overflow: hidden; word-wrap:break-word;">
                    <div class="commentUserMur">
                        <?php
                        if ($comm['id_user'] == 5) { ?>
                            <p>
                                <?php echo $comm['username']; ?>
                            </p>
                            <?php
                        } else { ?>
                            <a href="index.php?page=profil&id=<?= $comm['id_user'] ?>">
                                <p>
                                    <?php echo $comm['username']; ?>
                                </p>
                            </a>
                            <?php
                        }
                        ?>
                        <?php
                        if (!isset($comm['profile_picture']) || $comm['profile_picture'] == 'null') {
                            $pfp = "./public/images/defaultPfp.png";
                        } else {
                            $pfp = $comm['profile_picture'];
                        }
                        ?>
                        <img src="<?php echo $pfp; ?>" alt="profile picture" class="pfpCommentMur">
                        <p class="dateMur">
                            <?php
                            $date = explode('.', $comm['date']);
                            echo $date[0]; ?>
                        </p>
                    </div>
                    <div class="commentContentMur">
                        <p>
                            <?php echo $comm['description']; ?>
                        </p>
                    </div>
                </div>
                <hr class="commentSeparatorMur">
            <?php endforeach; ?>
        <?php endif; ?>
        <div class="voirPlus">
            <a href='index.php?page=mur&p=$numPage&id=<?php echo $annonceId; ?>' class="voirPlusBtn">Voir plus ...</a>
        </div>

    </div>

    <?php
    echo "</br>";
    echo "</br>";
}



$totalAnnonces = count($annonces);
$totalPages = ceil($totalAnnonces / $annoncesParPage);


echo "<div class='pagination'>";
for ($i = 1; $i <= $totalPages; $i++) {
    echo "<a href='index.php?page=mur&p=$i'class='paginationBtn'>$i</a>";
}
echo "</div>";
?>

<style>
    .imageAnnonce {
        max-height: 20vw;
    }

    #annoncesTitre {
        display: flex;
        justify-content: center;
    }

    .annonceMur {
        width: 70vw;
        margin: auto;
        padding: 1vw;
        border: 1px solid #31356E;
    }

    .annonceMur>.annonceType {
        margin-top: 1vw;
        margin-right: 1vw;
        margin-left: 1vw;
        float: right;
        background-color: #FEDF26;
        padding: 1vh;
        width: fit-content;
        font-size: 2vh;
        border-radius: 1vh;
        font-family: "Montserrat", sans-serif;

    }

    .nbLikesMur {
        font-size: 2vh;
    }

    .fas.fa-thumbtack {
        color: #31356E;
        /* float: right; */
        width: fit-content;
    }

    .like-btn-mur {
        background-color: white;
        border: none;
        margin-bottom: 1vw;
        font-size: 2vh;
    }

    .mainAnnonce {
        display: flex;
        gap: 8vw;
        margin-left: 5vw;
        font-family: "Montserrat", sans-serif;
    }

    .description {
        padding-top: 1vw;
        padding-bottom: 1vw;
    }

    .pfpCommentMur {
        max-height: 3vw;
        border-radius: 3vh;
    }

    .commentairesMur {
        margin-left: 5vw;
        margin-right: 3vw;
        border: none;
        display: flex;
        gap: 8%;
        font-family: "Montserrat", sans-serif;
    }

    .commentSeparatorMur {
        width: 60vw;
        margin: auto;
        margin-top: 2vw;
        margin-bottom: 2vw;
    }

    .annonceCommentSeparator {
        margin-bottom: 1vw;
    }

    .commentUserMur {
        border-right: #31356E 1px solid;
        padding-right: 1vw;
    }

    .dateMur {
        color: #9B91C3;
    }

    .voirPlus {
        display: flex;
        justify-content: center;
    }

    .voirPlusBtn {
        color: #9B91C3;
        font-family: "Montserrat", "sans-serif";
        text-decoration: none;
    }

    .voirPlusBtn:hover {
        color: #31356E;
    }

    .pagination {
        display: flex;
        justify-content: center;
    }

    .paginationBtn {
        text-decoration: none;
        padding: 1vh;
        margin: 1vh;
        font-size: 2vh;
        font-family: "Montserrat", "sans-serif";
    }

    .paginationBtn:hover {
        background-color: gainsboro;
    }
</style>