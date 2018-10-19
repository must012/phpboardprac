<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-03
 * Time: 오후 11:53
 */

class Controller
{
// url 에 따라 실행되는 기능이 달라짐
    private $model;
    private $num;
    private $loginCheck;
    private $name;

// model 을 조정하기 위한 객체를 받는 생성자
    function __construct(Model $model)
    {
        $this->model = $model;
        $this->num = $this->model->countContent();

    }

//메인 페이지를 불러오는 메서드
    function board($loginCheck)
    {
        $this->loginCheck = $loginCheck;
        $totalPage = floor($this->num[0] / COUNT_LIST);

        $totalPage = ($this->num[0] % COUNT_LIST > 0) ? $totalPage + 1 : $totalPage;
        $page = ($_REQUEST["page"]) ?? "1";

        $page = ($totalPage < $page) ? $totalPage : $page;

        $startPage = floor(($page - 1) / COUNT_PAGE) * COUNT_PAGE;

        $endPage = $startPage + COUNT_PAGE;

        $endPage = ($endPage > $totalPage) ? $totalPage : $endPage;

        $list = $this->model->callList($page, $endPage);

        require_once _VIEW . "BoardList.php";
    }

//    ========================= Main =======================
//로그인을 하는 메서드
    function login()
    {
        $id = requestValue("id");
        $pw = requestValue("pw");

        if ($id && $pw) {

            $member = $this->model->getMember($id);

            if ($member) {

                if ($member["pw"] == $pw) {

                    $_SESSION["id"] = $id;
                    $_SESSION["name"] = $member["name"];

                    echo "<script>
                        history.back();
                        </script>";

                } else {
                    errorBack("비밀번호 확인");
                }
            } else {
                errorBack("아이디 확인");
            }
        } else {
            errorBack("값 부족");
        }
    }

//로그아웃을 하는 메서드
    function logout()
    {

        unset($_SESSION["id"]);
        unset($_SESSION["name"]);

        echo "<script>
        history.back();
        </script>";

    }

//회원가입을 하는 메서드
    function signUp()
    {
        $id = requestValue("id");
        $pw = requestValue("pw");
        $name = requestValue("name");

        if ($name && $id && $pw) {
            $mdao = new Model();

            if ($this->model->getMember($id)) {
                errorBack("이미 사용중인 아이디 입니다!");

            } else {
                $this->model->SignUp($id, $pw, $name);
                goToPage("가입완료", "/board");
            }
        } else {
            errorBack("입력 내용 부족");
        }
    }

//정보 수정을 하는 View 를 불러오고 데이터를 입력받을 메서드
    function member()
    {
        $originId = $_SESSION["id"] ?? '';

        $data = $this->model->getMember($originId);

        require_once _VIEW . "Member.php";
    }

//받은 데이터대로 회원 정보를 수정하는 메서드
    function memberModify()
    {
        $id = requestValue("id");
        $pw = requestValue("pw");
        $name = requestValue("name");

        if ($pw) {
            if ($_SESSION["id"] == $id) {

                $this->model->changeMemberData($id, $pw, $name);

                $_SESSION["name"] = $name;
                goToPage("정보 변경 완료", "board");
            } else {
                errorBack("본인의 아이디만 변경 가능합니다");
            }
        } else {
            errorBack("정보 입력이 덜 되었습니다");
        }
    }

    //    ========================= Member =======================

//컨텐츠의 상세내용을 보여주는 메서드
    function detail($commentList)
    {
        $id = $_SESSION["id"] ?? '';
        $name = $_SESSION["name"] ?? '';
        $comments = $commentList;

        $num = requestValue("num");

        $data = $this->model->getContents($num);

        $count = $this->model->getCountViewer($num);

        if ($id) {

            $viewCheck = $this->model->getViewer($num, $id);

            if (!($viewCheck))
                $this->model->increaseViewCount($num, $id);

        }

        require_once _VIEW . "BoardDetail.php";

    }

//컨텐츠의 내용을 수정하는 View를 불러오고 데이터를 입력받는 메서드
    function contentModify($num)
    {
        $data = $this->model->getContents($num);
        $id = $_SESSION["id"] ?? '';


        if ($id == $data["writer"]) {
            require_once _VIEW . "ContentModify.php";
            exit();
        } else {
            errorBack("본인 글만 수정할 수 있습니다.");
        }
    }

//전송된 데이터를 바탕으로 컨텐츠를 업데이트하는 메서드
    function contentUpdate()
    {
        $num = $_REQUEST["num"];
        $ct = $_POST["contents"];

        $this->model->updateContents($num, $ct);

        goToPage("변경 완료", "/board");
    }

//컨텐츠를 삭제하는 메서드
    function contentDelete($num)
    {
        $data = $this->model->getContents($num);
        $id = $_SESSION["id"] ?? '';

        if ($data["writer"] == $id) {
            $this->model->deleteContents($num);
            goToPage("삭제 완료", "/board");
        } else
            errorBack("본인이 작성한 글만 삭제할 수 있습니다.");
    }

//글을 작성하는 메서드
    function write()
    {

        if (isset($_SESSION["id"])) {
            $wt = requestValue("writer");
            $tt = requestValue("title");
            $ct = requestValue("contents");
            $nn = requestValue("nick");

            if ($wt && $tt && $ct && $nn) {

                $this->model->insertContents($wt, $tt, $ct, $nn);

                header("Location: /board");

            } else {
                goToPage("값 충분하지 않음", "/board");
            }
        } else {
            goToPage("로그인 한 사용자만 글 작성이 가능합니다.", "/board");
        }
    }

//    ================= 댓글 관리

}