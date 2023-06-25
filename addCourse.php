<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Add Course</title>
</head>
<body>
    <div class="container">
        <h2>Add Course</h2>
        <form method="post" action="Save.php" class="grid-form">
            <label for="id">ID:</label>
            <input type="text" name="id" required>
            <label for="name">Name:</label>
            <input type="text" name="name" required>
            <button type="submit" name="addCoursebtn">Add Course</button>
        </form>
    </div>
</body>
</html>