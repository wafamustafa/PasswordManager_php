<?php

// File created by Barbara Cam 2021/04.

namespace Codesses\php\Models;

class Recovery 
{
    // get all users
    public function getUsers($db)
    {
        $query = "SELECT * FROM users";
        
        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }

    //get all questions
    public function getQuestions($db)
    {
        $query = "SELECT * FROM security_questions";

        $pdostm = $db->prepare($query);
        $pdostm->execute();
        //fetch all result
        $results = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $results;
    }
    
    //get question and answer by user
    public function getRecoveryByUser($db, $user)
    {
        $query = "SELECT sa.sa_id as id, sa.sq_id as sq_id, sa.user_id as user, us.user_name as uname, sq.question as question, sa.answer as answer FROM security_answers sa inner join security_questions sq on sq.sq_id = sa.sq_id inner join users us on sa.user_id = us.user_id AND sa.user_id = :user";
        
        $pdostm = $db->prepare($query);
        $pdostm->bindValue(':user', $user, \PDO::PARAM_STR);
        $pdostm->execute();
        $r = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $r;
    }

    //get questions and answer by Id. Using a join table with security questions, users and security answers tables
    public function getRecoveryById($id, $db)
    {
        $sql = "SELECT sa.sa_id as id, sa.user_id as user, us.user_name as uname, sa.sq_id as sq_id, sq.question as question, sa.answer as answer FROM security_answers sa inner join security_questions sq on sq.sq_id = sa.sq_id inner join users us on sa.user_id = us.user_id AND sa.sa_id = :id";
        
        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();        
        $r = $pst->fetch(\PDO::FETCH_OBJ);
        return $r;
    }

    // verified an email is in the database
    public function getEmail($email, $db)
    {
        $sql = "SELECT us.email as email FROM users us where us.email = :email";
        
        $pst = $db->prepare($sql);
        $pst->bindParam(':email', $email);
        $pst->execute();        
        $r = $pst->fetch(\PDO::FETCH_OBJ);
        return $r;
    }

    //get security question by user
    public function getSqByUserId($user_id, $db)
    {
        $sql = "SELECT sa.user_id, sq.question as question, sa.answer FROM security_answers sa 
        inner join security_questions sq on sq.sq_id = sa.sq_id 
        inner join users us on sa.user_id = us.user_id and sa.user_id = :user_id";
        
        $pst = $db->prepare($sql);
        $pst->bindParam(':user_id', $user_id);
        $pst->execute();        
        $r = $pst->fetch(\PDO::FETCH_OBJ);
        return $r;
    }

    //get security question and answer by email
    public function getSqByEmail($email, $db)
    {
        $sql = "SELECT sa.answer as answer, sq.question as question FROM security_answers sa 
        inner join security_questions sq on sq.sq_id = sa.sq_id 
        inner join users us on sa.user_id = us.user_id and us.email = :email";
        
        $pst = $db->prepare($sql);
        $pst->bindParam(':email', $email);
        $pst->execute();        
        $r = $pst->fetch(\PDO::FETCH_OBJ);
        return $r;
    }

    // get all recovery information for the list by user
    public function getAllRecoveries($user_id, $dbconnection)
    { 
        $sql = "SELECT sa.sa_id as id, us.user_name as uname, sq.question as question, sa.answer FROM security_answers sa inner join security_questions sq on sq.sq_id = sa.sq_id inner join users us on sa.user_id = us.user_id and sa.user_id = :user_id";
        
        $pdostm = $dbconnection->prepare($sql);
        $pdostm->bindParam(':user_id', $user_id);
        $pdostm->execute();
        $recoveries = $pdostm->fetchAll(\PDO::FETCH_OBJ);
        return $recoveries;
    }   

    // add recovery information (question and answer)
    public function addRecovery($sq_id, $answer, $user, $db)
    {
        $sql = "INSERT INTO security_answers(sq_id, answer, user_id) values (:sq_id, :answer, :user)";

        $pst = $db->prepare($sql);        
        $pst->bindParam(':sq_id', $sq_id);
        $pst->bindParam(':answer', $answer);
        $pst->bindParam(':user', $user);
        $count = $pst->execute();
        return $count;
    }

    //delete recovery information
    public function deleteRecovery($id, $db)
    {
        $sql = "DELETE FROM security_answers WHERE sa_id = :id";

        $pst = $db->prepare($sql);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }

    // update recovery information
    public function updateRecovery($id, $sq_id, $answer, $user, $db)
    {
        $sql = "UPDATE security_answers
                set user_id = :user,
                answer = :answer,
                sq_id = :sq_id            
                WHERE sa_id = :id";

        $pst =  $db->prepare($sql);
        $pst->bindParam(':sq_id', $sq_id);
        $pst->bindParam(':user', $user);
        $pst->bindParam(':answer', $answer);
        $pst->bindParam(':id', $id);
        $count = $pst->execute();
        return $count;
    }
    
    //update password by email if the user doesnt remember the password
    public function updatePasswordByEmail($email, $db)
    {
        $sql = "UPDATE users us
                set login_password = :pass,                         
                WHERE us.email = :email";

        $pst =  $db->prepare($sql);
        $pst->bindParam(':email', $email);       
        $count = $pst->execute();
        return $count;
    }

}

?>