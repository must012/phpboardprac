<!-- 컨텐츠의 상세내용을 보여주는 View -->

<script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>

<div class="row">
    <div class="subject col-md-10"><h2>Detail</h2></div>

    <div class="col-2 pl-5">
        <button class="btn greBtn" onclick="location.href= '/board'"><i class="fas fa-list"> 목록</i></button>

    </div>
</div>

<hr>

<div class="panel-default">

    <div class="panel-heading d-flex pt-2 pb-2">
        <div class="contents-title col-3">
            <div class="contents-writer">작성자 : <?= $data["writer"] ?></div>
            <div class="contents-data"><?= $data["publish"] ?></div>
        </div>
        <div class="col-4 empty-flex-box"></div>
        <div class="view-data col-2">
            <i class="far fa-eye"></i>&nbsp;<?= $count ?>
        </div>
        <div class="action col-3 pl-4 pt-2 float-right">
            <button class="btn blueBtn" onclick="location.href= '/board/modify/<?= $num ?>'"><i
                        class="far fa-edit">수정</i>
            </button>
            <button class="btn ml-md-1 redBtn" onclick="checkDelete(<?= $data["num"] ?>)"><i
                        class="far fa-trash-alt">
                    삭제</i>
            </button>
        </div>
    </div>

    <div class="panel-body clearfix">
        <div class="col-12 pt-2"><h3><?= $data["title"] ?></h3>
            <hr style="background-color: whitesmoke">
            <div><?= $data["contents"] ?></div>
        </div>

    </div>

</div>

<script>
    function checkDelete(num) {

        var con = confirm("정말 삭제 하시겠습니까?");
        if (con) {
            location.href = "/board/delete/" + num;
        } else
            return;
    }

    CKEDITOR.replace('data');
</script>