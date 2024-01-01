<nav>
    <div id="logoContainer">
        <img src="./public/images/logo_ltlb_transparent.png" alt="logo" id="logo">
    </div>
    <div >
        <ul id="menu">
            <li>
            <a href="index.php?page=home"><i class="fas fa-home"></i>Notre Projet</a>
            </li>
            <li id="navAnnonce">
                <i class="fas fa-comment" ></i>Annonces<i class="fas fa-caret-down"></i>
                <ul style="visibility:hidden;" id="navDeroulant">
                <li>
                    <a href="index.php?page=annuaire">Annuaire</a>
                </li>
                <li>
                    <a href="index.php?page=mur">Mur d'annonces</a>
                </li>
                </ul>
            </li>
    
    <?php
        if(isset($_SESSION['idUser']) && isset($_SESSION['username']) && isset($_SESSION['privileges'])){
            echo "
                <li>
                    <a href='index.php?page=profil&id=" . $_SESSION['idUser'] . "'><i class='fas fa-user'></i>Mon profil</a>
                </li>
            ";
            if($_SESSION['privileges'] != 'admin'){
                if($_SESSION['privileges'] == 'particulier'){
                    echo "
                <li>
                    <a href='index.php?page=postAnnonce'>Poster une Disponibilité</a>
                </li>";
                } else{
                    echo "
                        <li>
                            <a href='index.php?page=postAnnonce'>Poster une Annonce</a>
                        </li>";
                }
                
            }
        }
        else{
            echo "
                <li>
                    <a href='index.php?page=connexion'><i class='fas fa-user'></i>Me connecter</a>
                </li>
            ";
        }
    ?>
</ul>
    </div>
</nav>


<script>
    annonces = document.querySelector("#navAnnonce");
    deroulant = document.querySelector("#navDeroulant");
    annonces.addEventListener("click", (e) => {
        if (deroulant.style.visibility === "hidden" || deroulant.style.visibility === "") {
            deroulant.style.visibility = "visible";
        } else {
            deroulant.style.visibility = "hidden";
        }
        e.stopPropagation(); 
    });

    // Ajoutez un gestionnaire d'événements pour masquer le menu déroulant lorsque vous cliquez à l'extérieur
    document.addEventListener("click", (e) => {
        if (deroulant.style.visibility === "visible") {
            deroulant.style.visibility = "hidden";
        }
    });
</script>


<style>
    *, *::before, *::after {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        overflow: hidden;
    } 

    @font-face {
        font-family: 'Gotham';
        src: url('/public/fonts/Gotham-MediumItalic.otf') format('otf')
    }

    #menu{
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        background-color: #0F3F6C;
        color: white;
        font-family: 'Gotham';
    }

    a{
        color: white;
        text-decoration: none;
    }

    #logo{
        width: 35%;
    }

    #logoContainer{
        display: flex;
        justify-content: center;
    }

    #navAnnonce{
        position: inherit;
    }

    
</style>