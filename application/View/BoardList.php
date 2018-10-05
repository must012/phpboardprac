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
    <script type="text/javascript" src="ReportMVC/public/js/ckeditor/ckeditor.js"></script>


    <!-- 템플릿을 개인적으로 바꾸기 위한 css -->

    <link href="./public/css/Board.css" rel="stylesheet">

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
        <main role="main" class="col-sm-9 ml-sm-auto col-md-10 pl-md-5 pr-md-5 pt-md-3 pb-md-2" id="main">

            <h2 style="display: inline-block">Board</h2>
            <?php if ($loginCheck) { ?>
                <button class="btn btn-lg ml-md-8" id="blueBut" onclick="location.href='/write'"
                        style="float: right">글쓰기
                </button>
            <?php } ?>
            <hr>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" style="width: 5%">번호</th>
                        <th scope="col" style="width: 25%">제목</th>
                        <th scope="col" style="width: 35%">내용</th>
                        <th scope="col" style="width: 8%">작성자</th>
                        <th scope="col" style="width: 20%">작성 일자</th>
                        <th scope="col" style="width: 7%">조회수</th>
                    </tr>
                    </thead>

                    <tbody><?php foreach ($list as $value) : ?>
                        <tr>
                            <td scope="row"><?= ($page - 1) * COUNT_LIST + $value["NUM"] ?></td>
                            <td><p class="detail" id="<?= $value["num"] ?>"><?= $value["title"] ?></p></td>
                            <td scope="row"><?= substr($value["contents"], 0, 10); ?></td>
                            <td><?= $value["writer"] ?></td>
                            <td><?= $value["publish"] ?></td>
                            <td><?= $value["view"] ?></td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
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
                    <li class="page-item"><a class="page-link" href="/board?page=<?= ($startPage > 0) ? $startPage : 1 ?>">&laquo;</a>
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

        <div class="aside col-sm-3 ml-sm-9 col-md-2 d-none d-sm-block pt-4 align-middle">
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
                            <button type="submit" class="btn btn-sm col-md-5 mr-md-1" id="blueBut">로그인</button>
                            <button class="btn btn-sm col-md-6 ml-md-1" id="redBut"
                                    onclick="location.href='/signup'">
                                회원가입
                            </button>
                        </div>
                    </form>
                <?php } else { ?>
                    <div id="uName"><?= $name ?>님 환영합니다!</div>
                    <hr>
                    <div>
                        <button id="redBut" class="btn btn-sm col-md-4 ml-md-3 mr-md-1 mb"
                                onclick="location.href='/board/logout'">로그아웃
                        </button>
                        <button class="btn btn-sm col-md-6 ml-md-1" id="blueBut"
                                onclick="location.href='/member'">
                            회원정보수정
                        </button>
                    </div>
                <?php } ?>
            </div>
        </div>

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