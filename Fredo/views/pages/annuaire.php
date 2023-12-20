<h1>Annuaire public</h1>
<form method="post" action="">
    <input type="hidden" name="triValue" value="<?php echo $triValue; ?>">
    <?php
        if($_POST['triValue'] == "DESC"){
            ?><input type="submit" name="tri_particuliers" value="A à Z" id="boutonTri"><?php
        } else {
            ?><input type="submit" name="tri_particuliers" value="Z à A" id="boutonTri"><?php
        }

    ?>
    <input type="text" name="recherche" id="recherche">
    <input type="submit" value="rechercher">
    
</form>



<table id="annuaire">
    <tr>
        <td>Nom</td>
        <td>Activités</td>
        <td>Contact</td>
    </tr>

    <?php foreach($particuliers as $particulier) {
        if ($particulier['username'] != 'utilisateur introuvable') {
            echo "<tr>";
            echo "<td>" . $particulier['username'] . "</td>";
            $activites = explode(';', $particulier['activit‚s']);
            echo "<td>" ;
            foreach ($activites as $activite) {
                echo $activite . "<br>";
            }
            echo "</td>";
            echo "<td>" . $particulier['email'] . "</td>";
            echo "</tr>";
        }
    } ?>
</table>

