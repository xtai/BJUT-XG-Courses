<?php
  /**
  * User Class
  * code by Xiaoyu Tai, 2014-3-22 @Beijing.
  *
  * Protected functions:
  * . __construct()
  * . login($username, $password, $type)
  * . logout()
  * . login_state()
  * . login_data()
  *
  * Private functions:
  * . md5_password($password)
  *   encrypt password
  * . is_legal($string)
  *   detect illegal inputs
  * . login_db($username, $password, $table)
  *   login and check with database
  */
  class User{
    private $MySQL;
    public function __construct($MySQL){
      $this->MySQL = $MySQL;
    }
    public function login($username, $password, $type){
      if($this->is_legal($username) && $this->is_legal($password)){
        return $this->login_db($username, $password, $type);
      }else{
        return 0;
      }
    }
    public function logout(){
      if($this->login_state()){
        unset($_SESSION['xg_type']);
        unset($_SESSION['xg_name']);
        unset($_SESSION['xg_id']);
        return 1;
      }else{
        return 0;
      }
    }
    public function change_password($new_password){
      if($this->login_state()){
        $new_password = $this->md5_password($new_password);
        $datetime = date('Y-m-d H:i:s');
        $this->MySQL->query("UPDATE ".$this->user_data('type')." SET pwd = '".$new_password."' WHERE id = '".$_SESSION['xg_id']."';");
        $this->MySQL->query("UPDATE ".$this->user_data('type')." SET lastpwdchange = '".$datetime."' WHERE id = '".$_SESSION['xg_id']."';");
        return 1;
      }else{
        return 0;
      }
    }
    public function login_state(){
      if(isset($_SESSION['xg_id'])){
        return 1;
      }else{
        return 0;
      }
    }
    public function user_data($x){
      if(isset($_SESSION['xg_id'])){
        if($x == "type" || $x == "id" || $x == "name"){
          return $_SESSION["xg_".$x];
        }
      }
    }
    private function md5_password($password){
      return md5($password . 'taixiaoyu');
    }
    private function is_legal($string){
      return !(strpbrk($string, '\'')||strpbrk($string, "\""));
      //if legal return 1 else 0
    }
    private function login_db($username, $password, $table){
      $password = $this->md5_password($password);
      $result = $this->MySQL->query("SELECT * FROM ".$table." WHERE id = '".$username."' AND pwd = '".$password."';");
      $row = mysql_fetch_array($result);
      $numrows = mysql_num_rows($result);
      if($numrows){
        //Setting last login time and adding login times.
        $datetime = date('Y-m-d H:i:s');
        $row['logintimes']++;
        $this->MySQL->query("UPDATE ".$table." SET lastlogin = '".$datetime."' WHERE id = '".$row['id']."';");
        $this->MySQL->query("UPDATE ".$table." SET logintimes = '".$row['logintimes']."' WHERE id = '".$row['id']."';");
        //Using sessions
        $_SESSION['xg_type'] = $table;
        $_SESSION['xg_name'] = $row['name'];
        $_SESSION['xg_id'] = $row['id'];
        return 1;
      }else{
        $_SESSION['xg_pwd'] = true;
        return 0;
      }
    }
  }
?>