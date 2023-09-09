<?php

include 'app/controllers/users.php';
?>
<!DOCTYPE html>
<html lang="ru">

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
  <?php
  include "./app/includes/header.php";
  ?>
  <!-- end header -->
  <div class="container reg_form">
    <h2>Авторизация</h2>
    <div class="error row justify-content-center">
      <p class="mb-3 col-2  text-danger p-3"><?php include "app/helps/error_info.php"; ?></p>
    </div>
    <form class="row justify-content-center" method="post" action="log.php">
      <div class="mb-3 col-12 col-md-4">
        <label for="formGroupExampleInput" class="form-label">Введите вашу почту</label>
        <input type="email" class="form-control" id="formGroupExampleInput" value="<?= $email ?>" placeholder="Example input placeholder" name="email">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <button class="btn btn-secondary" type="submit" name="button_log">Войти</button>
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        Нет аккаунта?
        <a href="reg.php" style="color: blue;">Зарегистрироваться</a>
      </div>
    </form>
  </div>


  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/358646f9ff.js" crossorigin="anonymous"></script>
  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>