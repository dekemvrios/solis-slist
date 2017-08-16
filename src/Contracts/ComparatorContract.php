<?php

namespace Solis\SList\Contracts;

/**
 * Interface ComparatorContract
 *
 * @package Solis\SList\Contracts
 */
interface ComparatorContract
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
    );
}