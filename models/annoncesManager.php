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
        $sql = "SELECT titre, description, username, date, profile_picture FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id WHERE id_annonce_mere = ".$id_annonce." ORDER BY date DESC;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    public function getLastCommentaires($id_annonce){
        $sql = "SELECT titre, description, username, date, profile_picture FROM ".annoncesManager::TABLE_NAME." JOIN Users ON ".annoncesManager::TABLE_NAME.".id_user = Users.id WHERE id_annonce_mere = ".$id_annonce." ORDER BY date DESC LIMIT 3;";
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
        
        $query = $this->dbConnect()->prepare($sql);
        $query->bindParam(':id_annonce', $id_annonce, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchAll();
    }
    
    function getSingleAnnonce($annonceId){
        $sql = "SELECT Annonces.id, titre, description, username, profile_picture, date, nb_likes, image  FROM " . annoncesManager::TABLE_NAME . " JOIN Users ON " . annoncesManager::TABLE_NAME . ".id_user = Users.id WHERE " . annoncesManager::TABLE_NAME . ".id=" . $annonceId . " ;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetch(); 
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

    

    function getAnnoncesUser(string $id){
        if($id){
            $sql = "SELECT id, titre, description, date, image FROM ".annoncesManager::TABLE_NAME." WHERE id_user=(:id) AND id_annonce_mere IS NULL ORDER BY date DESC";
            $query = $this->db->prepare($sql);
            $query->execute([
                ':id' => $id
            ]);
            return $query->fetchAll();
        }
    }


    function postAnnonce(bool $pinned, string $imagePath) {
        $sql = "INSERT INTO ".annoncesManager::TABLE_NAME."(titre, description, image, id_user, pinned, date, nb_likes) VALUES (:titre, :description, :image, :id_user, :pinned, (SELECT NOW()), 0);";
        $query = $this->db->prepare($sql);
        
        $query->execute([
            ':titre' => $_POST['titre'],
            ':description' => $_POST['description'],
            ':image' => $imagePath,
            ':id_user' => $_SESSION['idUser'],
            ':pinned' => $pinned ? 1 : 0, 
        ]);
    
        return $query->fetchAll();
    }

    

    function getlastAnnonce(){
        $sql= "SELECT id, titre FROM ".annoncesManager::TABLE_NAME." ORDER BY date DESC LIMIT 1;";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }

    function pinAnnonce($annonceId){
        $sql = "UPDATE ".annoncesManager::TABLE_NAME." SET pinned = true WHERE id = ".$annonceId.";";
        $query = $this->dbConnect()->query($sql);
        return $query->fetchAll();
    }


    function supprimerCommentaires($annonceId) {
        try {
            $sql = "DELETE FROM " . annoncesManager::TABLE_NAME . " WHERE id_annonce_mere = :annonceId";
            $stmt = $this->dbConnect()->prepare($sql);
            $stmt->bindParam(':annonceId', $annonceId, PDO::PARAM_INT);
            $stmt->execute();
            return true; 
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; 
        }
    }
    
    
    function supprimerAnnonce($annonceId, $typeAnnonce) {
        try {
            $sql1 = "DELETE FROM Recherche WHERE id_annonce = :annonceId1";
            $stmt1 = $this->dbConnect()->prepare($sql1);
            $stmt1->bindParam(':annonceId1', $annonceId, PDO::PARAM_INT);
            $stmt1->execute();

            $sql2 = "DELETE FROM Avancees WHERE id_annonce = :annonceId1";
            $stmt2 = $this->dbConnect()->prepare($sql2);
            $stmt2->bindParam(':annonceId1', $annonceId, PDO::PARAM_INT);
            $stmt2->execute();

            $sql3 = "DELETE FROM Dispos WHERE id_annonce = :annonceId1";
            $stmt3 = $this->dbConnect()->prepare($sql3);
            $stmt3->bindParam(':annonceId1', $annonceId, PDO::PARAM_INT);
            $stmt3->execute();
    
            $sql4 = "DELETE FROM " . annoncesManager::TABLE_NAME . " WHERE id = :annonceId2";
            $stmt4 = $this->dbConnect()->prepare($sql4);
            $stmt4->bindParam(':annonceId2', $annonceId, PDO::PARAM_INT);
            $stmt4->execute();
    
            return true; 
        } catch (PDOException $e) {
            echo "Erreur : " . $e->getMessage();
            return false; 
        }
    }

    function changerUserAnnonces($idUser){
        $sql = "UPDATE " . annoncesManager::TABLE_NAME . " SET id_user=5 WHERE id_user=:id_user;";
        $query = $this->db->prepare($sql);
        $query->execute([
            ':id_user' => $idUser
        ]);
    }
    
}

