<?php
include "$_SERVER[DOCUMENT_ROOT]/bookproject/app/controllers/topics.php";


$page= isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;
$offset = $limit * ($page - 1);
$total_pages = ceil(count_row('posts') / $limit);
$posts = select_publisheds_from_posts_with_author($limit, $offset);
$top_posts = select_top('posts', 'views', 3);
// tt($posts);
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

  <!-- header -->
  <?php
  include "./app/includes/header.php";
  ?>
  <!-- header end-->
  <!-- карусель start -->
  <div class="container">
    <div class="row">
      <h2 class="slider_title">Топ посты</h2>
    </div>
    <div id="carouselExampleCaptions" class="carousel slide">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <?php foreach ($top_posts as $key => $value) : ?>
          <div class="carousel-item <?= !$key ? "active" : '' ?>">
            <img src="<?= BASE_URL ?>images/posts/<?= $value['img'] ?>" class="d-block w-100 slider_image" alt="..." />
            <div class="carousel-caption d-none d-md-block">
              <h5><a href="<?= BASE_URL . 'single.php?post_id=' . $value['id'] ?>"><?= $value['title'] ?></a></h5>
            </div>
          </div>
        <?php endforeach; ?>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
  </div>
  <!-- карусель end -->
  <!-- main -->
  <div class="container">
    <div class="content row">
      <!-- main content-->
      <div class="main-content col-md-9">
        <h2 class="last_publications">Последние публикации</h2>
        <?php include("app/includes/pagination.php");?>
        <?php foreach ($posts as $key => $value) : ?>
          <div class="post row">
            <div class="img col-12 col-md-4">
              <img class="post_image img-thumbnail  mx-auto d-block" src="<?= BASE_URL ?>images/posts/<?= $value['img'] ?>" alt="<?= $value['img'] ?>" />
            </div>
            <div class="post_text col-12 col-md-8 shadow p-3 mb-5 bg-body-tertiary rounded">
              <h2>
                <a class="title_of_post" href="<?= BASE_URL . 'single.php?post_id=' . $value['id'] ?>">
                  <?= mb_substr($value['title'], 0, 30,'UTF-8');
                  if (strlen($value['title']) > 30) echo "..."; ?>
                </a>
              </h2>
              <i class="far fa-user"><?= $value['user_name'] ?></i>
              <?php

              $myDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $value['created_date']);
              $newDateString = $myDateTime->format("d/m/Y H:i");
              $date_time = str_replace(" ", " <i class='fa-regular fa-clock'></i>", $newDateString);
              ?>
              <i class="far fa-calendar"><?= $date_time;  ?></i>
              <p class="preview-text">
                <?= mb_substr($value['content'], 0, 100, 'UTF-8');
                if (strlen($value['content']) > 100) echo "..."; ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
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

  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/358646f9ff.js" crossorigin="anonymous"></script>
  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>