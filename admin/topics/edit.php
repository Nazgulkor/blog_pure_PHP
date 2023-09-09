<?php
include "../../app/controllers/topics.php";
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
                <h1>Категории обновление</h1>
                <div class="button row">
                    <a class="col-3 btn btn-success" href="create.php">Создать</a>
                    <span class="col-1"></span>
                    <a class="col-3 btn btn-warning" href="index.php">Редактировать</a>
                </div>
                <hr>
                <div class="row add_post">
                    <form action="edit.php" method="post">
                    <input type="hidden" name="topic_id" value="<?= $topic_id ?>">
                        <div class="row g-3">
                            <div class="col-10">
                                <input type="text" 
                                       class="form-control" 
                                       placeholder="Title" 
                                       aria-label="Title" 
                                       name="topic_name" 
                                       value="<?= $topic_name ?>">
                            </div>
                            <div class="col">
                                <button class="btn btn-primary" type="submit" name="topic_edit">update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="error row justify-content-center">
                    <p class="mb-3 col-12  text-danger p-3"><?= $error_message ?></p>
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