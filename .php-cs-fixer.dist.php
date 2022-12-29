<?php
/**
 * Rules we follow are from PSR-2 as well as the rectified PSR-2 guide.
 *
 * - https://mlocati.github.io/php-cs-fixer-configurator
 * - https://github.com/FriendsOfPHP/PHP-CS-Fixer
 * - https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-2-coding-style-guide.md
 * - https://github.com/php-fig-rectified/fig-rectified-standards/blob/master/PSR-2-R-coding-style-guide-additions.md
 *
 * If something isn't addressed in either of those, some other common community rules are
 * used that might not be addressed explicitly in PSR-2 in order to improve code quality.
 *
 * For instance: removing trailing white space, removing extra line breaks where
 * they're not needed (back to back, beginning or end of function/class, etc.),
 * adding trailing commas in the last line of an array, etc.
 *
 * Run check: vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --dry-run --using-cache=no
 * Run fix: vendor/bin/php-cs-fixer fix --config=.php_cs.dist -v --using-cache=no
 */

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__)
    ->exclude([
        'ci',
        'docker',
        'runtime',
        'vendor',
        'tests/_support/_generated',
    ]);

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@PSR1' => true,
        '@PSR2' => true,
        '@PSR12' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['operators' => ['=' => 'single_space', '=>' => 'single_space']],
        'cast_spaces' => ['space' => 'none'],
        'combine_consecutive_unsets' => true,
        'concat_space' => ['spacing' => 'one'],
        'linebreak_after_opening_tag' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_extra_blank_lines' => true,
        'no_trailing_comma_in_singleline' => true,
        'no_whitespace_in_blank_line' => true,
        'no_spaces_around_offset' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'normalize_index_brace' => true,
        'phpdoc_indent' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'single_quote' => true,
        'trailing_comma_in_multiline' => true,
        'trim_array_spaces' => true,
        'method_argument_space' => ['on_multiline' => 'ignore'],
        'no_break_comment' => false,
        'blank_line_before_statement' => ['statements' => ['return', 'try']],
        'single_import_per_statement' => false,
    ])
    ->setFinder($finder);
