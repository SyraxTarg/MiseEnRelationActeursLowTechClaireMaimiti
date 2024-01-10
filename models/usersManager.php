<?php

require_once 'models/abstactManager.php';
require_once 'models/annoncesManager.php';

class usersManager extends AbstractManager {

    const TABLE_NAME="Users";

    function getUsers(){
        $sql = "SELECT id, username, password, email, profile_picture, bio, activites FROM ".usersManager::TABLE_NAME.";";
        $query = $this->db->query($sql);
        return $query->fetchAll();
    }

    function getCurrentUser(){
        if(!empty($_SESSION)){
            $sql = "SELECT id, username, password, email, profile_picture, bio, activites FROM ".usersManager::TABLE_NAME." WHERE id=(:id);";
            $query = $this->db->prepare($sql);
            $query->execute([
                ':id' => $_SESSION['idUser']
            ]);
            return $query->fetch();
        }
    }

    function getUniqueUser(string $id){
        if($id){
            $sql = "SELECT id, username, password, email, profile_picture, activites, bio FROM ".usersManager::TABLE_NAME." WHERE id=(:id);";
            $query = $this->db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            return $query->fetch();
        }
    }

    function getUniqueUserInfo(string $email, $password){
        if($password){
            $sql = "SELECT id, username, password, email FROM " . usersManager::TABLE_NAME . " WHERE email=(:email) AND password= (:password);";
        }
        else{
            $sql = "SELECT id, username, password, email FROM " . usersManager::TABLE_NAME . " WHERE email=(:email);";
        }
        $query = $this->db->prepare($sql);
        if($password){
            $query->execute([
                ':email' => $email,
                ':password' => $password
            ]);
        }
        else{
            $query->execute([
                ':email' => $email
            ]);
        }
        $user = $query->fetch();

        if($user)
            return $user;
        else
            return null;
    }

    function addUser(string $username, string $password, string $email, string $profile_picture, string $activites){
        $sql = "INSERT INTO ".usersManager::TABLE_NAME." (username, password, email, profile_picture, activites) VALUES(:username, :password, :email, :profile_picture, :activites);";
        $query = $this->db->prepare($sql);
        $query->execute([
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':profile_picture' => $profile_picture,
            ':activites' => $activites
        ]);
        $sql2 = "INSERT INTO Particuliers (id_user) SELECT id FROM ".usersManager::TABLE_NAME." ORDER BY id DESC LIMIT 1";
        $query2 = $this->db->query($sql2);
        return $query->fetchAll();
    }

    function setUser($id, string $username, string $password, string $email, string $profile_picture, string $activites, string $bio){
        $sql = "UPDATE " . usersManager::TABLE_NAME . " SET username=:username, password=:password, email=:email, profile_picture=:profile_picture, activites=:activites, bio=:bio WHERE id=:id";
        $query = $this->db->prepare($sql);
        $query->execute([
            ':username' => $username,
            ':password' => $password,
            ':email' => $email,
            ':profile_picture' => $profile_picture,
            ':activites' => $activites,
            ':bio' => $bio,
            ':id' => $id
        ]);
    }

    
}
