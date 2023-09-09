<?php
include "$_SERVER[DOCUMENT_ROOT]/bookproject/path.php";
include "$_SERVER[DOCUMENT_ROOT]/bookproject/app/database/db.php";



$error_message = [];
$reg_status = '';
$login = '';
$email = '';
$users = select_all('users');
// код регистрации
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_reg'])) {
    $admin = 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);


    if ($login === '' || $email === '' || $password === '') {
        array_push($error_message, 'Заполните все поля');
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($error_message, 'Логин слишком короткий (не менее 2 символов)');
    } elseif ($password !== $password2) {
        array_push($error_message, 'Пароли не совпадают');
    } elseif (select_one('users', ['email' => $email])) {
        array_push($error_message, 'Пользователь с такой почтой уже зарегистрирован');
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $post = [
            'admin' => $admin,
            'user_name' => $login,
            'email' => $email,
            'password' => $password
        ];

        $id =  insert('users', $post);
        $user = select_one('users', ['id' => $id]);
        $_SESSION['id'] = $user['id'];
        $_SESSION['login'] = $user['user_name'];
        $_SESSION['admin'] = $user['admin'];
        if ($_SESSION['admin']) {
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        } else {

            header('location: ' . BASE_URL);
        }
    }
}

// вход
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['button_log'])) {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    if ($email === '' || $password === '') {
        array_push($error_message, 'Заполните все поля');
    } else {
        $user = select_one('users', ['email' => $email]);
        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['id'] = $user['id'];
            $_SESSION['login'] = $user['user_name'];
            $_SESSION['admin'] = $user['admin'];
            if ($_SESSION['admin']) {
                header('location: ' . BASE_URL );
            } else {

                header('location: ' . BASE_URL);
            }
        } else {
            array_push($error_message, 'Неверная почта или пароль');
        }
    }
}



// код создания порльзователя посредством админа
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['create_user'])) {

    $admin = isset($_POST['admin']) ? 1 : 0;
    $login = trim($_POST['login']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);


    if ($login === '' || $email === '' || $password === '') {
        array_push($error_message, 'Заполните все поля');
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        array_push($error_message, 'Логин слишком короткий (не менее 2 символов)');
    } elseif ($password !== $password2) {
        array_push($error_message, 'Пароли не совпадают');
    } elseif (select_one('users', ['email' => $email])) {
        array_push($error_message, 'Пользователь с такой почтой уже зарегистрирован');
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'admin' => $admin,
            'user_name' => $login,
            'email' => $email,
            'password' => $password
        ];

        $id =  insert('users', $user);
    }
}
// Редактировать юзера GET
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_edit_id'])) {

    $user = select_one('users', ['id' => $_GET['user_edit_id']]);
    // tt($user);
}
// Редактировать юзера POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_user'])) {
    // tt($_POST);

    $id = $_POST['user_id'];
    $login = trim($_POST['login']);
    $admin = 0;
    if (isset($_POST['admin'])) $admin =  1 ;
    $password = trim($_POST['password1']);
    $password2 = trim($_POST['password2']);
    if ($login === '') {
        $user['id'] = $id;
        $user['user_name'] = $login;
        $user['admin'] = $admin;
        array_push($error_message, 'Заполните все поля');
    } elseif (mb_strlen($login, 'UTF8') < 2) {
        $user['id'] = $id;
        $user['user_name'] = $login;
        $user['admin'] = $admin;
        array_push($error_message, 'короткий логин (не менее 2 символов)');
    }elseif ($password !== $password2) {
        $user['id'] = $id;
        $user['user_name'] = $login;
        $user['admin'] = $admin;
        array_push($error_message, 'Пароли не совпадают');
    } elseif (!empty($password)) {
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user = [
            'admin' => $admin,
            'user_name' => $login,
            'password' => $password
        ];

        $id =  update('users', $id, $user);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }else{
        $user = [
            'admin' => $admin,
            'user_name' => $login,
        ];

        $id =  update('users', $id, $user);
        header('location: ' . BASE_URL . 'admin/users/index.php');
    }
}else {
  
}
// удалить юзера
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['user_del_id'])) {
    $id = $_GET['user_del_id'];
    delete('users', $id);
    header('location: ' . BASE_URL . 'admin/users/index.php');
}
