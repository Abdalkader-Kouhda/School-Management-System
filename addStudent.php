<?php
include('Save.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>studentAdd</title>
</head>
<body>
    <div class="container">
    <h2>Add Student</h2>
	<form method="post" action="index.php">
            <label for="id">ID
                <input type="text" name='id'/>
            </label
            ><br><br>
            <label for="firstName">First Name
                <input type="text" name='firstName'/>
            </label><br><br>
            <label for="lastName">Last Name
                <input type="text" name='lastName'/>
            </label><br><br>
            <label for="class">Class
                <input type="text" name='class'/>
            </label><br><br>
            <input type="submit" value="Add Student" name='addStudentbtn'/>

        </form>
    </div>
</body>
</html>

