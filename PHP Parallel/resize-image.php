<?php

use Alura\Threads\Student\InMemoryStudentRepository;
use Alura\Threads\Student\Student;
use parallel\Runtime;

require_once 'vendor/autoload.php';

$repository  = new InMemoryStudentRepository();
$studentList = $repository->all();

$runtimes = [];
foreach ($studentList as $i => $student) {
    $runtimes[$i] = new Runtime(__DIR__ . '/vendor/autoload.php');
    $runtimes[$i]->run(function (Student $student) {
        echo 'Resizing ' . $student->fullName() . ' profile picture' . PHP_EOL;

        $imagePath = $student->profilePicturePath();
        [$width, $height] = getimagesize($imagePath);

        $ratio = $height / $width;

        $newWidth  = 200;
        $newHeight = 200 * $ratio;

        $sourceImage      = imagecreatefromjpeg($imagePath);
        $destinationImage = imagecreatetruecolor($newWidth, $newHeight);
        imagecopyresampled($destinationImage, $sourceImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        imagejpeg($destinationImage, __DIR__ . '/storage/resized/' . basename($imagePath));

        echo 'Finish resizing ' . $student->fullName() . ' profile picture' . PHP_EOL;
    }, [$student]);
}

foreach ($runtimes as $runtime) {
    $runtime->close();
}

echo 'Finalizando thread principal' . PHP_EOL;