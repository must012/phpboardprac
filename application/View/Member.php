<!-- 회원 정보를 변경하는 View -->
<link href="./public/css/SignUp.css" rel="stylesheet">

<div class="row">
    <div class="subject col-md-10"><h2>정보 수정</h2></div>

</div>


<div class="panel-default">
    <form class="form-signup" action="/membermodify">

        <h2 class="form-signup-heading">회원 정보 변경</h2>
        <input type="text" id="id" class="form-control" name="id" value="<?= $data["id"] ?>" readonly>
        <input type="text" id="name" class="form-control" name="name" value="<?= $data["name"] ?>" required>
        <input type="password" id="pw" class="form-control" name="pw" value="<?= $data["pw"] ?>" required>

        <button class="btn btn-lg btn-block" type="submit">변경 완료</button>
    </form>
</div>