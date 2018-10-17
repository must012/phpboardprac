<!doctype html>
<html lang="kr">
<head>
    <!--  google font -->

    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

    <!--  head   -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!--  bootstrap  -->
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

    <title>WELCOME!</title>
</head>

<body>

<div class="container-fluid">
    <div class="row">
        <nav class="sidebar col-sm-3 col-md-2 d-none d-sm-block pt-4 align-middle">
            <div class="pb-2" style="text-align: center">
                <h2><a class="brand" href="/board">PHP REPORT</a></h2></div>

            <div class="p-1 col-md-11 ml-auto mr-auto mt-3 mb-3">
                <?php if (!$loginCheck) :?>
                    <form action="/board/login" method="post">
                        <div class="form-group col-11 ml-auto mr-auto">

                            <input type="text" class="form-control col-12" id="id" name="id" placeholder="아이디"
                                   required>
                            <input type="password" class="form-control col-12" id="pw" name="pw" placeholder="비밀번호"
                                   required>

                        </div>

                        <div class="d-flex col-12 p-0">
                            <button type="submit" class="btn btn-sm col-6 blueBtn">로그인
                            </button>
                            <button class="btn btn-sm col-6 whiteBtn"
                                    onclick="location.href='/signup'">회원가입
                            </button>
                        </div>

                    </form>
                <?php else : ?>
                    <div class="mb-md-2 row" id="uName" style="color: #FFFFFF">
                        <div class="col-6 align-middle ml-4 pt-2"><p id="nickName"><?= $name ?> 님</p></div>
                        <div class="col-4 d-flex flex-column">
                            <div class="pb-1"><i class="fas fa-sign-out-alt"
                                                 onclick="location.href='/board/logout'"></i></div>
                            <div><i class="fas fa-user-cog" onclick="location.href='/member'"></i></div>
                        </div>

                    </div>
                    <hr style="background-color: #808080">
                <?php endif; ?>
            </div>

            <ul class="nav pl-auto pr-0 ml-auto mr-0 flex-column">

                <li class="nav-item">
                    <a href="/board" class="nav-link yjp">Board</a>
                </li>

                <li class="nav-item">
                    <a href="https://www.yjp.ac.kr/portal/main/index_noie.jsp" class="nav-link yjp" target="_blank">
                        YJP<i class="fas fa-external-link-alt float-right"></i></a>
                </li>

                <li class="nav-item">
                    <a href="https://yel.yjc.ac.kr/" class="nav-link yjp" target="_blank">YEL<i class="fas fa-external-link-alt float-right"></i></a>
                </li>

                <li class="nav-item">
                    <a href="https://fontawesome.com/" class="nav-link yjp" target="_blank">FontAwesome<i class="fas fa-external-link-alt float-right"></i></a>
                </li>

                <li class="nav-item">
                    <a href="http://bootstrap4.kr/" class="nav-link yjp" target="_blank">BootStrap<i class="fas fa-external-link-alt float-right"></i></a>
                </li>

                <li class="nav-item">
                    <a href="https://www.evernote.com/client/web" class="nav-link yjp" target="_blank">Evernote<i class="fas fa-external-link-alt float-right"></i></a>
                </li>

                <li class="nav-item">
                    <a href="https://github.com/must012" class="nav-link yjp" target="_blank"><i class="fab fa-github fa-2x"></i></a>
                </li>

            </ul>
        </nav>

        <div class="col-md-2 col-sm-3 mr-4"></div>

        <main role="main" class="col-sm-7 col-md-7 pr-md-5 pt-md-4 pb-md-2" id="main">