<?php

require_once 'models/abstactManager.php';

class rechercheManager extends AbstractManager {

    const TABLE_NAME="Recherche";

    function getRecherche(): array {
        $sql = "SELECT * FROM ".rechercheManager::TABLE_NAME." ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


}
