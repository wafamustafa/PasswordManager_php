<?php
    // Elle
    //I tried another way to get and use the DB connection for practice 
    namespace Codesses\php\Models;
    use PDO;
    class LoginHistory
    {
        //Create Private Database Function 
        private $db;

        public function __construct($db)
        {
            $this->db = $db;
        }
        // Get All Users
        public function getUsers(){
            $sql = "SELECT *  FROM users";
            $pdostm = $this->db->prepare($sql);
            $pdostm->execute();

            //fetch all result
            $results = $pdostm->fetchAll(PDO::FETCH_OBJ);
            return $results;
        }
        // Get Login History From User        
        public function getLoginHistoryFromUser($user){
            $sql = "SELECT users.user_id as user, login_history.lh_id, login_history.timestamp,login_history.action FROM login_history, users where users.user_id = login_history.user_id AND user_id = :user";
            $pdostm = $this->db->prepare($sql);
            $pdostm->bindValue(':user', $user, PDO::PARAM_STR);
            $pdostm->execute();
            $s = $pdostm->fetchAll(PDO::FETCH_OBJ);
            return $s;
        }
        // Get Login History By Id
        public function getLoginHistoryById($id){
            $sql = "SELECT * FROM login_history where user_id = :id";
            $pdostm = $this->db->prepare($sql);
            $pdostm->bindParam(':id', $id);
            $pdostm->execute();
            $s = $pdostm->fetchAll(PDO::FETCH_OBJ);
            return $s;
        }
        // Get All Login History
        public function getAllLoginHistory($user_id){
            $sql = "SELECT users.user_id as user, login_history.lh_id, login_history.timestamp, login_history.action FROM login_history inner join users on users.user_id = login_history.user_id and login_history.user_id = :user_id ";
            $pdostm = $this->db->prepare($sql);
            $pdostm->bindParam(':user_id', $user_id);
            $pdostm->execute();
            $login_history = $pdostm->fetchAll(PDO::FETCH_OBJ);
            return $login_history;
        }
        // Add Login History Entry
        public function addLoginHistory($user, $action)
        {
            $sql = "INSERT INTO login_history (user_id, timestamp, action) 
            VALUES (:user, NOW(), :action) ";
            $pdostm = $this->db->prepare($sql);
            $pdostm->bindParam(':user', $user);

            $pdostm->bindParam(':action', $action);
            $count = $pdostm->execute();
            return $count;
        }
        // Delete Login History Entry
        public function deleteLoginHistory($id){
            $sql = "DELETE FROM login_history WHERE lh_id = :id";
            $pdostm = $this->db->prepare($sql);
            $pdostm->bindParam(':id', $id);
            $count = $pdostm->execute();
            return $count;
        }
        //Not Needed but used for Practice
        // Update Login History Entry
        public function updateLoginHistory($id, $user, $timestamp, $action, $db){
            $sql = "UPDATE login_history
                SET user_id = :user,
                timestamp = :timestamp,
                action = :action
                WHERE lh_id = :id";

            $pdostm =  $db->prepare($sql);
            $pdostm->bindParam(':user', $user);
            $pdostm->bindParam(':timestamp', $timestamp);
            $pdostm->bindParam(':action', $action);
            $pdostm->bindParam(':id', $id);
            $count = $pdostm->execute();

            return $count;
        }
    };
?>