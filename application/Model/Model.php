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
            $pstmt = $this->db->query("SELECT @ROWNUM := @ROWNUM + 1 AS NUM, num, writer, title, publish, view
            FROM board, (SELECT @ROWNUM := 0) A 
            ORDER BY publish DESC 
            LIMIT " . ($page - 1) * COUNT_LIST . ", " . COUNT_LIST);
            $pstmt->execute();
            return $result = $pstmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function countContent()
    {
//        게시물 갯수 체크
        try {
            $pstmt = $this->db->query("SELECT COUNT(*) FROM board");
            return $result = $pstmt->fetch(PDO::FETCH_NUM);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }

    }

//----------------------------------    컨텐츠 관련

    public function increaseViewCount($num, $id)
    {
//        이 글을 본사람의 아이디를 조회 테이블에 넣음
        try {
            $pstmt = $this->db->prepare("INSERT INTO viewer(contentsNum, viewer) VALUES (:num,:id )");

            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->bindValue(":id", $id, PDO::PARAM_STR);
            $pstmt->execute();

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function countViewer($num)
    {
//        조회수 검색
        try {
            $pstmt = $this->db->prepare("SELECT COUNT(viewer) as viewercount FROM viewer WHERE contentsNum = :num");

            $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            $pstmt->execute();

            $return = $pstmt->fetch(PDO::FETCH_ASSOC);
            return $return["viewercount"];
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    public function getViewer($num, $viwere)
    {
//        해당 게시글을 본 사람 검색
        try {
            $pstmt = $this->db->prepare("SELECT COUNT(viewer) as viewercount FROM viewer WHERE contentsNum = :num AND viewer = :viewer");
            $pstmt->bindValue("num", $num, PDO::PARAM_INT);
            $pstmt->bindValue("viewer", $viwere, PDO::PARAM_STR);
            $pstmt->execute();
            $result = $pstmt->fetch(PDO::FETCH_ASSOC);
            return $result["viewercount"];
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

//    ===================== 조회 관련

}