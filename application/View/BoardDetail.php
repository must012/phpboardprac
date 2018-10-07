<!-- 컨텐츠의 상세내용을 보여주는 View -->
<script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>
<!--    google font -->

<link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">

<h2 class="d-inline-block">Detail</h2>
<div class="float-right">
    <button id="greBut" class="btn" onclick="location.href= '/board'"><i class="fas fa-list"> 목록</i></button>
    <button id="blueBut" class="btn" onclick="location.href= '/board/modify/<?= $num ?>'"><i class="far fa-edit"> 수정</i>
    </button>
    <button id="redBut" class="btn" onclick="checkDelete(<?= $data["num"] ?>)"><i class="far fa-trash-alt"> 삭제</i>
    </button>
</div>
<hr>
<div class="container p-2">
    <div class="data p-2">
        <div><?= $data["contents"] ?></div>
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