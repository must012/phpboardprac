<?php

class Model
{
    private $db;

    public function __construct()
    {
        try {
            $this->db = new PDO("mysql:host=localhost;dbname=report", "root", "rootro");

            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function signUp($id, $pw, $name)
    {
        try {
            $pstmt = $this->db->prepare("INSERT INTO member VALUES (:id, :pw, :name)");
            $pstmt->bindValue(":id", $id, PDO::PARAM_STR);
            $pstmt->bindValue(":pw", $pw, PDO::PARAM_STR);
            $pstmt->bindValue(":name", $name, PDO::PARAM_STR);

            $pstmt->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function changeMemberData($id, $pw, $name)
    {
        try {
            $pstmt = $this->db->prepare("UPDATE member SET pw=:pw, name=:name WHERE id=:id");
            $pstmt->bindValue(":pw", $pw, PDO::PARAM_STR);
            $pstmt->bindValue(":name", $name, PDO::PARAM_STR);
            $pstmt->bindValue(":id", $id, PDO::PARAM_STR);

            $pstmt->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function getMember($id)
    {
        try {
            $pstmt = $this->db->prepare("SELECT * FROM member WHERE id=:id");
            $pstmt->bindValue(":id", $id, PDO::PARAM_STR);
            $pstmt->execute();

            return $result = $pstmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

// ----------------- 멤버 관련 ---------------------

    function insertContents($wt, $tt, $ct)
    {
        try {
            $pstmt = $this->db->prepare("INSERT INTO board(writer, title, contents) VALUES (:wt, :tt, :ct)");
            $pstmt->bindValue(":wt", $wt, PDO::PARAM_STR);
            $pstmt->bindValue(":tt", $tt, PDO::PARAM_STR);
            $pstmt->bindValue(":ct", $ct, PDO::PARAM_STR);
            $pstmt->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getContents($num)
    {
        try {
            $pstmt = $this->db->prepare("SELECT * FROM board WHERE num=:num");
            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->execute();

            return $result = $pstmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function updateContents($num, $ct)
    {
        try {
            $pstmt = $this->db->prepare("UPDATE board SET contents=:ct WHERE num=:num");
            $pstmt->bindValue(":ct", $ct, PDO::PARAM_STR);
            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function deleteContents($num)
    {
        try {
            $pstmt = $this->db->prepare("DELETE FROM board WHERE num=:num");
            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function callList($page)
    {
        try {
            $pstmt = $this->db->query("SELECT @ROWNUM := @ROWNUM + 1 AS NUM, writer, title, contents, publish, view 
            FROM board, (SELECT @ROWNUM := 0) A 
            ORDER BY publish DESC 
            LIMIT ".($page-1)*COUNT_LIST.", ".COUNT_LIST);
            $pstmt->execute();
            return $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function increaseViewCount($num)
    {
        try {
            $pstmt = $this->db->prepare("UPDATE board SET view =view+1 WHERE num=:num");
            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->execute();

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function countContent()
    {
        try {
            $pstmt = $this->db->query("SELECT COUNT(*) FROM board");
            return $result = $pstmt->fetch(PDO::FETCH_NUM);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }

    }

}

?>