<!-- 컨텐츠의 내용을 수정하는 View -->
<script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>

<link href="../../public/css/Board.css" rel="stylesheet">
<style>
    body {
        background-color: #eeeeee;
    }

</style>

<?php if (!isset($_SESSION["id"])) :
    goToPage("로그인 한 사용자만 글쓰기 가능", "/board");
else :?>

    <div class="row">

        <div class="subject col-md-8"><h2 class="d-inline-block">Modify</h2></div>
        <div class="col-4 pl-5">
            <button class="btn float-right write-btn blueBtn" onclick="location.href='/board'">
                <i class="fas fa-list"> 목록</i>
            </button>
        </div>
    </div>

    <hr style="background-color: whitesmoke">

    <div class="panel-default">
        <form action="/board/update" method="post">
            <input type="hidden" name="num" value="<?= $num ?>" readonly>

            <div class="panel-heading d-flex justify-content-between pt-2 pb-2">
                <div class="contents-title col-3 pt-2">
                    <div class="contents-writer">작성자 : <?= $_SESSION["name"] ?> </div>
                </div>
                <div class="action col-2 pt-md-1">
                    <button class="btn float-right greBtn" type="submit"><i class="far fa-edit"> 수정완료</i></button>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-12 pt-2 form-group">

                    <input type="text" id="title" class="form-control" name="title" aria-label="제목" placeholder="제목"
                           value="<?= $data["title"] ?>"
                           required>

                    <hr style="background-color: whitesmoke">
                    <div class="form-group">
                            <textarea class="form-control" id="contents" name="contents" required><?= $data["contents"] ?></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <script type="text/javascript">

        CKEDITOR.replace('contents');

        CKEDITOR.instances.contents.updateElement();

    </script>

<?php endif; ?>