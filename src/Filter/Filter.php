<?php

/*
 * This file is part of the IMTDataGrid package.
 *
 * (c) Igor M. Timoshenko <igor.timoshenko@i.ua>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace IMT\DataGrid\Filter;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\Validator\Validation;

use IMT\DataGrid\Exception\InvalidOptionsException;

/**
 * This class represents the data grid filter
 *
 * @author Igor Timoshenko <igor.timoshenko@i.ua>
 */
class Filter implements FilterInterface
{
    /**
     * An array of objects of type FilterInterface
     *
     * @var FilterInterface[]
     */
    protected $filters = array();

    /**
     * An array of options
     *
     * @var array
     */
    protected $options = array();

    /**
     * An array of objects of type RuleInterface
     *
     * @var RuleInterface[]
     */
    protected $rules = array();

    /**
     * The constructor method
     *
     * @param  array                   $options An array of options
     * @throws InvalidOptionsException          If invalid options are passed
     */
    public function __construct(array $options)
    {
        $this->options = $options;

        $violations = Validation::createValidatorBuilder()
            ->addMethodMapping('loadValidatorMetadata')
            ->getValidator()
            ->validate($this);

        if (count($violations) > 0) {
            throw new InvalidOptionsException($violations);
        }
    }

    /**
     * {@inheritDoc}
     */
    public function addFilter(FilterInterface $filter)
    {
        $this->filters[] = $filter;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function addRule(RuleInterface $rule)
    {
        $this->rules[] = $rule;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function getFilters()
    {
        return $this->filters;
    }

    /**
     * {@inheritDoc}
     */
    public function getOperator()
    {
        return $this->options['groupOp'];
    }

    /**
     * {@inheritDoc}
     */
    public function getRules()
    {
        return $this->rules;
    }

    /**
     * Loads the metadata for the validator
     *
     * @param ClassMetadata $metadata
     */
    public static function loadValidatorMetadata(ClassMetadata $metadata)
    {
        $metadata->addPropertyConstraint(
            'options',
            new Assert\Collection(
                array(
                    'fields' => array(
                        'groupOp' => array(
                            new Assert\NotBlank(),
                            new Assert\Type(
                                array(
                                    'type' => 'string',
                                )
                            ),
                            new Assert\Choice(
                                array(
                                    'choices' => array(
                                        'AND',
                                        'OR',
                                    )
                                )
                            ),
                        )
                    ),
                )
            )
        );
    }
}
