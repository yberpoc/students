<?php
class ClassesList extends Common{
    public function selectAllClasses(){
        $classes = $this->dataBase->getQuery("SELECT * FROM `classes`");
        $classes = mysqli_fetch_all($classes);
        return $classes;
    }
}