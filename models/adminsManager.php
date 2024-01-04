<?php

require_once 'models/abstactManager.php';
require_once 'models/annoncesManager.php';

class adminsManager extends AbstractManager {

    const TABLE_NAME="Admins";

    function getAdmins(){
        $sql = "SELECT id, username, password, email , activites FROM ".adminsManager::TABLE_NAME." JOIN Users ON ".adminsManager::TABLE_NAME.".id_user = Users.id;";
        $query = $this->db->query($sql);
        return $query->fetchAll();
    }

    function getUniqueAdmin($id){
        $sql = "SELECT id, username, password, email , activites FROM ".adminsManager::TABLE_NAME." JOIN Users ON ".adminsManager::TABLE_NAME.".id_user = Users.id WHERE id=(:id);";
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id' => $id
        ]);
        $admin = $query->fetch();

        if($admin)
            return $admin;
        else
            return null;
    }

    function remove_user($id){
        $annoncesManager = new annoncesManager();
        $annoncesManager->changerUserAnnonces($id);

        $sqlPrivileges = "DELETE FROM Particuliers WHERE id_user=".$id.";";
        $query = $this->db->query($sqlPrivileges);
        $sqlPrivileges = "DELETE FROM Mod‚rateurs WHERE id_user=".$id.";";
        $query = $this->db->query($sqlPrivileges);
        $sqlPrivileges = "DELETE FROM Admins WHERE id_user=".$id.";";
        $query = $this->db->query($sqlPrivileges);

        $sql = "DELETE FROM Users WHERE id = ".$id.";";
        $query = $this->db->query($sql);
    }

    function give_modo_rights($id){
        $sql = "INSERT INTO Mod‚rateurs(id_user) VALUES(".$id.");";
        $query = $this->db->query($sql);
    }

    function remove_modo_rights($id){
        $sql = "DELETE FROM Mod‚rateurs WHERE id_user=". $id . ";";
        $query = $this->db->query($sql);
    }

    function give_admin_rights($id){
        $sql = "INSERT INTO Admins(id_user) VALUES(".$id.");";
        $query = $this->db->query($sql);
    }

}