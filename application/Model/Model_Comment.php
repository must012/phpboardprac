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

    function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=report", "root", "rootro");

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function insertComment($conNum, $comment, $writer, $rootComment = null)
    {
//        connum = 게시글 번호, rootcomment = 대댓글 대상, comment = 내용, writer = 작성자
//        sequence = 그 글에서의 댓글 번호
        try {
            $pstmt = $this->db->prepare("INSERT INTO comment(conNum, rootComment, sequence, comment, writer) VALUES(:conNum1, :rootComment,
                                                    (SELECT (COUNT(num)+1) FROM comment as a WHERE conNum = :conNum2), :comment, :writer)");

            $pstmt->bindValue(":conNum1", $conNum, PDO::PARAM_INT);
            $pstmt->bindValue(":rootComment", $rootComment, PDO::PARAM_INT);
            $pstmt->bindValue(":conNum2", $conNum, PDO::PARAM_INT);
            $pstmt->bindValue(":comment", $comment, PDO::PARAM_STR);
            $pstmt->bindValue(":writer", $writer, PDO::PARAM_STR);

            $pstmt->execute();

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function getComments($conNum)
    {
        try {
            $pstmt = $this->db->prepare("SELECT * FROM comment WHERE conNum = :conNum");
            $pstmt->bindValue(":conNum", $conNum, PDO::PARAM_INT);
            $pstmt->execute();

            return $pstmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function deleteComment($conNum, $num){
//        conNum - contentsNumber / num = commentNumber

    }
}