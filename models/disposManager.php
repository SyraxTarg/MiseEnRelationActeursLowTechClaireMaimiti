<?php

require_once 'models/abstactManager.php';

class disposManager extends AbstractManager {

    const TABLE_NAME="Dispos";

    function getDispos(): array {
        $sql = "SELECT * FROM ".disposManager::TABLE_NAME." ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


}
