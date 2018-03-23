<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php
include_once("permission.php");
include_once("database.php");

if (is_student() || is_teacher())
{
    get_connection();
    $course_no = $_GET["course_no"];
    if (isset($_GET["student_no"])) //老师操作
    {   
        $student_no = $_GET["student_no"];
        $teacher_no = $_SESSION["account_no"];
        $select_sql = "select course_no from instruct where course_no='$course_no' and teacher_no='$teacher_no'";
        $result_set = mysql_query($select_sql);
        if (mysql_num_rows($result_set) == 0)
        {
            $message = "您不是任课教师！";
            header("Location:index.php?message=$message");
            return;
        }
    } 
    else //学生操作 
    {
        $student_no = $_SESSION["account_no"];
    }

    // 删除已选课程
    $roll_num_back="update course set available=available+1 where course.course_no='$course_no'";
    $delete_course = "delete from choose where student_no='$student_no' and course_no='$course_no'";
    mysql_query("BEGIN");
    $res0=mysql_query($roll_num_back);
    $res1=mysql_query($delete_course);
    if ($res0 && $res1)
    {
        mysql_query("COMMIT");
        $message = "成功退选该课程！";
    }
    else
    {
        mysql_query("ROLLBACK");
        $message = "退选该课程失败！";
    }

    header("Location:index.php?message=$message");
    close_connection();
    return;
}
else
{
    $message = "您不是学生或者任课教师！";
    header("Location:index.php?message=$message");
    return;
}
?>

