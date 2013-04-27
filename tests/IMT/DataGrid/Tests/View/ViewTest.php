<?php

/*
 * This file is part of the IMTDataGrid package.
 *
 * (c) Igor M. Timoshenko <igor.timoshenko@i.ua>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IMT\DataGrid\Tests\View;

use Doctrine\Common\Collections\ArrayCollection;

use IMT\DataGrid\Column\Column;
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

        $this->view = new View('name', array(), $this->getColModel());
    }

    /**
     * @covers IMT\DataGrid\View\View::__construct
     * @covers IMT\DataGrid\View\View::getColModel
     */
    public function testGetColModel()
    {
        $this->assertEquals($this->getColModel(), $this->view->getColModel());
    }

    /**
     * @covers IMT\DataGrid\View\View::getColNames
     */
    public function testGetColNames()
    {
        $this->assertEquals(
            array(
                'label1',
                'label2',
                'label3',
            ),
            $this->view->getColNames()
        );
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
    public function getColModel()
    {
        return new ArrayCollection(
            array(
                new Column(
                    array(
                        'index' => 'index1',
                        'label' => 'label1',
                        'name'  => 'name1',
                    )
                ),
                new Column(
                    array(
                        'index' => 'index2',
                        'label' => 'label2',
                        'name'  => 'name2',
                    )
                ),
                new Column(
                    array(
                        'index' => 'index3',
                        'label' => 'label3',
                        'name'  => 'name3',
                    )
                ),
            )
        );
    }
}
