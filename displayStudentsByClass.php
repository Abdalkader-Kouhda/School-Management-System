<?php
include('session.php');

if (isset($_POST['back'])) {
    header('location:index.php');
}

$selectedClass = '';
$filteredStudents = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $selectedClass = $_POST['class']; // Assuming you're using POST method

    // Filter the students based on the selected class
    foreach ($studentList->getAllStudents() as $student) {
        if ($student->getClass() === $selectedClass) {
            $filteredStudents[] = $student;
        }
    }
}

// Generate the array of unique classes
$allClasses = [];
foreach ($studentList->getAllStudents() as $student) {
    $class = $student->getClass();
    if (!in_array($class, $allClasses)) {
        $allClasses[] = $class;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="styles.css">
    <title>Display Students by Class</title>
</head>
<body>
   <div class="container">
        <h1>Display Students by Class</h1>

        <form method="POST" action="">
            <label for="class">Select a Class:</label>
            <select name="class" id="class" required>
                <?php
                // Iterate through each unique class and generate an option for the select element
                foreach ($allClasses as $class) {
                    $selected = ($class === $selectedClass) ? 'selected' : '';
                    echo "<option value=\"{$class}\" {$selected}>{$class}</option>";
                }
                ?>
            </select>
            <br><br>
            <button type="submit">Show Students</button>
            <button type="submit" name="back">Back to main</button>
        </form>

        <?php
        if ($selectedClass !== '') {
            if (!empty($filteredStudents)) {
                echo "<h2>Students in Class: $selectedClass</h2>";
                echo "<table border='1'>";
                echo "<tr>";
                echo "<th>ID</th>";
                echo "<th>Name</th>";
                echo "</tr>";

                foreach ($filteredStudents as $student) {
                    echo "<tr>";
                    echo "<td>{$student->id}</td>";
                    echo "<td>{$student->firstName} {$student->lastName}</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>No students found for the selected class.</p>";
            }
        }
        ?>
   </div>
</body>
</html>