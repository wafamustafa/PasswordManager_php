<?php
//File created by Wafa 2021/03
namespace Codesses\php\Models
{

    Class Sharepassword {

        //method to get all the shared password from the shared password table 
        public function getSharedpassword($db){
            $sql = "SELECT * FROM shared_passwords";
    
            $pdostm = $db->prepare($sql);
            $pdostm->execute();
    
            //getting back an ARRAY of shared passwords as an object 
            $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $results;
        }

        //LIST
        //change url user id to session variable
        public function listSharedpassword($user_id, $dbcon)
        {
            $sql = "SELECT a.first_name as from_user, b.first_name as to_user, sp_id, url.user_name, url.url, url.password FROM shared_passwords sp
            inner join url on sp.url_id = url.url_id 
            inner join users a
            on sp.owner_id = a.user_id
            inner join users b
            on sp.recipient_id = b.user_id 
            where a.user_id = :user_id";
            $pdostm = $dbcon->prepare($sql);
            $pdostm->bindParam(':user_id', $user_id);
            $pdostm->execute();

            $sharepass = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $sharepass;
        }

        //ADD:: share a password 
        //get all users for reciepent_id
        public function getAllusers($db){
            $sql = "SELECT * FROM users";

            $pdostm = $db->prepare($sql);
            $pdostm->execute();
    
            //getting back an ARRAY of shared passwords as an object 
            $allUsers = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $allUsers;

        }
        //get all urls by owner id 
        public function getAllurlbyId($owner_id, $db){
            $sql = "SELECT * FROM url where url.user_id = :owner";

            $pdostm = $db->prepare($sql);
            $pdostm->bindParam(':owner', $owner_id);
            $pdostm->execute();
    
            //getting back an ARRAY of shared passwords as an object 
            $allUrl = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $allUrl;
        }
        //function to share a password
        public function sharePassword($url_id, $owner_id, $recipient_id, $db){

            $sql = "INSERT INTO shared_passwords (url_id, owner_id, recipient_id)
                VALUES (:url, :owner, :recipient)";

            //we prepare the $psostm means a PDO statment object 
            $pdostm = $db->prepare($sql);

            //binding vaules to post variables in the PDO statement
            $pdostm->bindParam(':url', $url_id);//click on the share button in the passwords page which will pick up the url_id
            $pdostm->bindParam(':owner', $owner_id); //owner_id is the user that is logged in
            $pdostm->bindParam(':recipient', $recipient_id); //populate a drop down on sharePass page which will have the value of user_id (different from the one that is logged in)

            //to execute the query
            $count = $pdostm->execute();

            return $count;
            
        }

        
        //UPDATE::function to update the user this password is shared to
        //first get shared password id
        public function getSharedPasswordById($sp_id, $db) {
            //SQL query with the placeholder
            $sql = "SELECT a.first_name as from_user, b.first_name as to_user, sp_id, url.user_name, url.url, url.password FROM shared_passwords sp
            inner join url on sp.url_id = url.url_id 
            inner join users a
            on sp.owner_id = a.user_id
            inner join users b
            on sp.recipient_id = b.user_id 
            WHERE sp_id =:sp_id";
            //we prepare and then execute..$psostm means a PDO statment object 
            $pdostm = $db->prepare($sql);
            //bind the id to pdo statment 
            $pdostm->bindParam(':sp_id', $sp_id);
            //to execute the query
            $pdostm ->execute();
            //because this is not Add or delete. rather getting the number of rows effected we want to fetch the data out
            $sharedPasswordId = $pdostm->fetch(\PDO::FETCH_OBJ);
            return $sharedPasswordId;
    
        }

        //only updating url to a shared user
        public function updateSharedPasswordByUrl($sp_id, $url_id, $db){
            //SQL query with the placeholder
            $sql = "UPDATE shared_passwords
            set url_id = :url_id             
            WHERE sp_id = :sp_id";
            //we prepare and then execute..$psostm means a PDO statment object 
            $pdostm = $db->prepare($sql);
            //bind the id to pdo statment 
            $pdostm->bindParam(':url_id' , $url_id);
            $pdostm->bindParam(':sp_id', $sp_id);
            //to execute the query
            $pdostm ->execute();
            //because this is not Add or delete. rather getting the number of rows effected we want to fetch the data out
            $updatePasswordUrl = $pdostm->fetch(\PDO::FETCH_OBJ);
            return $updatePasswordUrl;

        }



        //DELETE:: this fuction will delete shareed password
        public function deleteSharedPassword($sp_id, $db){
            //sql to delete shared password
            $sql = "DELETE FROM shared_passwords WHERE sp_id = :sp_id";

            $pdostm = $db->prepare($sql);
            $pdostm->bindParam(':sp_id', $sp_id);
            $deleteSharedPass = $pdostm->execute();
            return $deleteSharedPass;

        }


    }
}

