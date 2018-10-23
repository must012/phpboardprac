<!-- 글을 작성하는 View -->

<!--   ck editor -->

<script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>

<!--   custom css -->
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
        <div class="subject col-md-8"><h2 class="d-inline-block">Write</h2></div>

        <div class="col-4 pl-5">

            <button class="btn float-right write-btn blueBtn" onclick="location.href='/board'">
                <i class="fas fa-list"> 목록</i>
            </button>

        </div>
    </div>

    <hr style="background-color: whitesmoke">

    <div class="panel-default">
        <form action="/write/update" enctype="multipart/form-data">
            <input type="hidden" name="writer" value="<?= $_SESSION["id"] ?>" readonly>
            <input type="hidden" name="nick" value="<?= $_SESSION["name"] ?>" readonly>

            <div class="panel-heading d-flex justify-content-between pt-2 pb-2">
                <div class="contents-title col-3 pt-2">
                    <div class="contents-writer">작성자 : <?= $_SESSION["name"] ?> </div>
                </div>
                <div class="action col-2 pt-md-1">
                    <button class="btn ml-3 greBtn" type="submit"><i
                                class="far fa-edit"> 글쓰기</i>
                    </button>
                </div>
            </div>

            <div class="panel-body">
                <div class="col-12 pt-2 form-group">


                    <input type="text" id="title" class="form-control" name="title" aria-label="제목" placeholder="제목"
                           required autofocus>

                    <hr style="background-color: whitesmoke">
                    <div class="form-group">
                        <textarea class="form-control" id="contents" name="contents" required></textarea>
                    </div>
                </div>
            </div>

            <div class="panel-footer">
                <div class="col-11 input-group mb-3 m-auto pl-0">
                    <div class="btn-upload">
                        <button class="btn btn-outline-secondary">upload</button>
                    </div>
                    <div class="file border col-11">
                        <input type="file" class="custom-file-input" id="uploadFile">
                        <label class="custom-file-label" for="uploadFile">파일 검색</label>
                    </div>

                </div>
            </div>
    </div>
    </form>


    <script type="text/javascript">

        CKEDITOR.replace('contents');

        CKEDITOR.instances.contents.updateElement();

    </script>
<?php endif; ?>