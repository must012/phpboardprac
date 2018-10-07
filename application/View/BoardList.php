<!-- Board의 모든 내용을 보여줄 View -->

<!doctype html>
<html lang="kr">
<head>
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

    <!--    fontawesome  -->

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
          integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--    google font -->

    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">

    <!--    css -->

    <link href="../../public/css/Board.css" rel="stylesheet">

    <title>PHP 과제 제출</title>
</head>

<body>
<header>
    <nav class="navbar navbar-dark fixed-top">
        <h2><a class="navbar-brand" href="/board">Sujae's PHP REPORT</a></h2>
    </nav>
</header>

<div class="container-fluid">
    <div class="row">
        <div class="aside col-sm-3 col-md-2 d-none d-sm-block pt-4 align-middle">
            <div class="p-1 col-md-12 bg-white">
                <?php if (!$loginCheck) { ?>
                    <form action="/board/login" method="post">
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="id">ID</label>
                            <input type="text" class="form-control" id="id" name="id" placeholder="아이디" required>
                        </div>
                        <div class="form-group col-md-12 col-sm-12">
                            <label for="pw">PASSWORD</label>
                            <input type="password" class="form-control" id="pw" name="pw" placeholder="비밀번호" required>
                            <hr>
                            <div class="clearfix">
                                <button type="submit" class="btn btn-sm col-md-5 float-left" id="blueBut">로그인</button>
                                <button class="btn btn-sm col-md-6 float-right" id="redBut"
                                        onclick="location.href='/signup'">
                                    회원가입
                                </button>
                            </div>
                        </div>
                    </form>
                <?php } else { ?>
                    <div id="uName"><?= $name ?>님 환영합니다!</div>
                    <hr>
                    <div class="clearfix">
                        <button id="redBut" class="btn btn-sm col-md-4 float-left"
                                onclick="location.href='/board/logout'">로그아웃
                        </button>
                        <button class="btn btn-sm col-md-6 float-right" id="blueBut"
                                onclick="location.href='/member'">
                            회원정보수정
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>

        <main role="main" class="col-sm-6 col-md-7 pl-md-5 pr-md-5 pt-md-3 pb-md-2" id="main">
            <h2 class="d-inline-block">Board</h2>
            <?php if ($loginCheck) { ?>
                <div class="btn float-right write-btn" onclick="location.href='/write'">
                    글쓰기
                </div>
            <?php } ?>


            <hr>
            <div class="container">
                <ul class="list-group">
                    <?php foreach ($list as $value) : ?>
                        <li class="list-group-item d-flex flex-row">
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