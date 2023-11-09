<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
    include_once("E_Student.php");
    class Model_Student {
        public function __construct() {}
        public function getAllStudent() {
            $link = mysqli_connect("localhost","root","") or  die("Couldn't connect to SQL") ;
            mysqli_select_db($link, "DULIEU2");
            $sql = "select * from sinhvien";
            $rs = mysqli_query($link, $sql);
            $i =0;
            while ($row = mysqli_fetch_array($rs)) { 
                $id = $row['id'];
                $name = $row['name'];
                $age = $row['age'];
                $university = $row['university'];
                while ($i != $id ) { 
                    $i++;
                }

                $students[$i++] = new Entity_Student($id, $name, $age, $university);
            }

            return $students;
        }

        public function getStudentDetail($stid) {
            // load du lieu tu csdl
            $allStudent = $this->getAllStudent();
            return $allStudent[$stid];
        }

        public function insertStudent($id, $name, $age, $university) { 
            $link = mysqli_connect("localhost","root","") or  die("Couldn't connect to SQL") ;
            mysqli_select_db($link, "DULIEU2");
            $sql = "select id from sinhvien where id = '$id'";

            $rs = mysqli_query($link, $sql);
            
            if (mysqli_num_rows($rs) > 0) { 
                header("Location: C_Student.php?insertStudent");
            }

            else {
                $sql = "INSERT INTO sinhvien (id, name, age, university) VALUES ( ?, ?, ?, ?)";
                $stmt = mysqli_prepare($link, $sql);
                
                mysqli_stmt_bind_param($stmt, "ssss",$id, $name, $age, $university);
                mysqli_stmt_execute($stmt);
                
                header("Location: C_Student.php?ListStudent");
            }
            
        }

        // update
        public function updateStudent($id, $name, $age, $university) {
            $link = mysqli_connect("localhost", "root", "") or die("Couldn't connect to MySQL");
            mysqli_select_db($link, "dulieu2");
    
            $sql = "UPDATE sinhvien SET id = ?, name = ?, age = ?, university = ? WHERE id = ?";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "sssss", $id, $name, $age, $university, $id);
    
            if (mysqli_stmt_execute($stmt)) {
                header("Location: C_Student.php?ListStudent");
            } else {
                echo "Cập nhật thất bại!";
            }
    
            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }
        // 

        public function deleteStudent($id) {
            $link = mysqli_connect("localhost", "root", "") or die("Couldn't connect to MySQL");
            mysqli_select_db($link, "dulieu2");

            $sql = "DELETE FROM sinhvien WHERE id = ?  ";
            $stmt = mysqli_prepare($link, $sql);
            mysqli_stmt_bind_param($stmt, "s", $id);
            

            if (mysqli_stmt_execute($stmt)) {
                header("Location: C_Student.php?ListStudent");
            } else {
                echo "Xóa thất bại!";
            }

            mysqli_stmt_close($stmt);
            mysqli_close($link);
        }

        // 

        public function searchStudent($fieldsearch, $input){
            $link = mysqli_connect("localhost","root","") or die("Couldn't connect to SQLServer");
            mysqli_select_db($link,"dulieu2");


            $sql = "SELECT * FROM sinhvien where $fieldsearch like '%$input%' ";

            
            // echo $sql;

            $rs = mysqli_query($link,$sql);

            //
            // echo '<table border = "1" width = "100%">';

            // echo '<caption> BẢNG SINH VIÊN</caption>';
            
            // echo '<tr> <th>ID</th> <th>Name</th> <th>Age</th> <th>University</th> </tr> ';
                
            // while ($row = mysqli_fetch_array($rs)){
            //     echo
            //         '<tr> 
            //         <td>'.$row['id'].'</td> 
            //         <td>'.$row['name'].'</td> 
            //         <td>'.$row['age'].'</td> 
            //         <td>'.$row['university'].'</td> 
            //         </tr> ' ;
            //     }
            
            // echo '</table>';

            // echo '<p><a href="javascript:history.back()">BACK</a></p>';
            // header("Location: ../View/SearchList.php?");
            $searchResults = array();

            while ($row = mysqli_fetch_assoc($rs)) {
                $searchResults[] = $row;
            }

            mysqli_close($link);

            return $searchResults;

        }
    }
    ?>

    
</body>
</html>