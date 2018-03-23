<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php
include_once("database.php");
include_once("permission.php");

$account_no = $_SESSION["account_no"];      // 老师或管理员账号
$course_no = $_GET["course_no"];            // 课程号 

if (is_admin())  // 管理员
   { 
   		$sql = "delete from course where course_no = '$course_no'";
   		$instr="delete from instruct where course_no='$course_no'";
	}
else if (is_teacher())  // 教师 
  {
    $sql = "delete from course where course.course_no='$course_no' and checked='未审核'";
     $instr="delete from instruct where course_no='$course_no'";
  }
else            // 学生或其他人
{
    $message="您无权删除该课程！<br/>";
    header("Location:index.php?message=$message");
    return;
}

get_connection();
mysql_query("BEGIN");
$res1=mysql_query($instr);
$res0=mysql_query($sql);
//$eroor=mysql_error();
//echo "$eroor";
//return;
if ($res1 && $res0) 
{
    $message = "课程号为：" . $course_no . "的课程已经成功被删除";
    mysql_query("COMMIT");
}
else
{
    $message = "课程号为：" . $course_no . "的课程删除失败";
    mysql_query("ROLLBACK");
}
close_connection();
header("Location:index.php?message=$message"); 
?>
