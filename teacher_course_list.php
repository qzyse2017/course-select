<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php
include_once("database.php");
include_once("permission.php");
if (!is_teacher())
{
    $message = "您不是教师";
    header("Location:index.php?message=$message");
    return;
}
else
{
    $account_no = $_SESSION["account_no"];
    get_connection();  
    $sql = " select course.course_no,course_name, teacher_name, checked
    from teacher,course,instruct 
    where teacher.teacher_no=instruct.teacher_no 
    and instruct.course_no=course.course_no 
    and teacher.teacher_no='$account_no'";
    $result_set = mysql_query($sql);
    $rows = mysql_affected_rows();
   
    if ($rows == 0)
    {
        $message = "您暂时没有申报课程";
        header("Location:index.php?message=$message");
        return;
    }
    else
    { 
        echo "<table><tr> <th>课号</th> <th>课程名</th> <th>操作</th> </tr>";
        while ($course_teacher = mysql_fetch_array($result_set))
        {
            echo "<tr>";  
            $course_no = $course_teacher["course_no"];
            $course_name = $course_teacher["course_name"];
            $checked=$course_teacher["checked"];
            echo "<td>" . $course_no . "</td>";
            echo "<td>".$course_name."</td>";
            echo "<td>" . $checked . "</td>";
            if ($checked == "未审核")
                echo "<td><a href='index.php?url=delete_course.php&course_no=$course_no'>删除该课程</a></td>";
            else
                echo "<td><a href='index.php?url=course_student_list.php&course_no=$course_no'>查看学生信息</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    close_connection();
}
?>
