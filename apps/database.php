<?php 
 /**
  * database connection
  */
  function connector(){
      return new mysqli(HOST, USER, PASS, DB);
  }

  /**
   * data create
   */
  function create($sql){
     connector()-> query($sql);
  }

  /**
   * data show
   */
  function all($table){
    return connector()->query("SELECT * FROM {$table}");
  }

  /**
   * check data exits
   */
function data_exists($table, $col, $val){
  $data= connector()->query("SELECT * FROM {$table} WHERE {$col} = '{$val}'");
  if ($data->num_rows>0) {
    return false;
  } else {
    return true;
  }
  
}


function loginuserdata($table, $id){
      $loginuserdata= connector()->query("SELECT * FROM {$table} WHERE id='{$id}'");
      return $loginuserdata->fetch_object();
}


?>