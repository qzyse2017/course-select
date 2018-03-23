<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php
include_once("permission.php");
if (!is_admin())
{
    echo "此页面需要以管理员身份登陆！";
    return;
}
$account_no = $_SESSION["account_no"];
?>	
<form action="process_add_student.php" method="post">
学生姓名： <input type="text" name="student_name">
<br/>
学号： <input type="text" name="student_no">
<br/>
添加学生需要为其设置密码：<br/>
密码： <input type="text"  name="password"/> <br/>
确认密码： <input type="text"  name="re_password"/> <br/>
入学年份：<input type="text"  name="year"/> <br/>
专业：<input type="text"  name="subject"/> 
<br/>
<input type="submit" value="添加学生"/> 
<input type="reset" value="重填"/>
</form>

