<?php

use Solis\SList\Abstractions\SListAbstract;
use Solis\SList\SList;

/**
 * Class MockList
 */
class MockList
{
    /**
     * @return SListAbstract
     */
    public function getList()
    {
        $data = [
            [
                1,
                'first item of the list',
            ],
            [
                2,
                'second item of the list',
            ],
            [
                3,
                'third item of the list',
            ],
            [
                4,
                'fourth item of the list',
            ],
            [
                4,
                'fifth item of the list, but its value is 4',
            ],
        ];

        return SList::make($data);
    }
}

/**
 * Class TExceptionTest
 */
class SListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * testHasExpectedItem
     */
    public function testHasExpectedNumberOfEntries()
    {
        $list = (new MockList())->getList();

        $this->assertEquals(
            5,
            $list->count(),
            'List has not the expected number of values'
        );

        return $list;
    }

    /**
     * testHasExpectedNumberOfEntriesWithWhereClause
     *
     * @param SListAbstract $list
     *
     * @depends testHasExpectedNumberOfEntries
     */
    public function testHasExpectedNumberOfEntriesWithWhereClause(SListAbstract $list)
    {
        $this->assertEquals(
            2,
            $list->where(
                'value',
                4
            )->count(),
            'List has not the expected number of values'
        );
    }
}