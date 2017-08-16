<?php

namespace Solis\SList;

use Solis\SList\Abstractions\SEntryAbstract;

/**
 * Class SEntry
 *
 * @package Solis\SList
 */
class SEntry extends SEntryAbstract
{
    /**
     * make
     *
     * Factory method
     *
     * @param mixed $value
     * @param mixed $label
     *
     * @return \static
     */
    public static function make(
        $value,
        $label
    ) {
        $instance = new static();

        $instance->setValue($value);
        $instance->setLabel($label);
        $instance->setDescription($value . ' - ' . $label);

        return $instance;
    }
}