<?php

require_once 'models/abstactManager.php';

class avancéesManager extends AbstractManager {

    const TABLE_NAME="Avancees";

    function getAvancees(): array {
        $sql = "SELECT * FROM ".avancéesManager::TABLE_NAME." ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function postAvancees($id_annonce){
        $sql = "INSERT INTO " . avancéesManager::TABLE_NAME . "(id_annonce) VALUES (:id_annonce);";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([':id_annonce' => $id_annonce]);
        return $query->fetchAll();
    }


}
