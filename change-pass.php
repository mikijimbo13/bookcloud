<?php
session_start();
require_once('class.user.php');
$user = new USER();

if(isset($_POST['btn-confirm']))
{
    $old = strip_tags($_POST['txt_oldpass']);
    $new1 = strip_tags($_POST['txt_new1pass']);
    $new2 = strip_tags($_POST['txt_new2pass']);

    if($old=="")	{
        $error[] = "Provide old password !";
    }
    else if($new1=="")	{
        $error[] = "Provide new password !";
    }
    else if($new2=="")	{
        $error[] = "Provide new password !";
    }
    else if($new1 != $new2)	{
        $error[] = "Passwords do not match !";
    }
    else if(strlen($new1) < 6){
        $error[] = "Password must be atleast 6 characters";
    }
    else
    {
        try
        {
            $user->changePassword($old,$new1,$new2);
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

<div class="signin-form">

    <div class="container">

        <form method="post" class="form-signin">
            <h2 class="form-signin-heading">Change Password.</h2><hr />
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
            }
            ?>
            <div class="form-group">
                <input type="password" class="form-control" name="txt_oldpass" placeholder="Enter Old Password" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="txt_new1pass" placeholder="Enter New Password" />
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="txt_new2pass" placeholder="Re-Enter New Password" />
            </div>
            <div class="clearfix"></div><hr />
            <div class="form-group">
                <button type="submit" class="btn btn-primary" name="btn-confirm">
                    <i class="glyphicon glyphicon-open-file"></i>&nbsp;Change Password
                </button>
            </div>
            <br />
        </form>
    </div>
</div>
<?php include 'footer.php'; ?>