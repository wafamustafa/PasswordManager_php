<?php
//File created by Wafa 2021/03
namespace Codesses\php\Models
{

    Class PasswordHints {

        //LIST 
        public function getPasswordHintbyId($url_id, $db)
        {
            $sql = "SELECT url.password_hint FROM url where url.url_id = :url_id";
            $pst = $db->prepare($sql);
            $pst->bindParam(':url_id', $url_id);

            $pst->execute();
            $count = $pst->fetch(\PDO::FETCH_OBJ);
            return $count;
        }

        //CREATE or UPDATE
        public function addupdatePasswordHint($url_id, $pass_hint, $db)
        {
            $sql = "UPDATE url set password_hint = :pass_hint where url_id = :url_id";
    
            $pst = $db->prepare($sql);
            $pst->bindParam(':url_id', $url_id);
            $pst->bindParam(':pass_hint', $pass_hint);
            $count = $pst->execute();
            return $count;
        }

        //DELETE
        public function deletePasswordHint($url_id, $db)
        {
            $sql = "UPDATE url set password_hint = NULL where url_id = :url_id";

            $pst = $db->prepare($sql);
            $pst->bindParam(':url_id', $url_id);
            $count = $pst->execute();
            return $count;


        }



    }

}