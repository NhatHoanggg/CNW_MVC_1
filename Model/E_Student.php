<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    class Entity_Student{
        public $id; 
        public $name;
        public $age;
        public $university;

        public function __construct($_id, $_name, $_age, $_university) { 
            $this->id = $_id;
            $this->name = $_name; 
            $this->age = $_age;
            $this->university = $_university;
        }
    } 
    ?>
</body>
</html>