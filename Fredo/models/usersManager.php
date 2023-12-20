<?php

require_once 'models/abstactManager.php';

class usersManager extends AbstractManager {

    const TABLE_NAME="Users";

    function getUsers(){
        $sql = "SELECT id, username, password, email, activités FROM ".usersManager::TABLE_NAME.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

}