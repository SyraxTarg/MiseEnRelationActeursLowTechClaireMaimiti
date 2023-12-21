<?php

require_once 'models/abstactManager.php';

class usersManager extends AbstractManager {

    const TABLE_NAME="Users";

    function getUsers(){
        $sql = "SELECT id, username, password, email/* , activités */ FROM ".usersManager::TABLE_NAME.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function getCurrentUser(){
        if(!empty($_SESSION)){
            $sql = "SELECT id, username, password, email/* , activités */ FROM ".usersManager::TABLE_NAME." WHERE id=(:id);";
            $query = $this->db->prepare($sql);
            $query->execute([
                ':id' => $_SESSION['idUser']
            ]);
            return $query->fetchAll();
        }
    }

}