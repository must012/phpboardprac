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
        if (isset($_FILES["upFiles"]["name"][0]) && $_FILES["upFiles"]["name"][0] != '') {

            $writer = requestValue("writer");
            $checkExt = array("html", "htm", "php", "php3", "inc", "pl", "cgi", "asp", "jsp", "phtml", "js", "");
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

    function getFiles($contentNum = null)
    {
        if ($contentNum)
            $num = $contentNum;
        else
            $num = requestValue("num");

        return $this->model->getFiles($num);
    }

    function downloadFile()
    {
        $id = requestValue("id");
        $data = $this->model->getFiles($id, "fileId");

        $fileName = $data[0]["saveName"];
        $downloadName = $data[0]["originName"];

        $downloadPath = "../Files/";
        $fileSize = filesize($downloadPath . $fileName);
        if (is_ie()) $fileName = utf2euc($fileName);

        $path_parts = pathinfo($downloadPath . $fileName);
        $ext = strtolower($path_parts["extension"]);

        switch ($ext) {
            case "pdf":
                $ctype = "application/pdf";
                break;
            case "exe":
                $ctype = "application/octet-stream";
                break;
            case "zip":
                $ctype = "application/zip";
                break;
            case "doc":
                $ctype = "application/msword";
                break;
            case "xls":
                $ctype = "application/vnd.ms-excel";
                break;
            case "pptx":
            case "ppt":
                $ctype = "application/vnd.ms-powerpoint";
                break;
            case "gif":
                $ctype = "image/gif";
                break;
            case "png":
                $ctype = "image/png";
                break;
            case "jpeg":
            case "jpg":
                $ctype = "image/jpg";
                break;
            case "mp3":
                $ctype = "audio/mpeg";
                break;
            case "wav":
                $ctype = "audio/x-wav";
                break;
            case "mpeg":
            case "mpg":
            case "mpe":
                $ctype = "video/mpeg";
                break;
            case "mov":
                $ctype = "video/quicktime";
                break;
            case "avi":
                $ctype = "video/x-msvideo";
                break;
            case "php":
                $ctype = "application/force-download";
                break;
            case "htm":
            case "hwp":
                $ctype = "application/force-download";
                break;
            case "html":
            case 'txt' :
                $ctype = "text/plain";
                break;

            default:
                $ctype = "application/force-download";
        }

        if (is_file($downloadPath . $fileName)) {

//            header("Content-Type: $ctype");
//            header("Pragma: public");
//            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
//            header("Cache-Control: private", false);
//            header("Expires: 0");
//            header("Content-Disposition: attachment; filename=\"$downloadName\"");
//            header("Content-Transfer-Encoding: binary");
//            header("Content-Length: $fileSize");


            header("Pragma: public");
            header("Content-Type: $ctype");
            header("Expires: 0");
            header("Content-Disposition: attachment; filename=\"$downloadName\"");
            header("Content-Transfer-Encoding: binary");
            header("Content-Length: $fileSize");

            $fp = fopen($downloadPath . $fileName, "rb");

            fpassthru($fp);
           // $content =  fread($fp, filesize($downloadPath . $fileName));
           // print $content;
            flush();
            fclose($fp);


        } else {
            echo "해당 파일이나 경로가 존재하지 않습니다.";
            exit;
        }
    }

    function deleteFile()
    {
        $data = $this->model->getFiles(requestValue("num"), "num");
        $this->model->deleteFile(requestValue("num"));
        $saveName = $data[0]["saveName"];

        if (unlink("../Files/" . $saveName))
            echo "<script>alert('삭제성공');</script>";
        else
            echo "<script>alert('삭제실패');</script>";

        echo "<script>history.back();</script>";
    }

}