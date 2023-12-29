<h1>Annuaire public</h1>
<form method="post" action="">
    <input type="hidden" name="triValue" value="<?php echo isset($triValue) ? $triValue : 'DESC'; ?>">
    <?php
        if(isset($_POST['triValue']) && $_POST['triValue'] == "DESC") {
            ?><input type="submit" name="tri_particuliers" value="Z à A" id="boutonTri"><?php
        } else {
            ?><input type="submit" name="tri_particuliers" value="A à Z" id="boutonTri"><?php
        }
    ?>
    
</form>
<form action="" method="post">
    <input type="text" name="recherche" id="recherche">
    <input type="submit" value="rechercher" name='rechercher'>
</form>

<table id="annuaire">
    <tr>
        <td>Nom</td>
        <td>Activités</td>
        <td>Contact</td>
    </tr>

    <?php foreach ($particuliers as $particulier) {
        if ($particulier['username'] != 'utilisateur introuvable') {
            echo "<tr>";
            echo "<td>";
            $image = "https://as2.ftcdn.net/v2/jpg/00/64/67/63/1000_F_64676383_LdbmhiNM6Ypzb3FM4PPuFP9rHe7ri8Ju.jpg";
            if ($particulier['profile_picture'] == null) {
                echo "<img src =" . $image . " alt='default pfp' class='pfp'/>";
            } else {
                echo "<img src ='" . $particulier['profile_picture'] . "' alt='pfp' class='pfp'/>";
            }
            echo $particulier['username'] . "</td>";
            $activites = explode(';', $particulier['activites']);
            echo "<td>";
            foreach ($activites as $activite) {
                echo $activite . "<br>";
            }
            echo "</td>";
            echo "<td>" . $particulier['email'] . "</td>";
            echo "</tr>";
        }
    } ?>
</table>
