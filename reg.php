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
    <h2>Форма регистрации</h2>
    <div class="error row justify-content-center">
      <p class="mb-3 col-2  text-danger p-3"><?php include "app/helps/error_info.php"; ?></p>
    </div>
    <div class="w-100"></div>
    <form class="row justify-content-center" method="post" action="reg.php">
      <div class="mb-3 col-12 col-md-4">
        <label for="formGroupExampleInput" class="form-label">Логин</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="login" value="<?=$login?>" placeholder="Example input placeholder">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputEmail1" class="form-label">Email</label>
        <input type="email" class="form-control" id="exampleInputEmail1" name="email" value="<?=$email?>" aria-describedby="emailHelp">
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputPassword1" class="form-label">Пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword1" name="password1">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
        <input type="password" class="form-control" id="exampleInputPassword2" name="password2">
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        <button class="btn btn-secondary" type="submit" name="button_reg">регистрация</button>
      </div>
      <div class="w-100"></div>
      <div class="mb-3 col-12 col-md-4">
        Уже есть аккаунт?
        <a href="log.php" style="color: blue;">Войти</a>
      </div>
    </form>
  </div>


  <!-- font awesome -->
  <script src="https://kit.fontawesome.com/358646f9ff.js" crossorigin="anonymous"></script>
  <!-- bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>