<?php
include $_SERVER['DOCUMENT_ROOT'] . "/bookproject/app/controllers/comments.php";
?>
<div class="comments col-md-12 col-12 ">
    <h3>Оставить комментарий</h3>

    <form action="<?= BASE_URL?>/single.php?post_id=<?=$post_id?>" method="POST">
        <input hidden value="<?=$post_id;?>" name="post_id"/>
        <!-- <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
        </div> -->
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Ваш комментарий</label>
            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="comment"></textarea>
        </div>
        <div class="col-12" style="margin-bottom: 20px;">
            <button type="submit" name="leave_comment" class="btn btn-primary" style="float: right;">
                Оставить
            </button>
        </div>
    </form>
    <div class="error row justify-content-center">
        <p class="col-12  text-danger p-3"><?= $error_text ?></p>
    </div>
    <h3>Комментрии</h3>
    <?php foreach($comments as $comment):?>
        <div class="card mb-4">
          <div class="card-body">
            <p><?=$comment['comment']?></p>

            <div class="d-flex justify-content-between">
              <div class="d-flex flex-row align-items-center">
                <p class="small mb-0 ms-2"><?=$comment['user_name']?></p>
              </div>
              <div class="d-flex flex-row align-items-center">
                <p class="small text-muted mb-0"><?=$comment['publicated']?></p>
              </div>
            </div>
          </div>
        </div>
    <?php endforeach;?>
</div>