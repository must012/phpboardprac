<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-23
 * Time: 오후 2:49
 */

// fileId, originName, tmpName, uploadTime, uploader
class Model_Files
{
    private $db;

    public function __construct($setDb)
    {
        $this->db = $setDb;
    }

    function uploadFile($fileId, $originName, $saveName, $tmpName, $uploader, $conNum)
    {
        try {

            $pstmt = $this->db->prepare("INSERT INTO file(fileId, originName, saveName, tmpName, uploader, contentNum) VALUES (:fileId, :originName, :saveName, :tmpName, :uploader, :conNum)");
            $pstmt->bindValue(":fileId", $fileId, PDO::PARAM_STR);
            $pstmt->bindValue(":originName", $originName, PDO::PARAM_STR);
            $pstmt->bindValue(":saveName", $saveName, PDO::PARAM_STR);
            $pstmt->bindValue(":tmpName", $tmpName, PDO::PARAM_STR);
            $pstmt->bindValue(":uploader", $uploader, PDO::PARAM_STR);
            $pstmt->bindValue(":conNum", $conNum, PDO::PARAM_INT);

            $pstmt->execute();
        } catch (PDOException $e) {
            exit($e->getMessage());
        }

    }

    function getFiles($num, $column = "contentNum")
    {
        try {
            $pstmt = $this->db->prepare("SELECT * FROM file WHERE $column = :num");
            if ($column != "contentNum") {
                $pstmt->bindValue(":num", $num, PDO::PARAM_STR);
            } else {
                $pstmt->bindValue(":num", $num, PDO::PARAM_INT);
            }
            $pstmt->execute();

            return $pstmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }

    function downloadFile($fileId)
    {
        try {

        } catch (PDOException $e) {
            exit($e->getMessage());
        }
    }
}