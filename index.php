
<?php include_once "autoload.php";

// QUICK LOG IN 
if (isset($_GET['quick_login_now'])) {
    $quick_login= $_GET['quick_login_now'];
    setcookie('login_user_cookie_id', $quick_login, time() + (60*60*24*360*10));
    header('location:index.php');
}





// DELECT  ID FROM  QUICK EXIS
if (isset($_GET['quick_login_id'])) {
    $quick_login_id= $_GET['quick_login_id'];
    $quick_login_user_arr= json_decode($_COOKIE['recent_login_id'], true);
    $quick_login_user_uniqe= array_unique($quick_login_user_arr);
    $index=array_search($quick_login_id, $quick_login_user_uniqe);
    array_splice($quick_login_user_uniqe, $index, 1);
    if (count($quick_login_user_uniqe) > 0) {
        setcookie('recent_login_id', json_encode($quick_login_user_uniqe), time() + (60*60*24*365*10));
    } else {
        setcookie('recent_login_id', '', time() - (60*60*24*365*10));
    }
    header('location: index.php');
    

}

if (user_log()==true) {
    header('location:profile.php');
}
if (isset($_COOKIE['login_user_cookie_id'])) {
    $login_user_cookie_id= $_COOKIE['login_user_cookie_id'];
    $_SESSION['id'] = $login_user_cookie_id;
    header('location:profile.php');

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Facebook - log in or sign up</title>


    <!--CSS FILES-->
    <link rel="stylesheet" href="assets/font/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">

    <!--FAVINCON-->
    <link rel="shortcut icon" href="assets/img/icon.png" type="image/x-icon">

</head>
<body>
   
<!-- FACEBOOK LOGIN PAGE -->
<?php
// FORM ISSETING
if (isset($_POST['login'])) {
    $email= $_POST['email'];
    $password= $_POST['password'];

    // INPUT VALIDATION
    if (empty($email) || empty($password)) {
        $mgs=validation("Enter your email and password");
     }else {
         $Login_user_data= authCheck('users', 'email', $email);
 
         if ($Login_user_data==false) {
             $mgs= validation("Incorrect email address", "warning");
         } else {
             if (pass_verify($password, $Login_user_data->password)==false) {
                 $mgs= validation("Incorrect password", "warning");
             } else {
 
                 $_SESSION['id']= $Login_user_data->id;
                  setcookie('login_user_cookie_id', $Login_user_data->id, time() + (60*60*24*365*12));
                 
                 header('location:profile.php');
             }
             
         }
         
 
     }
    




}




?>
<div class="container1">
    <div class="row">

        <div class="col-md-8">
            <div class="left_col">
               <div class="logo">
                   <a href="#"> <img src="assets/img/logo.png" alt=""></a>
               </div>
               <?php if(empty($_COOKIE['recent_login_id'])) : ?>
            <h2>Facebook helps you connect and share with the people in your life.</h2>
            <?php endif; ?>
            <?php if(isset($_COOKIE['recent_login_id'])) : ?>
            <h2>Recent Logins</h2>
            <p>Click Your picture</p>
            <?php endif; ?>

            <div class="row">

           <?php  
           if(isset($_COOKIE['recent_login_id'])) :
           $recent_login_user= json_decode($_COOKIE['recent_login_id'], true);
           $recent_login_user_id= implode(',', $recent_login_user);
           $all_users= connector()->query("SELECT * FROM users WHERE id IN ($recent_login_user_id)");
           while($users_data= $all_users->fetch_object()) :
           
           
           ?>

            <div class="col-md-4">
                <div  class="wrap" style="width: 250px; text-align:center;">
                <div  class="card shadow">
                    <div class="card-body">
                        <a class="close" href="?quick_login_id=<?php echo $users_data->id; ?>'">&times;</a>
                        <a style="text-decoration: none;" href="?quick_login_now=<?php echo $users_data->id; ?>">
                        <img style="cursor:pointer;height: 100px; width:100px" src="assets/img/<?php echo $users_data->photo; ?>" alt=""><br><br>
                        <h4><?php echo $users_data->name; ?></h4>
                        </a>
                        
                    </div>
                </div>
            </div>
                </div>

                <?php endwhile; endif; ?>



            </div>

            



            </div>
        </div>

        <div class="col-md-4">
            <div class="right_col">
                <div class="wrap shadow">
                    <div class="card">
                        <div class="card-body">
                            <?php
                            if (isset($mgs)) {
                             echo $mgs;
                            }
                            ?>
                            <form action="" method="POST">
    
                                <div class="form-group">
                                    <input name="email" class="form-control" type="text" placeholder="email or phone number" value="<?php old('email') ?>">
                                </div><br>
                                <div class="form-group">
                                    <input name="password" class="form-control" type="password" placeholder="Password">
                                </div>
                                <a href="#">Forgotten Password?</a>
                                <div class="form-group">
                                    <input name="login" class="form-control btn btn-primary" type="submit" value="Log In">
                                </div><br>
    
                                <div class="form-group">
                                    <a class="btn btn-success" href="reg.php">Create New Account</a>
                                </div>
    
    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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