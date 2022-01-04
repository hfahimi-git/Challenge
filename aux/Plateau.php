<?php
class Plateau {

    /**
     * @var int
     */
    private $xBoundary;
    /**
     * @var int
     */
    private $yBoundary;

    /**
     * Plateau constructor.
     * @param int $xBoundary
     * @param int $yBoundary
     */
    private function __construct($xBoundary, $yBoundary) {
        $this->xBoundary = $xBoundary;
        $this->yBoundary = $yBoundary;
    }

    /**
     * @param array $coordinates
     * @return array
     * @throws Exception
     */
    private static function getValidatedMaxCoordinates(array $coordinates) {

        //check correctness pattern of coordinates
        if (count($coordinates) < 2) {
            throw new Exception('invalid plateau coordinates, example: integer[space]integer');
        }

        //check coordinates are integer number
        if (!is_numeric($coordinates[0]) || !is_numeric($coordinates[1])) {
            throw new Exception('plateau coordinates must be integer');
        }

        //make coordinates real integer
        $coordinates[0] = (int)$coordinates[0];
        $coordinates[1] = (int)$coordinates[1];

        //check coordinates are greater than zero
        if ($coordinates[0] < 0 || $coordinates[1] < 0) {
            throw new Exception('plateau coordinates must not be negative');
        }
        return $coordinates;
    }

    /**
     * @param string $maxCoordinates
     * @return Plateau
     * @throws Exception
     */
    public static function getInstance($maxCoordinates) {
        $coordinates = explode(' ', $maxCoordinates, 2);
        try {
            $coordinates = self::getValidatedMaxCoordinates($coordinates);
            return new self($coordinates[0], $coordinates[1]);
        } catch (Exception $e) {
            throw $e;
        }
    }

    /**
     * @return int
     */
    public function getXBoundary() {
        return $this->xBoundary;
    }

    /**
     * @return int
     */
    public function getYBoundary() {
        return $this->yBoundary;
    }
}

