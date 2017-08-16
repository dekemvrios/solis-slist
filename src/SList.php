<?php

namespace Solis\SList;

use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\SList\Abstractions\SListAbstract;
use Solis\Breaker\TException;

/**
 * Class SList
 *
 * @package Solis\SList
 */
class SList extends SListAbstract
{

    /**
     * @return static
     */
    public static function make()
    {
        return new static();
    }

    /**
     * @param array ...$args
     *
     * @return static
     *
     * @throws TExceptionAbstract
     */
    public function addItem(...$args)
    {
        $value = $args[0];

        if (is_null($value)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "value [value] argument cannot be null",
                400
            );
        }

        $label = $args[1];
        if (is_null($value)) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                "value [description] argument cannot be null",
                400
            );
        }

        $this->addEntry(SEntry::make($value, $label));

        return $this;
    }
}