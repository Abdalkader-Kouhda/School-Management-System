<?php
class Student{
    public $id;
    public $firstName;
    public $lastName;
    public $class;
	public $courses =array();

    public function __construct($id, $firstName, $lastName, $class) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->class = $class; 
   
    }

	public function registerCourse($course) {
		if(!in_array($course,$this->courses)){
		array_push($this->courses, $course);
	}
}

	
    public function getCourses() {
        return $this->courses;
    }

}
class StudentListClass{
    public $studentList ;
	
	public function getClasses()
	{	
		$temp_array = array();
		
		foreach ($this->studentList as $key => $value) {
			
			if ( !empty($value->class) && !in_array($value->class, $temp_array) ){
				array_push($temp_array,$value->class);
			}
		}
		return $temp_array;		
	}
	
	public function getStudentByClass($class)
	{	
		foreach ($this->studentList as $key=>$value) {
		
		if ($value->class == $class){
			$studentClass[] = $value;
		}
		}
		return $studentClass;
	}

	public function getAllStudents()
	{ 
		foreach ($this->studentList as $key=>$value)
		{
			$allStudents[]= $value;
		}
		return $allStudents;
	}

	// Get an array of course objects for the given student ID


	
 }

 class Course{
    public $id;
    public $Name;

    public function __construct($id, $Name) {
        $this->id = $id;
        $this->Name = $Name;    
    }
}
class CoursetListClass{
    public $CoursesList ;
	
	public function getAllCourses()
	{ 
		foreach ($this->CoursesList as $key=>$value)
		{
			$allCourses[]= $value;
		}
		return $allCourses;
	}

	public function getCourseById($id) {
		foreach ($this->CoursesList as $course) {
			if ($course->id == $id) {
				return $course;
			}
		}
		return null;
	}
	
 }



?>
