<?php
namespace supercraft;

use FriendsOfTwig\Twigcs\Ruleset\RulesetInterface;
use FriendsOfTwig\Twigcs\Rule;
use FriendsOfTwig\Twigcs\Validator\Violation;
use FriendsOfTwig\Twigcs\Whitelist\TokenWhitelist;
use FriendsOfTwig\Twigcs\RegEngine\RulesetConfigurator;
use FriendsOfTwig\Twigcs\RegEngine\RulesetBuilder;

class SupercraftRuleset implements RulesetInterface
{
    private $twigMajorVersion;

    public function __construct(int $twigMajorVersion = null)
    {
        // Use this to customize your rules based on the major twig version
        $this->twigMajorVersion = $twigMajorVersion;
    }

    public function getRules()
    {
        $configurator = new RulesetConfigurator();
        $configurator->setTwigMajorVersion($this->twigMajorVersion);
        $builder = new RulesetBuilder($configurator);
        $configurator->setTagSpacingPattern('{% expr %}');
        $configurator->setPrintStatementSpacingPattern('{{ expr }}');
        $configurator->setEmptyParenthesesSpacingPattern('()');
        $configurator->setParenthesesSpacingPattern('(expr)');
        $configurator->setListSpacingPattern('expr, expr'); // Dictates spaces between values
        $configurator->setArraySpacingPattern('[expr]'); // Dictates spaces between the [] and the inside of the array.
        $configurator->setEmptyArraySpacingPattern('[]');
        $configurator->setHashSpacingPattern('{key: expr, key: expr}');
        $configurator->setEmptyHashSpacingPattern('{}');
        $configurator->setUnaryOpSpacingPattern('op expr');
        $configurator->setBinaryOpSpacingPattern('expr op expr');
        $configurator->setRangeOpSpacingPattern('expr..expr');
        $configurator->setTernarySpacingPattern('expr ? expr : expr||expr ?: expr');
        $configurator->setSliceSpacingPattern('[expr:expr]');

        return [
            new Rule\UnusedMacro(Violation::SEVERITY_ERROR),
            new Rule\TrailingSpace(Violation::SEVERITY_ERROR),
            new Rule\RegEngineRule(Violation::SEVERITY_ERROR, $builder->build()),
        ];
    }
}
