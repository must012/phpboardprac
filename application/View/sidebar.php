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
            <div class="pb-2 text-center">
                <h2><a class="brand" href="/board">PHP REPORT</a></h2></div>

            <div class="p-1 col-md-11 ml-auto mr-auto mt-3 mb-3">
                <?php if (!$loginCheck) : ?>
                    <form action="/board/login" method="post">
                        <div class="form-group col-11 ml-auto mr-auto">

                            <input type="text" class="form-control col-12" id="id" name="id" placeholder="아이디"
                                   required>
                            <input type="password" class="form-control col-12" id="pw" name="pw" placeholder="비밀번호" required>

                        </div>

                        <div class="d-flex col-12 p-0">
                            <button type="submit" class="btn btn-sm col-6 blueBtn" id="loginBtn">로그인
                            </button>
                            <button class="btn btn-sm col-6 whiteBtn" data-toggle="modal" data-target="#regModal">회원가입
                            </button>
                        </div>

                    </form>
                <?php else : ?>
                    <div class="mt-md-3 mb-md-4 row" id="uName" style="color: #FFFFFF">
                        <div class="col-md-6 col-sm-6 align-middle ml-4 pt-md-2 p-sm-0"><p id="nickName"><?= $name ?>
                                님</p></div>
                        <div class="col-4 d-flex flex-column">
                            <div class="pb-1"><i class="fas fa-sign-out-alt"
                                                 onclick="location.href='/board/logout'"></i></div>
                            <div><i class="fas fa-user-cog" data-toggle="modal" data-target="#memberChangeModal"></i>
                            </div>
                        </div>

                    </div>
                    <hr style="background-color: #808080">
                <?php endif; ?>
            </div>

            <ul class="nav pl-auto pr-0 ml-auto mr-0 flex-column">

                <li class="nav-item">
                    <a href="/board" class="nav-link side-nav side-nav-1">Board</a>
                </li>

                <li class="nav-item">
                    <a href="/board" class="nav-link side-nav side-nav-2">Board2</a>
                </li>

                <ul class="list-group text-center pt-md-2 pb-md-2" id="tools" style="color: white;font-weight: bold">
                    TOOLS

                    <li class="list-group-item tool-item" style="display: none">
                        <a href="https://www.yjp.ac.kr/portal/main/index_noie.jsp" class="nav-link side-nav"
                           target="_blank">
                            YJP<i class="fas fa-external-link-alt float-right"></i></a>
                    </li>

                    <li class="list-group-item tool-item" style="display: none;">
                        <a href="https://yel.yjc.ac.kr/" class="nav-link side-nav" target="_blank">YEL<i
                                    class="fas fa-external-link-alt float-right"></i></a>
                    </li>

                    <li class="list-group-item tool-item" style="display: none;">
                        <a href="https://fontawesome.com/" class="nav-link side-nav" target="_blank">FontAwesome<i
                                    class="fas fa-external-link-alt float-right"></i></a>
                    </li>

                    <li class="list-group-item tool-item" style="display: none;">
                        <a href="http://bootstrap4.kr/" class="nav-link side-nav" target="_blank">BootStrap<i
                                    class="fas fa-external-link-alt float-right"></i></a>
                    </li>

                    <li class="list-group-item tool-item" style="display: none;">
                        <a href="https://jsfiddle.net/coligo/49gptnad/" class="nav-link side-nav" target="_blank">JSFiddle<i
                                    class="fas fa-external-link-alt float-right"></i></a>
                    </li>

                    <li class="list-group-item tool-item" style="display: none;">
                        <a href="https://www.evernote.com/client/web" class="nav-link side-nav" target="_blank">Evernote<i
                                    class="fas fa-external-link-alt float-right"></i></a>
                    </li>

                    <li class="list-group-item tool-item" style="display: none;">
                        <a href="https://github.com/must012" class="nav-link side-nav" target="_blank"><i
                                    class="fab fa-github fa-2x"></i></a>
                    </li>
                </ul>
            </ul>
        </nav>

        <div class="col-md-2 col-sm-3 mr-4"></div>

        <script>
            var $target = $("#tools");
            $target.click(function (e) {
                var $item = $(".tool-item");
                $item.slideToggle(200);
            })
        </script>

        <?php if (!$loginCheck) : ?>

            <div class="modal fade" id="regModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div></div>
                            <div class="modal-title">회원 가입</div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="modal-out" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-signup" action="/signup/update" method="post">
                            <div class="modal-body">
                                <input type="text" id="name" class="form-control mb-4" name="name" placeholder="이름"
                                       required
                                       autofocus>
                                <input type="text" id="id" class="form-control mb-4" name="id" placeholder="ID"
                                       required>
                                <input type="password" id="pw" class="form-control mb-4" name="pw"
                                       placeholder="PASSWORD"
                                       required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn blueBtn" type="submit">회원가입</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        <?php else: ?>

            <div class="modal fade" id="memberChangeModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <div></div>
                            <div class="modal-title">회원 정보 변경</div>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span class="modal-out" aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-signup" action="/membermodify" method="post">
                            <div class="modal-body">
                                <input type="text" id="id" class="form-control" name="id"
                                       value="<?= $data["id"] ?>"
                                       readonly>
                                <input type="text" id="name" class="form-control" name="name"
                                       value="<?= $data["name"] ?>" required>
                                <input type="password" id="pw" class="form-control" name="pw" value="<?= $data["pw"] ?>"
                                       required>
                            </div>
                            <div class="modal-footer">
                                <button class="btn blueBtn" type="submit">변경완료</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <main role="main" class="col-sm-7 col-md-7 pr-md-5 pt-md-4 pb-md-2" id="main">
