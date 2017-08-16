<?php

namespace Solis\SList\Abstractions;

/**
 * Class SEntryAbstract
 *
 * @package Solis\SList\Abstractions
 */
abstract class SEntryAbstract
{
    /**
     * $info
     *
     * @var array
     */
    protected $info;

    /**
     * __construct
     *
     * @param array $info
     */
    protected function __construct($info = [])
    {
        $this->setInfo($info);
    }

    /**
     * setInfo
     *
     * @param array $value
     */
    public function setInfo($value)
    {
        $this->info = $value;
    }

    /**
     * getInfo
     *
     * @return array
     */
    public function getInfo()
    {
        return $this->info;
    }

    /**
     * addEntry
     *
     * @param string $key
     * @param mixed  $value
     *
     * @return boolean
     */
    public function addEntry(
        $key,
        $value
    ) {
        if (array_key_exists($key, $this->info)) {
            return false;
        }

        $this->info[$key] = $value;

        return true;
    }

    /**
     * @param string $key
     * @param mixed  $value
     *
     * @return bool
     */
    public function setEntry(
        $key,
        $value
    ) {
        $this->info[$key] = $value;

        return true;
    }

    /**
     * getEntry
     *
     * @param string $key
     *
     * @return mixed
     */
    public function getEntry($key)
    {
        if (!array_key_exists($key, $this->info)) {
            return false;
        }

        return $this->info[$key];
    }

    /**
     * removeEntry
     *
     * @param string $key
     *
     * @return boolean
     */
    public function removeEntry($key)
    {
        if (!array_key_exists($key, $this->info)) {
            return false;
        }

        unset($this->info[$key]);

        return true;
    }

    /**
     * toJson
     *
     * @return string
     */
    public function toJson()
    {
        return json_encode($this->getInfo(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    }

    /**
     * toArray
     *
     * @return array
     */
    public function toArray()
    {
        return $this->getInfo();
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
        if (preg_match('/^get/', $name)) {
            return $this->getEntry(strtolower(str_replace('get', '', $name)));
        }

        if (preg_match('/^set/', $name)) {
            return $this->setEntry(
                strtolower(str_replace('set', '', $name)),
                count($arguments) == 1 ? $arguments[0] : $arguments
            );
        }

        return false;
    }
}