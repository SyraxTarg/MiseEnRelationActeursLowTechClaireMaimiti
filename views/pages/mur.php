<?php
// Supposons que $annoncesPinned et $annoncesNonPinned soient déjà définis
foreach ($annoncesPinned as $index => $annoncePinned) {
    $annonceId = $annoncePinned['id'];
    $etatBoutonKey = 'etat_bouton_' . $annonceId;

    // Initialise l'état du bouton si ce n'est pas encore défini
    if (!isset($_POST[$etatBoutonKey])) {
        $_POST[$etatBoutonKey] = 0;
    }

    if (isset($_POST['like'][$index])) {
        // Inverse l'état du bouton spécifique à cette annonce
        $_POST[$etatBoutonKey] = ($_POST[$etatBoutonKey] == 0) ? 1 : 0;

        // Mettez à jour le nombre de likes dans votre base de données
        $addLike = ($_POST[$etatBoutonKey] == 1);
        $annoncesManager->leaveOrRemoveLike($annonceId, $addLike);

        // Rafraîchissez les données après la mise à jour
        $annoncePinned['nb_likes'] = $annoncesManager->getLikesCount($annonceId);
    }
    ?>

    <div class="annonce">
        <h3><?php echo $annoncePinned['titre']; ?></h3>
        <p><?php echo $annoncePinned['description']; ?></p>
        <p><?php echo $annoncePinned['date']; ?></p>

        <form method="post" action="">
            <input type="hidden" name="annonce_id" value="<?php echo $annonceId; ?>">
            <p>
                <?php echo $annoncePinned['nb_likes']; ?>
                <button type="submit" name="like[<?php echo $index; ?>]" style="color: <?php echo ($_POST[$etatBoutonKey] == 1) ? 'red' : 'black'; ?>" class="like-btn">
                    <i class="fas fa-heart"></i>
                </button>
            </p>
        </form>

        <div id="likes-count-<?php echo $annonceId; ?>"><?php echo $annoncePinned['nb_likes']; ?> likes</div>

        <!-- Le reste de votre code pour les commentaires -->

    </div>
    <br>

<?php
}
?>

<script>
    $(document).ready(function(){
        $(".like-btn").click(function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),  // Assurez-vous que c'est le bon chemin vers votre script PHP
                data: form.serialize(),
                success: function(response){
                    // Mettez à jour le nombre de likes sur la page sans recharger
                    var annonceId = form.find('input[name="annonce_id"]').val();
                    $("#likes-count-" + annonceId).text(response + " likes");
                }
            });
        });
    });
</script>
