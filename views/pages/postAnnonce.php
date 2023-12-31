<h1>Poster une annonce</h1>

<form method="post" enctype="multipart/form-data">
    <input type="text" name="titre" id="titre" placeholder="Votre titre ici">
    <input type="text" name="description" id="description" placeholder="Votre description ici">
    <label for="file">Ajouter une image</label>
    <input type="file" name ="file" id = "photo">
    <?php
        if($_SESSION['privileges'] == "modo")
        {
        ?>
            <fieldset>
                <legend>Quel est le type de votre annonce ?</legend>
        
                    <div>
                        <input type="radio" id="Recherche" name="Recherche" value="Recherche" />
                        <label for="Recherche">Recherche</label>
                    </div>
                    <div>
                        <input type="radio" id="Avancées" name="Avancées" value="Avancées" />
                        <label for="Avancées">Avancées</label>
                    </div>
            </fieldset>            
            <input type="checkbox" name="pinned" id="pinned">
            <label for="pinned">Epingler</label>            
    <?php
    }
    ?>
        
    
    
    <input type="submit" value="Envoyer" name="postAnnonce" id="postAnnonce">
</form>
