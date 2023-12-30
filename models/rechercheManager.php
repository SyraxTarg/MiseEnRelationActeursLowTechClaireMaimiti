<?php

require_once 'models/abstactManager.php';

class rechercheManager extends AbstractManager {

    const TABLE_NAME="Recherche";

    function getRecherche(): array {
        $sql = "SELECT * FROM ".rechercheManager::TABLE_NAME." ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function postRecherche($id_annonce){
        $sql = "INSERT INTO " . rechercheManager::TABLE_NAME . "(id_annonce) VALUES (:id_annonce);";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([':id_annonce' => $id_annonce]);
        return $query->fetchAll();
    }



}
