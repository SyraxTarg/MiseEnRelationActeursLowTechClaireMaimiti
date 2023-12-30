<?php

require_once 'models/abstactManager.php';

class disposManager extends AbstractManager {

    const TABLE_NAME="Dispos";

    function getDispos(): array {
        $sql = "SELECT * FROM ".disposManager::TABLE_NAME." ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function postDispos($id_annonce){
        $sql = "INSERT INTO " . disposManager::TABLE_NAME . "(id_annonce) VALUES (:id_annonce);";
        $query = $this->dbConnect()->prepare($sql);
        $query->execute([':id_annonce' => $id_annonce]);
        return $query->fetchAll();
    }



}
