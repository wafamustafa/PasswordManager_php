<?php
//File created by Wafa 2021/04
namespace Codesses\php\Models;

class Aboutus {

    public function getAboutus($dbcon)
    {
        $sql = "SELECT * FROM about_us";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $listAu = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        return $listAu;
    }

    public function getAboutusById($au_id, $db)
    {
        $sql = "SELECT about_us.au_id, about_us.au_member, about_us.au_msg, about_us.img_path FROM about_us where about_us.au_id = :au_id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':au_id', $au_id);
        $pst->execute();
        $listAuid = $pst->fetch(\PDO::FETCH_OBJ);
        return $listAuid;
    }

    public function addAboutus($au_member, $au_msg, $img_path, $db)
    {
        $sql = "INSERT INTO about_us (au_member, au_msg, img_path)
            VALUES (:member, :message, :imgpath)";
        $pst = $db->prepare($sql);

        $pst->bindParam(':member', $au_member);
        $pst->bindParam(':message', $au_msg);
        $pst->bindParam(':imgpath', $img_path);

        $addAu = $pst->execute();
        return $addAu;
    }

    public function updateAboutus($au_id, $au_member, $au_msg, $db)
    {
        $sql = "UPDATE about_us set au_member = :member, au_msg = :message WHERE au_id = :au_id";
        $pst =   $db->prepare($sql);
        $pst->bindParam(':au_id', $au_id);
        $pst->bindParam(':member', $au_member);
        $pst->bindParam(':message', $au_msg);

        $updateAu = $pst->execute();
        return $updateAu;
    }

    public function deleteAboutus($au_id, $db)
    {
        $sql = "DELETE FROM about_us WHERE au_id = :au_id";

        $id = $_POST['au_id'];
        $pst = $db->prepare($sql);
        $pst->bindParam(':au_id', $au_id);
        $deleteAu = $pst->execute();
        return $deleteAu;
    }

}
?>
