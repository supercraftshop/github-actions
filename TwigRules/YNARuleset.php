<?php

namespace TwigRules;

use FriendsOfTwig\Twigcs\RegEngine\RulesetBuilder;
use FriendsOfTwig\Twigcs\RegEngine\RulesetConfigurator;
use FriendsOfTwig\Twigcs\Ruleset\RulesetInterface;
use FriendsOfTwig\Twigcs\Rule;
use FriendsOfTwig\Twigcs\Validator\Violation;

class YNARuleset implements RulesetInterface
{
    private $twigMajorVersion;

    public function __construct(int $twigMajorVersion)
    {
        // Use this to customize your rules based on the major twig version
        $this->twigMajorVersion = $twigMajorVersion;
    }

    public function getRules()
    {
        $configurator = new RulesetConfigurator();
        $configurator->setTagSpacingPattern('{% expr %}');
        $configurator->setPrintStatementSpacingPattern('{{ expr }}');
        $configurator->setEmptyParenthesesSpacingPattern('()');
        $configurator->setParenthesesSpacingPattern('(expr)');
        // Dictates spaces between values
        $configurator->setListSpacingPattern('expr, expr');
        // Dictates spaces between the [] and the inside of the array.
        $configurator->setArraySpacingPattern('[expr]');
        $configurator->setEmptyArraySpacingPattern('[]');
        $configurator->setHashSpacingPattern('{key: expr, key: expr}');
        $configurator->setEmptyHashSpacingPattern('{}');
        $configurator->setTernarySpacingPattern('expr ? expr : expr||expr ?: expr');
        $configurator->setSliceSpacingPattern('[expr:expr]');
        $configurator->setUnaryOpSpacingPattern('op expr');
        $configurator->setBinaryOpSpacingPattern('expr op expr');
        // Handles the special case of expressions like "range(1..10)"
        $configurator->setRangeOpSpacingPattern('expr..expr');
        $builder = new RulesetBuilder($configurator);

        return [
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
            new Rule\UnusedMacro(Violation::SEVERITY_WARNING),
            new Rule\TrailingSpace(Violation::SEVERITY_ERROR),
        ];
    }
}
