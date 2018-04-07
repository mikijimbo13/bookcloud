<?php

	require_once("session.php");
	
	require_once("class.user.php");
	$auth_user = new USER();
	
	
	$user_id = $_SESSION['user_session'];
	
	$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
	$stmt->execute(array(":user_id"=>$user_id));
	
	$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
    require_once "class.book.php";
    $book_shelf = new BOOK();
	
    include 'header.php';
    include 'menuLogged.php';
?>
	
    <div class="container-fluid">
        <label class="h5">welcome : <?php print($userRow['user_name']); ?></label>
    </div>


<?php
    include 'discussion/comments.php';
    include 'footer.php';
?>
