<?php
include_once('Classes.php');
session_start();

if(!isset($_SESSION['studentList']))
    {$_SESSION['studentList']=new StudentListClass();}
    $studentList =$_SESSION['studentList'];

    if(!isset($_SESSION['CourseList']))
    {$_SESSION['CourseList']=new CoursetListClass();}
    $courseList =$_SESSION['CourseList'];
?>

