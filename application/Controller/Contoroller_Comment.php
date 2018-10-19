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
            $writer = $_SESSION["name"];

            if(isset($rootComment))
                $this->model->insertComment($conNum, $comment, $writer, $rootComment);
            else
                $this->model->insertComment($conNum, $comment, $writer);

            echo "<script> location.href = '/board/detail?num=$conNum'; </script>";

        } else {
            errorBack("로그인 한 사용자만 댓글을 등록할 수 있습니다.");
        }
    }

    function getComments()
    {
        $num = requestValue("num");

        return $this->model->getComments($num);
    }

    function deleteComments($id, $num){
        if($_SESSION["id"]==$id){

        }else
            errorBack("본인 댓글만 삭제할 수 있습니다.");
    }

}