<?php


include "$_SERVER[DOCUMENT_ROOT]/bookproject/app/controllers/topics.php";
$post = select_one('posts', ['id' => $_GET['post_id']]);
$user = select_one('users', ['id' => $post['id_user']]);
$topics = select_all('topics');
update('posts', $_GET['post_id'], ['views' => $post['views'] + 1]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>My blog</title>
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Comfortaa:wght@300;400;500;600;700&display=swap" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <div class="scrooll_comments"><i class="fa-solid fa-comment fa-2xl"></i></div>
  <?php
  include "./app/includes/header.php";
  ?>

  <!-- main -->
  <div class="container">
    <div class="content row">
      <!-- main content-->
      <div class="main-content col-md-9">
        <h2 class="last_publications"><?= $post['title'] ?></h2>
        <div class="single_post row">
          <div class="single_img col-12">
            <img class="img-thumbnail" src="images/posts/<?= $post['img'] ?>" alt="" />
          </div>
          <div class="info">

            <i class="far fa-user"><?= $user['user_name'] ?></i>
            <i class="fa-regular fa-eye" style="margin-left: 300px;"><?= $post['views'] ?></i>
            <?php
            $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $post['created_date']);
            $newDateString = $myDateTime->format("d F,YRH:i");
            $date_time = str_replace("R", " <i class='fa-regular fa-clock' style='margin:0'></i>", $newDateString);
            ?>
            <i class="far fa-calendar"><?= $date_time ?></i>
          </div>
          <div class="single_post_text col-12 shadow p-3 mb-5 bg-body-tertiary rounded">
            <?= $post['content'] ?>
          </div>

          <?php
          include "./app/includes/comments.php";
          ?>
        </div>
      </div>
      <!-- sidebar content -->
      <div class="sidebar col-md-3 col-12">
        <div class="section search">
          <h3>Search</h3>
          <form action="search.php" method="post">
            <input class="text_input" type="text" name="search_str" placeholder="Search...">
          </form>
        </div>

        <div class="section topics">
          <h3>Категории</h3>
          <ul>
            <?php foreach ($topics as $key => $value) : ?>
              <li><a href="<?= BASE_URL . 'category.php?topic_id=' . $value['id'] ?>"><?= $value['name'] ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
      </div>
      <!-- sidebar content  end-->
      <div class="sidebar col-md-3"></div>
    </div>
  </div>
  <!-- main end-->
            <script src="js/scroll.js"></script>
  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/358646f9ff.js" crossorigin="anonymous"></script>
  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>