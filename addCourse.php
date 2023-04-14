<?php
include('Save.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Add Course</title>
</head>
<body>
    <div class="container">
    <h2>Add Course</h2>
	<form method="post" action="index.php">
            <label for="id">ID
                <input type="text" name='id'/>
            </label
            ><br><br>
            <label for="Name">Name
                <input type="text" name='Name'/>
            </label><br><br>
        
            <input type="submit" value="Add Course" name='addCoursebtn'/>

        </form>
    </div>
</body>
</html>

