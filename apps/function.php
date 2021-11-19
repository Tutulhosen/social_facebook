

<?php

/**
 * message validation
 */

function validation($mgs, $type='danger'){
    return "<p class=\"alert alert-{$type}\">{$mgs}<button class=\"close\" data-dismiss=\"alert\">&times;</button></p>";
}


/**
 * email validation
 */

 function emailCheck($email){
     if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
         return true;
     }else{
         return false;
     }

 }

 /**
  * fixed email validation
  */

  function fixedemail(string $email, array $mail){

    $eamil_err= explode('@', $email);
    $last = end($eamil_err);

    if (in_array($last, $mail)) {
        return true;
    } else {
        return false;
    }
    

  }
  /**
   * cell validation
   * [01, 8801, +8801 min length=11]
   */
  function numCheck($cell){
      $length= strlen($cell);
     if (substr($cell, 0, 2) =='01' && $length>10) {
          return true;
      }
      elseif (substr($cell, 0, 4) =='8801' && $length>12) {
        return true;
    }elseif (substr($cell, 0, 5) =='+8801' && $length>13) {
        return true;
    }else {
        return false;
    }
  }

  /**
   * file upload function
   */

  function file_upload($file, $path='/'){

    $file_name=time() . '_' . rand() . '_' . $file['name'];
    $file_tmp=   $file['tmp_name'];
    $file_size =   $file['size'];
    
    move_uploaded_file($file_tmp, $path . $file_name);
    return $file_name;
    }

  /**
   * old data manage
   */

   function old($name){

    if (isset($_POST[$name])) {
        echo $_POST[$name];
    } else {
        echo "";
    }
    

   }

   /**
    * data clear
    */
    function cleardata(){
        $_POST = "";
    }

    /**
     * password match checking
     */
    function passCheck($password, $cpassword){
        if ($password===$cpassword) {
            return true;
        } else {
            return  false;
        }
        

    }

    /**
     * converting hash password
     */
    function hash_pass($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    
    











?>
