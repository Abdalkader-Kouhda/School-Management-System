<?php
include('initSession.php');

// Back to main menu if back button is clicked
if (isset($_POST['back'])) {
    header('location:display_chapters.php?course='.$_GET['course']);
    exit;
}

// Get course and chapter names from the GET parameter
if (!isset($_GET['course']) || empty($_GET['course']) || !isset($_GET['chapter']) || empty($_GET['chapter'])) {
    header('location:display_courses.php');
    exit;
} else {
    $courseName = $_GET['course'];
    $chapterName = $_GET['chapter'];
    $course = $courseList->getCourseByName($courseName);
    if ($course == null) {
        header('location:display_courses.php');
        exit;
    } else {
        $chapter = $course->getChapterByName($chapterName);
        if ($chapter == null) {
            header('location:display_chapters.php?course='.$courseName);
            exit;
        } else {
            $documents = $chapter->getDocuments();
        }
    }
}

// Delete document if delete button is clicked
if (isset($_POST['delete'])) {
    $documentName = $_POST['document_name'];
    $chapter->deleteDocumentByName($documentName);
    header('location:display_documents.php?course='.$courseName.'&chapter='.$chapterName);
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $chapterName; ?> Documents</title>
</head>
<body>

<h2><?php echo $chapterName; ?> Documents</h2>

<table border="1">
    <tr>
        <th>Document Name</th>
        <th>Delete</th>
        <th>Modify</th>
    </tr>
    <?php foreach ($documents as $document) { ?>
        <tr>
            <td><?php echo $document->name; ?></td>
            <td>
                <form method="post" onsubmit="return confirm('Are you sure you want to delete <?php echo $document->name; ?>?')">
                    <input type="hidden" name="document_name" value="<?php echo $document->name; ?>">
                    <input type="hidden" name="delete" value="delete">
                    <button type="submit">Delete</button>
                </form>
            </td>
            <td>
                <a href="modify_document.php?course=<?php echo $courseName; ?>&chapter=<?php echo $chapterName; ?>&document=<?php echo $document->name; ?>">Modify</a>
            </td>
        </tr>
    <?php } ?>
</table>

<form action='add_document.php' method="get">
    <input type="hidden" name="course" value="<?php echo $courseName; ?>">
    <input type="hidden" name="chapter" value="<?php echo $chapterName; ?>">
    <input type="submit" value="Add">
</form>

<form action='display_chapters.php?course=<?php echo $courseName; ?>' method="post">
    <input type="submit" value="Back" name="back">
</form>

</body>
</html>