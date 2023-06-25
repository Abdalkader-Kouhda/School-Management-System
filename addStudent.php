<?php
include('session.php');

$studentList = $_SESSION['studentList'];

if (isset($_POST['addStudentbtn'])) {
    $id = $_POST['id'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $class = $_POST['class'];

    // Create a new Student object
    $student = new Student($id, $firstName, $lastName, $class);

    // Add the student to the student list
    $studentList->addStudent($student);

    // Update the session variable
    $_SESSION['studentList'] = $studentList;

    // Redirect back to the main page
    header('Location: main.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Student</title>
</head>
<body>
    <div class="container">
        <h2>Add Student</h2>
        <form method="post" action="save.php" class="grid-form">
            <label for="id">ID:</label>
            <input type="text" name="id" required>
            <label for="firstName">First Name:</label>
            <input type="text" name="firstName" required>
            <label for="lastName">Last Name:</label>
            <input type="text" name="lastName" required>
            <label for="class">Class:</label>
            <input type="text" name="class" required>
            <button type="submit" name="addStudentbtn">Add Student</button>
        </form>
    </div>
</body>
</html>
