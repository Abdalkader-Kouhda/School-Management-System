<?php
include('session.php');

if (isset($_POST['back'])) {
    header('location:index.php');
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Display Grades of a Student</title>
</head>
<body>  
    <div class="container">
        <h1>Display grades of student</h1>
        <form method="post" action="displayGradesOfStd.php">
            <label for="id">Student ID</label>
            <input type="text" name="id" required><br><br>
            <button type="submit" name="display">Display grades</button>
        </form>
        <form method="post">
            <button type="submit" name="back">Back to main</button>
        </form>

        <?php
        if (isset($_POST['display']) && isset($_POST['id'])) {
            $studentId = $_POST['id'];
            $student = $studentList->getStudentById($studentId);

            if ($student) {
                $courses = $student->getCourses();
                $grades = [];
                echo "<table border='1'>";
                echo "<tr><th>Course</th><th>Grade</th></tr>";

                foreach ($courses as $course) {
                    $grade = $course->getGradeByStudent($student);
                    if ($grade !== null) {
                        echo "<tr><td>{$course->getName()}</td><td>$grade</td></tr>";
                        $grades[] = $grade;
                    }
                }

                $totalGrades = array_sum($grades);
                $averageGrade = count($grades) > 0 ? round($totalGrades / count($grades), 2) : 0;
                $minimumGrade = count($grades) > 0 ? min($grades) : 0;
                $maximumGrade = count($grades) > 0 ? max($grades) : 0;

                echo "<tr><td><strong>Total</strong></td><td>$totalGrades</td></tr>";
                echo "<tr><td><strong>Average</strong></td><td>$averageGrade</td></tr>";
                echo "<tr><td><strong>Minimum</strong></td><td>$minimumGrade</td></tr>";
                echo "<tr><td><strong>Maximum</strong></td><td>$maximumGrade</td></tr>";

                echo "</table>";
            } else {
                echo "Student not found.";
            }
        }
        ?>
    </div>
</body>
</html>
