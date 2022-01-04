<?php
require_once 'Rules.php';
require_once 'Plateau.php';
require_once 'Rover.php';


$i = 0;
echo 'use Ctrl+C to break' . "\n" .
    'line 0: upper-right coordinates of the plateau' . "\n" .
    'line 1: rover\'s position' . "\n" .
    'line 2: series of instructions telling the rover how to explore the plateau' . "\n";
do {
    $line = readline($i . '> ');
    if (!empty($line)) {
        readline_add_history($line);
    }

    if ($i == 0) {
        try {
            $p = Plateau::getInstance($line); //'5 5'
            $i++;
        } catch (Exception $e) {
            echo($e->getMessage() . "\n");
            $i = 0;
        }
        continue;
    }

    if ($i == 1) {
        try {
            $r = Rover::getInstance($line, $p); //'1 2 N'
            $i++;
        } catch (Exception $e) {
            echo($e->getMessage() . "\n");
            $i = 1;
        }
        continue;
    }


    if($i == 2) {
        try {
            $r->start($line); //'L M L M L M L M M'
            $i++;
            echo($r->getPosition() . "\n");
            $i = 1;
        } catch (Exception $exception) {
            echo($exception->getMessage() . "\n");
            $i = 2;
        }
        continue;
    }

} while (true);
