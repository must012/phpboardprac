<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-03
 * Time: 오후 11:38
 */

//index에서 모든 url이 나누어 지므로 session_start 는 index에서 한번만 실행해주면 됨
session_start();

//매번 require 하지 않고 여기서 하며, 클래스에 생성자를 만들 떄, 매번 추가하지 않도록 autoload 설정
require_once 'application/config/config.php';
require_once 'application/vendor/autoload.php';

//들어오는 url을 해석하여 Controller 를 지정
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

//매개변수값이 있는 경우를 위한 부분
$paths = explode("/", $path);
$num = '';

//매개 변수값은 따로 저장
if(count($paths)>3){
  $num = array_pop($paths);
  $path = implode("/", $paths);
}

$model = new Model();
$controller = new Controller($model);

switch($path){

    case '/board/login':
        $controller->login();
        break;

    case '/board/logout':
        $controller->logout();
        break;

    case '/signup':
        require_once _VIEW."Signup.php";
        break;

    case '/signup/update':
        $controller->signUp();
        break;

    case '/member':
        $controller->member();
        break;

    case '/membermodify':
        $controller->memberModify();
        break;

    case '/board/detail':
        $controller->detail();
        break;

    case '/board/modify':
        $controller->contentModify($num);
        break;

    case '/board/update':
        $controller->contentUpdate();
        break;

    case '/board/delete':
        $controller->contentDelete($num);
        break;

    case '/write':
        require_once _VIEW."Write.php";
        break;

    case '/write/update':
        $controller->write();
        break;

//        잘못치거나 board로 치면 항상 기본 페이지로
    case '/board':
    default:
        $controller->board();
}