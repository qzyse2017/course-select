#course(course_no char(20),course_name char(20),up_limit int default 60,
#checked char(10),available int default 60,TimeRange char(20),subject char(20),
#year char(20) );
#course
insert into course values('COMP130005.01','代数结构与数理逻辑',85,'已审核',85,'一 3-4；三 3-4','计算机科学与技术','2015');
insert into course values('COMP130007.01','计算机原理',45,'已审核',45,'一 6-7；四 6-8','计算机科学与技术','2015');
insert into course values('COMP130010.01','数据库引论',45,'已审核',45,'三 6-8；五 3-4','计算机科学与技术','2015');
insert into course values('COMP130010.02','数据库引论',45,'已审核',45,'三 6-8；五 3-4','计算机科学与技术','2015');
insert into course values('COMP130010.03','数据库引论',30,'已审核',30,'一 11-12；三 6-8','计算机科学与技术','2015');
insert into course values('COMP130011.01','算法设计与分析',40,'已审核',40,'一 8-9；五 2-4','计算机科学与技术','2014');
insert into course values('COMP130011.02','算法设计与分析',35,'已审核',35,'一 8-9；四 6-8','计算机科学与技术','2014');
insert into course values('COMP130011.03','算法设计与分析',20,'已审核',20,'三 6-8；五 3-4','信息安全','2014');
insert into course values('COMP130012.01','计算机体系结构',35,'已审核',35,'四 6-8','计算机科学与技术','2014');
insert into course values('COMP130012.02','计算机体系结构',35,'已审核',35,'五 2-4','计算机科学与技术','2014');

#student & teacher 由于存在md5的加密过程，老师和学生信息在测试时的密码都设置为
#md5(1)所对应的"c4ca4238a0b923820dcc509a6f75849b"

# teacher(teacher_no char(10)  primary key,      
#  password char(32) ,
# teacher_name char(10)) ;
insert into teacher values('1','c4ca4238a0b923820dcc509a6f75849b','赵');
insert into teacher values('2','c4ca4238a0b923820dcc509a6f75849b','钱');
insert into teacher values('3','c4ca4238a0b923820dcc509a6f75849b','孙');
insert into teacher values('4','c4ca4238a0b923820dcc509a6f75849b','李');
insert into teacher values('5','c4ca4238a0b923820dcc509a6f75849b','周');
insert into teacher values('6','c4ca4238a0b923820dcc509a6f75849b','吴');
insert into teacher values('7','c4ca4238a0b923820dcc509a6f75849b','郑');
insert into teacher values('8','c4ca4238a0b923820dcc509a6f75849b','王');
insert into teacher values('9','c4ca4238a0b923820dcc509a6f75849b','郭');
insert into teacher values('10','c4ca4238a0b923820dcc509a6f75849b','刘');


#student(student_no char(11) not null primary key,
#password char(32),
#student_name char(10),
#year char(4),
#subject char(20)); 

insert into student values('1','c4ca4238a0b923820dcc509a6f75849b','a','2013','计算机科学与技术');
insert into student values('2','c4ca4238a0b923820dcc509a6f75849b','b','2014','计算机科学与技术');
insert into student values('3','c4ca4238a0b923820dcc509a6f75849b','c','2015','信息安全');

#instruct(instruct_no int auto_increment  primary key,
#teacher_no char(10) not null);

insert into instruct values('1','1','COMP130005.01');
insert into instruct values('2','2','COMP130007.01');
insert into instruct values('3','3','COMP130010.01');
insert into instruct values('4','4','COMP130010.02');
insert into instruct values('5','5','COMP130010.03');
insert into instruct values('6','6','COMP130011.01');
insert into instruct values('7','7','COMP130011.02');
insert into instruct values('8','8','COMP130011.03');
insert into instruct values('9','9','COMP130012.01');
insert into instruct values('10','10','COMP130012.02');


#show warnings;

