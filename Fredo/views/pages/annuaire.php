<h1>Annuaire public</h1>
<form action="" method="get">
    <input type="button" value="De a à z" name="tri_particuliers" id="tri_particuliers">
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

