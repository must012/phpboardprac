<!-- 컨텐츠의 상세내용을 보여주는 View -->

<h2>Detail</h2>
<hr>
<div class="container p-2">
    <table class="table table-striped table-bordered">
        <tr>
            <td>제목</td>
            <td><?= $data["title"] ?></td>
        </tr>
        <tr>
            <td>작성자</td>
            <td><?= $data["writer"] ?></td>
        </tr>
        <tr>
            <td>작성일시</td>
            <td><?= $data["publish"] ?></td>
        </tr>
        <tr>
            <td>조회수</td>
            <td><?= $data["view"] ?></td>
        </tr>
        <tr>
            <td>내용</td>
            <td><?= $data["contents"] ?></td>
        </tr>
    </table>

    <button id="greBut" class="btn" onclick="location.href= '/board'">목록보기</button>
    <button id="blueBut" class="btn" onclick="location.href= '/board/modify/<?= $num ?>'">글 수정
    </button>

    <button id="redBut" class="btn" onclick="checkDelete(<?= $data["num"] ?>)">글 삭제</button>
</div>

<script>
    function checkDelete(num) {

        var con = confirm("정말 삭제 하시겠습니까?");
        if (con) {
            location.href = "/board/delete/" + num;
        } else
            return;
    }
</script>