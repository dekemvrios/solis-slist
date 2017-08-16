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
        $list = SList::make();

        $list->addItem(
            1,
            'first item of the list'
        );
        $list->addItem(
            2,
            'second item of the list'
        );
        $list->addItem(
            3,
            'third item of the list'
        );
        $list->addItem(
            4,
            'fourth item of the list'
        );
        $list->addItem(
            4,
            'fifth item of the list, but its value is 4'
        );

        return $list;
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