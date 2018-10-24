<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-12
 * Time: 오전 12:38
 */


if ($_FILES['upload']) {

    // 현재 시간
    $data_filedir = date("YmdHis");

    //오리지널 파일 이름, 확장자
    //upload 된 파일의 이름을 뒤에서 부터 읽어서 .으로 시작하는 부분의 포인터를 가져온 뒤 1번째 자리(0부터 시작하니까)를 입력 -> 확장자명
    $ext = substr(strrchr($_FILES['upload']['name'],'.'),1);
    $ext = strtolower($ext);
    $saveFileName = $data_filedir."_".str_replace(" ","_",$_FILES["upload"]["name"]);

    $upLoadPath = "C:\phpstudy\ReportMVC\img";
    $upLoadSrc = "\img\\";

//    $upLoadPath = "/../Img";
//    $upLoadSrc = "../Img";

    $http = 'http'.((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')?'s':'').'://';

    if($ext=='jpg' or $ext=='gif' or $ext=='png' or $ext=='jpeg'){
        if(move_uploaded_file($_FILES['upload']['tmp_name'],$upLoadPath."/".iconv("UTF-8","EUC-KR",$saveFileName))){
            $upLoadFile = $saveFileName;
        }
        }else{
        exit;
    }

} else {
    exit;
}

$return = ["filename"=>$upLoadFile,"uploaded"=>1,"url"=>$upLoadSrc.$upLoadFile];
$request = json_encode($return);

echo $request;