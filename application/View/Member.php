<!-- 회원 정보를 변경하는 View -->

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="./public/css/SignUp.css" rel="stylesheet">

    <title>회원 정보 변경</title>
</head>
<body>
<nav class="navbar navbar-dark fixed-top">
    <h2><a class="navbar-brand" href="/board">Sujae's PHP REPORT</a></h2>
</nav>
<div class="container-fluid">

    <form class="form-signup" action="/membermodify">

        <h2 class="form-signup-heading">회원 정보 변경</h2>
        <input type="text" id="id" class="form-control" name="id" value="<?= $data["id"] ?>" readonly>
        <input type="text" id="name" class="form-control" name="name" value="<?= $data["name"] ?>" required>
        <input type="password" id="pw" class="form-control" name="pw" value="<?= $data["pw"] ?>" required>

        <button class="btn btn-lg btn-block" type="submit">변경 완료</button>
    </form>

</div> <!-- /container -->

</body>
</html>
