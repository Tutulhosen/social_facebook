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
        <?php if(isset($login_user_data->photo)) : ?>
            <img src="assets/img/<?php echo $login_user_data->photo; ?>" alt="">

            <?php elseif($login_user_data->gender=='Male') : ?>
            <img src="assets/img/male.jpg" alt="">
            <?php elseif($login_user_data->gender=='Female') : ?>
            <img src="assets/img/female.jpg" alt="">
            <?php else : ?>
            <img src="assets/img/a.png" alt="">

            <?php endif; ?>
            <br><br><br>

            <?php 
            if (isset($_POST['upload'])) {
                $user_id= $_SESSION['id'];
                if (empty($_FILES['photo']['name'])) {
                   setMgs('warning', 'Please select a photo');
                    header('location:photo.php');
                } else {
                  $file= file_upload($_FILES['photo'], 'assets/img/');
                   create("UPDATE users SET photo='$file' WHERE id='$user_id'");
                   setMgs('upload', 'Profile photo upload successfull');
                   header('location:photo.php');

                }
                
               
            }
            
          getMgs('warning');
          getMgs('upload');
            
            
            
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <input name="photo" type="file">
                    <input name="upload" type="submit" value="upload">
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