<?php
include('session.php');
$courses = $courseList->getAllCourses();

if (isset($_POST['back'])) {
    header('location:index.php');
    exit();
}

$selectedCourse = '';
$course = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedCourse = $_POST['courseID'];

    foreach ($courses as $con) {
        if ($con->getId() == $selectedCourse) {
            $course = $con;
            break;
        }
    }

    if ($course !== null) {
        $students = $studentList->getStudentsByCourse($selectedCourse);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Display Grades by Course</title>
</head>
<body>

<div class="container">
    <h1>Display Grades by Course</h1>
    <form method="POST" action="">
        <label for="class">Select a Course:</label>
        <select name="courseID" required>
            <?php
            foreach ($courses as $con) {
                echo '<option value="' . $con->getId() . '">' . $con->getName() . '</option>';
            }
            ?>
        </select>
        <br><br>
        <button type="submit"  name="show">Show</button>
        <button type="submit" name="back">Back to Main</button>
    </form>

    <?php
    if (isset($_POST['show'])) {
        if ($selectedCourse !== '') {
            if ($course !== null && isset($students)) {
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Grade</th>";
                echo "</tr>";

                $totalGrades = 0;
                $countGrades = 0;
                $minGrade = PHP_INT_MAX;
                $maxGrade = PHP_INT_MIN;

                foreach ($students as $student) {
                    $grade = $course->getGrade($student);
                    echo "<tr>";
                    echo "<td>{$student->getFirstName()} {$student->getLastName()}</td>";
                    echo "<td>" . ($grade !== null ? $grade : 'N/A') . "</td>";
                    echo "</tr>";

                    if ($grade !== null) {
                        $totalGrades += $grade;
                        $countGrades++;
                        $minGrade = min($minGrade, $grade);
                        $maxGrade = max($maxGrade, $grade);
                    }
                }

                if ($countGrades > 0) {
                    $averageGrade = $totalGrades / $countGrades;
                    echo "<tr>";
                    echo "<td>Average</td>";
                    echo "<td>$averageGrade</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Total</td>";
                    echo "<td>$totalGrades</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Minimum</td>";
                    echo "<td>$minGrade</td>";
                    echo "</tr>";

                    echo "<tr>";
                    echo "<td>Maximum</td>";
                    echo "<td>$maxGrade</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No students found for the selected course.</p>";
            }
        }
    }
    ?>
</div>
</body>
</html>