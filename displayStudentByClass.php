<?php
include_once('session.php');

if(isset($_GET['back'])){
    header('location:index.php');
}
?>
<form action="displayStudentFun.php" method="get">
       <label for="">Class
            <input type="text"placeholder="enter a class name " name='class'>
            <input type="submit" value="display" >
        </label>
        <br>
     </form>
<form action="displayStudentByClass.php" method='get'>
<input type="submit" value="back" name='back'>

</form>
     
     
