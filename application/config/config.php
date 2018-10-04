<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-03
 * Time: 오후 11:35
 */

// 상수 정의 및 자주 쓰는 메서드 정의

define("_ROOT",'C:/phpstudy/ReportMVC');
define("_PUBLIC", _ROOT."/public/");
define("_APP", _ROOT."/application/");
define("_MODEL", _APP."/Model/");
define("_VIEW", _APP."View/");
define("_CTR", _APP."/Controller/");
define("_CONFIG", _APP."/config/");

define("LOGIN_PAGE", "login_form.php");
define("MAIN_PAGE", _VIEW."BoardList.php");

require_once(_CONFIG."config.php");

function requestValue($name)
{
    return $_REQUEST[$name]?? '';
}

// 에러 발생시 변수로 받은 메시지를 alert 후 전 페이지로 다시 돌아감
function errorBack($msg)
{
    ?>
    <script>
        alert("<?=$msg?>");
        history.back();
    </script>
    <?php
    exit();
}
?>

<?php

//전페이지로 돌아갈 상황이 아닐 떄
function goToPage($msg, $url)
{
    ?>
    <script>
        alert("<?=$msg?>");
        location.href = "<?= $url ?>";
    </script>
    <?php
}
