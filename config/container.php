<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Hyperflex\DependencyInjection\Definition;
use Psr\Container\ContainerInterface;
use Hyperflex\Di;

/**
 * Initial a dependency injection container that implemented PSR-11 and return the container.
 */

$configFromProviders = \Hyperflex\Config\ProviderConfig::load();
$definitions = require __DIR__ . '/dependencies.php';
$dependencies = array_replace($configFromProviders['dependencies'] ?? [], $definitions['dependencies'] ?? []);
/** @var ContainerInterface $container */
if (true) {
    $container = new Di\Container(new Di\Definition\DefinitionSource($dependencies, new Di\Annotation\Scanner()));
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

return $container;