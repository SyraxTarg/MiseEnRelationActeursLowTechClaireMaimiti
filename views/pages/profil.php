<div id="profil" class="column_align">
    <?php

    if ($user['id'] == 1 && $user['username'] == "utilisateur introuvable") { ?>
        <h1 class="user_infos">Cet utilisateur n'existe pas.</h1>
        <?php
    } else {
        if (isset($msg))
            echo $msg;
        ?>

        <section>
            <div class="row_align user_infos">
                <img class="profil_pfp" src="<?= $user['profile_picture'] ?>" alt="pfp">

                <div class="column_align">
                    <h1 class="user_info">
                        <?= $user['username'] ?>
                    </h1>
                    <div>
                        <?php
                        if (isset($userPrivileges)) { ?>
                            <p><?=$userPrivileges?></p>
                        <?php }
                        ?>
                    </div>
                    <p class="user_info">
                        <?= $user['bio'] ?>
                    </p>

                    <p class="user_info">Contact :
                        <a class="link_action" href="mailto:<?= $user['email'] ?>">
                            <?= $user['email'] ?>
                        </a>
                    </p>

                    <?php
                    if ($user['activites']) { ?>
                        <div class="user_info">
                            <p>Activités :</p>
                            <?php
                            foreach ($activites as $act) { ?>
                                <p class="unique_act">
                                    <?= $act ?>
                                </p>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </section>


        <section>
            <div class="row_align profil_links">
                <?php
                if ($currentUser) { ?>
                    <a class="link_action" href='index.php?page=profil&action=disconnect'>Me déconnecter</a>
                    <p> | </p>
                    <a class="link_action" href='index.php?page=modifierProfil'>Modifier mon profil</a>
                    <?php
                } else {
                    if (isset($_SESSION['privileges']) && $_SESSION['privileges'] == "admin") {
                        if ($userPrivileges != "Administrateur") { ?>
                            <a class="link_action" href="#"
                                onclick="confirmDelete(<?= $user['id'] ?>, 'Êtes-vous sûr de vouloir bannir cet utilisateur ? Il ne sera pas prévenu.', 'ban')">Ban</a>
                            <p> | </p>
                        <?php }
                        if ($userPrivileges == "Particulier") { ?>
                            <a class="link_action" href="index.php?page=profil&id=<?= $user['id'] ?>&action=grantModo">Nommer
                                modérateur</a>
                        <?php } elseif ($userPrivileges == "Modérateur") { ?>
                            <a class="link_action" href="index.php?page=profil&id=<?= $user['id'] ?>&action=removeModo">Supprimer les
                                privilèges de modérateur</a>
                            <p> | </p>
                            <a class="link_action" href="#"
                                onclick="confirmDelete(<?= $user['id'] ?>, 'Êtes-vous sûr de vouloir nommer cet utilisateur administrateur ? Cette action est irréversible.', 'grantAdmin')">Nommer
                                administrateur</a>
                        <?php }
                    }
                }
                ?>
            </div>
        </section>


        <!-- afficher les annonces (sans les commentaires) -->
        <?php
        if ($annonces) {
            ?>
            <section>
                <h1 class="align_center">Annonces récentes</h1>
                <div class="column_align profil_list_annonces">
                    <?php
                    foreach ($annonces as $annonce) {
                        ?>
                        <div class="annonce profil_annonce">
                            <a class="link_action" href="index.php?page=focusAnnonce&id=<?= $annonce['id'] ?>">
                                <h2 class="annonce_info">
                                    <?= $annonce['titre'] ?>
                                </h2>
                            </a>
                            <?php
                            if ($annonce['image'] && $annonce['image'] != "null") { ?>
                                <img class="annonce_info" src="<?= $annonce['image'] ?>" alt="visuel annonce">
                                <?php
                            }
                            ?>
                            <p class="annonce_info">
                                <?= $annonce['description'] ?>
                            </p>
                            <p class="annonce_info">
                                <?php
                                $date = explode('.', $annonce['date']);
                                echo $date[0];
                                ?>
                            </p>
                        </div>
                        <br>
                        <?php
                    }
                    ?>
                </div>
            </section>

            <?php
        }
    }
    ?>
</div>

<style>
    .align_center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    #profil {
        font-family: "Montserrat", sans-serif;
    }

    .profil_links {
        margin: 0 6vw;
    }

    /* INFOS UTILISATEUR */
    #profil .user_infos {
        margin: 6vh 0 4vh 6vw;
    }

    #profil .user_infos>div {
        margin: 0 0 0 6vw;
    }

    #profil .profil_pfp {
        width: 20vw;
        height: 20vw;
        object-fit: cover;
        border-radius: 100%;
    }

    #profil .user_info {
        margin: 0.5vw 0;
        display: flex;
        align-items: center;
    }

    /* ANNONCES */
    #profil .profil_list_annonces {
        margin: 2vw;
    }

    #profil .profil_annonce {
        padding: 1.5vw;
    }

    #profil .profil_annonce img {
        height: 20vw;
    }

    #profil .annonce_info {
        margin: 1vh 0;
    }
</style>