<?php

use Alura\Threads\Activity\Activity;
use Alura\Threads\Student\InMemoryStudentRepository;
use Alura\Threads\Student\Student;
use parallel\Runtime;
use parallel\Future;

require_once 'vendor/autoload.php';

$repository  = new InMemoryStudentRepository();
$studentList = $repository->all();

$runtimes = [];
$futures  = [];
foreach ($studentList as $i => $student) {
    $activities = $repository->activitiesInADay($student);

    $runtimes[$i] = new Runtime(__DIR__ . '/vendor/autoload.php');
    $futures[$i]  = $runtimes[$i]->run(function (array $activities, Student $student) {
        $points = array_reduce(
            $activities,
            fn(int $total, Activity $activity) => $total + $activity->points(),
            0
        );

        printf("%s made %d points today\n", $student->fullName(), $points);

        return $points;
    }, [$activities, $student]);
}

$totalPoints = array_reduce(
    $futures,
    fn(int $total, Future $future) => $total + $future->value(),
    0
);

printf("We had a total of %d points today\n", $totalPoints);