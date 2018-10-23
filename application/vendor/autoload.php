<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-03
 * Time: 오후 11:40
 */

spl_autoload_register(function ($path){

    $className = strtolower($path);//클래스 이름 소문자로
    $className2 = preg_replace("/(model|application)(.*)/", "$1", $className);
    switch ($className2) {
        case 'model': $dir = _MODEL; break;
        case 'application': $dir = _APP; break;
        default: $dir = _CTR; break;
    }
    require_once "$dir"."/"."$className".".php";
});
