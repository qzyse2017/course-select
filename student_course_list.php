<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php
include_once("database.php");
include_once("permission.php");
if (!is_student())
{
    $message = "您不是学生";
    header("Location:index.php?message=$message");
    return;
}
else
{
    $account_no = $_SESSION["account_no"];
    get_connection();
    $sql = "select course.course_no,course_name
            from choose,course
            where choose.course_no=course.course_no
            and choose.student_no='$account_no'";
    $result_set = mysql_query($sql);
    $rows = mysql_num_rows($result_set);
   
    if ($rows == 0)
    {
        $message = "您暂时没有选课";
        header("Location:index.php?message=$message");
        return;
    }
    else
    {
        echo "<table> <tr> <th>课号</th> <th>课程名</th> <th>操作</th> </tr>";
        while ($course_student = mysql_fetch_array($result_set))
        {
            echo "<tr>";
            $course_no = $course_student["course_no"];
            $course_name = $course_student["course_name"];
            echo "<td>" . $course_no . "</td>";
            echo "<td>" . $course_name . "</td>";
            echo "<td><a href='index.php?url=quit_course.php&course_no=$course_no'>取消选修该课程</a>";
            echo "</tr>";
        }
        echo "</table>";
    }
    close_connection();

}

?>

