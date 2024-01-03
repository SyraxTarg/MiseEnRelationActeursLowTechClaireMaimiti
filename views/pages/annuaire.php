<h1>Annuaire public</h1>

<?php
if(isset($msg))
    echo $msg;
?>

<!-- <form method="post" action="">
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
</form> -->

<table id="annuaire">
    <thead>
        <tr>
            <th>Nom  <i class="fas fa-sort"></i></th>
            <th>Activités et compétences  <i class="fas fa-sort"></i></th>
            <th>Contact  <i class="fas fa-sort"></i></th>
        </tr>
    </thead>
    

    <?php foreach ($particuliers as $particulier) {
        if ($particulier['username'] != 'utilisateur introuvable') {
            echo "<tr>";
            echo "<td>";
            $image = "./public/images/defaultPfp.png";
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

<script>
    $(document).ready(function() {
        $('#annuaire').DataTable({
            language: {
                search: "Rechercher :",
                show: "Montrer",
                lengthMenu: 'Montrer <select>'+
                            '<option value="10">10</option>'+
                            '<option value="25">25</option>'+
                            '<option value="50">50</option>'+
                            '<option value="-1">Tous</option>'+
                            '</select> utilisateurs'
            }
        });
    });
</script>




<style>
    th{
        border: 1px black solid;
        padding: 2vw;
        width: 20vw;
        background-color: #9B91C3;
    }

    
</style>