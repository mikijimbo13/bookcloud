<?php
session_start();
require_once("class.user.php");
$login = new USER();

if($login->is_loggedin()!="")
{
    $login->redirect('home.php');
}


include 'header.php';
include 'menu.php';
require_once "class.book.php";
$book_shelf = new BOOK();
$book_shelf->findBooks("","","","",15,0);
?>
</div>
<?php include 'footer.php'; ?>