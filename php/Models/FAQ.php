<?php

namespace Codesses\php\Models;

class FAQ
{
    public function getFAQ($dbcon)
    {
        $sql = "SELECT * FROM faq";
        $pdostm = $dbcon->prepare($sql);
        $pdostm->execute();

        $faq = $pdostm->fetchAll(\PDO::FETCH_ASSOC);
        return $faq;
    }

    public function getFAQById($id, $db)
    {
        $sql = "SELECT faq.faq_id, faq.question, faq.answer FROM faq where faq.faq_id = :faq_id";
        $pst = $db->prepare($sql);
        $pst->bindParam(':faq_id', $id);
        $pst->execute();
        $s = $pst->fetch(\PDO::FETCH_OBJ);
        return $s;
    }

    public function addFAQ($question, $answer, $db)
    {
        $sql = "INSERT INTO faq (question, answer)
            VALUES (:question, :answer)";
        $pst = $db->prepare($sql);

        $pst->bindParam(':question', $question);
        $pst->bindParam(':answer', $answer);

        $count = $pst->execute();
        return $count;
    }

    public function updateFAQ($id, $question, $answer, $db)
    {
        $sql = "UPDATE faq set question = :question, answer = :answer WHERE faq_id = :faq_id";

        $pst =   $db->prepare($sql);
        $pst->bindParam(':faq_id', $id);
        $pst->bindParam(':question', $question);
        $pst->bindParam(':answer', $answer);

        $count = $pst->execute();
        return $count;
    }

    public function deleteFAQ($id, $db)
    {
        $sql = "DELETE FROM faq WHERE faq_id = :faq_id";

        $id = $_POST['faq_id'];
        $pst = $db->prepare($sql);
        $pst->bindParam(':faq_id', $id);
        $count = $pst->execute();
        return $count;
    }
}
