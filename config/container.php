<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Hyperflex\DependencyInjection\Definition;
use Hyperflex\Di;
use Hyperflex\Hyperflex;
use Psr\Container\ContainerInterface;

/**
 * Initial a dependency injection container that implemented PSR-11 and return the container.
 */

$configFromProviders = \Hyperflex\Config\ProviderConfig::load();
$definitions = require __DIR__ . '/dependencies.php';
$serverDependencies = array_replace($configFromProviders['dependencies'] ?? [], $definitions['dependencies'] ?? []);

/** @var ContainerInterface $container */
if (true) {
    $annotations = require __DIR__ . '/autoload/annotations.php';
    $scanDirs = $configFromProviders['scan']['paths'];
    $scanDirs = array_merge($scanDirs, $annotations['scan']['paths'] ?? []);
    
    $scanner = new Di\Annotation\Scanner();
    $definitionSource = new Di\Definition\DefinitionSource($serverDependencies, $scanDirs, $scanner);
    $container = new Di\Container($definitionSource);
} else {
    $definitionSource = Definition::reorganizeDefinitions($dependencies ?? []);
    $container = (new ContainerBuilder())->useAnnotations(true)
        ->useAutowiring(true)
        ->writeProxiesToFile(true, BASE_PATH . '/runtime/container/proxy')
        ->addDefinitions($definitionSource)
        ->build();
}


if (! $container instanceof \Psr\Container\ContainerInterface) {
    throw new \RuntimeException('The dependency injection container is invalid.');
}

return Hyperflex::setContainer($container);