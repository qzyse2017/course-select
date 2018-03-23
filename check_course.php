<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php
include_once("database.php");
include_once("permission.php");
if (!is_admin())
{
    $message = "您无权审核课程<br/>";
    header("Location:index.php?message=$message");
    return;
}
else
{
    $course_no = $_GET["course_no"]; 
	//echo $course_no; 
    $sql = "update course set checked='已审核' where course_no='$course_no' and checked='未审核'";
    get_connection();
    mysql_query($sql);
    $affected_rows = mysql_affected_rows();
    close_connection();
    if ($affected_rows > 0)
        $message = "课程号为：" . $course_no . "的课程已经成功审核！";
    else
        $message = "课程号为：" . $course_no . "的课程审核失败！";       
}
header("Location:index.php?message=$message");
?>
