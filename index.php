<?php
include("Save.php");

if(isset($_POST['resetStudents'])){
    unset($studentList->studentList);
}

if(isset($_POST['resetCourses'])){
    unset($courseList->CoursesList);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Main Menu</title>
</head>
<body>
    <a href="addStudent.php">Add student</a><br>
    <a href="displayStudentByClass.php">Display all students</a><br>
    <a href="addCourse.php">Add Course</a><br>
    <a href="displayCourses.php">Display all courses</a><br>
    <a href="registerStudentToCourse.php">register to courses</a><br>

    <br> <br>
    <form action="mainMenu.php" method="post">
        <input type="submit" value="reset Students" name="resetStudents">
        <input type="submit" value="reset Courses" name="resetCourses">

    </form>


</body>
</html>

