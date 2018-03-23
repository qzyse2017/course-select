<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php //此页面用于教师和管理员查看选课信息
include_once("permission.php");
include_once("database.php");
get_connection();   
$course_no = $_GET["course_no"];  

//如果是教师，检查该教师是不是这门课的老师   
if (is_teacher())
{
    $teacher_no = $_SESSION["account_no"];   // 从固有cookie中得到账号  
    $select_sql = "select course_no from instruct where course_no='$course_no' and teacher_no = '$teacher_no'";
    $result_set = mysql_query($select_sql);  
    if (mysql_num_rows($result_set) == 0)  
    {
        $message = "您不是任课教师！";  
        header("Location:index.php?message=$message");
        return;
    }
}

if (is_admin() || is_teacher())
{
    $sql = "select student.student_no,student_name,subject,year
            from choose,student
            where student.student_no=choose.student_no 
            and choose.course_no='$course_no'";
    $result_set = mysql_query($sql);
    $rows = mysql_num_rows($result_set);
    if ($rows == 0)
    {
        $message =  "这门课程暂无学生选修！";
        header("Location:index.php?message=$message");
        return;
    }
    else      // 显示一门课所有学生信息
    {
        
        echo "<table><tr> <th>学号</th> <th>学生姓名</th> <th>操作</th></tr>";
        while ($student_info = mysql_fetch_array($result_set))
        {
            echo "<tr>";
            $student_no = $student_info["student_no"]; 
            $student_name = $student_info["student_name"];
            echo "<td>" . $student_no . "</td>";
            echo "<td>" . $student_name . "</td>";
            echo "<td><a href='index.php?url=quit_course.php&student_no=$student_no&course_no=$course_no'>取消该学生的选课</a></td>"; 
            echo "</tr>";
        }
        echo "</table>";
    }    
    close_connection(); 
}
else
{
    $message = "您无权查看！";
    header("Location:index.php?message=$message");
    return;
}
?>
