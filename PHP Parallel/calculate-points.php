<?php

use Alura\Threads\Activity\Activity;
use Alura\Threads\Student\InMemoryStudentRepository;
use Alura\Threads\Student\Student;
use parallel\Channel;
use parallel\Future;
use parallel\Runtime;

require_once 'vendor/autoload.php';

$repository  = new InMemoryStudentRepository();
$studentList = $repository->all();

$runtimes = [];
$futures  = [];
$channel  = Channel::make('points');
foreach ($studentList as $i => $student) {
    $activities = $repository->activitiesInADay($student);

    $runtimes[$i] = new Runtime(__DIR__ . '/vendor/autoload.php');
    $futures[$i]  = $runtimes[$i]->run(function (array $activities, Student $student, Channel $channel) {
        $points = array_reduce(
            $activities,
            fn(int $total, Activity $activity) => $total + $activity->points(),
            0
        );

        $channel->send($points);

        printf("%s made %d points today\n", $student->fullName(), $points);

        return $points;
    }, [$activities, $student, $channel]);
}

$totalPointsWithChanel = 0;
for ($i = 0; $i < count($studentList); $i++) {
    $totalPointsWithChanel += $channel->recv();
}
$channel->close();

$totalPoints = array_reduce(
    $futures,
    fn(int $total, Future $future) => $total + $future->value(),
    0
);

printf("We had a total of %d points today\n", $totalPointsWithChanel);
printf("We had a total of %d points today\n", $totalPoints);