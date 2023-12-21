<?php

require_once 'models/abstactManager.php';

class adminsManager extends AbstractManager {

    const TABLE_NAME="Admins";

    function getAdmins(){
        $sql = "SELECT id, username, password, email, activités FROM ".adminsManager::TABLE_NAME." JOIN Users ON ".adminsManager::TABLE_NAME.".id_user = Users.id;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function remove_user($id){
        $sql = "DELETE FROM Users WHERE id = ".$id.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function give_modo_rights($id){
        $sql = "INSERT INTO Modérateurs(id_user) VALUES(".$id.");";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function give_admin_rights($id){
        $sql = "INSERT INTO Admins(id_user) VALUES(".$id.");";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

}