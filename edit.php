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

<?php include_once "assets/template/folder.php" ?>
   
<!-- REGESTRATION PAGE -->

<?php
// FORM ISSETING 
if (isset($_POST['submit'])) {
    // GET VALUE FROM INPUT FIELDS 
    $name= $_POST['name'];
    $uname= $_POST['uname'];
    $email= $_POST['email'];
    $cell= $_POST['cell'];
    $age= $_POST['age'];
    $education= $_POST['education'];
    $gender= $_POST['gender'];
    $update_at= date('Y-m-d, h:m:s');
    $user_id= $login_user_data->id;

    

    // FORM VALIDATION 
    if (empty($name) || empty($uname) || empty($email) || empty($cell)) {
        $mgs= validation("All fields are require");
    }elseif (emailCheck($email)==false) {
        $mgs= validation("Incorrect email address", "warning");
        
    }elseif (numCheck($cell)==false) {
        $mgs= validation("Incorrect phone number", "warning");
        
    } else {
        create("UPDATE users SET name='$name', username='$uname', cell='$cell', gender='$gender', age='$age',  email='$email', edu='$education', updated_at='$update_at' WHERE id='$user_id'" );
        setMgs('edit', 'Edit done');
        header('location:edit.php');
        


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
                            <h2>Edit your profile</h2>
                            

                            <?php 
                            if (isset($mgs)) {
                                echo $mgs;
                            }
                            echo getMgs('edit');

                            
                            ?>



                            <form action="" method="POST" autocomplete="on">
    
                               <div class="form-group">
                                   <label for="">Name</label>
                                   <input name="name" class="form-control" type="text" value="<?php echo $login_user_data->name; ?>">
                               </div>
    
                               <div class="form-group">
                                <label for="">Username</label>
                                <input name="uname" class="form-control" type="text" value="<?php echo $login_user_data->username; ?>">
                            </div>
    
                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" class="form-control" type="text" value="<?php echo $login_user_data->email; ?>">
                            </div>
    
                            <div class="form-group">
                                <label for="">Phone</label>
                                <input name="cell" class="form-control" type="text" value="<?php echo $login_user_data->cell; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Age</label>
                                <input name="age" class="form-control" type="text" value="<?php echo $login_user_data->age; ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Education</label>
                                <input name="education" class="form-control" type="text" value="<?php echo $login_user_data->edu; ?>">
                            </div>
    
                            
                            <div class="form-group">
                                <label for="">Gender</label> <br>
                                <input name="gender"  type="radio" <?php echo ($login_user_data->gender=='Male') ? 'checked' : 'Male' ?> id="male" value="Male"> <label for="male">Male</label>
                                <input name="gender"  type="radio"  <?php echo ($login_user_data->gender=='Female') ? 'checked' : 'Female' ?>  id="female" value="Female"> <label for="female">Female</label>
                                <input name="gender"  type="radio"  <?php echo ($login_user_data->gender=='Custom') ? 'checked' : 'Custom' ?>  id="custom" value="Custom"> <label for="custom">Custom</label>
                            </div>
    
                            <div class="form-group">
                                <input name="submit" class="btn btn-primary" type="submit" value="Submit">
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