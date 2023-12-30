<p>HEADER</p>
<ul>
    <li>
        <a href="index.php?page=home">Home</a>
    </li>
    <li>
        <a href="index.php?page=annuaire">Annuaire</a>
    </li>
    <li>
        <a href="index.php?page=mur">Mur d'annonces</a>
    </li>
    <?php
        if(isset($_SESSION['idUser']) && isset($_SESSION['username']) && isset($_SESSION['privileges'])){
            echo "
                <li>
                    <a href='index.php?page=profil&id=" . $_SESSION['idUser'] . "'>Mon profil</a>
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
                    <a href='index.php?page=connexion'>Me connecter</a>
                </li>
            ";
        }
    ?>
</ul>