<?php
class Student
{
    private $SLastName;
    private $SFirstName;
    private $SMidName;
    private $SBirthDate;
    private $CId;
    private $dataBase;
    private $SId;


    public function __construct($SLastName, $SFirstName, $SMidName, $SBirthDate, $CId, $dataBase, $SId = -1)
    {
        $this->SLastName = $SLastName;
        $this->SFirstName = $SFirstName;
        $this->SMidName = $SMidName;
        $this->SBirthDate = $SBirthDate;
        $this->CId = $CId;
        $this->SId = $SId;

        $this->dataBase = $dataBase;
    }

    public function insert()
    {
        $check_user = $this->dataBase->getQuery("SELECT * FROM `students` WHERE `SLastName` = '$this->SLastName' AND `SFirstName` = '$this->SFirstName' AND `SMidName` = '$this->SMidName' AND `SBirthDate` = '$this->SBirthDate' AND `CId` = '$this->CId'");
        if (mysqli_num_rows($check_user) > 0) {
            return true;
        } else {
            $this->dataBase->getQuery("INSERT INTO `students` (`SLastName`, `SFirstName`, `SMidName`, `SBirthDate`, `CId`) VALUES ('$this->SLastName', '$this->SFirstName', '$this->SMidName', '$this->SBirthDate', '$this->CId')");
            return false;
        }
    }
    public function delete() {
        $this->dataBase->getQuery("DELETE FROM `students` WHERE `students`.`SId` = '$this->SId'");
    }
}