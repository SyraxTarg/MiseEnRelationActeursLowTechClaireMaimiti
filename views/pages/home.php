<h1>HOME</h1>

<ul class="homeArticles">
    <?php foreach($annonces as $annonce) { ?>
        <li>
            <h3><?php echo $annonce["titre"] ?></h3>
            <div class=divArt>
                <div class="content"><p><?php echo $annonce["description"]?></p></div>
            </div>
        </li>
    <?php } ?>
</ul>
