<?php
include "$_SERVER[DOCUMENT_ROOT]/blog_pure_PHP/path.php";
include "$_SERVER[DOCUMENT_ROOT]/blog_pure_PHP/app/database/db.php";


$topics = select_all('topics');
$posts = select_all_from_posts_with_author('posts');
// tt($posts);

$title = '';
$content = '';
$img = '';

$error_message = [];
// создание поста
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_post'])) {
    $_POST['img'] = '';
    if(!empty($_FILES['img']['name'])){
        $img_name = time() . "_" . $_FILES['img']['name'];
        $file_tmp_name = $_FILES['img']['tmp_name'];
        $file_type = $_FILES['img']['type'];
        $destination = ROOT_PATH . "/images/posts/".$img_name;
        if(strpos($file_type, 'image') === false){
            array_push($error_message, 'загрузи картинку да');
        }else{
            $result = move_uploaded_file($file_tmp_name,  $destination );

            if($result){
                $_POST['img'] = $img_name;
            }else {
                array_push($error_message, 'С картинкой что то не так');
            }
        }
    }

    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $id_topic = trim($_POST['topic']);
    $img = $_POST['img'];
    $publish = $_POST['publish'] ? 1 : 0;
    // tt($_POST);
    if ($title === '' || $content === '' || $id_topic ==='') {
        array_push($error_message, 'Заполните все поля');
    } elseif (mb_strlen($title, 'UTF8') < 7) {
        array_push($error_message, 'слишком коротко (не менее 7 символов)');
    }  elseif (!$id_topic) {
        array_push($error_message, 'выбери категорию');
    }   else {
        $post = [
            'title' => $title,
            'content' => $content,
            'img' => $img,
            'status' => $publish,
            'id_user' => $_SESSION['id'],
            'id_topic' => $id_topic,
    
        ];
        $id =  insert('posts', $post);
        $post = select_one('posts', ['id' => $id]);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}

// Редактировать GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $post = select_one('posts', ['id' => $id]);
    $post_id = $post['id'];
    $post_title = $post['title'];
    $post_content = $post['content'];
    $post_topic_id = $post['id_topic'];
    $post_publish= $post['status'];
}
// Редактировать POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_post'])) {
    $_POST['img'] = '';
    if(!empty($_FILES['img']['name'])){
        $img_name = time() . "_" . $_FILES['img']['name'];
        $file_tmp_name = $_FILES['img']['tmp_name'];
        $file_type = $_FILES['img']['type'];
        $destination = ROOT_PATH . "/images/posts/".$img_name;
        if(strpos($file_type, 'image') === false){
            array_push($error_message, 'загрузи картинку да');
        }else{
            $result = move_uploaded_file($file_tmp_name,  $destination );

            if($result){
                $_POST['img'] = $img_name;
            }else {
                array_push($error_message, 'С картинкой что то не так');
            }
        }
    }
    $id = $_POST['post_id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $id_topic = trim($_POST['topic']);
    $img = $_POST['img'];
    $publish = $_POST['publish'] ? 1 : 0;
    // tt($_POST);
    if ($title === '' || $content === '' || $id_topic ==='') {
        array_push($error_message, 'Заполните все поля');
    } elseif (mb_strlen($title, 'UTF8') < 7) {
        array_push($error_message, 'слишком коротко (не менее 7 символов)');
    } else {
        $post = [
            'title' => $title,
            'content' => $content,
            'img' => $img,
            'status' => $publish,
            'id_user' => $_SESSION['id'],
            'id_topic' => $id_topic,
        ];
        $id =  update('posts', $id, $post);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
}else {

}
// публикация и депубликация поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])) {
    // tt($_GET);
    $id = $_GET['pub_id'];
    $status = $_GET['set_status'];
    $post = [
        'status' => $status
    ];
    update('posts', $id, $post);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}

// удаление поста
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('posts', $id);
    header('location: ' . BASE_URL . 'admin/posts/index.php');
}

?>