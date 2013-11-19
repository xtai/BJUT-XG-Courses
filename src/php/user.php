<?php
  function login($username,$password){
    $M = new MySQL();
    if(!$M->con()){
      echo "Cannot connet to Database";
    }
    $sql = "SELECT * FROM users WHERE id = '$username' AND pwd = '$password';";
    $result = mysql_query($sql);
    $numrows = mysql_num_rows($result);
    if($numrows == 1){
      $row = mysql_fetch_assoc($result);
      $_SESSION['xg_name']=$row[name];
      $_SESSION[xg_id]=$row[id];
      return 1;
    }else{
      return 0;
    }
    $M->close_con();
  }
  function logout(){
    unset($_SESSION['xg_name']);
    unset($_SESSION[xg_id]);
  }
  function user(){
    if($_SESSION['xg_name']){
      return 1;
    }else{
      return 0;
    }
  }
  function password($new_password){
    $M = new MySQL();
    if(!$M->con()){
      echo "Cannot connet to Database";
    }
    mysql_query("UPDATE users SET pwd='$new_password' WHERE id='$_SESSION[id]';");
    $M->close_con();
  }
?>