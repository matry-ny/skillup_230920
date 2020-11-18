<?php

declare(strict_types=1);

error_reporting(E_ALL);

require_once __DIR__ . '/Human.php';
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/Mentor.php';

//var_dump(Student::BIOLOGIC);

$student = new Student();
$student->setName('Mark Antonio');
$student->setAge(22);
$student->setName('Mark Antonio II');

$student2 = new Student();
$student2->setName('Augusto Pinochet');
$student2->setAge(32);

$mentor = new Mentor();
$mentor->setName('Phillip Kirkorov');
$mentor->setAge(58);

//echo "{$student->getName()}: {$student->makeHomework()}", PHP_EOL;
//echo "{$student2->getName()}: {$student2->makeHomework()}", PHP_EOL;
//echo "{$mentor->getName()}: {$mentor->checkHomework()}", PHP_EOL;

$student2->breathe('O2');
$student2->breathe('O2');
$student2->breathe('O2');
$student2->breathe('O2');

//var_dump($student, $student2, $mentor);

//var_dump($student->writeCode(), $mentor->writeCode());

changeMentor($mentor);

function changeMentor(Mentor $mentor)
{
    $mentor->setName('Inside Function');
}

$mentor2 = clone $mentor;
$mentor2->setName('Mentor Two');
$mentor->setName('Mentor One');
//var_dump($mentor, $mentor2);

var_dump($student instanceof Human, $mentor instanceof Human);

// Homework
// создать классы Homework, Mentor, Student
// реализовать переброс задания:
// - от ментора к студенту для выполнения
// - от студента к ментору на проверку
// - от метрора к студенту с результатом проверки

