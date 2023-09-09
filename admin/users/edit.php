<?php
include "../../app/controllers/users.php";

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
    <link rel="stylesheet" href="../../css/admin.css" />
</head>

<body>
    <!-- header -->
    <?php
    include "../../app/includes/header_admin.php";
    ?>
    <!-- header end-->
    <div class="container">
        <div class="row">
            <?php include '../../app/includes/sidebar_admin.php'; ?>

            <div class="posts col-8">
                <h1>Редактировать пользователя</h1>

                <div class="button row">
                    <a class="col-3 btn btn-success" href="create.php">Создать</a>
                    <span class="col-1"></span>
                    <a class="col-3 btn btn-warning" href="index.php">Редактировать</a>
                </div>
                <hr>
                <div class="row add_post">
                    <div class="error row justify-content-center">
                        <p class="mb-3 col-12  text-danger p-3"><?php include "../../app/helps/error_info.php"; ?></p>
                    </div>
                    <form action="edit.php" method="post">
                    <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                        <div class="col">
                            <label for="formGroupExampleInput" class="form-label">Логин</label>
                            <input type="text" class="form-control" id="formGroupExampleInput" name="login" value="<?=$user['user_name']?>" placeholder="Example input placeholder">
                        </div>
                        <div class="col">
                            <label for="exampleInputPassword1" class="form-label">Пароль</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" name="password1">
                        </div>

                        <div class="col">
                            <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" name="password2">
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="defaultCheck1" value="1" name="admin" <?=$user['admin']? "checked" : ''?>>
                            <label class="form-check-label" for="defaultCheck1">
                                Set admin grants
                            </label>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-primary" type="submit" name="edit_user">edit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/358646f9ff.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>