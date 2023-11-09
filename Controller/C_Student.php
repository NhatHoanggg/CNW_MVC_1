<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once("../Model/M_Student.php");
    class Ctrl_Student {
        public function getStudent() {
            if (isset($_GET['stid']) ) { 
                $modelStudent = new Model_Student();
                $student = $modelStudent->getStudentDetail($_GET['stid']);
                include_once("../View/StudentDetail.html");
            }

        // insert student 
            else if (isset($_POST["insertStudentBtn"])){
                $id = $_REQUEST['id'];
                $name = $_REQUEST['name'];
                $age = $_REQUEST['age'];
                $university = $_REQUEST['university'];
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->insertStudent($id, $name, $age, $university);
                header("Location: C_Student.php" );
            }
            
            else if (isset($_GET["insertStudent"])) {
                include_once("../View/InsertStudent.html");
            }
        // end insert student

        // update student
            else if (isset($_POST["updateStudentBtn"])){
                $id = $_REQUEST['id'];
                $name = $_REQUEST['name'];
                $age = $_REQUEST['age'];
                $university = $_REQUEST['university'];
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->updateStudent($id, $name, $age, $university);
                header("Location: C_Student.php" );
            }

            else if (isset($_GET['id_update']) ) { 
                $modelStudent = new Model_Student();
                $student = $modelStudent->getStudentDetail($_GET['id_update']);
                include_once("../View/UpdateStudent.html");
                // include_once("../View/StudentDetail.html");
            }
            
            else if (isset($_GET["updateStudent"])) {
                // include_once("../View/updateStudent.html");
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->getAllStudent();
                include_once("../View/UpdateList.html");
            }
        // end update student

        
        // delete student
            else if (isset($_GET['id_delete']) ) { 
                $id = $_GET['id_delete'];
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->deleteStudent($id);
                header("Location: C_Student.php" );
            }

            else if (isset($_GET["deleteStudent"])) {
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->getAllStudent();
                include_once("../View/DeleteList.html");
            }   
        // end delete student 

        // find student 
            else if (isset($_POST["searchBtn"])){
                $selectfield = $_POST["select"];
                $input = $_POST["input"];
                echo $selectfield;
                echo $input;

                $modelStudent = new Model_Student();
                $studentList = $modelStudent->searchStudent($selectfield, $input);
                // header("Location: C_Student.php" );
                include("../View/SearchList.html");
            }

            else if (isset($_GET["searchStudent"])) {
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->getAllStudent();
                include_once("../View/SearchStudent.html");
            }   

            
        // end find student 

            else { 
                $modelStudent = new Model_Student();
                $studentList = $modelStudent->getAllStudent();
                include_once("../View/StudentList.html");
            }
        }

    } 


    $C_Student = new Ctrl_Student();
        $C_Student->getStudent();   
    ?>

</body>
</html>