<?php

use Alura\Threads\Student\InMemoryStudentRepository;
use parallel\Runtime;

require_once 'vendor/autoload.php';

$repository  = new InMemoryStudentRepository();
$studentList = $repository->all();

$studentChunks = array_chunk($studentList, ceil(count($studentList) / 8));

$runtimes = [];
foreach ($studentChunks as $i => $studentChunk) {
    $runtimes[$i] = new Runtime(__DIR__ . '/vendor/autoload.php');
    $runtimes[$i]->run(function (array $students) {

        foreach ($students as $student) {
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
        }

    }, [$studentChunk]);
}

foreach ($runtimes as $runtime) {
    $runtime->close();
}

echo 'Finalizando thread principal' . PHP_EOL;