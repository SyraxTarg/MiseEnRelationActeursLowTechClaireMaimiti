<?php

require_once 'models/abstactManager.php';

class avancéesManager extends AbstractManager {

    const TABLE_NAME="Avancees";

    function getAvancees(): array {
        $sql = "SELECT * FROM ".avancéesManager::TABLE_NAME." ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


}
