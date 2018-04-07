<?php
/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 10-Jan-17
 * Time: 16:43
 */
session_start();
require_once("class.user.php");
$auth_user = new USER();

include 'header.php';
if($auth_user->is_loggedin()!="")
{
    $user_id = $_SESSION['user_session'];
    $stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
    $stmt->execute(array(":user_id"=>$user_id));
    $userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    include 'menuLogged.php';
} else {
    include 'menu.php';
}
if (isset($_GET['book'])) {
    $book_id = $_GET['book'];
}

require_once "class.book.php";
$book_shelf = new BOOK();

$book_shelf->bookDetail($book_id);

if($auth_user->is_loggedin()!="") {
    include 'discussion/comments.php';
}
include 'footer.php';
?>