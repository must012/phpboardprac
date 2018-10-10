<!-- 컨텐츠의 상세내용을 보여주는 View -->
<script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>
<!--    google font -->

<link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">

<div class="row">
    <div class="subject col-md-10"><h2>Detail</h2></div>

    <div class="col-2 pl-5">
        <button id="greBut" class="btn" onclick="location.href= '/board'"><i class="fas fa-list"> 목록</i></button>

    </div>
</div>

<hr>
<div class="panel-default">

    <div class="panel-heading d-flex justify-content-between pt-2 pb-2">
        <div class="contents-title col-3">
            <div class="contents-writer">작성자 : <?= $data["writer"] ?></div>
            <div class="contents-data"><?= $data["publish"] ?></div>
        </div>
        <div class="action col-3 pt-md-1">
            <button id="blueBut" class="btn" onclick="location.href= '/board/modify/<?= $num ?>'"><i
                        class="far fa-edit">수정</i>
            </button>
            <button id="redBut" class="btn ml-md-1" onclick="checkDelete(<?= $data["num"] ?>)"><i
                        class="far fa-trash-alt">
                    삭제</i>
            </button>
        </div>
    </div>

    <div class="panel-body">
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