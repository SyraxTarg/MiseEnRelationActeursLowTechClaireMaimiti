<?php

require_once 'models/abstactManager.php';

class annoncesManager extends AbstractManager {

    const TABLE_NAME="Annonces";

    function getAnnonces(): array {
        $sql = "SELECT titre, description, username FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    public function set_annonce_mère($id_annonce, $id_annonce_mère) {
        $sql = "UPDATE ".annoncesManager::TABLE_NAME." SET id_annonce_mère = ".$id_annonce_mère. " WHERE id = ".$id_annonce.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


}

