<?php
include "../../app/controllers/posts.php";

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
                <h1>Редактировать посты</h1>
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
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        
                    <input type="hidden" name="post_id" value="<?= $post_id ?>">
                        <div class="row g-3">
                            <div class="col">
                                <input name="title" type="text" class="form-control" placeholder="Title" aria-label="Title" value="<?= $post_title ?>">
                            </div>
                            <div class="mb-3">
                                <label for="post_content" class="form-label">content</label>
                                <textarea name="content" class="form-control" id="post_content" rows="3"><?= $post_content ?></textarea>
                            </div>
                            <div class="input-group col">
                                <input name="img" type="file" class="form-control" id="inputGroupFile02">
                                <label class="input-group-text" for="inputGroupFile02">Upload</label>
                            </div>
                            <select name="topic" class="form-select" aria-label="Default select example">
                                <option>Категория</option>
                                <?php foreach ($topics as $key => $value) : ?>
                                    <?php $selected = $value['id'] == $post_topic_id ? 'selected' : '';?>
                                    <option value="<?= $value['id'] ?>" <?=$selected?>><?= $value['name'] ?></option>
                                <?php endforeach; ?>
                            </select>

                            <div class="form-check form-switch col-7">
                                <?php if (!$post_publish) : ?>
                                    <input name="publish" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">опубликовать</label>
                                <?php else : ?>
                                    <input name="publish" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">опубликовать</label>
                                <?php endif; ?>
                            </div>
                            <div class="col-5">
                                <button name="update_post" class="btn btn-primary" type="submit" style="float: right;">save post</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ckeditor -->
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <!-- font awesome -->
    <script src="https://kit.fontawesome.com/358646f9ff.js" crossorigin="anonymous"></script>
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- scripts -->
    <script src="../../js/script.js"></script>
</body>

</html>