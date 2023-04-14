<?php
include_once('session.php');

if (isset($_POST['Register'])) {
    $students = $studentList->getAllStudents();
    $courses = $courseList->getAllCourses();

    foreach ($students as $student) {
        foreach ($courses as $course) {
            $checkboxName = $student->id . "-" . $course->id;
            if (isset($_POST[$checkboxName])) {
                $student->registerCourse($course);
            }
        }
    }
}

//back to main menu if back button is clicked
if(isset($_POST['back'])){
    header('location:index.php');
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Course Registration</title>
</head>
<body>
<form method="post" action="registerStudentToCourse.php">
    <table border="1">
        <tr>
            <th>Student</th>
            <?php
            $courses = $courseList->getAllCourses();
            foreach ($courses as $course) {
                echo "<th>$course->Name</th>";
            }
            ?>
        </tr>
        <?php
        $students = $studentList->getAllStudents();
        foreach ($students as $student) {
            echo "<tr><td>" . $student->firstName . " " . $student->lastName . "</td>";
            foreach ($courses as $course) {
                $checkboxName = $student->id . "-" . $course->id;
                echo "<td><input type='checkbox' name='" . $checkboxName . "'></td>";
            }
            echo "</tr>";
        }
        ?>
    </table>
	<input type="submit" value="back" name="back">

    <input type="submit" value="Register" name="Register">
</form>

<?php
echo "<table border='1'>";
echo "<tr>";
echo "<th>Student Name</th>";
echo "<th>Registered Courses</th>";
echo "</tr>";
foreach ($students as $student) {
	$registeredCourses = $student->getCourses();
	echo "<tr>";
	echo "<td>" . $student->firstName . " " . $student->lastName . "</td>";
	if (count($registeredCourses) > 0) {
		echo "<td>";
		// echo "<ul>";
		foreach ($registeredCourses as $course) {
			echo $course->Name;
			echo "<br>";
		}
		// echo "</ul>";
		echo "</td>";
	} else {
		echo "<td>No registered courses for this student.</td>";
	}
	echo "</tr>";
}

echo "</table>";

?>
</body>
</html>
