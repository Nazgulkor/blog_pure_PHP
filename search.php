<?php
include "$_SERVER[DOCUMENT_ROOT]/blog_pure_PHP/app/database/db.php";
include 'path.php';
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search_str'])){
  if($_POST['search_str'] === '') header('Location: index.php');
  $posts = search_posts($_POST['search_str']);
}

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

  <!-- main -->
  <div class="container">
    <div class="content row">
      <!-- main content-->
      <div class="main-content col-md-9">
        <h2 class="last_publications">Результаты поиска на слово "<?=$_POST['search_str']?>"</h2>
        <?php if(!$posts) :?>
          нет результатов
        <?php endif;?>
        <?php foreach ($posts as $key => $value) : ?>
          <div class="post row">
            <div class="img col-12 col-md-4">
              <img class="post_image img-thumbnail  mx-auto d-block" src="<?= BASE_URL ?>images/posts/<?= $value['img'] ?>" alt="<?= $value['img'] ?>" />
            </div>
            <div class="post_text col-12 col-md-8 shadow p-3 mb-5 bg-body-tertiary rounded">
              <h2>
                <a class="title_of_post" href="<?= BASE_URL . 'single.php?post_id=' . $value['id'] ?>">
                  <?= mb_substr($value['title'], 0, 30);
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
                <?= mb_substr($value['content'], 0, 100);
                if (strlen($value['content']) > 100) echo "..."; ?>
              </p>
            </div>
          </div>
        <?php endforeach; ?>
      </div>

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