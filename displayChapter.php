<?php
include('session.php');

// Back to main menu if back button is clicked
if (isset($_POST['back'])) {
    header('location: main.php');
    exit;
}

// Get course name from the GET parameter
if (!isset($_GET['course']) || empty($_GET['course'])) {
    header('location: displayCourses.php');
    exit;
} else {
    $courseName = $_GET['course'];
    $course = $courseList->getCourseByName($courseName);
    if ($course == null) {
        header('location: displayCourses.php');
        exit;
    } else {
        $chapters = $course->getChapters();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $courseName; ?> Chapters</title>
</head>
<body>

<h2><?php echo $courseName; ?> Chapters</h2>

<table border="1">
    <tr>
        <th>Chapter Name</th>
    </tr>
    <?php foreach ($chapters as $chapter) { ?>
        <tr>
            <td><a href="displayDocuments.php?course=<?php echo urlencode($courseName); ?>&chapter=<?php echo urlencode($chapter->name); ?>"><?php echo $chapter->name; ?></a></td>
        </tr>
    <?php } ?>
</table>

<form action='displayCourses.php' method="post">
    <input type="submit" value="Back" name="back">
</form>

</body>
</html>