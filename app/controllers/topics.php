<?php
include "$_SERVER[DOCUMENT_ROOT]/bookproject/path.php";
include "$_SERVER[DOCUMENT_ROOT]/bookproject/app/database/db.php";


$topics = select_all('topics');


$error_message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic_create'])) {
    $topic_name = trim($_POST['topic_name']);
    if ($topic_name === '') {
        $error_message = 'Заполните все поля';
    } elseif (mb_strlen($topic_name, 'UTF8') < 2) {
        $error_message = 'Категория слишком короткая (не менее 2 символов)';
    } elseif (select_one('topics', ['name' => $topic_name])) {
        $error_message = 'такая категория уже есть';
    } else {
        $topic = [
            'name' => $topic_name,
        ];
        $id =  insert('topics', $topic);
        $topic = select_one('topics', ['id' => $id]);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    }
}

// Редактировать GET
$topic_id = '';
$topic_name = '';
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];
    $topic = select_one('topics', ['id' => $id]);
    $topic_id = $topic['id'];
    $topic_name = $topic['name'];
}
// Редактировать POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['topic_edit'])) {
    $topic_name = trim($_POST['topic_name']);
    $topic_id = trim($_POST['topic_id']);
    if ($topic_name === '') {
        $error_message = 'Заполните все поля';
    } elseif (mb_strlen($topic_name, 'UTF8') < 2) {
        $error_message = 'Категория слишком короткая (не менее 2 символов)';
    } elseif (select_one('topics', ['name' => $topic_name])) {
        $error_message = 'такая категория уже есть';
    } else {
        $topic = [
            'id' => $topic_id,
        ];
        $id =  update('topics', $topic_id, ['name' => $topic_name]);
        header('location: ' . BASE_URL . 'admin/topics/index.php');
    }
}
// удаление топика
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['del_id'])) {
    $id = $_GET['del_id'];
    delete('topics', $id);
    header('location: ' . BASE_URL . 'admin/topics/index.php');
}
?>