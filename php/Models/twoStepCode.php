<?php
//***NO LONGER BEING USED ***/

namespace Codesses\php\Models {

    class Codes
    {
        public function getIdByEmail($email, $first_name, $last_name, $db)
        {
            $sql = "SELECT users.user_id, users.first_name, users.last_name, users.email FROM users where users.email = :email";

            $pst = $db->prepare($sql);
            $pst->bindParam(':email', $email);
            $pst->bindParam(':first_name', $first_name);
            $pst->bindParam(':last_name', $last_name);
            $pst->execute();
            $r = $pst->fetch(\PDO::FETCH_OBJ);
            return $r;
        }
    }
}
