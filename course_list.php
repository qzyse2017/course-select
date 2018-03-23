<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php
include_once("permission.php");
include_once("database.php"); 
get_connection();


if (!is_login() || is_student() || is_teacher())
{
    $sql = "select * from course_teacher_view where checked='已审核'";
}
else if (is_admin())
{
    $sql = "select * from course_teacher_view";
}

$result_set = mysql_query($sql);
$rows = mysql_num_rows($result_set);

if ($rows == 0) 
{
    echo "暂无课程记录";
    return;
}

echo
"
<table>
<tr> 
<th>课号</th>  <th>课程名</th> <th>人数上限</th> <th>任课教师</th> <th>可选人数</th> <th>课程状态</th> <th>操作</th>
</tr>
";


//遍历结果集
while ($course_teacher = mysql_fetch_array($result_set))
{
    echo "<tr>";
    $course_no = $course_teacher["course_no"];
    $course_name = $course_teacher["course_name"];
    echo "<td>" . $course_no . "</td>";
    echo "<td>". $course_name . "</td>";
    echo "<td>" . $course_teacher["up_limit"] . "</td>";
    echo "<td>" . $course_teacher["teacher_name"] . "</td>";
    echo "<td>" . $course_teacher["available"] . "</td>";
    echo "<td>" . $course_teacher["checked"] . "</td>";
    if (is_admin())
    {
        if ($course_teacher["checked"] == "未审核")  // 可删除 可通过
        {
            echo "<td bgcolor='#f0f0f0'><a href=index.php?url=check_course.php&course_no=$course_no>" . "通过审核" . "</a> <a href=index.php?url=delete_course.php&course_no=$course_no>" . "删除该课程" . "</a></td>";
        }
        elseif($course_teacher["checked"]=="已审核")       // 可查看 可取消
        {
            echo "<td><a href=index.php?url=quit_check_course.php&course_no=$course_no>" . "取消审核" . "</a> <a href=index.php?url=course_student_list.php&course_no=$course_no>" . "查看学生信息" . "</a></td>";
        }
        
    }
    elseif (is_student()) 
    {
        $account_no = $_SESSION["account_no"];
			
        echo "<td><a href='index.php?url=choose_course.php&dest_course=$course_no'>选修该课程</a></td>";
    }
    else
        echo "<td>暂时无法操作</td>";
    echo "</tr>";
}
close_connection();
?>

