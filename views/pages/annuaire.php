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
            $image = "https://www.google.com/url?sa=i&url=https%3A%2F%2Farchive.org%2Fdetails%2Ftwitter-default-pfp&psig=AOvVaw3nabfu3kbr9VEYGg5iRdkp&ust=1703239839133000&source=images&cd=vfe&opi=89978449&ved=0CBEQjRxqFwoTCLjBxv-koIMDFQAAAAAdAAAAABAD";
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
