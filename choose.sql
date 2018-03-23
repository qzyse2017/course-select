
set character_set_database = utf8;
set character_set_server = utf8;
set character_set_client = utf8;
set character_set_connection = utf8;
set character_set_results = gbk;

drop database if exists choose;
create database choose default character set utf8 collate utf8_unicode_ci; 
show databases;
use choose;

drop table if exists admin; 
create table admin /*admin table*/
(
    admin_no char(10)  not null primary key,
    password char(32) not null,
    admin_name char(20) character set utf8 collate utf8_unicode_ci not null
) character set utf8 collate utf8_unicode_ci;
insert into admin values('admin', md5('admin'), 'administrator');/*default admin*/
show tables;


drop table if exists  teacher; 
create table teacher  /*teacher table*/
( 
    teacher_no char(10)  primary key,      
    password char(32) character set utf8 collate utf8_unicode_ci not null,
    teacher_name char(10)  character set utf8 collate utf8_unicode_ci not null 
    ) engine = InnoDB default character set utf8 collate utf8_unicode_ci;
show tables;


drop table if exists course; 
create table course  /*course table*/
(
    course_no char(20)  not null primary key,
    course_name char(20) character set utf8 collate utf8_unicode_ci not null,        
    up_limit int default 60,
    checked char(10)  character set utf8 collate utf8_unicode_ci default '未审核' ,
    available int default 60 ,
    TimeRange char(20)  character set utf8 collate utf8_unicode_ci not null,/*上课时间*/
    subject char(20)  character set utf8 collate utf8_unicode_ci not null,
    year char(20)  character set utf8 collate utf8_unicode_ci not null
) engine = InnoDB  default character set utf8 collate utf8_unicode_ci;
show tables;


drop table if exists student;
create table student            /*student table*/ 
(
    student_no char(11) not null primary key,
    password char(32) character set utf8 collate utf8_unicode_ci not null,
    student_name char(10) character set utf8 collate utf8_unicode_ci not null,
    year char(4) character set  utf8 collate utf8_unicode_ci not null,
    subject char(20) character set  utf8 collate utf8_unicode_ci not null
) engine = InnoDB  default character set utf8 collate utf8_unicode_ci;
show tables;


drop table if exists choose; 
create table choose              /*course & student*/
(   
    choose_no int auto_increment  primary key,
    student_no char(11) not null,
    course_no char(20)  not null,
    constraint choose_student_fk foreign key(student_no) references student(student_no),
    constraint choose_course_fk foreign  key(course_no) references course(course_no)
) engine = InnoDB  default character set utf8 collate utf8_unicode_ci;
show tables;


drop table if exists instruct; 
create table instruct              /*course & teacher*/
(   
    instruct_no int auto_increment  primary key,
    teacher_no char(10) not null,
    course_no char(20) not null,
    constraint choose_teacher_fk foreign key(teacher_no) references teacher(teacher_no),
    constraint choose_instr_course_fk foreign  key(course_no) references course(course_no)
) engine = InnoDB  default character set utf8 collate utf8_unicode_ci;
show tables;



drop view if exists course_teacher_view; 
create view course_teacher_view as
select course.course_no, course_name, up_limit,TimeRange, teacher.teacher_no, teacher_name, available, checked 
from course,instruct,teacher 
where instruct.teacher_no=teacher.teacher_no and instruct.course_no=course.course_no;
show tables;







