<!-- 글을 작성하는 View -->

<!-- ck editor -->

<script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>

<!-- dropzone.js -->

<script src="../../public/js/dropzone/dropzone.js"></script>
<link rel="stylesheet" href="../../public/css/dropzone.css">

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
        <form class="mb-md-5 mb-sm-4" action="/write/update" enctype="multipart/form-data" method="post">
            <input type="hidden" name="writer" value="<?= $_SESSION["id"] ?>" readonly>
            <input type="hidden" name="nick" value="<?= $_SESSION["name"] ?>" readonly>

            <div class="panel-heading d-flex justify-content-between pt-2 pb-2">
                <div class="contents-title col-3 pt-2">
                    <div class="contents-writer">작성자 : <?= $_SESSION["name"] ?> </div>
                </div>
                <div class="action col-2 pt-md-1">
                    <button class="btn ml-3 greBtn" id="submit-all" type="submit"><i
                                class="far fa-edit"> 저장</i>
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

            <div class="panel-footer col-11 m-auto dropzone">
<!--                <div id="upfile-box" class="col-12 input-group p-0">-->
<!--                    <div class="input-group-append file-text pt-2 pl-1 pr-1">-->
<!--                        <span class="input-group-text">업로드</span>-->
<!--                    </div>-->
<!--                    <div class="col-11 p-0">-->
<!--                                                <input type="file" class="btn col-12 custom-file-input border border-primary" id="upFile"-->
<!--                                                       name="upFiles[]" multiple>-->
<!--                    </div>-->
<!--                </div>-->
<!--                <!---->-->
<!--                                <div id="upfile-drag-box" class="col-12 mt-3 text-center">-->
<!--                                    <input class="dropzone" type="file">-->
<!--                                </div>-->
            </div>
        </form>
    </div>


    <script type="text/javascript">


        CKEDITOR.replace('contents', {
            filebrowserImageUploadUrl: "/application/View/upload.php?type=image",
            extraPlugins: 'uploadimage'
        });

        CKEDITOR.instances.contents.updateElement();

        Dropzone.autoDiscover = false;

        Dropzone.options.myDropzone = {

            url: '/write/update',
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 25,
            maxFiles: 25,
            action: "post",
            acceptedFiles: 'image/*,audio/*,application/pdf,application/octet-stream,application/zip,application/msword,application/vnd.ms-excel,application/vnd.ms-powerpoint,application/force-download,video/*',
            addRemoveLinks: true,
            previewsContainer: '.dropzone-preview',
            init: function () {
                dzClosure = this; // Makes sure that 'this' is understood inside the functions below.

                // for Dropzone to process the queue (instead of default form behavior):
                document.getElementById("submit-all").addEventListener("click", function (e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    dzClosure.processQueue();
                });

                //send all the form data along with the files:
                this.on("sendingmultiple", function (data, xhr, formData) {
                    formData.append("firstname", jQuery("#firstname").val());
                    formData.append("lastname", jQuery("#lastname").val());
                });
            }
        }

    </script>
<?php endif; ?>