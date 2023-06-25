<?php
include_once('session.php');

$courseList = $_SESSION['CourseList'];
$selectedCourse = null;

if (isset($_POST['courseName'])) {
    $selectedCourse = $courseList->getCourseByName($_POST['courseName']);
}

if (isset($_POST['deleteChapter'])) {
    $chapterToDelete = $_POST['deleteChapter'];
    if ($selectedCourse != null && $selectedCourse->chapterExists($chapterToDelete)) {
        $selectedCourse->deleteChapter($chapterToDelete);
        // Save the updated course list in the session
        $_SESSION['CourseList'] = $courseList;
    }
    header('Location: displayCourseByCh.php');
    exit;
}

if (isset($_POST['modifyChapter'])) {
    $chapterToModify = $_POST['modifyChapter'];
    $_SESSION['chapterToModify'] = $chapterToModify;
    if ($selectedCourse != null) {
        // Store the selected course ID to access it in the displayChapter.php
        $_SESSION['selectedCourseId'] = $selectedCourse->id;
        header("Location: displayChapter.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Course by Chapters</title>
</head>
<body>
    <h1>Select a course to display its chapters:</h1>
    <form method="post">
        <select name="courseName">
            <?php foreach ($courseList->getAllCourses() as $course): ?>
                <option value="<?php echo $course->name; ?>"
                    <?php if (isset($selectedCourse) && $selectedCourse->name == $course->name): ?>
                        selected
                    <?php endif; ?>
                ><?php echo $course->name; ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Display</button>
    </form>

    <?php if (isset($selectedCourse)): ?>
        <h2>Chapters for <?php echo $selectedCourse->name; ?>:</h2>
        <table border="1">
            <tr>
                <th>Chapter Name</th>
                <th>Delete</th>
                <th>Modify</th>
            </tr>
            <?php foreach ($selectedCourse->getChapters() as $chapter): ?>
                <tr>
                    <td><?php echo $chapter->name; ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Are you sure you want to delete this chapter?')">
                            <input type="hidden" name="deleteChapter" value="<?php echo $chapter->name; ?>">
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                    <td>
                        <form method="post">
                            <input type="hidden" name="modifyChapter" value="<?php echo $chapter->name; ?>">
                            <button type="submit">Modify</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>