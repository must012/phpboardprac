<!-- 컨텐츠의 상세내용을 보여주는 View -->

<script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" href="/public/css/Detail.css">

<div class="row">
    <div class="subject col-md-10"><h2>Detail</h2></div>

    <div class="col-2 pl-5">
        <button class="btn greBtn" onclick="location.href= '/board'"><i class="fas fa-list"> 목록</i></button>
    </div>

</div>

<hr>

<div class="panel panel-default">

    <div class="panel-heading d-flex pt-2 pb-2">
        <div class="contents-title col-md-3 col-sm-5">
            <div class="contents-writer"> <?= $data["nick"] ?></div>
            <div class="contents-data"><?= $data["publish"] ?></div>
        </div>
        <div class="col-4 empty-flex-box"></div>
        <div class="view-data col-2 text-right">
            <i class="far fa-eye"></i>&nbsp;<?= $count ?>
        </div>

        <?php if ($id == $data["writer"]): ?>
            <div class="action col-3 pl-4 pt-2 float-right">
                <button class="btn blueBtn" onclick="location.href= '/board/modify/<?= $num ?>'"><i
                            class="far fa-edit">수정</i>
                </button>
                <button class="btn ml-md-1 redBtn" onclick="checkDeleteContents(<?= $data["num"] ?>)"><i
                            class="far fa-trash-alt">
                        삭제</i>
                </button>
            </div>
        <?php endif; ?>

    </div>

    <div class="panel-body comment-panel-body pb-4 clearfix">
        <div class="col-12 pt-2"><h3><?= $data["title"] ?></h3>
            <hr style="background-color: whitesmoke">
            <div><?= $data["contents"] ?></div>
        </div>

    </div>

</div>

<!-- 댓글 부분 -->
<div class="panel panel-default mt-4">

    <ul class="list-group">
        <li class="list-group-item comment-count border-0">댓글 <?= count($comments) ?></li>

        <?php foreach ($comments as $comment): ?>
            <li class="list-group-item comments" id="<?= $comment["num"] ?>">
                <div class="comment-head d-flex mb-2">
                    <div class="comment-data d-flex pl-0 col-6">
                        <div class="writer pl-0 mr-3 col-5"><?= $comment["writerNick"] ?></div>
                        <div class="comment-created"><?= $comment["createDate"] ?></div>
                    </div>


                        <div class="comment-action col-6 d-flex flex-row-reverse">
                            <div class="reply">

                                <button class="btn yellowBtn replyMessages" style="width:38px" id="<?= $comment["num"] ?>" title="대댓글작성">
                                    <i class="fas fa-comment fa-sm"></i>
                                </button>
                                <?php if ($id == $comment["writer"]): ?>
                                <button class="btn redBtn"
                                        onclick="checkDeleteComment(<?= $comment["num"] ?>, '<?= $comment["writer"] ?>')" title="댓글삭제">
                                    <i class="far fa-trash-alt fa-sm"></i>
                                </button>
                                <button class="btn blueBtn" style="width: 38px;" title="수정하기"><i class="fas fa-edit fa-sm"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </div>


                </div>
                <div class="comment-content"><?= $comment["comment"] ?></div>
            </li>
        <?php endforeach; ?>

        <?php if ($id): ?>
            <li class="list-group-item p-1">
                <form action="/comment/update" method="post">

                    <input type="hidden" name="conNum" value="<?= $num ?>">

                    <div class="writer d-flex justify-content-between p-1">
                        <div class="comment-writer mt-1 ml-2"><?= $name ?></div>
                        <div class="mr-2">
                            <button class="btn greBtn newComment" type="submit" data-connum="<?= $num ?>"><i class="far fa-edit"> 등록</i>
                            </button>
                        </div>
                    </div>

                    <div class="panel-body mt-1">
                    <textarea class="form-control" name="comment" id="comment<?= $num ?>" rows="3"
                              placeholder="댓글을 작성해주세요!" required></textarea>
                    </div>

                </form>
            </li>
        <?php endif; ?>
    </ul>
</div>

<script>

    function checkDeleteContents(num) {

        var con = confirm("삭제 하시겠습니까?");
        if (con) {
            location.href = "/board/delete/" + num;
        } else
            return;
    }

    function checkDeleteComment(num, writer) {
        var con = confirm("삭제 하시겠습니까?");

        if ("<?= $_SESSION["id"] ?>" == writer)
        {
            if (con) {
                location.href = "/comment/delete/" + num;
            } else
                return;
        }
    else
        {
            alert("본인이 작성한 댓글만 삭제할 수 있습니다.");
            location.reload();
        }
    }

    $(".replyMessages").click(function (e) {
        const 
    })

        //$(".newComment").click(function (e) {
        //    const conNum = $(this).data("connum");
        //    const commentArea = $("#comment"+conNum);
        //
        //    e.preventDefault(); // form 의 submit - reload 를 막음
        //    $.ajax({
        //        method: "POST",
        //        url: "/comment/update/" + conNum,
        //        data:{
        //            comment: commentArea.val(),
        //            conNum: conNum,
        //            writer: '<?//= $_SESSION["id"] ?>//',
        //            writerNick: '<?//= $_SESSION["name"] ?>//'
        //        },
        //        dataType: "json",
        //        success : function(data){
        //            console.log(data.id)
        //        },
        //        error: function (request, status, error) {
        //            console.log("실패");
        //            console.log("에러명 : " + error);
        //            console.log("상태 : " + status);
        //        }
        //    })
        //
        //});

</script>