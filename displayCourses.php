<?php
include('session.php');
$courses = $courseList->getAllCourses();

// Back to the main menu if the back button is clicked
if (isset($_POST['back'])) {
    header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Display Courses</title>
</head>
<body>

<div class="container">
    <form action='displayCourses.php' method="post">
        <?php
        echo '<table>';
        echo "<th>id</th>";
        echo "<th>name</th>";
        foreach ($courses as $course) {
            echo "<tr>";
            echo "<td>".$course->getId()."</td>";
            echo "<td>".$course->getName()."</td>";
            echo "</tr>";
        }
        echo '</table>';
        ?>
        <button type="submit" name="back">Back to Main</button>
    </form>
</div>
    
</body>
</html>