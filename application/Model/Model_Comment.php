<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-19
 * Time: 오전 10:52
 */

class Model_Comment
{
    private $db;

    function __construct($setDb)
    {
        $this->db = $setDb;
    }

    function insertComment($conNum, $comment, $writer, $writerNick, $rootComment = null)
    {
//        connum = 게시글 번호, rootcomment = 대댓글 대상, comment = 내용, writer = 작성자
//        sequence = 그 글에서의 댓글 번호
        try {
            $pstmt = $this->db->prepare("INSERT INTO comment(conNum, rootComment, sequence, comment, writer, writerNick) VALUES(:conNum1, :rootComment,
                                                    (SELECT (COUNT(num)+1) FROM comment as a WHERE conNum = :conNum2), :comment, :writer, :writerNick)");

            $pstmt->bindValue(":conNum1", $conNum, PDO::PARAM_INT);

            if (!($rootComment)) {
                $pstmt->bindValue(":rootComment", $rootComment, PDO::PARAM_NULL);
            } else {
                $pstmt->bindValue(":rootComment", $rootComment, PDO::PARAM_INT);
            }
            $pstmt->bindValue(":conNum2", $conNum, PDO::PARAM_INT);
            $pstmt->bindValue(":comment", $comment, PDO::PARAM_STR);
            $pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);
            $pstmt->bindValue(":writerNick", $writerNick, PDO::PARAM_STR);

            return $return = $pstmt->execute();

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function getComments($conNum)
    {
        try {
            $pstmt = $this->db->prepare("SELECT * FROM comment WHERE conNum = :conNum ORDER BY IF(ISNULL(rootComment), num, rootComment), sequence");
            $pstmt->bindValue(":conNum", $conNum, PDO::PARAM_INT);
            $pstmt->execute();

            return $pstmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function deleteComment($num)
    {
//        conNum - contentsNumber / num = commentNumber
        try {
            $pstmt = $this->db->prepare("DELETE FROM comment WHERE num = :num");
            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            return $pstmt->execute();

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}