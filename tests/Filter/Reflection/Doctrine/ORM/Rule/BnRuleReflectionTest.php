<?php

/*
 * This file is part of the IMTDataGrid package.
 *
 * (c) Igor M. Timoshenko <igor.timoshenko@i.ua>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IMT\DataGrid\Filter\Reflection\Doctrine\ORM\Rule;

use Doctrine\ORM\QueryBuilder;

use IMT\DataGrid\Filter\Reflection\Doctrine\ORM\Rule\BnRuleReflection;
use IMT\DataGrid\Filter\Reflection\Doctrine\ORM\AbstractTestCase;

/**
 * @author Igor Timoshenko <igor.timoshenko@i.ua>
 */
class BnRuleReflectionTest extends AbstractTestCase
{
    /**
     * @var BnRuleReflection
     */
    private $ruleReflection;

    /**
     * {@inheritDo}
     */
    public function setUp()
    {
        parent::setUp();

        $this->ruleReflection = new BnRuleReflection($this->queryBuilder);
    }

    /**
     * @covers IMT\DataGrid\Filter\Reflection\Doctrine\ORM\Rule\BnRuleReflection::doReflect
     */
    public function testDoReflect()
    {
        $this->assertEquals(
            'NOT(field LIKE ?1)',
            (string) $this->ruleReflection->doReflect($this->getRuleMock())
        );
    }

    /**
     * @covers IMT\DataGrid\Filter\Reflection\Doctrine\ORM\Rule\BnRuleReflection::setParameterValue
     */
    public function testSetParameterValue()
    {
        $this
            ->ruleReflection
            ->setParameterValue($this->getRuleMock()->getData());

        $this->assertEquals(
            'data%',
            $this->queryBuilder->getParameter(1)->getValue()
        );
    }
}
