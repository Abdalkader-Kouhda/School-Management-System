<?php
include('session.php');

function isStudentIdExists($id, $studentList) {
    foreach ($studentList as $student) {
        if ($student->getId() == $id) {
            return true;
        }
    }
    return false;
}

if (isset($_POST['addStudentbtn'])) {
    if (!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['id']) && !empty($_POST['class'])) {
        $studentId = $_POST['id'];
        
        // Check if student ID already exists
        if (isStudentIdExists($studentId, $studentList->getStudentList())) {
            echo "Student with ID $studentId already exists.";
        } else {
            $student = new Student($studentId, $_POST['firstName'], $_POST['lastName'], $_POST['class']);
            $studentList->addStudent($student);
            echo "Student added successfully.";
        }
    } else {
        echo "Please provide all the required information for adding a student.";
    }
    echo '<br><br>';
    echo '<a href="addStudent.php"><button>Go Back</button></a>';
    echo '<a href="index.php"><button>Go to main</button></a>';
}

function isCourseIdExists($id, $courseList) {
    foreach ($courseList as $course) {
        if ($course->getId() == $id) {
            return true;
        }
    }
    return false;
}

if (isset($_POST['addCoursebtn'])) {
    if (!empty($_POST['id']) && !empty($_POST['Name'])) {
        $courseId = $_POST['id'];
        
        // Check if course ID already exists
        if (isCourseIdExists($courseId, $courseList->getCoursesList())) {
            echo "Course with ID $courseId already exists.";
        } else {
            $course = new Course($courseId, $_POST['Name']);
            $courseList->addCourse($course);
            echo "Course added successfully.";
        }
    } else {
        echo "Please provide all the required information for adding a course.";
    }
    echo '<br><br>';
    echo '<a href="addCourse.php"><button>Go Back</button></a>';
    echo '<a href="index.php"><button>Go to main</button></a>';
}
?>