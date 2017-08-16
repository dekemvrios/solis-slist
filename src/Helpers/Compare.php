<?php

namespace Solis\SList\Helpers;

use Solis\SList\Contracts\ComparatorContract;

/**
 * Class Compare
 *
 * @package Solis\SList\Helpers
 */
class Compare implements ComparatorContract
{

    /**
     * @param mixed  $val1
     * @param mixed  $val2
     * @param string $conditional
     *
     * @return bool
     */
    public function is(
        $val1,
        $val2,
        $conditional = '==='
    ) {
        return $this->compare(
            $val1,
            $val2,
            $conditional
        );
    }

    /**
     * @param        $val1
     * @param        $val2
     * @param string $conditional
     *
     * @return bool
     */
    protected function compare(
        $val1,
        $val2,
        $conditional = '==='
    ) {

        switch ($conditional) {
            case '===':
                return $val1 === $val2;
            case '!==':
                return $val1 !== $val2;
            case '==':
                return $val1 == $val2;
            case '!=':
                return $val1 != $val2;
            case '>=':
                return $val1 >= $val2;
            case '<=':
                return $val1 <= $val2;
            case '>':
                return $val1 > $val2;
            case '<':
                return $val1 < $val2;
            default:
                break;
        }

        return false;
    }
}