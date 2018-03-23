<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 

<?php
include_once("permission.php");
include_once("database.php"); 
get_connection();
if (is_admin())
{
    $sql="select * from student";
    $result_set = mysql_query($sql);
   
    $rows = mysql_num_rows($result_set);

    if ($rows == 0) 
    {
    echo "暂无学生注册";
    return;
    }
    elseif($rows>0)
    {
        echo
        "
        <table>
        <tr> 
        <th>学号</th>  <th>学生姓名</th> <th>入学年</th> <th>专业</th>  
        </tr>
        ";


        //遍历结果集
        while ($student_info = mysql_fetch_array($result_set))    
        {
            echo "<tr>";
            $student_no = $student_info["student_no"];
            $student_name = $student_info["student_name"];
            $year=$student_info["year"];
            $subject=$student_info["subject"];
            echo "<td>" . $student_no . "</td>";
            echo "<td>". $student_name . "</td>";
            echo "<td>". $year . "</td>";
            echo "<td>". $subject . "</td>"; 
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

