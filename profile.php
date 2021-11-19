<?php include_once "autoload.php";

if (user_log()==false) {
    header('location:index.php');
}else{
    if (isset($_GET['friends_id'])) {
        $login_user_data= loginuserdata('users', $_GET['friends_id']);
    } else {
        $login_user_data= loginuserdata('users', $_SESSION['id']);
    }
    
}





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


            <h2><?php echo $login_user_data-> name; ?></h2>
            <table class="table table-bordered">
                <tr>
                    <td>Name</td>
                    <td><?php echo $login_user_data-> name; ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo $login_user_data-> email; ?></td>
                </tr>
                <tr>
                    <td>Phone number</td>
                    <td><?php echo $login_user_data-> cell; ?></td>
                </tr>
                <tr>
                    <td>Gender</td>
                    <td><?php echo $login_user_data-> gender; ?></td>
                </tr>

                <?php if(isset($login_user_data->age)) : ?>
                <tr>
                    <td>Age</td>
                    <td><?php echo $login_user_data-> gender; ?></td>
                </tr>
                    <?php endif; ?>

                    <?php if(isset($login_user_data->edu)) : ?>
                <tr>
                    <td>Education</td>
                    <td><?php echo $login_user_data-> gender; ?></td>
                </tr>
                <?php endif; ?>

            </table>
    
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