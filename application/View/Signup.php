<!-- 회원가입을 하는 View -->

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

    <!--  css -->

    <link href="./public/css/SignUp.css" rel="stylesheet">

    <title>WELCOME!</title>
</head>

<body>

<div class="container-fluid">
    <div class="row">

        <div class="container-fluid">

            <form class="form-signup" action="/signup/update" method="post">
                <div class="pb-3 text-center"><h2><a class="brand" href="/board">PHP REPORT</a></h2></div>
                <input type="text" id="name" class="form-control mb-4" name="name" placeholder="이름" required autofocus>
                <input type="text" id="id" class="form-control mb-4" name="id" placeholder="ID" required>
                <input type="password" id="pw" class="form-control mb-4" name="pw" placeholder="PASSWORD" required>

                <button class="btn btn-lg btn-block" type="submit">회원가입</button>
            </form>

        </div> <!-- /container -->


    </div>
</div>

</body>
</html>