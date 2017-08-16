<?php

namespace Solis\SList\Abstractions;

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
     * @param string $name
     * @param mixed  $arguments
     *
     * @return mixed
     */
    public function __call(
        $name,
        $arguments
    ) {
        if (preg_match('/^getListOf/', $name)) {
            return $this->getListOfProperty(strtolower(str_replace('getListOf', '', $name)));
        }

        return false;
    }
}