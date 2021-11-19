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

<section>
    <div class="container">
    <div class="row">
<?php
$all_users= all('users');

while($users_data= $all_users->fetch_object()) :

?>

<?php if($users_data->id !==$_SESSION['id']) : ?>


<div class="col-md-3">
    
<div style="margin-top: 20px; text-align:center; " class="card">
            <div class="card-body">
                <a href="">
                <img src="assets/img/<?php echo $users_data->photo; ?>" alt="">
                </a> <br><br>
                <a style="text-decoration: none;" href="">
                <h4><?php echo $users_data->name; ?></h4>
                </a>
                <a class="btn btn-sm btn-primary" href="profile.php?friends_id=<?php echo $users_data->id; ?>">View Profile</a>
            </div>
        </div>

</div>
<?php endif; ?>
<?php endwhile;?>


</div>
    </div>
</section>



  <!-- JS FILES  -->
  <script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/custom.js"></script>
</body>
</html>