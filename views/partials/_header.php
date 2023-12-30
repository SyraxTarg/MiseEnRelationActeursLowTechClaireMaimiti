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
                <li>
                    <a href='index.php?page=postAnnonce'>Poster une Annonce</a>
            ";
        }
    ?>
</ul>