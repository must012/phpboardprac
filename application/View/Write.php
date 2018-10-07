<!-- 글을 작성하는 View -->

<!doctype html>
<html lang="kr">
<head>
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
<header>
    <nav class="navbar navbar-dark fixed-top">
        <h2><a class="navbar-brand" href="/board">Sujae's PHP REPORT</a></h2>
    </nav>
</header>

<div class="row">
    <div class="container col-md-10">

        <h2>Write</h2>
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
            height : '50vh',  // 입력창의 높이
            startupFocus : false
        }
    );
</script>
</body>
</html>