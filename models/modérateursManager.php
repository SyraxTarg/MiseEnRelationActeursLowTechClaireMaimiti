<?php

require_once 'models/abstactManager.php';

class modérateursManager extends AbstractManager {

    const TABLE_NAME="mod‚rateurs";

    function getModérateurs(){
        $sql = "SELECT id, username, password, email/* , activités */ FROM ".modérateursManager::TABLE_NAME." JOIN Users ON ".modérateursManager::TABLE_NAME.".id_user = Users.id;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function getUniqueModo($id){
        $sql = "SELECT id, username, password, email/* , activités */ FROM ".adminsManager::TABLE_NAME." JOIN Users ON ".adminsManager::TABLE_NAME.".id_user = Users.id WHERE id=(:id);";
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);
        $modo = $query->fetch();

        if($modo)
            return $modo;
        else
            return null;
    }


    function post_recherche($titre, $description, $id_user){
        $sql = "INSERT INTO Annonces(titre, description, id_user) VALUES(:titre, :description, ".$id_user."); INSERT INTO Recherche (id_annonce) VALUES(SELECT id FROM Annonces ORDER BY ID DESC LIMIT 1);";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([
            ':description' => $_POST['description'],
            ':titre' => $_POST['titre']
        ]);
    }

    function post_avancées($id_user){
        $sql = "INSERT INTO Annonces(titre, description, id_user) VALUES(:titre, :description, ".$id_user."); INSERT INTO Avancées (id_annonce) VALUES(SELECT id FROM Annonces ORDER BY ID DESC LIMIT 1);";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([
            ':description' => $_POST['description'],
            ':titre' => $_POST['titre']
        ]);
    }

    function pin_annonce($id_annonce){
        $sql = "UPDATE Annonces SET pinned = true WHERE id = ".$id_annonce.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function unpin_annonce($id_annonce){
        $sql = "UPDATE Annonces SET pinned = false WHERE id = ".$id_annonce.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function remove_annonce($id_annonce){
        $sql = "DELETE FROM Recherche WHERE id_annonce = ".$id_annonce."; DELETE FROM Avancées WHERE id_annonce = ".$id_annonce."; DELETE FROM Dispos WHERE id_annonce = ".$id_annonce."; DELETE FROM Annonces WHERE id=".$id_annonce.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

}