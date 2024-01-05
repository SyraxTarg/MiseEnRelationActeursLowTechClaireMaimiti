
<?php
if(isset($msg))
    echo $msg;
?>

<div id="pageAnnuaire">
    <img class="annuaireIconPiggy" src="./public/images/elements/elements4_piggybank2.png" alt="piggybank">
    <div id="searchField">
        <input type="text" id="mySearch" placeholder="rechercher par mots-clé">
        <i class="fas fa-search"></i>
    </div>
    
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
                echo "<td class='nomImage'><a href='index.php?page=profil&id=".$particulier['id_user']."'>";
                $image = "./public/images/defaultPfp.png";
                if ($particulier['profile_picture'] == null) {
                    echo "<img src =" . $image . " alt='default pfp' class='pfpAnnuaire'/>";
                } else {
                    echo "<img src ='" . $particulier['profile_picture'] . "' alt='pfp' class='pfpAnnuaire'/>";
                }
                echo $particulier['username']."</a></td>";
                $activites = explode(';', $particulier['activites']);
                echo "<td>";
                foreach ($activites as $activite) {
                    echo $activite . "<br>";
                }
                echo "</td>";
                echo "<td>" . $particulier['email'] . "</td>";
                echo "</tr>";
            }
        } 
        if(isset($_SESSION['privileges'])){
            if($_SESSION['privileges'] == "admin"){
                foreach ($modos as $modo) {
                    if ($modo['username'] != 'utilisateur introuvable') {
                        echo "<tr>";
                        echo "<td class='nomImage'><a href='index.php?page=profil&id=".$modo['id_user']."'>";
                        $image = "./public/images/defaultPfp.png";
                        if ($modo['profile_picture'] == null) {
                            echo "<img src =" . $image . " alt='default pfp' class='pfpAnnuaire'/>";
                        } else {
                            echo "<img src ='" . $modo['profile_picture'] . "' alt='pfp' class='pfpAnnuaire'/>";
                        }
                        echo $modo['username']."</a></td>";
                        $activites = explode(';', $modo['activites']);
                        echo "<td>";
                        foreach ($activites as $activite) {
                            echo $activite . "<br>";
                        }
                        echo "</td>";
                        echo "<td>" . $modo['email'] . "</td>";
                        echo "</tr>";
                    }
                } 
            }
        }?>
    </table>
    <img class="annuaireIconMap" src="./public/images/elements/elements2_map2.png" alt="map">
</div>



<script>
    $(document).ready(function() {
    annuaire = $('#annuaire').DataTable({
        language: {
            search: "Rechercher : ",
            show: "Montrer",
            lengthMenu: 'Montrer <select>'+
                        '<option value="10">10</option>'+
                        '<option value="25">25</option>'+
                        '<option value="50">50</option>'+
                        '<option value="-1">Tous</option>'+
                        '</select> utilisateurs',
            info: "Affichage de _START_ à _END_ sur _TOTAL_ utilisateurs",
            infoEmpty: "Affichage de 0 à 0 sur 0 utilisateurs",
            infoFiltered: "(filtré sur un total de _MAX_ utilisateurs)",
            paginate: {
                first: 'Premier ',
                previous: 'Précédent  ',
                next: ' Suivant ',
                last: ' Dernier '
            },
            zeroRecords: "Aucun enregistrement trouvé"
        }
    });
});

$('#mySearch').keyup(function(){
    annuaire.search($(this).val()).draw();
})

</script>





<style>
    th{
        border: 1px black solid;
        padding: 2vw;
        width: 20vw;
        background-color: #9B91C3;
        cursor: pointer;
    }

    .dataTables_info {
        white-space: normal;
    }

    .dataTables_paginate {
        white-space: normal;
    }


    #annuaire_paginate .paginate_button:not(.previous):not(.next) {
        margin-right: 5px;
        padding: 1vh;
        cursor: pointer;
        font-family: "Montserrat", sans-serif;
    }

    #annuaire_paginate .paginate_button.previous {
        cursor: pointer;
        padding: 1vh;
        font-family: "Montserrat", sans-serif;
        margin-right: 1vh;
    }

    #annuaire_paginate .paginate_button.previous:hover {
        cursor: pointer;
        background-color: gainsboro;
        font-family: "Montserrat", sans-serif;
    }

    #annuaire_paginate .paginate_button.next {
        cursor: pointer;
        padding: 1vh;
        font-family: "Montserrat", sans-serif;
    }

    #annuaire_paginate .paginate_button.next:hover {
        cursor: pointer;
        background-color: gainsboro;
        font-family: "Montserrat", sans-serif;
    }

    #annuaire_paginate .paginate_button:not(.previous):not(.next):hover {
        margin-right: 5px;
        padding: 1vh;
        background-color:gainsboro;
        cursor: pointer;
        font-family: "Montserrat", sans-serif;
    }

    #annuaire_paginate .paginate_button:not(.previous):not(.next).current {
        margin-right: 5px;
        color: white;
        background-color: #9B91C3;
        padding: 1vh;
        cursor: pointer;
        font-family: "Montserrat", sans-serif;
    }

    
    #annuairePublic{
        text-align: center;
        font-family: "Montserrat", sans-serif;
    }

    #annuaire_filter {
        display: flex;
        justify-content: flex-end;
        margin-right: 20vw;
        margin-bottom: 3vw;
        font-size: 2vh;
        font-family: "Montserrat", sans-serif;
        visibility: hidden;
    }

    #annuaire_filter input[type="search"] {
        /* width: 20vw;
        height: max-content;
        font-size: 2vh;
        font-family: "Montserrat", sans-serif; */
        visibility: hidden;
    }


    #annuaire{
        margin: auto;
        font-family: "Montserrat", sans-serif;
        border-collapse: collapse;
        position: relative;
        z-index: 0;
        background-color: white;
    }

    #annuaire a{
        text-decoration: none;
        color: black;
    }

    #annuaire_info{
        display: flex;
        justify-content: center;
        margin-top: 1vw;
        font-size: 2vh;
        font-family: "Montserrat", sans-serif;
    }

    #annuaire_paginate{
        display: flex;
        justify-content: center;
        margin-top: 1vw;
        font-size: 2vh;
        align-items: baseline;
        font-family: "Montserrat", sans-serif;
        

    }


    #annuaire_length{
        font-size: 2vh;
        margin-left: 15vw;
        font-family: "Montserrat", sans-serif;
        margin-top: 2vw;
        margin-bottom: 0;
    }

    td{
        text-align: center;
        padding: 1vh;
    }

    tr:hover{
        background-color: gainsboro;
    }

    .pfpAnnuaire{
        height: 5vh;
        border-radius: 5vh;
        margin-right: 1vh;
    }

    .nomImage {
        text-align: center;
    }

    .annuaireIconPiggy {
        position: absolute;
        top: -3vw;
        right: 6vw; 
        z-index: -1;
        height: 60%;
        padding: 0;
        margin: 0;
    }

    .annuaireIconMap {
        position: absolute;
        bottom: -3vw;
        left: 1vw; 
        z-index: -1;
        height: 40%;
        padding: 0;
        margin: 0;
    }




    body { 
        max-width: 100%; 
        overflow-x: hidden; 
    }

    #pageAnnuaire{
        height: 100%;
        position: relative;
    }


    #searchField{
        display: flex;
        justify-content: flex-end;
        margin-right: 7vw;
        font-size: 2vh;
        margin-top: 3vw;
        font-family: "Montserrat", sans-serif;
    }

    #searchField > input{
        width: 20vw;
        font-family: "Montserrat", sans-serif;
    }

    #searchField > i{
        background-color: #0F3F6C;
        color: white;
        padding: 1vh;
    }

</style>