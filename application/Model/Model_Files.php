<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-23
 * Time: 오후 2:49
 */
// fileId, originName, tmpName, uploadTime, uploader
class Model_Files{
    private $db;

    public function __construct($setDb)
    {
        $this->db = $setDb;
    }

    function uploadFile($fileId, $originName, $tmpName, $uploader){
        try{
            $pstmt = $this->db->prepare("INSERT INTO files(fileId, originName, tmpName, uploader) VALUES (:fileId, :originName, :tmpName, :uploader)");
            $pstmt->bindValue(":fileId",$fileId,PDO::PARAM_STR);
            $pstmt->bindValue(":originName",$originName,PDO::PARAM_STR);
            $pstmt->bindValue(":tmpName",$tmpName,PDO::PARAM_STR);
            $pstmt->bindValue(":uploader",$uploader,PDO::PARAM_STR);

            return $pstmt->execute();
        }catch(PDOException $e){
            exit($e->getMessage());
        }

    }
}