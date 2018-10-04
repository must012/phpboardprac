<!-- 컨텐츠의 내용을 수정하는 View -->

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="../../public/css/Board.css" rel="stylesheet">
    <style>
        body {
            background-color: #eeeeee;
        }

        .row {
            margin-top: 3.5rem;
        }
    </style>

    <title>글 수정</title>
</head>
<body>

<header>
    <nav class="navbar navbar-dark fixed-top">
        <h2><a class="navbar-brand" href="/board">Sujae's PHP REPORT</a></h2>
    </nav>
</header>
<div class="row">
    <div class="container col-md-10">

        <h2>Modify</h2>
        <form action="/board/update" method="post">
            <div class="form-group">
                <label for="title">제목</label>
                <input type="hidden" name="num" value="<?= $num ?>" readonly>
                <input type="text" id="title" class="form-control" name="title" value="<?= $data["title"] ?>"
                       required>
            </div>
            <div class="form-group">
                <label for="contents">내용</label>
                <textarea class="form-control" id="contnets" name="contents" rows="10" required autofocus><?=
                    $data["contents"] ?></textarea>
            </div>

            <button id="blueBut" class="btn btn-lg" type="submit">수정완료</button>
        </form>

    </div>
</div>
</body>
</html>