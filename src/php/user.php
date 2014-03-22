<?php
  function login($username, $password)
  {
    if(strpbrk($username, '\'')||strpbrk($password, '\'')||strpbrk($username, "\"")||strpbrk($password, "\"")){
      return 0;
    }
    else
    {
      $password = md5($password . 'taixiaoyu');
      $result = mysql_query("SELECT * FROM users WHERE id = '$username' AND pwd = '$password';");
      $row = mysql_fetch_array($result);
      $numrows = mysql_num_rows($result);
      if($numrows)
      {
        //Setting last login time and adding login times.
        $datetime = date('Y-m-d H:i:s');
        $row['logintimes']++;
        mysql_query("UPDATE users SET lastlogin = '$datetime' WHERE id = '$row[id]';");
        mysql_query("UPDATE users SET logintimes = '$row[logintimes]' WHERE id = '$row[id]';");
        //Using sessions
        $_SESSION['xg_name'] = $row['name'];
        $_SESSION['xg_id'] = $row['id'];
        return 1;
      }
      else
      {
        return 0;
      }
    }
  }
  function logout()
  {
    unset($_SESSION['xg_name']);
    unset($_SESSION['xg_id']);
  }
  function user()
  {
    if(isset($_SESSION['xg_name']))
    {
      return 1;
    }
    else
    {
      return 0;
    }
  }
  function password($new_password)
  {
    $new_password = md5($new_password . 'taixiaoyu');
    $datetime = date('Y-m-d H:i:s');
    mysql_query("UPDATE users SET pwd = '$new_password' WHERE id = '$_SESSION[xg_id]';");
    mysql_query("UPDATE users SET lastpwdchange = '$datetime' WHERE id = '$_SESSION[xg_id]';");
  }
?>