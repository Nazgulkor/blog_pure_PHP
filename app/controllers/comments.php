<?php
$post_id = $_GET['post_id'];
$comments = select_comments($post_id);

$error_text = '';
//оставить комментарий
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['leave_comment'])) {
    $comment = trim($_POST['comment']);
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['id'];
    if ($comment === '') {
        $error_text =  'нельзя отправить пустой комментарий';
    } else {
        $comment = [
            'post_id' => $post_id,
            'user_id' => $user_id,
            'comment' => $comment,
        ];
        $id =  insert('comments', $comment);
        $comments = select_comments($post_id);
    }
}
