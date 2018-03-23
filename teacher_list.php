<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

<?php
include_once("permission.php");
include_once("database.php"); 
get_connection();
if (is_admin())
{
    $sql="select * from teacher";
    $result_set = mysql_query($sql);
  
    $rows = mysql_num_rows($result_set);

    if ($rows == 0) 
    {
    echo "暂无教师注册";
    return;
    }
    elseif($rows>0)
    {
        echo
        "
        <table>
        <tr> 
        <th>工号</th>  <th>教师姓名</th> 
        </tr>
        ";


        //遍历结果集
        while ($teacher_info = mysql_fetch_array($result_set))    
        {
            echo "<tr>";
            $teacher_no = $teacher_info["teacher_no"];
            $teacher_name = $teacher_info["teacher_name"];
            echo "<td>" . $teacher_no . "</td>";
            echo "<td>". $teacher_name . "</td>";
            echo "</tr>";
        }
        
    }
    close_connection();
}
else
{
    echo "非管理员不可以查看";
    return;
}


?>

