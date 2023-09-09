<?php
include 'connect.php';

session_start();


function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
    exit();
}
//проверка на ошибку
function db_check_error($query)
{
    $error_info = $query->errorInfo();
    if ($error_info[0] !== PDO::ERR_NONE) {
        echo $error_info[2];
        exit();
    }
    return true;
}
// запрос на все поля
function select_all($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql .= " WHERE $key = '$value' ";
            } else {
                $sql .= "AND $key = '$value' ";
            }
            $i++;
        }
    }
    // tt($sql);
    // exit();
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchAll();
}
//запрос на одну строку
function select_one($table, $params = [])
{
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql .= " WHERE $key = '$value' ";
            } else {
                $sql .= "AND $key = '$value' ";
            }
            $i++;
        }
    }
    $sql .= ' LIMIT 1';
    // tt($sql);
    // exit();
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetch();
}
function select_top($table, $field, $limit)
{
    global $pdo;
    $sql = "SELECT * FROM $table ORDER BY $field DESC LIMIT $limit";

    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchAll();
}
// запись данных в бд
function insert($table, $params)
{
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $coll .= "$key";
            $mask .= "'$value'";
        } else {
            $coll .= ", $key";
            $mask .= ", '$value'";
        }
        $i++;
    }
    $sql = "INSERT INTO $table ($coll) VALUES ($mask)";
    // tt($sql);
    // exit();
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $pdo->lastInsertId();
}

// обновление данных в бд
function update($table, $id, $params): void
{
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0) {
            $str .= "$key = '$value'";
        } else {
            $str .= ", $key = '$value'";
        }
        $i++;
    }
    $sql = "UPDATE $table SET $str WHERE id = $id";
    // tt($sql);
    // exit();
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
}

// удаление данных  в бд
function delete($table, $id): void
{
    global $pdo;
    $sql = "DELETE FROM $table WHERE id = $id";
    // tt($sql);
    // exit();
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
}

// выбор постов с автором
function select_all_from_posts_with_author()
{
    global $pdo;
    $sql = "
    SELECT
     t1.*,
     t2.user_name
    FROM posts AS t1 JOIN users AS t2 ON t1.id_user = t2.id";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchAll();
}
// выбор постов с автором на главную
function select_publisheds_from_posts_with_author($limit, $offset)
{
    global $pdo;
    $sql = "
    SELECT
     t1.*,
     t2.user_name
    FROM posts AS t1 JOIN users AS t2 ON t1.id_user = t2.id 
    WHERE t1.status = 1 ORDER BY t1.created_date DESC LIMIT $limit OFFSET $offset";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchAll();
}
// выбор постов с поиском
function search_posts($search_str)
{
    $search_str = trim(strip_tags(stripslashes(htmlspecialchars($search_str))));
    global $pdo;
    $sql = "
    SELECT
     t1.*,
     t2.user_name
    FROM posts AS t1 JOIN users AS t2 
    ON t1.id_user = t2.id 
    WHERE t1.status = 1 AND t1.title LIKE '%$search_str%' OR t1.content LIKE '%$search_str%'
    ORDER BY t1.created_date DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchAll();
}
// получить посты связанные с топиком
function get_posts_by_topic($topic_id)
{

    global $pdo;
    $sql = "
    SELECT
     t1.*,
     t2.user_name
    FROM posts AS t1 JOIN users AS t2 
    ON t1.id_user = t2.id 
    WHERE t1.status = 1 AND t1.id_topic = '$topic_id'
    ORDER BY t1.created_date DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchAll();
}


// count get
function count_row($table){
    global $pdo;
    $sql = "SELECT COUNT(*) FROM $table WHERE status = 1";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchColumn();
}
//get comments
function select_comments($post_id){
    global $pdo;
    $sql = "
    SELECT
     t1.*,
     t2.user_name
    FROM comments AS t1 JOIN users AS t2 
    ON t1.user_id = t2.id 
    WHERE t1.post_id = '$post_id'
    ORDER BY t1.publicated DESC";
    $query = $pdo->prepare($sql);
    $query->execute();
    db_check_error($query);
    return $query->fetchAll();
}