<?php
class Rules {
    const ORIENTATION = [
        'N' => ['L' => 'W', 'R' => 'E', 'M' => 'plusY' /*y+1*/],
        'E' => ['L' => 'N', 'R' => 'S', 'M' => 'plusX' /*x+1*/],
        'S' => ['L' => 'E', 'R' => 'W', 'M' => 'minusY'/*y-1*/],
        'W' => ['L' => 'S', 'R' => 'N', 'M' => 'minusX' /*x-1*/]
    ];

    const COMMANDS = ['L', 'R', 'M'];

}

