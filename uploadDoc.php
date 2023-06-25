<?php
include('session.php');

// Back to the main menu if the back button is clicked
if (isset($_POST['back'])) {
    header('location:displayChapters.php?course=' . $_GET['course'] . '&chapter=' . $_GET['chapter']);
    exit;
}

// Add a document if the add button is clicked
if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $file = $_FILES['file'];

    // Check if file is valid
    if (empty($name) || empty($category) || empty($file)) {
        $errorMessage = "Please fill all required fields.";
    } else {
        $validTypes = array('pdf', 'mp4', 'avi', 'mov', 'wmv');
        $validSize = 50 * 1024 * 1024; // 50 MB
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($extension), $validTypes)) {
            $errorMessage = "Invalid file type. Only PDF and MP4 files are allowed.";
        } elseif ($file['size'] > $validSize) {
            $errorMessage = "File size exceeds the limit of 50 MB.";
        } else {
            $chapter = $courseList->getChapter($_GET['course'], $_GET['chapter']);
            if ($chapter) {
                $document = new Document($name, $category, $file['name'], $file['type'], $file['size'], $file['tmp_name']);
                $chapter->addDocument($document);
                $courseList->saveData();
                header('location:displayDocuments.php?course=' . $_GET['course'] . '&chapter=' . $_GET['chapter']);
                exit;
            } else {
                $errorMessage = "Chapter not found.";
            }
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Document</title>
</head>
<body>

<h2>Add Document</h2>

<?php if (isset($errorMessage)) { ?>
    <p style="color: red;"><?php echo $errorMessage; ?></p>
<?php } ?>

<form action="addDocument.php?course=<?php echo $_GET['course']; ?>&chapter=<?php echo $_GET['chapter']; ?>" method="post" enctype="multipart/form-data">
    <label for="name">Document Name:</label>
    <input type="text" name="name" id="name"><br><br>

    <label for="category">Category:</label>
    <select name="category" id="category">
        <option value="exercises">Exercises</option>
        <option value="solutions">Solutions</option>
        <option value="video_lecture">Video Lecture</option>
        <option value="pdf_lecture">PDF Lecture</option>
    </select><br><br>

    <label for="file">File:</label>
    <input type="file" name="file" id="file"><br><br>

    <input type="submit" value="Add" name="add">
</form>

<form action="displayDocuments.php?course=<?php echo $_GET['course']; ?>&chapter=<?php echo $_GET['chapter']; ?>" method="post">
    <input type="submit" value="Back" name="back">
</form>

</body>
</html>