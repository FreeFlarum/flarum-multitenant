<?php

use Doctum\Doctum;
use Doctum\RemoteRepository\GitHubRemoteRepository;
use Symfony\Component\Finder\Finder;

$dir = 'src';
$iterator = Finder::create()
    ->files()
    ->name('*.php')
    ->in($dir);

return new Doctum($iterator, [
    'title' => 'Flarum SSO PHP Plugin API Docs',
    'theme' => 'flarum',
    'source_dir' => dirname($dir) . '/',
    'build_dir' => 'docs',
    'template_dirs' => [__DIR__ . '/themes/flarum'],
    'remote_repository' => new GitHubRemoteRepository('maicol07/flarum-sso-php-plugin', dirname($dir)),
    'source_url' => 'https://github.com/maicol07/flarum-sso-php-plugin'
]);
