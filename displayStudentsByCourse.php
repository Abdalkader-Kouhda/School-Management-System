<?php
include_once("session.php");

if (isset($_POST['back'])) {
    header('location:index.php');
}

$courses = $courseList->getAllCourses();

$students = [];
$Cpage = 1;
$perpage = 3;

if (isset($_GET['courseID'])) {
    $students = $studentList->getStudentsByCourse($_GET['courseID']);
    $Cpage = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="styles.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display students by course</title>
</head>
<body>
    <div class="container">
        <form action="" method="get">
            Choose a course:     
            <select name="courseID" required>
                <?php
                foreach ($courses as $con) {
                    $selected = isset($_GET['courseID']) && $_GET['courseID'] == $con->id ? 'selected' : '';
                    echo '<option value="' . $con->id . '" ' . $selected . '>' . $con->name . '</option>';
                }
                ?>
            </select>
            <br><br>
            <button type="submit">Display</button>
            <button type="submit" name="back">Back to main</button>
        </form>

        <?php
        if (!empty($students)) {
            echo "<table>";
            echo "<th>ID</th>";
            echo "<th>First Name</th>";
            echo "<th>Last Name</th>";

            $count = count($students);
            $pages = ceil($count / $perpage);
            $offset = ($Cpage - 1) * $perpage;

            $allStd = array_slice($students, $offset, $perpage);

            foreach ($allStd as $val) {
                echo "<tr>";    
                echo "<td>".$val->id."</td>";
                echo "<td>".$val->firstName."</td>";
                echo "<td>".$val->lastName."</td>";
                echo "</tr>";   
            }

            echo "</table>";

            if ($Cpage > 1) {
                $p = $Cpage - 1;
                echo '<p><a href="?courseID=' . $_GET['courseID'] . '&page=' . $p . '">previous</a>';
            }

            echo "Current page: " . $Cpage;

            if ($Cpage < $pages) {
                $p = $Cpage + 1;
                echo '<a href="?courseID=' . $_GET['courseID'] . '&page=' . $p . '">next</a></p>';
            }
        } else {
            echo "<p>No students found for the selected course.</p>";
        }
        ?>
    </div>    
</body>
</html>
