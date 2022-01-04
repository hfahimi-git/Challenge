<?php

/**
 * Class Rover
 */
class Rover {
    /**
     * @var string
     */
    private $orientation;
    /**
     * @var int
     */
    private $x;
    /**
     * @var int
     */
    private $y;
    /**
     * @var Plateau $plateau
     */
    private $plateau;

    /**
     * Rover constructor.
     * @param int $x
     * @param int $y
     * @param string $orientation
     * @param Plateau $plateau
     */
    private function __construct($x, $y, $orientation, $plateau) {
        $this->orientation = $orientation;
        $this->x = $x;
        $this->y = $y;
        $this->plateau = $plateau;
    }

    /**
     * @param array $coordinates
     * @param Plateau $plateau
     * @return array
     * @throws Exception
     */
    private static function getValidatedMaxCoordinates(array $coordinates, Plateau $plateau) {

        //check correctness pattern of coordinates
        if (count($coordinates) < 3) {
            throw new Exception('invalid rover position, example: integer[space]integer[space][N|E|S|W]');
        }

        //check coordinates are integer number
        if (!is_numeric($coordinates[0]) || !is_numeric($coordinates[1])) {
            throw new Exception('rover position must be integer');
        }

        //make coordinates real integer
        $coordinates[0] = (int)$coordinates[0];
        $coordinates[1] = (int)$coordinates[1];

        //check coordinates exceeded plateau boundaries
        if ($coordinates[0] > $plateau->getXBoundary() || $coordinates[1] > $plateau->getYBoundary()) {
            throw new Exception('rover coordinates exceeded plateau boundaries');
        }

        //check coordinates are greater than zero
        if ($coordinates[0] < 0 || $coordinates[1] < 0) {
            throw new Exception('rover coordinates must not be negative');
        }

        //check orientation is valid
        if (!in_array($coordinates[2], array_keys(Rules::ORIENTATION))) {
            throw new Exception('rover orientation must be N, E, S or W');
        }

        return $coordinates;
    }

    /**
     * @param $startPosition
     * @param Plateau $plateau
     * @return Rover
     * @throws Exception
     */
    public static function getInstance($startPosition, Plateau $plateau) {
        $startPosition = explode(' ', $startPosition, 3);
        try {
            $startPosition = self::getValidatedMaxCoordinates($startPosition, $plateau);
            return new self($startPosition[0], $startPosition[1], $startPosition[2], $plateau);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @throws Exception
     */
    private function plusY() {
        if ($this->y >= $this->plateau->getYBoundary()) {
            throw new Exception('rover\'s y exceeded');
        }
        $this->y = $this->y + 1;
    }

    /**
     * @throws Exception
     */
    private function plusX() {
        if ($this->x >= $this->plateau->getXBoundary()) {
            throw new Exception('rover\'s x exceeded');
        }
        $this->x = $this->x + 1;
    }

    /**
     * @throws Exception
     */
    private function minusY() {
        if ($this->y <= 0) {
            throw new Exception('rover\'s y can not be negative');
        }
        $this->y = $this->y - 1;
    }

    /**
     * @throws Exception
     */
    private function minusX() {
        if ($this->x <= 0) {
            throw new Exception('rover\'s x can not be negative');
        }
        $this->x = $this->x - 1;
    }

    /**
     * @param string $commands
     * @return string
     * @throws Exception
     */
    public function start($commands) {
        $commands = explode(' ', $commands);

        //check valid of all elements in commands string
        if (count(array_diff($commands, Rules::COMMANDS)) > 0) {
            throw new Exception('invalid commands string');
        }

        foreach ($commands as $command) {
            if ($command == Rules::COMMANDS[2]) {
                $this->move();
            }
            else {
                $this->spin($command);
            }
        }
    }

    /**
     *
     */
    private function move() {
        $function = Rules::ORIENTATION[$this->orientation]['M'];
        $this->$function();
    }

    /**
     * @param $command
     */
    private function spin($command) {
        $this->orientation = Rules::ORIENTATION[$this->orientation][$command];
    }

    /**
     * @return string
     */
    public function getPosition() {
        return $this->x . ' ' . $this->y . ' ' . $this->orientation;
    }

}
