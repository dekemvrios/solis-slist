<?php

namespace Solis\SList;

use Solis\Breaker\Abstractions\TExceptionAbstract;
use Solis\SList\Abstractions\SListAbstract;
use Solis\Breaker\TException;
use Solis\SList\Helpers\Compare;

/**
 * Class SList
 *
 * @package Solis\SList
 */
class SList extends SListAbstract
{

    /**
     * @param array $data
     *
     * @return static
     *
     * @throws TExceptionAbstract
     */
    public static function make(array $data = [])
    {
        $instance = new static(new Compare());

        if (!empty($data)) {
            foreach ($data as $entry) {
                if (!is_array($entry) || empty($entry)) {
                    throw new TException(
                        __CLASS__,
                        __METHOD__,
                        "entry must be an not empty array",
                        400
                    );
                }

                if (count($entry) == 1) {
                    throw new TException(
                        __CLASS__,
                        __METHOD__,
                        "entry have two indexes. First for value e second for label",
                        400
                    );
                }

                $instance->addItem(
                    $entry[0],
                    $entry[1]
                );
            }
        }

        return $instance;
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

        $this->addEntry(
            SEntry::make(
                $value,
                $label
            )
        );

        return $this;
    }
}