<?php

require_once 'models/abstactManager.php';

class disposManager extends AbstractManager {

    const TABLE_NAME="Dispos";

    function getdispos(): array {
        $sql = "SELECT titre, description, username FROM ".disposManager::TABLE_NAME." JOIN Users ON ".disposManager::TABLE_NAME.".id_user = Users.id ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


}
