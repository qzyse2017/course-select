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
<form action="process_add_teacher.php" method="post">
教师姓名： <input type="text" name="teacher_name">
<br/>
工号： <input type="text" name="teacher_no">
<br/>
添加教师需要为其设置密码：<br/>
密码： <input type="text"  name="password"/> <br/>
确认密码： <input type="text"  name="re_password"/> <br/>
<br/>
<input type="submit" value="添加教师"/> 
<input type="reset" value="重填"/>
</form>

