<!-- Board의 모든 내용을 보여줄 View -->

<div class="row">
    <div class="subject col-md-10"><h2 class="d-inline-block">Board</h2></div>

    <?php if ($loginCheck) { ?>
        <div class="col-2 pl-5">
            <button class="btn float-right write-btn blueBtn" onclick="location.href='/write'">
                <i class="far fa-edit"> 글쓰기</i>
            </button>
        </div>
    <?php } ?>
</div>

<hr>
<div class="container">
    <ul class="list-group">
        <?php foreach ($list as $value) : ?>
            <li class="list-group-item d-flex flex-row contents-list">

                <!--                        제목 부분 div -->
                <div class="list-title-wrapper col-md-6">
                    <div class="list-tag">
                        <span class="list-group-item-text article-id"><?= ($page - 1) * COUNT_LIST + $value["NUM"] ?></span>
                        <a href="#" class="list-group-item-text item-tag label label-info"><i
                                    class="fa fa-database"></i> 태그 부분 </a>
                    </div>
                    <p class="list-title detail"
                       onclick="location.href = '/board/detail?num=<?= $value["num"] ?>'"><?= $value["title"] ?></p>
                </div>

                <!--                        댓글 부분 div  -->
                <div class="list-comment-wrapper col-md-2">

                    <div class="item-comment-icon col-md-5 float-left"><i class="far fa-comment-alt"></i>
                    </div>
                    <div class="item-comment-count col-md-5 mr-md-2 float-right"><p>1</p></div>

                </div>

                <!--                        작성자 및 날짜 div-->
                <div class="list-data-wrapper col-md-4">
                    <div class='content-data'>
                        <div class="writer-info"><p class="writer"><?= $value["writer"] ?></p>
                            <div class="published"><?= $value["publish"] ?>
                            </div>
                        </div>
                    </div>
                </div>

            </li>
        <?php endforeach; ?>
    </ul>
</div>


<nav aria-label="pagination" class="pt-1">
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
        <li class="page-item"><a class="page-link"
                                 href="/board?page=<?= ($startPage > 0) ? $startPage : 1 ?>">&laquo;</a>
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