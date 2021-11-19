<?php include_once "autoload.php";

$login_user_data= loginuserdata('users', $_SESSION['id']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title><?php echo $login_user_data-> name; ?></title>


    <!--CSS FILES-->
    <link rel="stylesheet" href="assets/font/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!--FAVINCON-->
    <link rel="shortcut icon" href="assets/img/icon.png" type="image/x-icon">

</head>
<body>


<?php include_once "assets/template/folder.php" ?>

<div class="profile_body ">
    <div class="card shadow">
        <div class="card-body ">

        <?php 
        
        // FORM ISSETION 

        if (isset($_POST['submit'])) {
            // GET VALUE FROM FIELDS 
            $oldpass= $_POST['oldpass'];
            $newpass= $_POST['newpass'];
            $confpass= $_POST['confpass'];
            $hasspass= hash_pass($newpass);

            // FORM VALIDATION 
            if (empty($oldpass) || empty($newpass) || empty($confpass)) {
                $mgs= validation("All fields are require", "warning");
            }elseif (pass_verify($oldpass, $login_user_data->password)==false) {
                $mgs= validation("Your old password is incorrect", "warning");

            }elseif (passCheck($newpass, $confpass)==false) {
                $mgs= validation("Confirm password not match", "warning");
                
            } else {
                create("UPDATE users SET password='$hasspass' WHERE id= '$login_user_data->id'");
                session_destroy();
                header('location:index.php');
            }
            

        }
        
        if (isset($mgs)) {
            echo $mgs;
        }
        
        ?>

          <form action="" method="POST">
                <div class="form-group">
                    <input name="oldpass" class="form-control" type="password" placeholder="Old password">
                </div>

                <div class="form-group">
                    <input name="newpass" class="form-control" type="password" placeholder="New password">
                </div>

                <div class="form-group">
                    <input name="confpass" class="form-control" type="password" placeholder="Confirm password">
                </div>

                <div class="form-group">
                    <input name="submit" class="form-control btn btn-primary" type="submit" value="Submit">
                </div>
            </form>
            
    
        </div>
    </div>
</div>



  <!-- JS FILES  -->
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>