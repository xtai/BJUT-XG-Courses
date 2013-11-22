<?php
  //for home.php dispaly each course and if it selected or not
  function cards($time, $type, $option)
  {
    global $page_path;
    $type_num;
    $num = 0;
    if($option == "all")
    {
      $result = mysql_query("SELECT * FROM subjects_detail WHERE time = '$time' AND type = '$type' ORDER BY id;");
    }
    else
    {
      $result = mysql_query("SELECT * FROM selects_detail WHERE time = '$time' AND type = '$type' AND uid='$_SESSION[xg_id]' ORDER BY id;");
    }
    $numrows = mysql_num_rows($result);
    if($numrows == 0)
    {
      echo "<p style=\"text-align:center; font-weight:200; font-size: 16px;\">N/A</p>";
      if($time == "7"){
        echo "<br />";
      }
    }
    else
    {
      switch($type)
      {
        case "必修":
          $type_num = 1;
          break;
        case "学科基础选修课":
          $type_num = 2;
          break;  
        case "专业任选课":
          $type_num = 3;
          break;
        case "专业限选课":
          $type_num = 4;
          break;
        default:
          $type_num = 0;
          break;
      }
      while($row = mysql_fetch_array($result))
      {
        if($option == "all")
        {
          $numrows2 = mysql_num_rows(mysql_query("SELECT * FROM selects WHERE uid = '$_SESSION[xg_id]' AND sid='$row[id]' LIMIT 1;"));
          echo "<div class=\"subjects type_$type_num";
          if($numrows2 == 1)
          {
            echo " checked";
          }
          echo "\" id=\"$row[id]\" onclick=\"change_val($row[id],$type_num,$row[point])\" >
          <p style=\"font-weight:600; font-size: 18px; color:#D55;\"><a id=\"title$row[id]\" onclick=\"avoid_val($row[id],$type_num,$row[point]);\" href=\"$page_path/view/subject.php?i=$row[id]\">$row[name]</a></p>
          <hr />
          <p style=\"text-align: right;\">$row[exam] | $row[point] 学分</p>
          <p style=\"text-align: right;\">";
          if($type == "必修")
          {
            echo "已选: 51人";
          }
          else
          {
            echo "已选: <span id=\"enroll_$row[id]\">$row[enroll]</span>人";
          }
          echo " | <strong>选这门课</strong> <input id=\"box$row[id]\" type=\"checkbox\" name=\"$row[id]\" onclick=\"change_val_2($row[id],$type_num,$row[point])\" ";
          if($numrows2 == 1)
          {
            echo "checked=\"\" ";
            $num+=$row['point'];
          }
          if($type == "必修")
          {
            echo "disabled=\"\" checked=\"\" ";
          }
          echo"/></p></div>";
        }
        elseif($option == "mine")
        {
          $num+=$row['point'];
          echo "<div class=\"subjects type_$type_num checked\" id=\"$row[id]\">
                <p style=\"font-weight:600; font-size: 18px; color:#D55;\"><a id=\"title$row[id]\" href=\"$page_path/view/subject.php?i=$row[id]\">$row[name]</a></p>
                <hr />
                <p style=\"text-align: right;\">$row[exam] | $row[point] 学分</p>
                <p style=\"text-align: right;\">已选: ";
          if($type == "必修")
          {
            echo "51";
          }
          else
          {
            echo "<span id=\"enroll_$row[id]\">$row[enroll]</span>";
          }
          echo "人 | <strong>已选这门课</strong></p></div>";
        }
      }
      return $num;
    }
  }
  //for subject.php to display content, option can be 'all', 'list', and database table column name
  function subject($id, $option)
  {
    $result = mysql_query("SELECT * FROM subjects_detail WHERE id = '$id';");
    $row = mysql_fetch_array($result);
    //option 'all' stands for display course detial like type, way for exam
    if($option == "all")
    {
      $type_num;
      switch($row['type'])
      {
        case "必修":
          $type_num = 0;
          break;
        case "学科基础选修课":
          $type_num = 1;
          break;  
        case "专业任选课":
          $type_num = 2;
          break;
        case "专业限选课":
          $type_num = 3;
          break;
        default:
          $type_num = 0;
          break;
      }
      echo "
      <h4>课程ID: $row[id]</h4>
      <h4>学分: $row[point]</h4>
      <h4>课程性质: <span class=\"type_$type_num\">$row[type]</span></h4>
      <h4>开课时间: ";
      switch($row['time'])
      {
        case "5":
          echo "大三上";
          break;
        case "6":
          echo "大三下";
          break;  
        case "7":
          echo "大四上";
          break;
        case "8":
          echo "大四下";
          break;
        default:
          echo "WTF?";
          break;
      }
      echo "</h4>
      <h4>考试形式: $row[exam]</h4>
      <h4>开课学院:  $row[school]</h4>
      <h4>已选人数: ";
      if($row['type'] == "必修")
      {
        echo "51";
      }
      else
      {
        echo "$row[enroll]";
      }
      echo "人</h4>";
      return;
    }
    elseif($option == "list")
    {//option 'list' stands for dispaly course selected students list
      if($row['type'] == "必修")
      {
        $result1 = mysql_query("SELECT id, name FROM users WHERE users.id LIKE '111101%';");
        $numrows1 = mysql_num_rows($result1);
        $result2 = mysql_query("SELECT id, name FROM users WHERE users.id LIKE '111102%';");
        $numrows2 = mysql_num_rows($result2);
      }
      else
      {
        $result1 = mysql_query("SELECT selects.uid AS id, users.name AS name FROM selects JOIN users WHERE selects.uid=users.id AND selects.sid = '$id' AND users.id LIKE '111101%';");
        $numrows1 = mysql_num_rows($result1);
        $result2 = mysql_query("SELECT selects.uid AS id, users.name AS name FROM selects JOIN users WHERE selects.uid=users.id AND selects.sid = '$id' AND users.id LIKE '111102%';");
        $numrows2 = mysql_num_rows($result2);
      }
      echo "<div class=\"row\">
        <div class=\"col-sm-6\">
          <h4>111101班</h4>";
      if($numrows1 == 0){
        echo "<h5>没人选</h5>";
      }
      else
      {
        echo "
          <table class=\"table table-striped table-bordered\">
            <thead>
              <tr>
                <th>学号</th>
                <th>姓名</th>
              </tr>
            </thead>
            <tbody>";
        while($row1 = mysql_fetch_array($result1))
        {
          echo "<tr><td>$row1[id]</td><td>$row1[name]</td></tr>";
        }
        echo "</tbody>
          </table>";
      }
      echo "</div>
        <div class=\"col-sm-6\">
          <h4>111102班</h4>";
      if($numrows2 == 0)
      {
        echo "<h5>没人选</h5>";
      }
      else
      {
        echo "<table class=\"table table-striped table-bordered\">
            <thead>
              <tr>
                <th>学号</th>
                <th>姓名</th>
              </tr>
            </thead>
            <tbody>";
            while($row2 = mysql_fetch_array($result2))
            {
              echo "<tr><td>$row2[id]</td><td>$row2[name]</td></tr>";
            }
            echo "</tbody>
          </table>";
      }
      echo "</div>
      </div>";
      return;
    }
    //other options stand for dispaly course table column content
    else
    {
      if($option == "enroll" && $row[type] == "必修")
      {
        return "51";
      }
      else
      {
        return $row[$option];
      }
    }
  }
  //for AJAX dealing with database
  function ajax_change($id, $option)
  {
    if($option == 'insert')
    {
      mysql_query("INSERT INTO selects (`uid`, `sid`) VALUES ('$_SESSION[xg_id]', '$id');");
      $numrows = mysql_num_rows(mysql_query("SELECT * FROM selects WHERE uid = '$_SESSION[xg_id]' AND sid = '$id';"));
      if($numrows)
      {
        return 1;
      }
      else
      {
        return 0;
      }
    }
    elseif($option == 'delete')
    {
      mysql_query("DELETE FROM selects WHERE `uid`='$_SESSION[xg_id]' and`sid`='$id';");
      $numrows = mysql_num_rows(mysql_query("SELECT * FROM selects WHERE uid = '$_SESSION[xg_id]' AND sid = '$id';"));
      if($numrows)
      {
        return 0;
      }
      else
      {
        return 1;
      }
    }
  }
?>