<?php
/**
 * Initial a dependency injection container that implemented PSR-11 and return the container.
 */

declare(strict_types=1);

use Hyperflex\Config\ProviderConfig;
use Hyperflex\Di\Annotation\Scanner;
use Hyperflex\Di\Container;
use Hyperflex\Di\Definition\DefinitionSource;
use Hyperflex\Framework\Hyperflex;


$configFromProviders = ProviderConfig::load();
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

$definitionSource = new DefinitionSource($serverDependencies, $scanDirs, new Scanner());
$container = new Container($definitionSource);


if (! $container instanceof \Psr\Container\ContainerInterface) {
    throw new RuntimeException('The dependency injection container is invalid.');
}

return Hyperflex::setContainer($container);