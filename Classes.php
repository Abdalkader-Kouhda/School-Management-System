<?php
interface CourseComponent {
    public function getName();
}

class Document implements CourseComponent {
    private $name;
    private $category;
    private $filename;
    private $filetype;
    private $filesize;
    private $filetmpname;

    public function __construct($name, $category, $filename, $filetype, $filesize, $filetmpname) {
        $this->name = $name;
        $this->category = $category;
        $this->filename = $filename;
        $this->filetype = $filetype;
        $this->filesize = $filesize;
        $this->filetmpname = $filetmpname;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    // ... Implement getter and setter methods for other properties
}

class Chapter implements CourseComponent {
    private $name;
    private $documents = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function getName() {
        return $this->name;
    }

    public function addDocument(Document $document) {
        $this->documents[] = $document;
    }

    public function removeDocument(Document $document) {
        $index = array_search($document, $this->documents, true);
        if ($index !== false) {
            array_splice($this->documents, $index, 1);
        }
    }

    public function removeAllDocuments() {
        $this->documents = [];
    }

    public function getDocumentByName($name) {
        foreach ($this->documents as $document) {
            if ($document->getName() === $name) {
                return $document;
            }
        }
        return null;
    }
}

class Course {
    private $id;
    private $name;
    private $grades = [];
    private $year;
    private $components = [];

    public function __construct($id, $name, $year) {
        $this->id = $id;
        $this->name = $name;
        $this->year = $year;
    }

    public function registerGrade(Student $student, $grade) {
        $this->grades[$student->getId()] = $grade;
    }

    public function getGrade(Student $student) {
        return isset($this->grades[$student->getId()]) ? $this->grades[$student->getId()] : null;
    }

    public function addComponent(CourseComponent $component) {
        $this->components[] = $component;
    }

    public function removeComponent(CourseComponent $component) {
        $index = array_search($component, $this->components, true);
        if ($index !== false) {
            array_splice($this->components, $index, 1);
        }
    }

    public function getComponentByName($name) {
        foreach ($this->components as $component) {
            if ($component->getName() === $name) {
                return $component;
            }
        }
        return null;
    }

    public function getComponentByIndex($index) {
        return isset($this->components[$index]) ? $this->components[$index] : null;
    }

    public function deleteComponentByName($name) {
        foreach ($this->components as $index => $component) {
            if ($component->getName() === $name) {
                unset($this->components[$index]);
                return true;
            }
        }
        return false;
    }
}

class CourseListClass {
    private $courses = [];

    public function addCourse(Course $course) {
        $this->courses[] = $course;
    }

    public function getAllCourses() {
        return $this->courses;
    }

    public function getCourseById($id) {
        foreach ($this->courses as $course) {
            if ($course->getId() == $id) {
                return $course;
            }
        }
        return null;
    }

    public function getCourseByName($name) {
        foreach ($this->courses as $course) {
            if ($course->getName() === $name) {
                return $course;
            }
        }
        return null;
    }
}

class Student {
    private $id;
    private $firstName;
    private $lastName;
    private $class;
    private $courses = [];

    public function __construct($id, $firstName, $lastName, $class) {
        $this->id = $id;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->class = $class;
    }

    public function getId() {
        return $this->id;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function getClass() {
        return $this->class;
    }

    public function setClass($class) {
        $this->class = $class;
    }

    public function registerCourse(Course $course) {
        if (!in_array($course, $this->courses, true)) {
            $this->courses[] = $course;
        }
    }

    public function getCourses() {
        return $this->courses;
    }
}

class StudentListClass {
    private $studentList = [];

    public function addStudent(Student $student) {
        $this->studentList[] = $student;
    }

    public function getAllStudents() {
        return $this->studentList;
    }

    public function getStudentsByCourse($courseId) {
        $students = [];

        foreach ($this->studentList as $student) {
            $courses = $student->getCourses();
            foreach ($courses as $course) {
                if ($course->getId() == $courseId) {
                    $students[] = $student;
                    break;
                }
            }
        }

        return $students;
    }

    public function getStudentById($id) {
        foreach ($this->studentList as $student) {
            if ($student->getId() == $id) {
                return $student;
            }
        }
        return null;
    }
}
?>