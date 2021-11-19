<?php
/**
 * email verify
 */
function authCheck($table, $col, $data){

    $users_data= connector()->query("SELECT * FROM {$table} WHERE {$col}='{$data}'");
    if ($users_data->num_rows==1) {
        return $users_data->fetch_object() ;
    } else {
        return false;
    }
    
}
/**
 * password verify
 */
function pass_verify($u_pass, $db_pass){
        if (password_verify($u_pass, $db_pass)==true) {
            return true;
        } else {
           return false;
        }
        
}


/**
 * user log check
 */
function user_log(){
    if (isset($_SESSION['id'])) {
        return true;
    } else {
        return false;
    }
    
}


?>