<?php
include('session.php');
$courses=$courseList->getAllCourses();
//back to main menu if back button is clicked
if(isset($_POST['back'])){
    header('location:index.php');
}?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form action='displayCourses.php' method="post">
    <?php
echo '<table border=1>';
echo "<th>id</th>";
echo "<th>name</th>";
foreach($courses as $con){
    echo "<tr>";
 echo "<td>".$con->id."</td>";
 echo '<td>'.$con->Name.'</td>';
 echo "</tr>";

}

echo '</table>';
?>
<input type="submit" value="back" name="back">
</form>
    
</body>
</html>