#!/bin/sh

cp /action/problem-matcher.json /github/workflow/problem-matcher.json

echo "::add-matcher::${RUNNER_TEMP}/_github_workflow/problem-matcher.json"

if [ -z "${INPUT_ENABLE_WARNINGS}" ] || [ "${INPUT_ENABLE_WARNINGS}" = "false" ]; then
    echo "Check for warnings disabled"

    ${INPUT_PHPCS_BIN_PATH} -n --standard=YNA --standatd--report=checkstyle --ignore=${INPUT_PHPCS_IGNORE_PATHS} ${INPUT_PHPCS_PATHS}
else
    echo "Check for warnings enabled"

    ${INPUT_PHPCS_BIN_PATH} --standard=YNA --report=checkstyle --ignore=${INPUT_PHPCS_IGNORE_PATHS} ${INPUT_PHPCS_PATHS}
fi

/root/.composer/vendor/friendsoftwig/twigcs/bin/twigcs --ruleset \\TwigRules\\YNARuleset ${INPUT_TWIGCS_PATHS}

status=$?

echo "::remove-matcher owner=phpcs::"

exit $status
