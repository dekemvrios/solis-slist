<?php

namespace Solis\SList\Abstractions;

use Solis\Breaker\TException;
use Solis\SList\Contracts\ComparatorContract;

/**
 * Class SListAbstract
 *
 * @package Solis\SList\Abstractions
 */
abstract class SListAbstract
{

    /**
     * @var SEntryAbstract[]
     */
    protected $entries = [];

    /**
     * @var ComparatorContract
     */
    protected $comparator;

    /**
     * SListAbstract constructor.
     *
     * @param ComparatorContract $comparator
     */
    protected function __construct(ComparatorContract $comparator = null)
    {
        if (!empty($comparator)) {
            $this->setComparator($comparator);
        }
    }

    /**
     * @return SEntryAbstract[]
     */
    public function getEntries(): array
    {
        return $this->entries;
    }

    /**
     * @param SEntryAbstract[] $entries
     */
    public function setEntries(array $entries)
    {
        $this->entries = $entries;
    }

    /**
     * @param SEntryAbstract $entry
     */
    public function addEntry(SEntryAbstract $entry)
    {
        $this->entries[] = $entry;
    }

    /**
     * @return ComparatorContract
     */
    public function getComparator(): ComparatorContract
    {
        return $this->comparator;
    }

    /**
     * @param ComparatorContract $comparator
     */
    public function setComparator(ComparatorContract $comparator)
    {
        $this->comparator = $comparator;
    }

    /**
     * @param array ...$args
     *
     * @return static
     */
    abstract public function addItem(...$args);

    /**
     * @param $name
     *
     * @return array
     */
    public function getListOfProperty($name)
    {
        $list = [];

        if (empty($this->getEntries())) {
            return $list;
        }

        foreach ($this->getEntries() as $entry) {
            $value = $entry->getEntry($name);
            if (!is_null($value)) {
                $list[] = $value;
            }
        }

        return $list;
    }

    /**
     * @param mixed  $property
     * @param mixed  $value
     * @param string $operator
     *
     * @return boolean|self
     *
     * @throws TException
     */
    public function where(
        $property,
        $value,
        $operator = '==='
    ) {
        if (empty($this->getEntries())) {
            return false;
        }

        if (empty($this->getComparator())) {
            throw new TException(
                __CLASS__,
                __METHOD__,
                'a instance of comparator has not been set for this list',
                500
            );
        }

        $entries = array_filter(
            $this->getEntries(),
            function (SEntryAbstract $entry) use
            (
                $property,
                $value,
                $operator
            ) {
                $entryValue = $entry->getEntry($property);

                return $this->getComparator()->is(
                    $value,
                    $entryValue,
                    $operator
                );
            }
        );

        if (empty($entries)) {
            return false;
        }

        $newList = new static();
        $newList->setEntries(array_values($entries));

        return $newList;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->getEntries());
    }

    /**
     * @param string $name
     * @param mixed  $arguments
     *
     * @return mixed
     */
    public function __call(
        $name,
        $arguments
    ) {
        if (preg_match(
            '/^getListOf/',
            $name
        )) {
            return $this->getListOfProperty(
                strtolower(
                    str_replace(
                        'getListOf',
                        '',
                        $name
                    )
                )
            );
        }

        return false;
    }
}
