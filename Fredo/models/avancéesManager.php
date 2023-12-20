<?php

require_once 'models/abstactManager.php';

class avancéesManager extends AbstractManager {

    const TABLE_NAME="Avancées";

    function getavancées(): array {
        $sql = "SELECT titre, description, username FROM ".avancéesManager::TABLE_NAME." JOIN Users ON ".avancéesManager::TABLE_NAME.".id_user = Users.id ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


}
