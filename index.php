<?php

/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-03
 * Time: 오후 11:38
 */

session_start();

//매번 require 하지 않고 여기서 하며, 클래스에 생성자를 만들 떄, 매번 추가하지 않도록 autoload 설정
require_once 'application/config/config.php';
require_once 'application/vendor/autoload.php';

//들어오는 url을 해석하여 Controller 를 지정
$path = parse_url($_SERVER['REQUEST_URI'], 5);

//매개변수값이 있는 경우를 위한 부분
$paths = explode("/", $_SERVER["REQUEST_URI"]);
$num = '';

?>
    <script type="text/javascript">
        console.log("request url : <?= $_SERVER["REQUEST_URI"] ?>");
        console.log("path type : <?= gettype($path) ?>");
        console.log("path value : <?= $path ?> ");
    </script>
<?php

//매개 변수값은 따로 저장
if (count($paths) > 3) {
    $num = array_pop($paths);
    $path = implode("/", $paths);
}
$db = returnDB();

$model = new Model($db);
$controller = new Controller($model);

$commentModel = new Model_Comment($db);
$commentController = new Controller_Comment($commentModel);

$fileModel = new Model_Files($db);
$fileController = new Controller_Files($fileModel);

$value = loginCheck();
$loginCheck = $value[0];
$name = $value[1];

if (!(($path == "/board/logout") || ($path == "/write/update") || ($path == "/signup") || ($path == "/file/download"))){
    if($loginCheck)
        $data = $model->getMember($_SESSION["id"]);

    require_once _VIEW . "sidebar.php";
}

switch ($path) {

    case '/board/login':
        $controller->login();
        break;

    case '/board/logout':
        $controller->logout();
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
        $commentList = $commentController->getComments();
        $fileList = $fileController->getFiles();
        $controller->detail($commentList, $fileList);
        break;

    case '/board/modify':
        $fileList = $fileController->getFiles($num);
        $controller->contentModify($num, $fileList);
        break;

    case '/board/update':
        $controller->contentUpdate();
        break;

    case '/board/delete':
        $controller->contentDelete($num);
        break;

    case '/write':
        require_once _VIEW . "Write.php";
        break;

    case '/write/update':

        $conNum = $controller->write();
        $fileController->uploadFile($conNum);
        break;

    case '/comment/update' :
        $commentController->insertComment();
        break;

    case '/comment/delete' :
        $commentController->deleteComments($num);
        break;

    case 'file/upload':
        $fileController->uploadFile($_REQUEST["num"]);
        break;

    case '/file/download' :
        $fileController->downloadFile();
        break;

    case '/file/delete' :
        $fileController->deleteFile();
        break;

    //  잘못치거나 board로 치면 항상 기본 페이지로
    case '/board':
    default:
        $controller->board($loginCheck);
}

require_once _VIEW . "footer.php";