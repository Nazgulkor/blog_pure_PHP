<?php

include "../../app/controllers/posts.php";
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
                <h1 class="col-12">Посты</h1>
                <div class="button row">
                    <a class="col-3 btn btn-success" href="create.php">Создать</a>
                    <span class="col-1"></span>
                    <a class="col-3 btn btn-warning" href="index.php">Редактировать</a>
                </div>
                <div class="row title-table">
                    <div class="id col-1">
                        ID
                    </div>
                    <div class="title col-4">
                        название
                    </div>
                    <div class="author col-2">
                        автор
                    </div>
                    <div class="red col-4" style="text-align: center;">
                        Управление
                    </div>
                </div>
                <hr>
                <?php foreach ($posts as $key => $value) : ?>
                    <div class="row post">
                        <div class="id col-1">
                            <?= $value['id'] ?>
                        </div>
                        <div class="title col-4" style="word-wrap:none;">
                            <?= $value['title'] ?>
                        </div>
                        <div class="author col-2">
                            <?= $value['user_name'] ?>
                        </div>
                        <div class="red col-2">
                            <a href="edit.php?id=<?= $value['id'] ?>">
                                <i class="fa-regular fa-pen-to-square"></i>
                            </a>
                        </div>
                        <div class="del col-2">
                            <a href="edit.php?del_id=<?= $value['id'] ?>">
                                <i class="fa-solid fa-x" style="color: #e40c0c;"></i>
                            </a>
                        </div>
                        <?php if ($value['status']) : ?>
                            <div class="status col-1">
                                <a href="edit.php?set_status=0&pub_id=<?= $value['id'] ?>">
                                    <i class="fa-solid fa-code-compare">снять</i>
                                </a>
                            </div>
                        <?php else : ?>
                            <div class="status col-1">
                                <a href="edit.php?set_status=1&pub_id=<?= $value['id'] ?>">
                                    <i class="fa-solid fa-code-compare" style="color: #8d1616;">опубл...</i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <hr>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/358646f9ff.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>