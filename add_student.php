<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php
include_once("permission.php");
?>	

<form action="process_add_student.php" method="post">
注意请务必填写姓名，学号，密码
<br/>
学生姓名： <input type="text" name="student_name">
<br/>
学号： <input type="text" name="student_no">
<br/>
请设置密码：<br/>
密码： <input type="text"  name="password"/> 
 <br/>
确认密码： <input type="text"  name="re_password"/> <br/>
入学年份：<input type="text"  name="year"/> <br/>
专业：<input type="text"  name="subject"/> 
<br/>
<input type="submit" value="注册"/> 
<input type="reset" value="重填"/>
</form>

