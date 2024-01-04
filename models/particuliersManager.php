<?php

require_once 'models/abstactManager.php';

class particuliersManager extends AbstractManager {

    const TABLE_NAME="Particuliers";

    function getParticuliers($desc_or_asc){
        $sql = "SELECT DISTINCT id_user, profile_picture, Users.username, Users.password, Users.email, Users.activites  FROM ".particuliersManager::TABLE_NAME." JOIN Users ON ".particuliersManager::TABLE_NAME.".id_user = Users.id ORDER BY Users.username ".$desc_or_asc.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function post_dispos($titre, $description, $id_user){
        $sql = "INSERT INTO Annonces(titre, description, id_user) VALUES(:titre, :description, ".$id_user."); INSERT INTO Dispos (id_annonce) VALUES(SELECT id FROM Annonces ORDER BY ID DESC LIMIT 1);";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([
            ':description' => $_POST['description'],
            ':titre' => $_POST['titre'],
        ]);
    }

    function post_comment($id_annonce_mère, $id_user){
        $sql = "INSERT INTO Annonces(description, id_user, id_annonce_mère) VALUES(:description, ".$id_user.", ".$id_annonce_mère.");";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([
            ':description' => $_POST['description']
        ]);
    }

    function recherche_dans_annonces($mot_clé){
        //ICI JE METS LE MOT CLE EN MINUSCULE PUIS JE LE RECHERCHE DANS LES ANNONCES DONT J AI CONVERTIT LE TITRE ET LA DESCRIPTION EN MINUSCULE (juste pour la requete bien sur) CELA FAIT EN SORTE QUE LA REQUETE SOIT INSENSIBLE A LA CASSE
        $mot_clé = strtolower($mot_clé);
        $sql="SELECT * FROM Annonces WHERE LOWER(titre) LIKE '%:mot_clé%' OR LOWER(description) LIKE '%:mot_clé%';";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([
            ':mot_clé' => $_POST['mot_clé']
        ]);
        return $query->fetchAll();
    }

    function remove_my_annonce($id_annonce, $id_user){
        $sql = "DELETE FROM Recherche JOIN Annonces ON Recherche.id_annonce = Annonces.id WHERE id_annonce = ".$id_annonce." AND id_user = ".$id_user."; DELETE FROM Avancées JOIN Annonces ON Avancées.id_annonce = Annonces.id WHERE id_annonce = ".$id_annonce." AND id_user = ".$id_user."; DELETE FROM Dispos JOIN Annonces ON Dispos.id_annonce = Annonces.id WHERE id_annonce = ".$id_annonce." AND id_user = ".$id_user."; DELETE FROM Annonces WHERE id=".$id_annonce." AND id_user = ".$id_user.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function edit_profile($value_to_edit, $id_user){
        $sql = "UPDATE Users SET $value_to_edit = :edited_value WHERE id = ".$id_user.";";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([
            ':edited_value' => $_POST['edited_value']
        ]);
    }

    function rechercheParticuliers($mot_clé)
    {
        $mot_clé = strtolower($mot_clé);
        $sql = "SELECT id_user, Users.profile_picture, Users.username, Users.password, Users.email,  Users.activites FROM " . particuliersManager::TABLE_NAME . " JOIN Users ON " . particuliersManager::TABLE_NAME . ".id_user = Users.id WHERE LOWER(Users.username) LIKE '%" . $mot_clé . "%' OR LOWER( Users.activites) LIKE '%" . $mot_clé . "%';";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

// function createParticulier(){
//     $sql="INSERT INTO Users(username, password, email, activit,s "
// } peut utiliser un tab des elements que l'on veut ajouter
    



}