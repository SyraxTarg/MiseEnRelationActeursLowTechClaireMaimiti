
<?php
    if($_SESSION['privileges'] == 'modo'){
        echo "<h1 class='postTitre'>Poster une annonce</h1>";
    } else{
        echo "<h1 class='postTitre'>Poster une disponibilité</h1>";
    }


    if(isset($alert)){
        echo $alert;
    }
?>
<br>
<div id="divEnvoyer">

    <form method="post" enctype="multipart/form-data" class="posterUneAnnonce">
        <div class="formAnnonce">
            <label for="titre">Titre</label>
            <input type="text" name="titre" id="titre" placeholder="Votre titre ici" required>
        </div>
        <div class="formAnnonce">
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Votre description ici" required></textarea>
        </div>
        <div class="formAnnonce">
            <label for="file">Ajouter une image</label>
            <input type="file" name ="file" id = "photo">
        </div>
        
        <?php
            if($_SESSION['privileges'] == "modo")
            {
            ?>
            <div id="choixAnnonce">
                <fieldset>
                    <legend>Quel est le type de votre annonce ?</legend>
            
                        <div>
                            <input type="radio" id="Recherche" name="type" value="Recherche" required/>
                            <label for="Recherche">Recherche</label>
                        </div>
                        <div>
                            <input type="radio" id="Avancées" name="type" value="Avancées" />
                            <label for="Avancées">Avancées</label>
                        </div>
                </fieldset> 
                <div>
                    <input type="checkbox" name="pinned" id="pinned">
                    <label for="pinned">Epingler</label>
                </div>
                
            </div>
            
                            
        <?php
        }
        ?>
        
        <input type="submit" value="Envoyer" name="postAnnonce" id="postAnnonce" class="submitPostAnnonce">
    </form>
</div>


<script>
        const boutonEnvoyer = document.querySelector("#postAnnonce");
        const divEnvoyer = document.querySelector('#divEnvoyer');
        const titre = document.querySelector("#titre");
        const description = document.querySelector("#description");
        const type = document.querySelector("input[name=type]");
        boutonEnvoyer.addEventListener("click", () =>{
            const infoAnnonceExistant = document.querySelector("#infoAnnonce");
            if (!infoAnnonceExistant && titre.value.trim() !== "" && description.value.trim() !== "" && type !== null) {
                const infoAnnonce = document.createElement("p");
                infoAnnonce.innerText = "Votre annonce peut mettre quelques secondes à s'envoyer.";
                infoAnnonce.id = "infoAnnonce";
                divEnvoyer.append(infoAnnonce);
            }
        });
        document.addEventListener("DOMContentLoaded", function () {
            if(infoAnnonce){
                divEnvoyer.remove(infoAnnonce);
            }
        });
</script>

<style>
    #infoAnnonce{
        color: #9B91C3;
        font-family: "Montserrat", sans-serif;
        text-align: center;
        font-size: 2vh;
        margin-top: 1vh;
    }
    .errorPostAnnonce{
        font-family: "Montserrat", sans-serif;
        color: red;
        text-align: center;
    }


    .postTitre{
        text-align: center;
        font-family: "Montserrat", sans-serif;
    }

    .posterUneAnnonce{
        display: flex;
        flex-direction: column;
        justify-content: center;
        margin: auto;
        width: 75vw;
        font-family: "Montserrat", sans-serif;
    }


    .formAnnonce {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        margin: 2vh 0;
        font-family: "Montserrat", sans-serif;
    }

    .formAnnonce label {
        width: 30vw;
        padding: 0 2vw;
        text-align: right;
        font-family: "Montserrat", sans-serif;
    }
    .formAnnonce input,
    .formAnnonce textarea {
        width: 40vw;
        height: 5vh;
        font-family: "Montserrat", sans-serif;
    }
    .formAnnonce textarea {
        height: 15vh;
        padding: 0.75vw;
        font-family: "Montserrat", sans-serif;
        resize: vertical;
    }
    #photo::file-selector-button {
        width: 10vw;
        height: 5vh;
        border: none;
        border-radius: 0.5vw;
        cursor: pointer;

        background-color: var(--bleu-marine);
        color: white;
        font-family: "Montserrat", sans-serif;
    }

    #photo::file-selector-button:hover{
        background-color: #31356E;
    }

    .submitPostAnnonce{
        width: 15vw;
        height: 5vh;
        border: none;
        border-radius: 0.5vw;
        cursor: pointer;
        background-color: var(--bleu-marine);
        color: white;
        font-family: "Montserrat", sans-serif;
        font-size: 1em;
        margin: auto;
        margin-top: 3vh;
    }

    .submitPostAnnonce:hover{
        background-color: #31356E;
    }

    #choixAnnonce{
        display: flex;
        flex-direction: column;
        margin: auto;
        gap: 1vw;
    }

</style>