<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

    include 'header.php';
    include 'menuLogged.php';
    require_once "class.book.php";
    $book_shelf = new BOOK();
    $book_shelf->findBooks($userRow['user_name'],"","","",15,0);
    include 'footer.php';

?>
