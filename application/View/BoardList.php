<!-- Board의 모든 내용을 보여줄 View -->

<!doctype html>
<html lang="kr">
<head>
    <!--  google font -->

    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

    <!--  head   -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css"
          integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
            integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
            crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"
            integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1"
            crossorigin="anonymous"></script>

    <!--  fontawesome  -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--  css -->

    <link href="../../public/css/Board.css" rel="stylesheet">


    <title>PHP 과제 제출</title>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <nav class="sidebar col-sm-3 col-md-2 d-none d-sm-block pt-4 align-middle">
            <div class="pl-3 pb-2">
                <h2><a class="brand" href="/board">
                        Sujae's</br>PHP REPORT</a></h2></div>

            <div class="p-1 col-md-11 ml-auto mr-auto mt-3 mb-3">
                <?php if (!$loginCheck) { ?>
                    <form action="/board/login" method="post">
                        <div class="form-group col-11 ml-auto mr-auto">

                            <input type="text" class="form-control col-12" id="id" name="id" placeholder="아이디"
                                   required>
                            <input type="password" class="form-control col-12" id="pw" name="pw" placeholder="비밀번호"
                                   required>

                        </div>

                        <div class="d-flex col-12 p-0">
                            <button type="submit" class="btn btn-sm col-6" id="blueBut">로그인
                            </button>
                            <button class="btn btn-sm col-6" id="redBut"
                                    onclick="location.href='/signup'">회원가입
                            </button>
                        </div>

                    </form>
                <?php } else { ?>
                    <div class="mb-md-2 row" id="uName" style="color: #FFFFFF">
                        <div class="col-6 align-middle ml-4 pt-2"><p id="nickName"><?= $name ?> 님</p></div>
                        <div class="col-4 d-flex flex-column">
                            <div class="pb-1"><i class="fas fa-sign-out-alt"
                                                 onclick="location.href='/board/logout'"></i></div>
                            <div><i class="fas fa-user-cog" onclick="location.href='/member'"></i></div>
                        </div>

                    </div>
                    <hr style="background-color: #808080">
                <?php } ?>
            </div>
        </nav>

        <div class="col-md-2 col-sm-3 mr-4"></div>
        <main role="main" class="col-sm-7 col-md-7 pr-md-5 pt-md-3 pb-md-2" id="main">
            <div class="row">
                <div class="subject col-md-10"><h2 class="d-inline-block">Board</h2></div>

                <?php if ($loginCheck) { ?>
                    <div class="col-2 pl-5">
                        <button class="btn float-right write-btn" id="blueBut" onclick="location.href='/write'">
                            <i class="far fa-edit"> 글쓰기</i>
                        </button>
                    </div>
                <?php } ?></div>


            <hr>
            <div class="container">
                <ul class="list-group">
                    <?php foreach ($list as $value) : ?>
                        <li class="list-group-item d-flex flex-row contents-list">
                            <!--                        제목 부분 div -->
                            <div class="list-title-wrapper col-md-6">
                                <div class="list-tag">
                                    <span class="list-group-item-text article-id"><?= ($page - 1) * COUNT_LIST + $value["NUM"] ?></span>
                                    <a href="#" class="list-group-item-text item-tag label label-info"><i
                                                class="fa fa-database"></i> 태그 부분 </a>
                                </div>
                                <p class="list-title detail" id="<?= $value["num"] ?>"><?= $value["title"] ?></p>
                            </div>

                            <!--                        댓글 부분 div  -->
                            <div class="list-comment-wrapper col-md-2">

                                <div class="item-comment-icon col-md-5 float-left"><i class="far fa-comment-alt"></i>
                                </div>
                                <div class="item-comment-count col-md-5 mr-md-2 float-right"><p>1</p></div>

                            </div>

                            <!--                        작성자 및 날짜 div-->
                            <div class="list-data-wrapper col-md-4">
                                <div class='content-data'>
                                    <div class="writer-info"><p class="writer"><?= $value["writer"] ?></p>
                                        <div class="published"><?= $value["publish"] ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>


            <nav aria-label="pagination">
                <ul class="pagination justify-content-center mb-0">

                    <!--   첫 페이지 이동   -->

                    <?php if ($page != 1) : ?>
                        <li class="page-item">
                            <a class="page-link" href="/board?page=1">처음</a>
                        </li>
                    <?php endif; ?>

                    <!--   전 페이지 이동   -->

                    <?php if ($startPage == 0) : ?>
                <li class="page-item disabled"><span class="page-link">&laquo;</span>
                <?php else : ?>
                    <li class="page-item"><a class="page-link"
                                             href="/board?page=<?= ($startPage > 0) ? $startPage : 1 ?>">&laquo;</a>
                        <?php endif; ?></li>

                    <!-- 숫자 생성 -->

                    <?php for ($i = $startPage; $i < $endPage; $i++) : ?>
                        <?php if ($page == ($i + 1)) :
                            echo '<li class="page-item active">';
                        else :
                            echo '<li class="page-item">';
                        endif; ?><a class="page-link" href="/board?page=<?= $i + 1 ?>"><?= $i + 1 ?></a>
                        </li>
                    <?php endfor; ?>

                    <!--   다음 페이지 이동   -->

                    <?php if ($endPage < $totalPage) : ?>
                        <li class="page-item"><a class="page-link" href="/board?page=<?= $endPage + 1 ?>">&raquo;</a>
                        </li>
                    <?php else : ?>
                        <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
                    <?php endif; ?>

                    <!--   끝 페이지 이동   -->

                    <?php if ($page != $totalPage) : ?>
                        <li class="page-item">
                            <a class="page-link"
                               href="/board?page=<?= floor(($totalPage / COUNT_PAGE)) * 10 + ($totalPage % COUNT_PAGE) ?>">끝</a>
                        </li>
                    <?php endif; ?>

                </ul>
            </nav>
        </main>


    </div>
</div>

<script>

    $(".detail").click(function () {
        var number = $(this).attr("id");
        $.ajax({
            type: "get",
            url: "/board/detail",
            data: {num: number},
            success: function (data) {
                $("#main").html(data)
            },
            error: function (request, status, error) {
                alert("실패");
                alert("에러명 : " + error);
                alert("상태 : " + status);
            }
        })
    });

</script>

</body>
</html>