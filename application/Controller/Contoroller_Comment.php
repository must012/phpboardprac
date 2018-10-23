<?php
/**
 * Created by PhpStorm.
 * User: LeeSJ
 * Date: 2018-10-19
 * Time: 오전 10:51
 */

class Contoroller_Comment
{
    private $model;

// model 을 조정하기 위한 객체를 받는 생성자
    function __construct(Model_Comment $model)
    {
        $this->model = $model;
    }

    function insertComment()
    {
        if (isset($_SESSION["id"])) {
            $conNum = requestValue("conNum");
            $rootComment = requestValue("rootComment");
            $comment = requestValue("comment");
            $writer = $_SESSION["id"];
            $writerNick = $_SESSION["name"];

            if (isset($rootComment))
                $check = $this->model->insertComment($conNum, $comment, $writer, $writerNick, $rootComment);
            else
                $check = $this->model->insertComment($conNum, $comment, $writer, $writerNick);

            if ($check == 1)
                echo "<script>location.href = '/board/detail?num=$conNum'; </script>";
            else
                echo "<script>alert('댓글 등록 실패!'); location.href = '/board/detail?num=$conNum'; </script>";

        } else {
            errorBack("로그인 한 사용자만 댓글을 등록할 수 있습니다.");
        }
    }

    function getComments()
    {
        $num = requestValue("num");

        return $this->model->getComments($num);
    }

    function deleteComments($num)
    {
        $check = $this->model->deleteComment($num);

        if ($check == 1)
            errorBack("삭제 완료");
        else
            errorBack("삭제 실패");
    }

}