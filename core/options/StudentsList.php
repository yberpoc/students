<?php
class StudentsList extends Common{
    public function selectAllStudents() {
        $query = $this->dataBase->getQuery("SELECT SId, SLastName, SFirstName, SMidName, SBirthDate, CONCAT(classes.CLevel, ' ', classes.CLetter) as CClass FROM `students` INNER JOIN classes ON students.CId = classes.CId");
        return $this->groupArray($query);
    }
    public function selectStudentsByMinBirthDate() {
        $query = $this->dataBase->getQuery("SELECT SId, SLastName, SFirstName, SMidName, SBirthDate, CONCAT(classes.CLevel, ' ', classes.CLetter) as CClass FROM `students` INNER JOIN classes ON students.CId = classes.CId WHERE SBirthDate = (SELECT MAX(SBirthDate) FROM students)");
        return $this->groupArray($query);
    }

    private function groupArray($query) {
        $resultQueryStudent = [];
        while ($queryStudent = mysqli_fetch_assoc($query)) {
            $resultQueryStudent[] = $queryStudent;
        }
        //return $resultQueryStudent;
        return $this->groupArrayByKey('CClass', $resultQueryStudent);
    }

    private function groupArrayByKey($key, $array) {
        $newArray = [];
        foreach ($array as $k => $value) {
            $newArray[$value[$key]][] = $array[$k];
        }
        return $newArray;
    }

    public function selectStudentByClass() {
        $query = $this->dataBase->getQuery("SELECT * FROM students WHERE CId = 2");
        return $this->fetchAll($query);
    }
    public function selectStudentByMonth() {
        $query = $this->dataBase->getQuery("SELECT * FROM `students` WHERE MONTH(SBirthDate) = 7");
        return $this->fetchAll($query);
    }
    private function fetchAll($query){
        return mysqli_fetch_all($query);
    }
}