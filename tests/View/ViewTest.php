<?php

/*
 * This file is part of the IMTDataGrid package.
 *
 * (c) Igor M. Timoshenko <igor.timoshenko@i.ua>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IMT\DataGrid\View;

use Doctrine\Common\Collections\ArrayCollection;

use IMT\DataGrid\Column\Column;
use IMT\DataGrid\Column\ColumnCollection;
use IMT\DataGrid\View\View;

/**
 * @author Igor Timoshenko <igor.timoshenko@i.ua>
 */
class ViewTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var View
     */
    private $view;

    /**
     * {@inheritDoc}
     */
    public function setUp()
    {
        parent::setUp();

        $this->view = new View('name', array(), $this->getColumns());
    }

    /**
     * @covers IMT\DataGrid\View\View::__construct
     * @covers IMT\DataGrid\View\View::getColumns
     */
    public function testGetColumns()
    {
        $this->assertEquals($this->getColumns(), $this->view->getColumns());
    }

    /**
     * @covers IMT\DataGrid\View\View::__construct
     * @covers IMT\DataGrid\View\View::getOptions
     */
    public function testGetOptions()
    {
        $this->assertEquals(array(), $this->view->getOptions());
    }

    /**
     * @covers IMT\DataGrid\View\View::__construct
     * @covers IMT\DataGrid\View\View::getName
     */
    public function testGetName()
    {
        $this->assertEquals('name', $this->view->getName());
    }

    /**
     * @return ArrayCollection
     */
    public function getColumns()
    {
        $columnCollection = new ColumnCollection();
        $columnCollection->add($this->getColumn());
        $columnCollection->add($this->getColumn());
        $columnCollection->add($this->getColumn());

        return $columnCollection;
    }

    /**
     * @return Column
     */
    private function getColumn()
    {
        return new Column(
            array(
                'index' => 'index',
                'label' => 'label',
                'name'  => 'name',
            )
        );
    }
}
