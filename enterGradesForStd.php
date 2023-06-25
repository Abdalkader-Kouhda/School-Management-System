<?php
include_once("session.php");

if (isset($_POST['back'])) {
    header('location:index.php');
}

?>

<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Register Grades</title>
</head>
<body>  
    <div class="container">
        <form action="registerGradesForStd.php" method="post">
            Choose a course:     
            <select name="courseID" required>
                <?php
                $courses = $courseList->getAllCourses();
                foreach ($courses as $con) {
                    echo '<option value="' . $con->id . '">' . $con->name . '</option>';
                }
                ?>
            </select>
            <button type="submit" name="back">Back</button>
            <button type="submit" name="display">Display</button>
        </form>

        <?php
        if (isset($_POST['display'])) {
            if (isset($_POST['courseID'])) {
                $students = $courseList->getStudentsByCourse($_POST['courseID']);

                echo "<form action='registerGradesForStd.php' method='post'>";
                echo "<table>
                    <tr>
                        <th>Student Name</th>
                        <th>Grade</th>
                    </tr>";

                foreach ($students as $student) {
                    echo "<tr>
                        <td>" . $student->getFullName() . "</td>
                        <td>
                            <input type='number' name='grade[" . $student->getId() . "]' min='0' max='100' placeholder='Enter grade' required>
                        </td>
                    </tr>";
                }

                echo "</table>";
                echo "<input type='hidden' name='courseID' value='" . $_POST['courseID'] . "'>";
                echo "<button type='submit' name='enter'>Enter</button>";
                echo "</form>";
            }
        }
        ?>


<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['enter']) && isset($_POST['courseID'])) {
        $courseId = $_POST['courseID'];
        $grades = $_POST['grade'];

        foreach ($grades as $studentId => $grade) {
            if (is_numeric($grade) && $grade >= 0 && $grade <= 100) {
                $student = $studentList->getStudentById($studentId);
                $course = $courseList->getCourseById($courseId);

                if ($student && $course) {
                    $course->registerGrade($student, $grade);
                }
            }
        }

        echo "Grades have been successfully registered for the specified students.";
    } else {
        echo "Invalid grades entered.";
    }
}
?>
    </div>
</body>
</html>
