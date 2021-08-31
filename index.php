<?php
session_start();
require "vendor/autoload.php";
require_once 'core/config/connect.php';
require_once 'core/options/Common.php';
require_once 'core/options/StudentsList.php';
require_once 'core/options/ClassesList.php';
require_once 'core/options/Auth.php';
require_once 'core/options/Student.php';
require_once 'core/functions/auth.php';

Use eftec\bladeone\BladeOne;

$views = __DIR__ . '/views';
$cache = __DIR__ . '/cache';
$blade = new BladeOne($views,$cache,BladeOne::MODE_AUTO);


$db = new Database('localhost', 'test11amadopro', 'yberpoc', 'RG543fdsg');

$mode = $_GET['method'];

if(isset($_SESSION['auth']))
{
    $SLastName = htmlspecialchars($_POST['SLastName']);
    $SFirstName = htmlspecialchars($_POST['SFirstName']);
    $SMidName = htmlspecialchars($_POST['SMidName']);
    $SBirthDate = htmlspecialchars($_POST['SBirthDate']);
    $CId = htmlspecialchars($_POST['CId']);

    switch ($mode)
    {
        case 'show':default:
        //Работа с таблицой "Classes"
        $classesList = new ClassesList($db);
        $resultAllClasses = $classesList->selectAllClasses();

        //Работа с таблицой "Students"
        $studentsList = new StudentsList($db);
        $queryAllStudents = $studentsList->selectAllStudents();
        $queryByMinBirthDate = $studentsList->selectStudentsByMinBirthDate();
        $queryStudentsByClass = $studentsList->selectStudentByClass();
        $queryStudentsByMonth = $studentsList->selectStudentByMonth();

        echo $blade->run("page", array('resultAllClasses'=> $resultAllClasses, 'queryAllStudents' => $queryAllStudents,
            'queryByMinBirthDate' => $queryByMinBirthDate, 'queryStudentsByClass' => $queryStudentsByClass, 'queryStudentsByMonth' => $queryStudentsByMonth));
        break;
        case 'logout':
            unset($_SESSION['auth']);
            header('Location: /');
            break;
        case 'addStudent':
            if(isset($SLastName) && isset($SFirstName) && isset($SMidName) && isset($SBirthDate) && isset($CId))
            {
                $student = new Student($SLastName, $SFirstName, $SMidName, $SBirthDate, $CId, $db);
                $student->insert();
                unset($student);
            }
            header('Location: /?method=show');
            break;
        case 'delete':
            $SId = (int) $_REQUEST['SId'];
            if(isset($SId)){
                $student = new Student($SLastName, $SFirstName, $SMidName, $SBirthDate, $CId, $db, $SId);
                $student->delete();
                unset($student);
                header('Location: /?method=show');
                break;
            }
    }
} else {
    switch ($mode)
    {
        case 'auth':
            $login = htmlspecialchars($_POST['ALogin']);
            $password = htmlspecialchars($_POST['APassword']);

            auth($login, $password, $db);
            break;
        case 'wrong':
            echo $blade->run('auth', array('message' => 'Вы ввели неверный логин или пароль'));
            break;
        default:
            echo $blade->run("auth");
    }
}