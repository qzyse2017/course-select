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
 
<form action="process_add_course.php" method="post">
课程号： <input type="text" name="course_no">
<br/>
课程名： <input type="text" name="course_name">
<br/>
上限：<input type="number" name="up_limit">
<br/>
工号：<input type="text" name="teacher_no" > 
<br/>
是否审核：<input type="text" name="checked" value="已审核" readonly="true">
<br/>
可选人数：(默认60)<input type=" number" name="available">
<br/>
时间范围：不同时间之间使用";"进行分隔，例如："一 3-4；二 6-8"
<input type=" text" name="TimeRange">
<br/>
专业：<input type="text" name="subject">
<br/>
可选学生年级：<input type="text" name="year">
<br/>
<input type="submit" value="添加课程"/> 
<input type="reset" value="重填"/>
</form>

