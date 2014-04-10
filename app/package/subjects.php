<?php
  /**
  * Subject Class
  * code by Xiaoyu Tai, 2014-3-22 @Beijing.
  *
  * Private functions
  * . card() show single card based on options
  * . switch_type() I just don't like switch() function
  * . subject_info()
  * . enrollment_list()
  * . enrollment_list_class()
  */
  class Subject extends MySQL{
    private $path;
    private $temp;
    private $major;
    private $MySQL;
    public function __construct($MySQL, $path){
      $this->MySQL = $MySQL;
      $this->path  = $path;
    }
    public function cards($time, $type, $option){
      $this->major = substr($_SESSION['xg_id'],0,5);
      if($option == "all"){
        $mine   = false;
        $result = $this->MySQL->query("SELECT * FROM subjects_detail WHERE major ='".$this->major."' AND time = '".$time."' AND type = '".$type."' ORDER BY id;");
      }elseif($option == "mine"){
        $mine   = true;
        $result = $this->MySQL->query("SELECT * FROM selects_detail WHERE time = '".$time."' AND type = '".$type."' AND uid='".$_SESSION['xg_id']."' ORDER BY id;");
      }
      $type_num = $this->switch_type($type);
      $row_num  = mysql_num_rows($result);
      if($row_num == 0){
        echo "<div class=\"subjects\"><p style=\"text-align:center; font-weight:200; font-size: 16px; margin-top:18px; margin-bottom:16px;\">N/A</p></div>";
      }else{
        while($course = mysql_fetch_array($result)){
          $selected = mysql_num_rows($this->MySQL->query("SELECT * FROM selects WHERE uid = '$_SESSION[xg_id]' AND sid='$course[id]' LIMIT 1;"));
          $this->card($course['id'], $course['name'], $type_num, $course['enroll'], $course['exam'], $course['point'], $selected, $mine);
        }
      }
      return 1;
    }
    function sum_credits($type){
      $credits = 0;
      $result = $this->MySQL->query("SELECT * FROM selects_detail WHERE type = '".$type."' AND uid='".$_SESSION['xg_id']."' ORDER BY id;");
      while($course = mysql_fetch_array($result)){
        $credits += $course['point'];
      }
      return $credits;
    }
    //function subject is to display content, option can be 'all', 'list', and database table column names
    public function subject($id, $option){
      $result = $this->MySQL->query("SELECT * FROM subjects_detail WHERE id = '$id';");
      $course = mysql_fetch_array($result);
      if($option == "all"){
      //option 'all' stands for display course detial like type, way for exam
        $this->subject_info($course);
      }elseif($option == "list"){
      //option 'list' stands for dispaly course selected students list
        $this->enrollment_list($course);
      }else{
      //other options stand for dispaly course table column content
        if($option == "enroll" && $course['type'] == "必修"){
          return "51";
        }else{
          return $course[$option];
        }
      }
    }
    //for AJAX dealing with database
    public function ajax_change($id, $option){
      if($option == 'insert'){
        $this->MySQL->query("INSERT INTO selects (`uid`, `sid`) VALUES ('".$_SESSION['xg_id']."', '".$id."');");
        echo $this->have_course($id);
      }elseif($option == 'delete'){
        $this->MySQL->query("DELETE FROM selects WHERE `uid`='$_SESSION[xg_id]' and`sid`='$id';");
        echo !$this->have_course($id);
      }
    }
    public function have_course($id){
      $row_num = mysql_num_rows($this->MySQL->query("SELECT * FROM selects WHERE uid = '".$_SESSION['xg_id']."' AND sid = '".$id."';"));
      if($row_num){
        return 1;
      }else{
        return 0;
      }
    }
    private function card($id, $name, $type, $enroll, $exam, $point, $selected, $mine){
      echo "<div class=\"subjects type_".$type."";
      if($selected){
        echo " checked";
      }
      echo "\" id=\"".$id."\" onclick=\"change_val(".$id.",".$type.",".$point.")\" ><p style=\"font-weight:600; font-size: 18px; color:#D55;\">
      <a id=\"title".$id."\" onclick=\"avoid_val(".$id.",".$type.",".$point.");\" href=\"".$this->path."/subject.php?i=".$id."\">".$name."</a></p>
      <hr /><p style=\"text-align: right;\">";
      if($type == 1){
        echo "已选 51 人";
      }else{
        echo "已选 <span id=\"enroll_".$id."\">$enroll</span> 人";
      }
      echo " | ".$exam." | ".$point." 学分 | ";
      if($mine){
        echo "<strong>已选</strong>";
      }else{
        echo "<input id=\"box".$id."\" type=\"checkbox\" name=\"".$id."\" onclick=\"change_val_2(".$id.",".$type.",".$point.")\" ";
        if($selected){
          echo "checked=\"\" ";
        }elseif($type == 1){
          echo "disabled=\"\" checked=\"\" ";
        }
        echo"/>";
      }
      echo "</p></div>";
    }
    private function switch_type($type){
      switch($type){
        case "必修":          return 1;
        case "学科基础选修课":  return 2;  
        case "专业任选课":     return 3;
        case "专业限选课":     return 4;
        default:             return 0;
      }
    }
    private function subject_info($course){
      $type_num = $this->switch_type($course['type']);
      echo "<h4>课程ID: ".$course['id']."</h4><h4>学分: ".$course['point']."</h4><h4>课程性质: <span class=\"type_".$type_num."\">".$course['type']."</span></h4><h4>开课时间: ";
      switch($course['time']){
        case "5": echo "大三上"; break;
        case "6": echo "大三下"; break;  
        case "7": echo "大四上"; break;
        case "8": echo "大四下"; break;
        default:  echo "WTF?";  break;
      }
      echo "</h4><h4>考试形式: ".$course['exam']."</h4><h4>开课学院: ".$course['school']."</h4><h4>已选人数: ";
      if($type_num == 1){
        echo "51";
      }else{
        echo $course['enroll'];
      }
      echo "人</h4>";
      return 1;
    }
    private function enrollment_list($course){
      echo "<div class=\"row\">";
      $this->enrollment_list_class($course, "111101");
      $this->enrollment_list_class($course, "111102");
      echo "</div>";
      return 1;
    }
    private function enrollment_list_class($course, $class){
      if($course['type'] == "必修"){
        $result = $this->MySQL->query("SELECT id, name FROM users WHERE users.id LIKE '".$class."%';");
      }else{
        $result = $this->MySQL->query("SELECT selects.uid AS id, users.name AS name FROM selects JOIN users WHERE selects.uid=users.id AND selects.sid = '".$course['id']."' AND users.id LIKE '".$class."%';");
      }
      $enrollment_num = mysql_num_rows($result);
      echo "<div class=\"col-sm-6\"><h4>".$class."班</h4>";
      if($enrollment_num == 0){
        echo "<h5>没人选</h5>";
      }else{
        echo "<table class=\"table table-striped table-bordered\">
          <thead><tr><th>学号</th><th>姓名</th></tr></thead>
          <tbody>";
        while($student = mysql_fetch_array($result)){
          echo "<tr><td>".$student['id']."</td><td>".$student['name']."</td></tr>";
        }
        echo "</tbody></table>";
      }
      echo "</div>";
      return 1;
    }
  }
?>