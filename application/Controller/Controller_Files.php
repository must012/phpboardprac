<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-23
 * Time: 오후 2:22
 */

class Controller_Files
{
    private $model;

    function __construct(Model_Files $model)
    {
        $this->model = $model;
    }

    function uploadFile()
    {
        if (isset($_FILES["upFile"]) && $_FILES["upFile"]["name"] != '') {

            $writer = requestValue("writer");

            $originFileName = $_FILES["upFile"]["name"];
            $tmpName = $_FILES["upFile"]["tmp_name"];
            $fileId = md5($_FILES["upFile"]["tmp_name"]);

            $ext = substr(strrchr($_FILES["upFile"]["name"], '.'), 1);
            $ext = strtolower($ext);

            $checkExt = array("html", "htm", "php", "php3", "inc", "pl", "cgi", "txt", "TXT", "asp", "jsp", "phtml", "js", "");

            if (in_array($ext, $checkExt)) {
                echo "<script>alert('업로드를 할 수 없는 파일형식입니다.');	history.back();</script>";
                exit;
            }

            $saveFileName = $writer . "_" . date("YmdHis") . "_" . str_replace(" ", "_", $_FILES["upFile"]["name"]);
            $upLoadPath = "../Files";

            if (move_uploaded_file($_FILES["upFile"]["tmp_name"], $upLoadPath . "/" . iconv("UTF-8", "EUC-KR", $saveFileName))) {

                $daoCheck = $this->model->uploadFile($fileId, $originFileName, $tmpName, $writer);
                if ($daoCheck == 1) {
                    return $fileId;
                }
            } else {
                errorBack("업로드 실패!");
            }
        }
    }

}