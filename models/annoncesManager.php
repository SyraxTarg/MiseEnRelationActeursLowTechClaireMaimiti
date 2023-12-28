<?php

require_once 'models/abstactManager.php';

class annoncesManager extends AbstractManager {

    const TABLE_NAME="Annonces";

    function getAnnonces(): array {
        $sql = "(SELECT Annonces.id, titre, description, username FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id WHERE id_annonce_mere is null AND pinned = 't' ORDER BY date)
                UNION
                (SELECT Annonces.id, titre, description, username FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id WHERE id_annonce_mere is null ORDER BY date)";
    
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }
    

    public function set_annonce_mère($id_annonce, $id_annonce_mère) {
        $sql = "UPDATE ".annoncesManager::TABLE_NAME." SET id_annonce_mere = ".$id_annonce_mère. " WHERE id = ".$id_annonce.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    public function getCommentaires($id_annonce){
        $sql = "SELECT titre, description, username, date FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id WHERE id_annonce_mere = ".$id_annonce.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function getPinnedAnnonces(){
        $sql = "SELECT Annonces.id, titre, description, username, date, nb_likes, image FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id WHERE id_annonce_mere is null AND pinned = 't' ORDER BY date DESC;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function getNonPinnedAnnonces(){
        $sql = "SELECT Annonces.id, titre, description, username, date, nb_likes, image FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id WHERE id_annonce_mere IS NULL AND (pinned = 'f' OR pinned IS NULL) ORDER BY date DESC;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function leaveLike($id_annonce){
        $sql = "UPDATE Annonces SET nb_likes = nb_likes + 1 WHERE id = " . $id_annonce . ";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function removeLike($id_annonce){
        $sql = "UPDATE Annonces SET nb_likes = nb_likes - 1 WHERE id = " . $id_annonce . ";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }
    
    function getLikesCount($id_annonce) {
        $sql = "SELECT nb_likes FROM Annonces WHERE id = " . $id_annonce . ";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchColumn();
    }

    function leaveOrRemoveLike($id_annonce, $addLike = true) {
        $operator = ($addLike) ? '+' : '-';
        
        $sql = "UPDATE Annonces SET nb_likes = nb_likes {$operator} 1 WHERE id = :id_annonce;";
        
        $stmt = $this->dbConnect()->prepare($sql);
        $stmt->bindParam(':id_annonce', $id_annonce, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll();
    }
    
    function getSingleAnnonce($annonceId){
        $sql = "SELECT Annonces.id, titre, description, username, date, nb_likes, image FROM " . annoncesManager::TABLE_NAME . " JOIN Users ON " . annoncesManager::TABLE_NAME . ".id_user = Users.id WHERE " . annoncesManager::TABLE_NAME . ".id=" . $annonceId . " ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetch(); // Utilisez fetch(PDO::FETCH_ASSOC) pour obtenir un tableau associatif
    }
    

    function getAnnonceType($annonceId, $avancees, $dispos, $recherches){
        foreach($avancees as $avancee){
            if($avancee['id_annonce'] === $annonceId){
                echo "<p class ='annonceType'>Avancée</p>";
            }
        }
        foreach($dispos as $dispo){
            if($dispo['id_annonce'] === $annonceId){
                echo "<p class ='annonceType'>Disponibilité</p>";
            }
        }
        foreach($recherches as $recherche){
            if($recherche['id_annonce'] === $annonceId){
                echo "<p class ='annonceType'>Recherche</p>";
            }
        }
    }

    function postCommentaire($annonceId){
        $sql="INSERT INTO ". annoncesManager::TABLE_NAME . "(description, id_annonce_mere, id_user, date) VALUES(:description, ".$annonceId.", :id, (SELECT NOW()));";
        $query = $this->db->prepare($sql);
            $query->execute([
                ':description' => $_POST['description'],
                ':id' => $_SESSION['idUser']
            ]);
            return $query->fetch();
    }


}

