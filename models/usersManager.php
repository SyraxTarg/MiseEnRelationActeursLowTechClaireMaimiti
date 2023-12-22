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
            return $query->fetch();
        }
    }

    function getUniqueUser(){
        if(isset($_POST['username']) && isset($_POST['password'])){
            $sql = "SELECT id, username, password, email FROM " . usersManager::TABLE_NAME . " WHERE username=(:username) AND password= (:password);";
            $query = $this->db->prepare($sql);
            $query->execute([
                ':username' => $_POST['username'],
                ':password' => $_POST['password']
            ]);
            $user = $query->fetch();

            if($user){
                return $user;
            }
            else{
                return "UNF";
                //UI : User Not Found
            }
            
        }
    }
}