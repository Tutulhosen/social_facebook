<?php 
session_start();

$login_user_id= $_SESSION['id'];

if (isset($_COOKIE['recent_login_id'])) {
    $all_users= json_decode($_COOKIE['recent_login_id'], true);
    array_push($all_users, $login_user_id);
    setcookie('recent_login_id', json_encode($all_users), time() + (60*60*24*365*12));
} else {
    $first_user= [];
    array_push($first_user, $login_user_id);
    setcookie('recent_login_id', json_encode($first_user), time() + (60*60*24*365*12));
}





session_destroy();
setcookie('login_user_cookie_id', '', time() - (60*60*24*365*12));

header('location:index.php');

?>