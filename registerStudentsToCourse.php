<?php
include_once('session.php');

if (isset($_POST['Register'])) {
    $students = $studentList->getAllStudents();
    $courses = $courseList->getAllCourses();

    foreach ($students as $student) {
        foreach ($courses as $course) {
            $checkboxName = $student->getId() . "-" . $course->getId();
            if (isset($_POST[$checkboxName])) {
                $student->registerCourse($course);
            }
        }
    }
}

// Back to the main menu if the back button is clicked
if (isset($_POST['back'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Course Registration</title>
</head>
<body>
    <div class="left-container">
        <form method="post" action="registerStudentToCourse.php">
            <table>
                <tr>
                    <th>Student</th>
                    <?php
                    $courses = $courseList->getAllCourses();
                    foreach ($courses as $course) {
                        echo "<th>$course->getName()</th>";
                    }
                    ?>
                </tr>
                <?php
                $students = $studentList->getAllStudents();
                foreach ($students as $student) {
                    echo "<tr><td>" . $student->getFullName() . "</td>";
                    foreach ($courses as $course) {
                        $checkboxName = $student->getId() . "-" . $course->getId();
                        echo "<td><input type='checkbox' name='" . $checkboxName . "'></td>";
                    }
                    echo "</tr>";
                }
                ?>
            </table>
            <button type="submit" name="back">Back to main</button>
            <button type="submit" name="Register">Register</button>
        </form>
    </div>
    
    <div class="right-container">
        <?php
        echo "<table>";
        echo "<tr>";
        echo "<th>Student Name</th>";
        echo "<th>Registered Courses</th>";
        echo "</tr>";
        foreach ($students as $student) {
            $registeredCourses = $student->getCourses();
            echo "<tr>";
            echo "<td>" . $student->getFullName() . "</td>";
            if (count($registeredCourses) > 0) {
                echo "<td>";
                foreach ($registeredCourses as $course) {
                    echo $course->getName();
                    echo "<br>";
                }
                echo "</td>";
            } else {
                echo "<td>No registered courses for this student.</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
    </div>
</body>
</html>