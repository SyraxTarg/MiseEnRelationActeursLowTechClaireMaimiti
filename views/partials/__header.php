<i class="fas fa-bars" id="menu_icon"></i>
<div id="logoContainer">
    <img src="./public/images/logo_ltlb_transparent.png" alt="logo" id="logo">
</div>
<nav>
    <ul id="menu">
        <li>
            <a href="index.php?page=home"><i class="fas fa-home"></i>Notre Projet</a>
        </li>
        <li id="navAnnonces">
            <a href=""><i class="fas fa-comment"></i>Annonces &ensp;</a>
            <ul id="navDeroulant">
                <li>
                    <a href="index.php?page=annuaire">Annuaire public</a>
                </li>
                <li>
                    <a href="index.php?page=mur&p=1">Mur d'annonces</a>
                </li>


                <?php
                if (isset($_SESSION['idUser']) && isset($_SESSION['username']) && isset($_SESSION['privileges'])) {

                    if ($_SESSION['privileges'] != 'admin') {
                        if ($_SESSION['privileges'] == 'particulier') {
                            echo "
                <li>
                    <a href='index.php?page=postAnnonce'>Poster une Disponibilité</a>
                </li>";
                        } else {
                            echo "
                        <li>
                            <a href='index.php?page=postAnnonce'>Poster une Annonce</a>
                        </li>";
                        }

                    }
                    ?>
                </ul>
            </li>
            <?php
            echo "
                    <li>
                        <a href='index.php?page=profil&id=" . $_SESSION['idUser'] . "'><i class='fas fa-user'></i>Mon profil</a>
                    </li>
                ";

                } else {
                    ?>
        </ul>
        </li>
        <?php
        echo "
                <li>
                    <a href='index.php?page=connexion'><i class='fas fa-user'></i>Me connecter</a>
                </li>
            ";
                }
                ?>
    </ul>
</nav>





<style>
    *,
    *::before,
    *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }


    #menu {
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        background-color: #0F3F6C;
        color: white;
        font-family: "Montserrat", sans-serif;
        position: sticky;
        list-style-type: none;
    }

    nav a {
        color: white;
        text-decoration: none;
    }

    #menu_icon {
        display: none;
        position: absolute;
        margin: 2vh 0 0 2vh;
    }

    #logo {
        width: 35%;
    }

    #logoContainer {
        display: flex;
        justify-content: center;
    }


    nav {
        width: 100%;
        margin: 0 auto;
        background-color: white;
        position: sticky;
        top: 0px;
        margin-bottom: 2vw;
        z-index: 2;
    }

    nav ul {
        list-style-type: none;
    }

    nav ul li {
        float: left;
        width: 25%;
        text-align: center;
        position: relative;
    }


    nav a {
        display: block;
        text-decoration: none;
        color: white;
        border-bottom: 2px solid transparent;
        padding: 10px 0px;
        font-size: larger;
    }

    nav a:hover {
        color: #FCDB1B;
        border-bottom: 2px solid gold;
    }

    #navDeroulant {
        display: none;
        box-shadow: 0px 1px 2px #CCC;
        background-color: #0F3F6C;
        position: absolute;
        width: 100%;
        z-index: 1000;
    }

    nav>ul li:hover #navDeroulant {
        display: block;
    }

    #navDeroulant li {
        float: none;
        width: 100%;
        text-align: left;
    }

    #navDeroulant a {
        padding: 10px;
        border-bottom: none;
    }

    #navDeroulant a:hover {
        border-bottom: none;
        background-color: #31356E;
    }

    #navAnnonces>a::after {
        content: " ▼";
        font-size: small;
    }

    nav i {
        padding-right: 2%;
    }

    @media (max-width: 992px) {}

    @media (max-width: 768px) {
        #menu_icon {
            display: block;
        }
    }
</style>

<script>
    // let largeurViewport = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
    let menu_icon = document.querySelector('#menu_icon');
    let menu = document.querySelector('nav');
    let panel_open = false;
    menu.style.display = "none";

    menu_icon.addEventListener("click", function () {
        panel_open = !panel_open;
        if (panel_open) {
            menu.style.display = "block";
        } else {
            menu.style.display = "none";
        }
    })

</script>