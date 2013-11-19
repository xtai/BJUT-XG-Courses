<?php
  function login($username, $password){
    $result = mysql_query("SELECT * FROM users WHERE id = '$username' AND pwd = '$password';");
    $row = mysql_fetch_array($result);
    $numrows = mysql_num_rows($result);
    if($numrows){
      $_SESSION['xg_name'] = $row['name'];
      $_SESSION['xg_id'] = $row['id'];
      return 1;
    }else{
      return 0;
    }
  }
  function logout(){
    unset($_SESSION['xg_name']);
    unset($_SESSION['xg_id']);
  }
  function user(){
    if(isset($_SESSION['xg_name'])){
      return 1;
    }else{
      return 0;
    }
  }
  function password($new_password){
    mysql_query("UPDATE users SET pwd='$new_password' WHERE id='$_SESSION[xg_id]';");
  }
?>