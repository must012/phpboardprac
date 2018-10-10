<!-- 글을 작성하는 View -->

<!doctype html>
<html lang="kr">
<head>
    <!--  google font -->

    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--   ck editor -->

    <script type="text/javascript" src="../../public/js/ckeditor/ckeditor.js"></script>

    <!--   google font -->

    <link href="https://fonts.googleapis.com/css?family=Do+Hyeon" rel="stylesheet">

    <!--   css -->
    <link href="../../public/css/Board.css" rel="stylesheet">

    <style>
        body {
            background-color: #eeeeee;
        }

        .row {
            margin-top: 2rem;
        }
    </style>

    <title>글 작성하기</title>
</head>
<body>

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

    <div class="col-md-2 mr-md-4 col-sm-3"></div>



    <div class="container-fluid col-md-9 col-sm-8 bg-white">
        <div><h2>Write</h2>
            <hr style="background-color: whitesmoke"></div>

        <form action="/write/update">
            <input type="text" name="writer" value="<?= $_SESSION["id"] ?>" hidden readonly>
            <div class="form-group">
                <label for="title">제목</label>
                <input type="text" id="title" class="form-control" name="title" required autofocus>
            </div>
            <div class="form-group">
                <label for="contents">내용</label>
                <textarea class="form-control" id="contents" name="contents" required></textarea>
            </div>

            <button class="btn btn-lg" id="blueBut" type="submit">글쓰기</button>
            <button class="btn btn-lg" id="redBut" onclick="location.href='/board'">목록보기</button>
        </form>

    </div>
</div>

<script>

    CKEDITOR.replace('contents',
        {
            height: '45vh',  // 입력창의 높이
            startupFocus: false
        }
    );
</script>
</body>
</html>