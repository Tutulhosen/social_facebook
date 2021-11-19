<?php include_once "autoload.php" ?>

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
   
<!-- REGESTRATION PAGE -->

<?php
// FORM ISSETING 
if (isset($_POST['singup'])) {
    // GET VALUE FROM INPUT FIELDS 
    $name= $_POST['name'];
    $uname= $_POST['uname'];
    $email= $_POST['email'];
    $cell= $_POST['cell'];
    $password= $_POST['password'];
    $cpassword= $_POST['cpassword'];
    if (isset($_POST['gender'])) {
        $gender= $_POST['gender'];

    }
    $hashpass= hash_pass($password);

    // FORM VALIDATION 
    if (empty($name) || empty($uname) || empty($email) || empty($cell) || empty($password) || empty($cpassword) || empty($gender)) {
        $mgs= validation("All fields are require");
    }elseif (emailCheck($email)==false) {
        $mgs= validation("Incorrect email address", "warning");
        
    }elseif (numCheck($cell)==false) {
        $mgs= validation("Incorrect phone number", "warning");
        
    }elseif (passCheck($password, $cpassword)==false) {
        $mgs= validation("Password not match", "warning");

    }elseif (data_exists('users', 'username', $uname)==false) {
        $mgs= validation("This username is already exists", "warning");

    }elseif (data_exists('users', 'email', $email)==false) {
        $mgs= validation("This email is already exists", "warning");

    }elseif (data_exists('users', 'cell', $cell)==false) {
        $mgs= validation("This phone number is already exists", "warning");

    } else {
        create("INSERT INTO users (name, email, cell, username, password, gender) VALUE ('$name', '$email', '$cell', '$uname', '$hashpass', '$gender')");
        cleardata();

        $mgs= validation("Your registration is successfull", "success");

    }
    





}



?>



<div class="reg_page">
    <div class="conainer">
        <div class="row">
            <div class="col-md-12">
                <div class="wrap shadow">
                    <div class="card">
                        <div class="card-body">
                            <h2>Sign Up</h2>
                            <p>It's quick and easy</p>

                            <?php 
                            if (isset($mgs)) {
                                echo $mgs;
                            }
                            
                            ?>



                            <form action="" method="POST" autocomplete="on">
    
                               <div class="form-group">
                                   <label for="">Name</label>
                                   <input name="name" class="form-control" type="text" value="<?php old('name'); ?>">
                               </div>
    
                               <div class="form-group">
                                <label for="">Username</label>
                                <input name="uname" class="form-control" type="text" value="<?php old('uname'); ?>">
                            </div>
    
                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" class="form-control" type="text" value="<?php old('email'); ?>">
                            </div>
    
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input name="cell" class="form-control" type="text" value="<?php old('cell'); ?>">
                            </div>
    
                            <div class="form-group">
                                <label for="">New Password</label>
                                <input name="password" class="form-control" type="password">
                            </div>
    
                            <div class="form-group">
                                <label for="">Confirm Password</label>
                                <input name="cpassword" class="form-control" type="password">
                            </div>
                            <div class="form-group">
                                <label for="">Gender</label> <br>
                                <input name="gender"  type="radio" id="male" value="Male"> <label for="male">Male</label>
                                <input name="gender"  type="radio" id="female" value="Female"> <label for="female">Female</label>
                                <input name="gender"  type="radio" id="custom" value="Custom"> <label for="custom">Custom</label>
                            </div><br>
    
                            <div class="form-group">
                                <input name="singup" class="btn btn-primary" type="submit" value="Sign Up">
                            </div>
                                OR <br>
                                <a class="btn btn-primary" href="index.php">Log In</a>
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