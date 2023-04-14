<?php
include('session.php');
if (isset($_POST['addStudentbtn'])){
	if (!empty($_POST['firstName']) &&  !empty($_POST['lastName']) &&  !empty($_POST['id'] &&  !empty($_POST['class'])))
	{
		$student = new Student($_POST['id'],$_POST['firstName'],$_POST['lastName'], $_POST['class']);
		$studentList->studentList[]=$student;
	}			
}

if (isset($_POST['addCoursebtn'])){
	if (!empty($_POST['id']) &&  !empty($_POST['Name']))
	{
		$course = new Course($_POST['id'],$_POST['Name']);
		$courseList->CoursesList[]=$course;
	}			
}
?> 

