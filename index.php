<?php
include("session.php");

if (isset($_POST['resetStudents'])) {
    // Loop through each student and unregister them from their courses
    foreach ($studentList->studentList as $student) {
        $courses = $student->getCourses();
        foreach ($courses as $course) {
            unset($course->grades[$student->id]); // Remove the entry from the grades array
        }
    }
    unset($studentList->studentList);
}

if (isset($_POST['resetCourses'])) {
    unset($courseList->coursesList);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Main Menu</title>
</head>
<body>
    <div class="container">
    <h1>Main Page</h1>
    <a href="addStudent.php">Add student</a><br><br>
    <a href="addCourse.php">Add Course</a><br><br>

    <a href="registerStudentToCourse.php">Register to courses</a><br><br>
    <a href="registerGradesForStd.php">Enter grades for Course</a><br><br>

    <a href="displayCourses.php">Display all courses</a><br><br>
    <a href="displayStudentsByCourse.php">Display all students by course</a><br><br>
    <a href="displayStudentsByClass.php">Display all students by class</a><br><br>
    <a href="displayGradesOfStd.php">Display grades of student</a><br><br>
    <a href="displaygradebycourse.php">Display grades by course</a><br><br>

    <form action="index.php" method="post">
        <button type="submit" name="resetStudents">Reset Students</button>
        <button type="submit" name="resetCourses">Reset Courses</button>
    </form>
    </div>
</body>
</html>