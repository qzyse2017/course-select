<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<?php
include_once("database.php");

$course_name = $_POST["course_name"];    // 课程号
$course_no = $_POST["course_no"];
$up_limit = $_POST["up_limit"];          // 课程选课人数上限
$teacher_no = $_POST["teacher_no"];      // 教师工号
$checked=$_POST["checked"];
$available = $_POST["available"];                 
$subject=$_POST["subject"];
$year=$_POST["year"]; 
$TimeRange=$_POST["TimeRange"];
$break = "<br/>";


get_connection();
$check_sql="select * from instruct where instruct.course_no='$course_no'";
$check_result=mysql_query($check_sql);
$checked_result_num=mysql_num_rows($check_result);
$added_info=mysql_fetch_array($check_result);
$insert_instruct="insert into instruct values(null,'$teacher_no','$course_no')";
$insert_course="insert into course values('$course_no','$course_name',$up_limit,'$checked',$available,'$TimeRange','$subject','$year')"; 

//不存在同一课程号的课。添加
if($checked_result_num==0)
{
	//检查教师是否存在
	$check_teacher="select * from teacher where teacher_no='$teacher_no'";
	$check_teacher_result=mysql_query($check_teacher);
	$checked_teacher_num=mysql_num_rows($check_teacher_result);

	if($checked_teacher_num>0)//教师存在,可以插入这门课
	{
		mysql_query("BEGIN");
		$res0=mysql_query($insert_course);
		$res1=mysql_query($insert_instruct);
		if ($res0 && $res1)
		{
    		$message = "课程添加成功";
    		mysql_query("COMMIT");
		}
		else
		{
    		$message = "课程添加失败";
    		mysql_query("ROLLBACK");
		}
			close_connection();
			header("Location:index.php?message=$message");
		
	}
	else//教师不存在
	{
		echo "教师不存在，请先添加对应教师";
	}
}
//存在同一课程号的课
elseif($checked_result_num>0)
{
//检查教师是否存在
	$check_teacher="select * from teacher where teacher_no='$teacher_no'";
	$check_teacher_result=mysql_query($check_teacher);
	$checked_teacher_num=mysql_num_rows($check_teacher_result);
    $check_re="select * from instruct where instruct.teacher_no='$teacher_no' and instruct.course_no='$course_no'";
    $res=mysql_query("$check_re");
   
    $num=mysql_num_rows($res);
    if($num>0)
    {
    	echo "同一教师的相同课程已经添加，不可重复添加";
    	return;
    }    

	if($checked_teacher_num==0)//教师不存在
	{
		echo "教师不存在，请先添加对应教师啦";
	}
	elseif($checked_teacher_num>0)//教师存在,可以插入这门课
	{
		mysql_query($insert_course);
		mysql_query($insert_instruct);
		$affected_rows = mysql_affected_rows();
		close_connection();
		if ($affected_rows > 0)
    		echo "课程添加成功";
		else
    		{echo  "添加失败";}
		    echo " 注意这门课之前被其余教师注册过，默认此次添加行为是已添加的所有教师共同授课";
	}
}
?>