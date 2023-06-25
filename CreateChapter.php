<?php
include('session.php');

$courses = $courseList->getAllCourses();

if (isset($_POST['submit'])) {
    $courseName = $_POST['course'];
    $chapterName = $_POST['chapter'];

    // Get the selected course
    $selectedCourse = $courseList->getCourseByName($courseName);

    // Check if the chapter name already exists in the selected course
    if ($selectedCourse->chapterExists($chapterName)) {
        echo "Chapter already exists.";
        exit();
    }

    // Add the new chapter to the selected course's chapter array
    $chapter = new Chapter($chapterName);
    $selectedCourse->addChapter($chapter);

    // Redirect back to the display_course_by_ch.php page
    header('Location: DisplayCourseByCh.php');
    exit();
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Chapter</title>
</head>
<body>
    <h1>Create Chapter</h1>
    <form method="post">
        <label for="course">Course:</label>
        <select name="course" id="course">
            <?php foreach ($courses as $course) { ?>
                <option value="<?php echo $course->name; ?>"><?php echo $course->name; ?></option>
            <?php } ?>
        </select>
        <br>
        <label for="chapter">Chapter Name:</label>
        <input type="text" name="chapter" id="chapter">
        <br>
        <input type="submit" name="submit" value="Create">
    </form>
</body>
</html>