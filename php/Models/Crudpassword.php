<?php

namespace Codesses\php\Models {

    class Password
    {
        public function getPasswordbyId($id, $db)
        {
            $sql = "SELECT url.url_id, url.url, url.password, url.user_name FROM url where url.url_id = :url_id";
            $pst = $db->prepare($sql);
            $pst->bindParam(':url_id', $id);
            $pst->execute();
            $s = $pst->fetch(\PDO::FETCH_OBJ);
            return $s;
        }
        //Elle
        public function getPasswordsByURL($url, $db)
        {
            $sql = "SELECT * FROM url where url.url = :url";
            $pdostm = $db->prepare($sql);
            $pdostm->bindParam(':url', $url);
            $pdostm->execute();
            $s = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $s;
        } //End of Elle

        public function getAllPasswords($user_id, $db)
        {
            $sql = "SELECT url.url, url.password, url.user_id, url.user_name, url.url_id FROM url where url.user_id = :user_id; ";
            $pdostm = $db->prepare($sql);
            $pdostm->bindParam(':user_id', $user_id);
            $pdostm->execute();
            $passwords = $pdostm->fetchAll(\PDO::FETCH_OBJ);
            return $passwords;
        }
        public function addPassword($user_id, $user_name, $url, $password, $db)
        {
            $sql = "INSERT INTO url(user_id, user_name, url, password) values (:user, :user_name, :url, :password)";

            $pst = $db->prepare($sql);
            $pst->bindParam(':user', $user_id);
            $pst->bindParam(':user_name', $user_name);
            $pst->bindParam(':url', $url);
            $pst->bindParam(':password', $password);
            $count = $pst->execute();
            return $count;
        }
        public function deletePassword($id, $db)
        {
            $sql = "DELETE FROM url WHERE url_id = :id";
            $pst = $db->prepare($sql);
            $pst->bindParam(':id', $id);
            $count = $pst->execute();
            return $count;
        }
        public function updatePassword($id, $user_name, $url, $password, $db)
        {
            $sql = "UPDATE url set user_name = :user_name, url = :url, password = :password WHERE url_id = :url_id";

            $pst = $db->prepare($sql);
            $pst->bindParam(':url_id', $id);
            $pst->bindParam(':user_name', $user_name);
            $pst->bindParam(':url', $url);
            $pst->bindParam(':password', $password);
            $count = $pst->execute();
            return $count;
        }
    }
}
