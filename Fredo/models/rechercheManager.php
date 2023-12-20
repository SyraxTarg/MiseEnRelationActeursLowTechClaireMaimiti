<?php

require_once 'models/abstactManager.php';

class rechercheManager extends AbstractManager {

    const TABLE_NAME="Recherche";

    function getrecherche(): array {
        $sql = "SELECT titre, description, username FROM ".rechercheManager::TABLE_NAME." JOIN Users ON ".rechercheManager::TABLE_NAME.".id_user = Users.id ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


}
