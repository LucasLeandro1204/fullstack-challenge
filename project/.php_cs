<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude(['bootstrap', 'node_modules', 'public', 'resources', 'storage', 'vendor'])
    ->in(__DIR__)
    ->ignoreDotFiles(true)
    ->ignoreVCS(true);

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
    ])
    ->setFinder($finder)
    ->setUsingCache(true);
