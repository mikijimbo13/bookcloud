<?php
/**
 * Created by PhpStorm.
 * User: Michal
 * Date: 10-Jan-17
 * Time: 14:48
 */
require_once("session.php");

require_once("class.user.php");
$auth_user = new USER();


$user_id = $_SESSION['user_session'];

$stmt = $auth_user->runQuery("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));

$userRow=$stmt->fetch(PDO::FETCH_ASSOC);

require_once "class.book.php";
$book_shelf = new BOOK();

if(isset($_POST['btn-signup']))
{
    $bname = strip_tags($_POST['txt_bname']);
    $bauth = strip_tags($_POST['txt_bauth']);
    $bgenre = strip_tags($_POST['txt_genre']);
    $bcont = strip_tags($_POST['txt_bcont']);

    if($bname=="")	{
        $error[] = "Provide Book Name !";
    }
    else if($bauth=="")	{
        $error[] = "Provide Book Author !";
    }
    else if($bgenre=="")	{
        $error[] = "Provide Book Genre !";
    }
    else if($bcont=="")	{
        $error[] = "Provide Book Content !";
    }
    else
    {
        try
        {
            $book_shelf->registerBook($userRow['user_name'],$bname,$bauth,$bgenre,$bcont);
        }
        catch(PDOException $e)
        {
            echo $e->getMessage();
        }
    }
}

include 'header.php';
include 'menuLogged.php';
?>

<div class="registerbook-form">

    <div class="container">

        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Register book.</h2><hr />
            <?php
            if(isset($error))
            {
                foreach($error as $error)
                {
                    ?>
                    <div class="alert alert-danger">
                        <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?>
                    </div>
                    <?php
                }
            }?>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_bname" placeholder="Enter Book Name" value="<?php if(isset($error)){echo $bname;}?>" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_bauth" placeholder="Enter Book Author" value="<?php if(isset($error)){echo $bauth;}?>" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_genre" placeholder="Enter Book Genre" value="<?php if(isset($error)){echo $bgenre;}?>" />
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="txt_bcont" placeholder="Enter Book Content" value="<?php if(isset($error)){echo $bcont;}?>" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="btn-signup">
                    <i class="glyphicon glyphicon-open-file"></i>&nbsp;Submit
                </button>
            </div>
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>