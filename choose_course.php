<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/> 
<?php
include_once("permission.php");
include_once("database.php");

// 非学生不可以选课
if (!is_student())
{
    $message = "您无权选修课程！<br/>";
    header("Location:index.php?message=$message");
    return;
}
else
{
    $account_no = $_SESSION["account_no"];  
    $dest_course= $_GET["dest_course"]; 
    get_connection();  
    //检查是否已经选过这门课
    $check_have_course="select * from choose where course_no='$dest_course' and student_no='$account_no'";
    $have_res=mysql_query($check_have_course);
    $have_rows=mysql_num_rows($have_res);
    if($have_rows>0)
    {
         echo "您已经选过该课程，不可以重复选修";
         return;
    }

    //检查是否可选，即人数是否已满
    $check_available="select available from course where course_no='$dest_course'";
    $choose_c = "insert into choose values(null,'$account_no','$dest_course')";	
    $available_res=mysql_query($check_available);
    $available=mysql_fetch_array($available_res)["available"];
    $update_available="update course set available=available-1 where course_no='$dest_course'";

    if($available>0)//可选
    {
        mysql_query("BEGIN");
        $result=mysql_query($choose_c);
        $res_update=mysql_query($update_available);
        
        if($result && $res_update)
        {  
            $message="选课成功";
            mysql_query("COMMIT");
        }
        else
        {
            $message="选课失败";
            mysql_query("ROLLBACK");
        }
    }
    else// 人数已满，不可选
    {
        $message="人数已满，不可选";
    }
	close_connection();
    header("Location:index.php?message=$message");
}
?>

