<?php
$finder = PhpCsFixer\Finder::create()
    ->in('src')
    ->in('test')
    ->notPath('_files')
    ->filter(function (SplFileInfo $file) {
        if (strstr($file->getPath(), 'compatibility')) {
            return false;
        }
    });

return PhpCsFixer\Config::create()
    ->setRules(array(
        '@PSR2' => true,

        // Symfony
        'no_empty_statement' => true,
        'no_unused_imports' => true,
        'standardize_not_equals' => true,
        'no_whitespace_in_blank_line' => true,

        // Contrib
        'no_useless_return' => true
    ))
    ->setFinder($finder);
