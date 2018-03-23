<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php
include_once("database.php");
$student_no = $_POST["student_no"];
$password = $_POST["password"];
$re_password = $_POST["re_password"];
$message = "";
if($password=="")
    {
        echo "添加失败,密码不可以为空";
        return;
    }
if ($password == $re_password)
{    
    $student_name = $_POST["student_name"];
    $year=$_POST["year"];
    $subject=$_POST["subject"];
    $insert_sql = "insert into student values('$student_no', md5('$password'), '$student_name','$year','$subject')";
    get_connection();
    mysql_query($insert_sql);
    $affected_rows = mysql_affected_rows();
    close_connection();
    if ($affected_rows > 0)
        $message = "学生添加成功";
    else
        $message = "学生添加失败";
}
else
    $message = "密码与确认密码不一致，注册失败！";
header("Location:index.php?message=$message"); 
?>
