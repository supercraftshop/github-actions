<?php
namespace YNA;

use Allocine\Twigcs\Ruleset\RulesetInterface;
use Allocine\Twigcs\Rule;
use Allocine\Twigcs\Validator\Violation;
use Allocine\Twigcs\Whitelist\TokenWhitelist;

class YNARuleset implements RulesetInterface
{
    private $twigMajorVersion;

    public function __construct(int $twigMajorVersion = null)
    {
        // Use this to customize your rules based on the major twig version
        $this->twigMajorVersion = $twigMajorVersion;
    }

    public function getRules()
    {
//        $configurator = new RulesetConfigurator();
//        $configurator->setTwigMajorVersion($this->twigMajorVersion);
//        $builder = new RulesetBuilder($configurator);

        return [
            new Rule\DelimiterSpacing(Violation::SEVERITY_ERROR, 1),
            new Rule\ParenthesisSpacing(Violation::SEVERITY_ERROR, 0, 1),
            new Rule\ArraySeparatorSpacing(Violation::SEVERITY_ERROR, 0, 1),
            new Rule\HashSeparatorSpacing(Violation::SEVERITY_ERROR, 0, 1),
            new Rule\PunctuationSpacing(
                Violation::SEVERITY_ERROR,
                ['|', '.', '..', '[', ']'],
                0,
                new TokenWhitelist([
                    ')',
                    \Twig\Token::NAME_TYPE,
                    \Twig\Token::NUMBER_TYPE,
                    \Twig\Token::STRING_TYPE
                ], [2])
            ),
            new Rule\TernarySpacing(Violation::SEVERITY_ERROR, 1),
            new Rule\UnusedMacro(Violation::SEVERITY_WARNING),
            new Rule\SliceShorthandSpacing(Violation::SEVERITY_ERROR),
            new Rule\TrailingSpace(Violation::SEVERITY_ERROR),
        ];
    }
}
