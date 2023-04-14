<?php
// include the session file
include_once("session.php");

//back to main menu if back button is clicked
if(isset($_GET['back'])){
    header('location:index.php');
}
// check if class is set in the URL
if(isset($_GET['class'])){
    // get students by class using the studentList object
    $students = $studentList->getStudentByClass($_GET['class']);
    // get the current page number from the URL, set to 1 if not set
    $Cpage = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 1;
    // set the number of records to display per page
    $perpage = 3;
    // calculate the starting offset for the current page
    $offset  = ($Cpage - 1) * $perpage;

    // create a table to display student records
    echo "<table border=1>";
    echo "<th>Code</th>";
    echo "<th>Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Class</th>";

    // slice the students array to get the records for the current page
    $allStd = array_slice($students, $offset , $perpage);

    // display each student record in a table row
    foreach ($allStd as $key=>$value) {
        echo "<tr>";
        echo "<td>".$value->id."</td>";
        echo "<td>".$value->firstName."</td>";
        echo "<td>".$value->lastName."</td>";
        echo "<td>".$value->class."</td>";
        echo "</tr>";
    }

    // close the table tag
    echo "</table>";

    // calculate the total number of records and pages
    $count = count($students); //number of records
    $pages = ceil($count / $perpage);    //calculation of pages number

    // create pagination links for previous and next page
    if ($Cpage > 1) {
        $p = $Cpage - 1;
        echo '<p><a href="displayStudentFun.php?class='.$_GET['class'].'&page='.$p.'">previous</a>';
    }

    // display the current page number
    echo "     Current page :". $Cpage;

    if ($Cpage < $pages) {
        $p = $Cpage +1 ;
        echo '        <a href="displayStudentFun.php?class='.$_GET['class'].'&page='.$p.'">next</a></p>';
    }
}

//back button display
echo'<br>';
echo'<form action="displayStudentFun.php" method="get">';
echo '<input type="submit" value="back" name="back">';
echo '</form>'
?>

