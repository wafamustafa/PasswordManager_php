<?php
// File created by Barbara Cam 2021/04.
namespace Codesses\php\Models;

class PasswordHistory
{
    //get all users from the users table
    public function getUsers($db)
    {
        $query = "SELECT * FROM users";
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //get all password history by user
    public function getPHistoryByUser($db, $user)
    {
        $query = "SELECT ph.ph_id as id, ph.url_id as url_id, ur.url as url, ph.action as action, ph.old_password as old_password, ph.new_password as new_password, ph.old_password_hint as old_password_hint, ph.new_password_hint as new_password_hint, ph.timestamp as timestamp, ph.user_id as user_id FROM password_history ph, users us where ph.user_id = us.user_id AND ph.user_id = :user";
        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':user', $user, \PDO::PARAM_STR);
        $pdostm->execute();
        $ph = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $ph;
    }
    //get all password history by id
    public function getPHistoryById($id, $db)
    {
        $sql = "SELECT ph.ph_id as id, ph.url_id as url_id, ur.url as url, ph.action as action, ph.old_password as old_password, ph.new_password as new_password, ph.old_password_hint as old_password_hint, ph.new_password_hint as new_password_hint, ph.timestamp as timestamp, ph.user_id as user_id
        FROM password_history ph 
        inner join url ur on ur.url_id = ph.url_id 
        inner join users us on ph.user_id = us.user_id AND ph.ph_id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();        
        $ph = $pst->fetch(\PDO::FETCH_OBJ);
        return $ph;
    }
    
    //get all password history for the list
     public function getAllPasswordHistory($user_id,$dbconnection)
    {
        $sql = "SELECT ph.ph_id as id, ur.url as url, ph.action as action, ph.old_password as old_password, ph.new_password as new_password, ph.old_password_hint as old_password_hint, ph.new_password_hint as new_password_hint, ph.timestamp as timestamp, ph.user_id as user_id
        FROM password_history ph inner join users us on us.user_id = ph.user_id inner join url ur on ur.url_id = ph.url_id and ph.user_id = :user_id ";
        $pdostm = $dbconnection->prepare($sql);
        $pdostm->bindParam(':user_id', $user_id);
        $pdostm->execute();
        $phistories = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $phistories;
    } 

    //delete password history by user
    public function deletePasswordHistory($id, $db)
    {
        $sql = "DELETE FROM password_history WHERE ph_id = :id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
}

//Triggers were added in the database "password_history":

// --Create passwords/passwords hints--

// create TRIGGER create_phistory after insert on url for each row insert into password_history 
// (url_id, user_id, timestamp, action, new_password, new_password_hint) 
// VALUES(NEW.url_id, NEW.user_id, Now(),"insert", NEW.password, NEW.password_hint);


// --Update passwords/passwords hints--
// create TRIGGER update_phistory after update on url for each row insert into password_history
//  (url_id, user_id, timestamp, action, old_password, new_password, old_password_hint, new_password_hint) 
//  VALUES(OLD.url_id, OLD.user_id, Now(),"update", OLD.password, NEW.password, OLD.password_hint, NEW.password_hint);

// --Delete passwords/passwords hints--
// create TRIGGER delete_phistory after delete on url for each row insert into password_history 
// (url_id, user_id, timestamp, action, old_password, old_password_hint) 
// VALUES(OLD.url_id, OLD.user_id, Now(),"delete", OLD.password, OLD.password_hint);


?>