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

    function uploadFile($conNum)
    {

        if (isset($_FILES["upFiles"]) && $_FILES["upFiles"]["name"] != '') {
            $writer = requestValue("writer");
            $checkExt = array("html", "htm", "php", "php3", "inc", "pl", "cgi", "txt", "TXT", "asp", "jsp", "phtml", "js", "");
            $arrayCount = count($_FILES["upFiles"]["name"]);

            for ($i = 0; $i < $arrayCount; $i++) {

                $originFileName = $_FILES["upFiles"]["name"][$i];
                $tmpName = $_FILES["upFiles"]["tmp_name"][$i];
                $fileId = md5($tmpName);

                $ext = substr(strrchr($originFileName, '.'), 1);
                $ext = strtolower($ext);

                if (in_array($ext, $checkExt)) {
                    echo "<script>alert('업로드를 할 수 없는 파일형식입니다.');	history.back();</script>";
                    exit;
                };

                $saveFileName = $writer . "_" . date("YmdHis") . "_" . str_replace(" ", "_", $_FILES["upFiles"]["name"][$i]);
                $upLoadPath = "../Files";

                if (move_uploaded_file($_FILES["upFiles"]["tmp_name"][$i], $upLoadPath . "/" . iconv("UTF-8", "EUC-KR", $saveFileName))) {

                    $this->model->uploadFile($fileId, $originFileName, $saveFileName, $tmpName, $writer, $conNum);

                } else {
                    errorBack("업로드 실패!");
                }
            }

        }

        header("Location: /board");
    }

    function getFiles()
    {
        $num = requestValue("num");
        return $this->model->getFiles($num);
    }

    function downloadFile()
    {
        $id = requestValue("id");
        $data = $this->model->getFiles($id, "fileId");
        print_r($data);
        $fileName = $data[0]["saveName"];
        $downloadName = $data[0]["originName"];

        $downloadPath = "../Files/";
        $fileSize = filesize($downloadPath . $fileName);
        if (is_ie()) $fileName = utf2euc($fileName);

        if (is_file($downloadPath . $fileName)) {
            header("Pragma: no-cache");
            header("Expires: 0");
            header("Content-Type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$downloadName\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $fileSize");

            readfile($downloadPath . $fileName);

            $fp = fopen($downloadPath . $fileName, "r");
            if (!fpassthru($fp))// 서버부하를 줄이려면 print 나 echo 또는 while 문을 이용한 기타 보단 이방법이...
            {
                fclose($fp);
            }

        } else {
            echo "해당 파일이나 경로가 존재하지 않습니다.";
            exit;
        }
    }

}