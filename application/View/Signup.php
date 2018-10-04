<!-- 회원가입을 하는 View -->

<!doctype html>
<html lang="kr">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <link href="./public/css/SignUp.css" rel="stylesheet">

    <title>회원가입</title>
</head>
<body>
<header>
    <nav class="navbar navbar-dark fixed-top">
        <h2><a class="navbar-brand" href="/board">Sujae's PHP REPORT</a></h2>
    </nav>
</header>

<div class="container-fluid">
    <form class="form-signup" action="/signup/update" method="post">
        <h2 class="form-signup-heading">환영합니다!</h2>
        <input type="text" id="name" class="form-control" name="name" placeholder="이름" required autofocus>
        <input type="text" id="id" class="form-control" name="id" placeholder="ID" required>
        <input type="password" id="pw" class="form-control" name="pw" placeholder="PASSWORD" required>

        <button class="btn btn-lg btn-block" type="submit">회원가입</button>
    </form>

</div> <!-- /container -->

</body>
</html>
