<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Hyperflex\Framework\DependencyInjection\Definition;
use Hyperflex\Di;
use Hyperflex\Framework\Hyperflex;
use Psr\Container\ContainerInterface;

/**
 * Initial a dependency injection container that implemented PSR-11 and return the container.
 */

$configFromProviders = \Hyperflex\Config\ProviderConfig::load();
$definitions = include __DIR__ . '/dependencies.php';
$serverDependencies = array_replace($configFromProviders['dependencies'] ?? [], $definitions['dependencies'] ?? []);

$annotations = include __DIR__ . '/autoload/annotations.php';
$scanDirs = $configFromProviders['scan']['paths'];
$scanDirs = array_merge($scanDirs, $annotations['scan']['paths'] ?? []);

// @TODO Handle different path level.
$scanDirs = [
    'vendor/hyperflex',
    'app',
];

$scanner = new Di\Annotation\Scanner();
$definitionSource = new Di\Definition\DefinitionSource($serverDependencies, $scanDirs, $scanner);
$container = new Di\Container($definitionSource);


if (! $container instanceof \Psr\Container\ContainerInterface) {
    throw new \RuntimeException('The dependency injection container is invalid.');
}

return Hyperflex::setContainer($container);